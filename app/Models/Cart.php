<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Helpers
    public function getSubtotal(): float
    {
        return $this->items->sum(fn($item) => $item->product->price * $item->quantity);
    }

    public function getItemsCount(): int
    {
        return $this->items->sum('quantity');
    }

    public function addItem(int $productId, int $quantity = 1, array $options = []): CartItem
    {
        $existingItem = $this->items()->where('product_id', $productId)->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
            return $existingItem->fresh();
        }

        return $this->items()->create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'options' => $options,
        ]);
    }

    public function updateItemQuantity(int $itemId, int $quantity): void
    {
        $this->items()->where('id', $itemId)->update(['quantity' => $quantity]);
    }

    public function removeItem(int $itemId): void
    {
        $this->items()->where('id', $itemId)->delete();
    }

    public function clear(): void
    {
        $this->items()->delete();
    }

    public function isEmpty(): bool
    {
        return $this->items->isEmpty();
    }
}
