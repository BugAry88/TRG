<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LevelModel;
use App\Models\ComponentCategoryModel;
use App\Models\ComponentModel;
use App\Models\CompatibilityMapModel;
use App\Models\OrderModel;

class AdminController extends BaseController
{
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        // Check if user is admin (simple authentication)
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Please login to access admin panel');
        }

        $orderModel = new OrderModel();
        $allOrders = $orderModel->findAll();

        $data = [
            'title' => 'Admin Dashboard',
            'total_levels' => $this->getTotalLevels(),
            'total_categories' => $this->getTotalCategories(),
            'total_components' => $this->getTotalComponents(),
            'total_compatibilities' => $this->getTotalCompatibilities(),
            'orders_total' => count($allOrders),
            'orders_pending' => count(array_filter($allOrders, fn($o) => $o['status'] === 'pending')),
            'orders_processing' => count(array_filter($allOrders, fn($o) => in_array($o['status'], ['confirmed', 'processing', 'shipped']))),
            'orders_completed' => count(array_filter($allOrders, fn($o) => $o['status'] === 'completed')),
        ];

        return view('admin/dashboard', $data);
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Simple authentication (in production, use proper authentication)
            if ($username === 'admin' && $password === 'admin123') {
                $this->session->set('admin_logged_in', true);
                return redirect()->to(base_url('admin'))->with('success', 'Login successful');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        }

        return view('admin/login');
    }

    public function logout()
    {
        $this->session->remove('admin_logged_in');
        return redirect()->to(base_url('admin/login'))->with('success', 'Logged out successfully');
    }

    // Levels Management
    public function levels()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $levelModel = new LevelModel();
        $data['levels'] = $levelModel->findAll();
        $data['title'] = 'Manage Levels';

        return view('admin/levels', $data);
    }

    public function createLevel()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        if ($this->request->getMethod() === 'POST') {
            $levelModel = new LevelModel();
            
            $insertData = [
                'name' => $this->request->getPost('name'),
                'base_price' => $this->request->getPost('base_price'),
            ];

            if ($levelModel->insert($insertData)) {
                return redirect()->to(base_url('admin/levels'))->with('success', 'Level created successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to create level');
            }
        }

        $data['title'] = 'Create Level';
        return view('admin/create_level', $data);
    }

    public function editLevel($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $levelModel = new LevelModel();
        $data['level'] = $levelModel->find($id);

        if (!$data['level']) {
            return redirect()->to(base_url('admin/levels'))->with('error', 'Level not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $updateData = [
                'name' => $this->request->getPost('name'),
                'base_price' => $this->request->getPost('base_price'),
            ];

            if ($levelModel->update($id, $updateData)) {
                return redirect()->to(base_url('admin/levels'))->with('success', 'Level updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update level');
            }
        }

        $data['title'] = 'Edit Level';
        return view('admin/edit_level', $data);
    }

    public function deleteLevel($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $levelModel = new LevelModel();
        
        if ($levelModel->delete($id)) {
            return redirect()->to(base_url('admin/levels'))->with('success', 'Level deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete level');
        }
    }

    // Categories Management
    public function categories()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $categoryModel = new ComponentCategoryModel();
        $data['categories'] = $categoryModel->orderBy('display_order', 'ASC')->findAll();
        $data['title'] = 'Manage Categories';

        return view('admin/categories', $data);
    }

    public function createCategory()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        if ($this->request->getMethod() === 'POST') {
            $categoryModel = new ComponentCategoryModel();
            
            $insertData = [
                'name' => $this->request->getPost('name'),
                'display_order' => $this->request->getPost('display_order'),
            ];

            if ($categoryModel->insert($insertData)) {
                return redirect()->to(base_url('admin/categories'))->with('success', 'Category created successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to create category');
            }
        }

        $data['title'] = 'Create Category';
        return view('admin/create_category', $data);
    }

    public function editCategory($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $categoryModel = new ComponentCategoryModel();
        
        $data['category'] = $categoryModel->find($id);

        if (!$data['category']) {
            return redirect()->to(base_url('admin/categories'))->with('error', 'Category not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $updateData = [
                'name' => $this->request->getPost('name'),
                'display_order' => $this->request->getPost('display_order'),
                'description' => $this->request->getPost('description'),
            ];

            if ($categoryModel->update($id, $updateData)) {
                return redirect()->to(base_url('admin/categories'))->with('success', 'Category updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update category');
            }
        }

        $data['title'] = 'Edit Category';
        return view('admin/edit_category', $data);
    }

    public function deleteCategory($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $categoryModel = new ComponentCategoryModel();
        $category = $categoryModel->find($id);

        if (!$category) {
            return redirect()->to(base_url('admin/categories'))->with('error', 'Category not found');
        }

        if ($categoryModel->delete($id)) {
            return redirect()->to(base_url('admin/categories'))->with('success', 'Category deleted successfully');
        } else {
            return redirect()->to(base_url('admin/categories'))->with('error', 'Failed to delete category');
        }
    }

    // Components Management
    public function components()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $componentModel = new ComponentModel();
        $categoryModel = new ComponentCategoryModel();
        
        $data['components'] = $componentModel->findAll();
        $data['categories'] = $categoryModel->orderBy('display_order', 'ASC')->findAll();
        $data['title'] = 'Manage Components';

        return view('admin/components', $data);
    }

    public function createComponent()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $categoryModel = new ComponentCategoryModel();
        $data['categories'] = $categoryModel->orderBy('display_order', 'ASC')->findAll();

        if ($this->request->getMethod() === 'POST') {
            $componentModel = new ComponentModel();

            $imagePath = $this->handleImageUpload();

            $insertData = [
                'category_id'   => $this->request->getPost('category_id'),
                'name'          => $this->request->getPost('name'),
                'price_modifier'=> $this->request->getPost('price_modifier'),
                'image_path'    => $imagePath,
                'description'   => $this->request->getPost('description'),
            ];

            if ($componentModel->insert($insertData)) {
                return redirect()->to(base_url('admin/components'))->with('success', 'Component created successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to create component');
            }
        }

        $data['title'] = 'Create Component';
        return view('admin/create_component', $data);
    }

    public function editComponent($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $componentModel = new ComponentModel();
        $categoryModel = new ComponentCategoryModel();
        
        $data['component'] = $componentModel->find($id);
        $data['categories'] = $categoryModel->orderBy('display_order', 'ASC')->findAll();

        if (!$data['component']) {
            return redirect()->to(base_url('admin/components'))->with('error', 'Component not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $uploadedPath = $this->handleImageUpload();
            $imagePath = $uploadedPath ?: $this->request->getPost('image_path');

            $updateData = [
                'category_id'   => $this->request->getPost('category_id'),
                'name'          => $this->request->getPost('name'),
                'price_modifier'=> $this->request->getPost('price_modifier'),
                'image_path'    => $imagePath,
                'description'   => $this->request->getPost('description'),
            ];

            if ($componentModel->update($id, $updateData)) {
                return redirect()->to(base_url('admin/components'))->with('success', 'Component updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update component');
            }
        }

        $data['title'] = 'Edit Component';
        return view('admin/edit_component', $data);
    }

    public function deleteComponent($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $componentModel = new ComponentModel();
        
        if ($componentModel->delete($id)) {
            return redirect()->to(base_url('admin/components'))->with('success', 'Component deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete component');
        }
    }

    // Compatibility Management
    public function compatibility()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $compatibilityModel = new CompatibilityMapModel();
        $levelModel = new LevelModel();
        $componentModel = new ComponentModel();
        $categoryModel = new ComponentCategoryModel();
        
        $data['compatibilities'] = $compatibilityModel->findAll();
        $data['levels'] = $levelModel->findAll();
        $data['components'] = $componentModel->findAll();
        $data['categories'] = $categoryModel->orderBy('display_order', 'ASC')->findAll();
        $data['title'] = 'Manage Compatibility';

        return view('admin/compatibility', $data);
    }

    public function addCompatibility()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        if ($this->request->getMethod() === 'POST') {
            $compatibilityModel = new CompatibilityMapModel();
            
            $data = [
                'level_id' => $this->request->getPost('level_id'),
                'component_id' => $this->request->getPost('component_id'),
            ];

            if ($compatibilityModel->insert($data)) {
                return redirect()->to(base_url('admin/compatibility'))->with('success', 'Compatibility added successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to add compatibility');
            }
        }

        return redirect()->to(base_url('admin/compatibility'));
    }

    public function removeCompatibility($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $compatibilityModel = new CompatibilityMapModel();
        
        if ($compatibilityModel->delete($id)) {
            return redirect()->to(base_url('admin/compatibility'))->with('success', 'Compatibility removed successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to remove compatibility');
        }
    }

    // Orders Management
    public function orders()
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $orderModel = new OrderModel();
        $data['orders'] = $orderModel->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'Manage Orders';

        return view('admin/orders', $data);
    }

    public function viewOrder($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $orderModel = new OrderModel();
        $order = $orderModel->find($id);

        if (!$order) {
            return redirect()->to(base_url('admin/orders'))->with('error', 'Order not found');
        }

        $data['order'] = $order;
        $data['components'] = json_decode($order['components_json'], true) ?? [];
        $data['title'] = 'Order #' . $order['order_number'];

        return view('admin/view_order', $data);
    }

    public function updateOrderStatus($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->to(base_url('admin/login'));
        }

        $orderModel = new OrderModel();
        $order = $orderModel->find($id);

        if (!$order) {
            return redirect()->to(base_url('admin/orders'))->with('error', 'Order not found');
        }

        $status = $this->request->getPost('status');
        if ($orderModel->update($id, ['status' => $status])) {
            return redirect()->to(base_url('admin/orders/' . $id))->with('success', 'Order status updated');
        }

        return redirect()->back()->with('error', 'Failed to update status');
    }

    // Image Upload Helper
    private function handleImageUpload(): ?string
    {
        $file = $this->request->getFile('image_file');

        if (!$file || !$file->isValid() || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return null;
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            return null;
        }

        $ext = strtolower($file->getClientExtension());
        $newName = uniqid('component_') . '.' . $ext;

        $uploadPath = FCPATH . 'images/uploads/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if ($file->move($uploadPath, $newName)) {
            return '/images/uploads/' . $newName;
        }

        return null;
    }

    // Helper methods
    private function isAdmin()
    {
        return $this->session->get('admin_logged_in') === true;
    }

    private function getTotalLevels()
    {
        try {
            $levelModel = new LevelModel();
            return $levelModel->countAll();
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getTotalCategories()
    {
        try {
            $categoryModel = new ComponentCategoryModel();
            return $categoryModel->countAll();
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getTotalComponents()
    {
        try {
            $componentModel = new ComponentModel();
            return $componentModel->countAll();
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getTotalCompatibilities()
    {
        try {
            $compatibilityModel = new CompatibilityMapModel();
            return $compatibilityModel->countAll();
        } catch (\Exception $e) {
            return 0;
        }
    }
}
