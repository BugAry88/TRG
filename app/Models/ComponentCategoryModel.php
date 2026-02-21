<?php

namespace App\Models;

use CodeIgniter\Model;

class ComponentCategoryModel extends Model
{
    protected $table = 'component_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'display_order'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
