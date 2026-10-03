<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'full_name', 'email', 'password', 'created_at'];

    public function findByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Fetch single demo user profile record
     */
    public function getDemoUser()
    {
        return $this->first();
    }
}
