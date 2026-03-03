<?php

namespace App\Models;

use App\Enums\UserType;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasMedia
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',
        'bio',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
            'type' => UserType::class,
            'is_active' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->type === UserType::ADMIN || $this->hasRole('super_admin');
        }

        return true;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    // Relationships
    public function horses(): HasMany
    {
        return $this->hasMany(Horse::class, 'owner_id');
    }

    public function stables(): HasMany
    {
        return $this->hasMany(Stable::class, 'owner_id');
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class, 'owner_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function trainer(): HasOne
    {
        return $this->hasOne(Trainer::class);
    }

    public function veterinarian(): HasOne
    {
        return $this->hasOne(Veterinarian::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    // Helpers
    public function getDefaultAddress(): ?Address
    {
        return $this->addresses()->where('is_default', true)->first();
    }

    public function isAdmin(): bool
    {
        return $this->type === UserType::ADMIN || $this->hasRole('super_admin');
    }
}
