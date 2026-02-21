<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name',
        'email',
        'phone',
        'password',
        'address',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'name'     => 'required|min_length[2]|max_length[200]',
        'email'    => 'required|valid_email|max_length[200]',
        'password' => 'required|min_length[6]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Name is required.',
            'min_length' => 'Name must be at least 2 characters.',
        ],
        'email' => [
            'required'    => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.',
        ],
        'password' => [
            'required'   => 'Password is required.',
            'min_length' => 'Password must be at least 6 characters.',
        ],
    ];

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }
}
