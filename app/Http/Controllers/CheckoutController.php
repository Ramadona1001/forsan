<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('items.product.media')->first();

        if (!$cart || $cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        $addresses = auth()->user()->addresses;

        return view('checkout.index', compact('cart', 'addresses'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:cod,card,wallet',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = Cart::where('user_id', auth()->id())->with('items.product')->first();

        if (!$cart || $cart->isEmpty()) {
            return back()->with('error', 'السلة فارغة');
        }

        $address = auth()->user()->addresses()->findOrFail($validated['address_id']);

        try {
            DB::beginTransaction();

            $subtotal = $cart->getSubtotal();
            $tax = $subtotal * 0.15;
            $total = $subtotal + $tax;

            $order = Order::create([
                'user_id' => auth()->id(),
                'store_id' => $cart->items->first()->product->store_id,
                'subtotal' => $subtotal,
                'discount' => 0,
                'tax' => $tax,
                'shipping_cost' => 0,
                'total' => $total,
                'status' => OrderStatus::PENDING,
                'payment_status' => PaymentStatus::PENDING,
                'payment_method' => $validated['payment_method'],
                'shipping_address' => $address->toArray(),
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'total' => $item->product->price * $item->quantity,
                    'options' => $item->options,
                ]);

                if ($item->product->track_inventory) {
                    $item->product->decrement('stock', $item->quantity);
                }
                $item->product->increment('sales_count', $item->quantity);
            }

            $cart->clear();

            DB::commit();

            return redirect()
                ->route('checkout.success', $order)
                ->with('success', 'تم إنشاء طلبك بنجاح!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء معالجة طلبك. يرجى المحاولة مرة أخرى.');
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('checkout.success', compact('order'));
    }
}
