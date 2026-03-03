<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $orders = $request->user()
            ->orders()
            ->with('items.product:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate($request->per_page ?? 15);

        return $this->paginated($orders);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'shipping_address_id' => ['required', 'exists:addresses,id'],
            'payment_method' => ['required', 'string'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->isEmpty()) {
            return $this->error('السلة فارغة', 400);
        }

        $address = $user->addresses()->find($validated['shipping_address_id']);
        if (!$address) {
            return $this->error('العنوان غير موجود', 404);
        }

        try {
            DB::beginTransaction();

            $subtotal = $cart->getSubtotal();

            $order = Order::create([
                'user_id' => $user->id,
                'store_id' => $cart->items->first()->product->store_id,
                'subtotal' => $subtotal,
                'discount' => 0,
                'tax' => $subtotal * 0.15, // 15% VAT
                'shipping_cost' => 0,
                'total' => $subtotal * 1.15,
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

                // Update stock
                if ($item->product->track_inventory) {
                    $item->product->decrement('stock', $item->quantity);
                }

                // Update sales count
                $item->product->increment('sales_count', $item->quantity);
            }

            // Clear cart
            $cart->clear();

            DB::commit();

            return $this->success($order->load('items.product'), 'تم إنشاء الطلب بنجاح', 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('حدث خطأ أثناء إنشاء الطلب', 500);
        }
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        if ($order->user_id !== $request->user()->id) {
            return $this->error('غير مصرح', 403);
        }

        $order->load(['items.product.media', 'store:id,name']);

        return $this->success($order);
    }
}
