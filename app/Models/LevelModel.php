<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelModel extends Model
{
    protected $table = 'lp12_levels';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'base_price'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
