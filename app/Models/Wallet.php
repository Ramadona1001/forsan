<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'currency',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class);
    }

    // Helpers
    public function credit(float $amount, string $description = null, ?string $referenceType = null, ?int $referenceId = null): WalletTransaction
    {
        $this->balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => 'credit',
            'amount' => $amount,
            'balance_after' => $this->balance,
            'description' => $description,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
        ]);
    }

    public function debit(float $amount, string $description = null, ?string $referenceType = null, ?int $referenceId = null): WalletTransaction
    {
        if ($amount > $this->balance) {
            throw new \Exception('Insufficient balance');
        }

        $this->balance -= $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => 'debit',
            'amount' => $amount,
            'balance_after' => $this->balance,
            'description' => $description,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
        ]);
    }

    public function hasEnoughBalance(float $amount): bool
    {
        return $this->balance >= $amount;
    }
}
