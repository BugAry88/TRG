<?php

namespace App\Models;

use CodeIgniter\Model;

class ComponentModel extends Model
{
    protected $table = 'components';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_id', 'name', 'price_modifier', 'image_path', 'description'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
