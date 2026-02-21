<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LevelModel;
use App\Models\ComponentModel;
use App\Models\ComponentCategoryModel;

class CartController extends BaseController
{
    public function addConfiguration()
    {
        // Get POST data
        $levelId = $this->request->getPost('level');
        $components = $this->request->getPost('components') ?? [];
        
        // Validate level
        if (!$levelId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid level']);
        }
        
        // Store configuration in session
        $session = session();
        $session->set('lp12_config', [
            'level_id' => $levelId,
            'components' => is_array($components) ? $components : [],
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        $session->setFlashdata('success', 'Configuration saved successfully!');
        
        // Return JSON with redirect URL for AJAX
        return $this->response->setJSON([
            'success' => true,
            'redirect' => base_url('cart/summary')
        ]);
    }
    
    public function summary()
    {
        $session = session();
        $config = $session->get('lp12_config');
        
        if (!$config) {
            $session->setFlashdata('error', 'No configuration found');
            return redirect()->to(base_url('configurator'));
        }
        
        $levelModel = new LevelModel();
        $componentModel = new ComponentModel();
        $categoryModel = new ComponentCategoryModel();
        
        try {
            $level = $levelModel->find($config['level_id']);
            
            if (!$level) {
                throw new \Exception('Level not found');
            }
            
            $selectedComponents = [];
            $totalPrice = floatval($level['base_price']);
            
            // components comes as ['plinth' => '5', 'tonearm' => '7', ...]
            // Key is category name, value is component ID
            foreach ($config['components'] as $catName => $componentId) {
                if (!$componentId) continue;
                
                $component = $componentModel->find($componentId);
                if (!$component) continue;
                
                // Get category name from the component's category_id
                $category = $categoryModel->find($component['category_id']);
                $categoryName = $category ? $category['name'] : ucfirst($catName);
                
                $selectedComponents[] = [
                    'category'       => $categoryName,
                    'name'           => $component['name'],
                    'description'    => $component['description'] ?? '',
                    'price_modifier' => floatval($component['price_modifier']),
                    'image_path'     => $component['image_path'] ?? ''
                ];
                $totalPrice += floatval($component['price_modifier']);
            }
            
            $data = [
                'level'       => $level,
                'components'  => $selectedComponents,
                'total_price' => $totalPrice,
                'config_date' => $config['created_at']
            ];
            
        } catch (\Exception $e) {
            // Fallback if DB query fails
            $data = $this->getFallbackData($config);
        }
        
        return view('cart/summary', $data);
    }
    
    public function clear()
    {
        $session = session();
        $session->remove('lp12_config');
        $session->setFlashdata('success', 'Configuration cleared');
        
        return redirect()->to(base_url('configurator'));
    }
    
    private function getFallbackData($config)
    {
        $fallbackLevels = [
            1 => ['id' => 1, 'name' => 'Majik',   'base_price' => 85000.00],
            2 => ['id' => 2, 'name' => 'Akurate',  'base_price' => 195000.00],
            3 => ['id' => 3, 'name' => 'Klimax',   'base_price' => 485000.00],
        ];
        
        $level = $fallbackLevels[$config['level_id']] ?? $fallbackLevels[1];
        $totalPrice = floatval($level['base_price']);
        $selectedComponents = [];
        
        foreach ($config['components'] as $catName => $componentId) {
            if ($componentId) {
                $selectedComponents[] = [
                    'category'       => ucfirst($catName),
                    'name'           => ucfirst($catName) . ' #' . $componentId,
                    'description'    => 'Selected ' . $catName . ' component',
                    'price_modifier' => 0,
                    'image_path'     => ''
                ];
            }
        }
        
        return [
            'level'       => $level,
            'components'  => $selectedComponents,
            'total_price' => $totalPrice,
            'config_date' => $config['created_at']
        ];
    }
}
