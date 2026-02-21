<?php

namespace App\Models;

use CodeIgniter\Model;

class CompatibilityMapModel extends Model
{
    protected $table = 'compatibility_map';
    protected $primaryKey = 'id';
    protected $allowedFields = ['level_id', 'component_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
