<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Configurator extends BaseController
{
    public function index()
    {
        // Load data from database
        $levelModel = new \App\Models\LevelModel();
        $categoryModel = new \App\Models\ComponentCategoryModel();
        $componentModel = new \App\Models\ComponentModel();
        $compatibilityModel = new \App\Models\CompatibilityMapModel();

        $data['levels'] = $levelModel->findAll();
        $data['categories'] = $categoryModel->orderBy('display_order', 'ASC')->findAll();
        $data['components'] = $componentModel->findAll();
        $data['compatibilities'] = $compatibilityModel->findAll();

        // Group components by category
        $data['components_by_category'] = [];
        foreach ($data['categories'] as $category) {
            $data['components_by_category'][$category['id']] = array_filter($data['components'], function ($component) use ($category) {
                return $component['category_id'] == $category['id'];
            });
        }

        return view('configurator/index', $data);
    }
}
