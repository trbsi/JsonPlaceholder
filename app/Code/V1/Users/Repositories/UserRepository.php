<?php

namespace App\Code\V1\Users\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getUserByIdAndEmail(int $id, ?string $email): Collection
    {
        $users = User::select('*');
        if (0 !== $id) {
            $users = $users->where('id', $id);
        }

        if (null !== $email) {
            $users = $users->where('email', $email);
        }

        return $users->get();
    }
}