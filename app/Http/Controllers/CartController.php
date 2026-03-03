<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $this->getOrCreateCart($request);
        $cart->load('items.product.media');

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
            'product_color' => 'nullable|string',
            'product_size' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->isOutOfStock()) {
            return back()->with('error', 'المنتج غير متوفر');
        }

        $options = [];
        if (!empty($validated['product_color'])) {
            $options['color'] = $validated['product_color'];
        }
        if (!empty($validated['product_size'])) {
            $options['size'] = $validated['product_size'];
        }

        $cart = $this->getOrCreateCart($request);
        $cart->addItem(
            $validated['product_id'],
            $validated['quantity'] ?? 1,
            $options
        );

        return back()->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getOrCreateCart($request);
        $cart->updateItemQuantity($validated['item_id'], $validated['quantity']);

        return back()->with('success', 'تم تحديث الكمية');
    }

    public function remove(Request $request, int $id)
    {
        $cart = $this->getOrCreateCart($request);
        $cart->removeItem($id);

        return back()->with('success', 'تم إزالة المنتج من السلة');
    }

    public function clear(Request $request)
    {
        $cart = $this->getOrCreateCart($request);
        $cart->clear();

        return back()->with('success', 'تم إفراغ السلة');
    }

    private function getOrCreateCart(Request $request): Cart
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }

        $sessionId = $request->session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }
}
