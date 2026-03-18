<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->hasRole('service_provider');
    }

    public function view(User $user, Service $service): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->hasRole('service_provider')) {
            return $service->provider_id === $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->hasRole('service_provider');
    }

    public function update(User $user, Service $service): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->hasRole('service_provider')) {
            return $service->provider_id === $user->id;
        }

        return false;
    }

    public function delete(User $user, Service $service): bool
    {
        return $this->update($user, $service);
    }
}

