<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'order_number',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'level_id',
        'level_name',
        'level_price',
        'components_json',
        'total_price',
        'status',
        'notes',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generateOrderNumber(): string
    {
        return 'LP12-' . strtoupper(substr(uniqid(), -6)) . '-' . date('Ymd');
    }
}
