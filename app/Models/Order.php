<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'store_id',
        'subtotal',
        'discount',
        'tax',
        'shipping_cost',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'shipping_address',
        'billing_address',
        'notes',
        'admin_notes',
        'paid_at',
        'shipped_at',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'discount' => 'decimal:2',
            'tax' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'total' => 'decimal:2',
            'status' => OrderStatus::class,
            'payment_status' => PaymentStatus::class,
            'shipping_address' => 'array',
            'billing_address' => 'array',
            'paid_at' => 'datetime',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'ORD-' . strtoupper(uniqid());
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', OrderStatus::PENDING);
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', PaymentStatus::PAID);
    }

    // Helpers
    public function isPaid(): bool
    {
        return $this->payment_status === PaymentStatus::PAID;
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, [OrderStatus::PENDING, OrderStatus::CONFIRMED]);
    }

    public function updateTotal(): void
    {
        $this->subtotal = $this->items->sum('total');
        $this->total = $this->subtotal - $this->discount + $this->tax + $this->shipping_cost;
        $this->save();
    }
}
