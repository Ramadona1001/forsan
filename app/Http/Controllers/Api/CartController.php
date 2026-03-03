<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $cart = $this->getOrCreateCart($request);
        $cart->load('items.product.media');

        return $this->success([
            'items' => $cart->items,
            'subtotal' => $cart->getSubtotal(),
            'items_count' => $cart->getItemsCount(),
        ]);
    }

    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['integer', 'min:1'],
            'options' => ['nullable', 'array'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->isOutOfStock()) {
            return $this->error('المنتج غير متوفر', 400);
        }

        $cart = $this->getOrCreateCart($request);
        $item = $cart->addItem(
            $validated['product_id'],
            $validated['quantity'] ?? 1,
            $validated['options'] ?? []
        );

        return $this->success($item->load('product'), 'تمت الإضافة إلى السلة');
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'item_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $this->getOrCreateCart($request);
        $cart->updateItemQuantity($validated['item_id'], $validated['quantity']);

        return $this->success(null, 'تم تحديث الكمية');
    }

    public function remove(Request $request, int $id): JsonResponse
    {
        $cart = $this->getOrCreateCart($request);
        $cart->removeItem($id);

        return $this->success(null, 'تم إزالة المنتج من السلة');
    }

    public function clear(Request $request): JsonResponse
    {
        $cart = $this->getOrCreateCart($request);
        $cart->clear();

        return $this->success(null, 'تم إفراغ السلة');
    }

    private function getOrCreateCart(Request $request): Cart
    {
        if ($request->user()) {
            return Cart::firstOrCreate(['user_id' => $request->user()->id]);
        }

        $sessionId = $request->session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }
}
