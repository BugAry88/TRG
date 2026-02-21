<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\LevelModel;
use App\Models\ComponentModel;
use App\Models\ComponentCategoryModel;
use App\Models\CustomerModel;

class CheckoutController extends BaseController
{
    public function index()
    {
        $session = session();
        $config = $session->get('lp12_config');

        if (!$config) {
            $session->setFlashdata('error', 'No configuration found. Please build your LP12 first.');
            return redirect()->to(base_url('configurator'));
        }

        $levelModel = new LevelModel();
        $componentModel = new ComponentModel();
        $categoryModel = new ComponentCategoryModel();

        $level = $levelModel->find($config['level_id']);
        if (!$level) {
            $session->setFlashdata('error', 'Invalid configuration. Please try again.');
            return redirect()->to(base_url('configurator'));
        }

        $selectedComponents = [];
        $totalPrice = floatval($level['base_price']);

        foreach ($config['components'] as $catName => $componentId) {
            if (!$componentId) continue;
            $component = $componentModel->find($componentId);
            if (!$component) continue;
            $category = $categoryModel->find($component['category_id']);
            $selectedComponents[] = [
                'id'             => $component['id'],
                'category'       => $category ? $category['name'] : ucfirst($catName),
                'name'           => $component['name'],
                'price_modifier' => floatval($component['price_modifier']),
            ];
            $totalPrice += floatval($component['price_modifier']);
        }

        $customer = null;
        if ($session->get('customer_logged_in')) {
            $customerModel = new CustomerModel();
            $customer = $customerModel->find($session->get('customer_id'));
        }

        $data = [
            'title'       => 'Checkout',
            'level'       => $level,
            'components'  => $selectedComponents,
            'total_price' => $totalPrice,
            'customer'    => $customer,
        ];

        return view('checkout/index', $data);
    }

    public function placeOrder()
    {
        $session = session();
        $config = $session->get('lp12_config');

        if (!$config) {
            return redirect()->to(base_url('configurator'));
        }

        $levelModel     = new LevelModel();
        $componentModel = new ComponentModel();
        $categoryModel  = new ComponentCategoryModel();
        $orderModel     = new OrderModel();

        $level = $levelModel->find($config['level_id']);
        if (!$level) {
            return redirect()->to(base_url('configurator'));
        }

        $selectedComponents = [];
        $totalPrice = floatval($level['base_price']);

        foreach ($config['components'] as $catName => $componentId) {
            if (!$componentId) continue;
            $component = $componentModel->find($componentId);
            if (!$component) continue;
            $category = $categoryModel->find($component['category_id']);
            $selectedComponents[] = [
                'id'             => $component['id'],
                'category'       => $category ? $category['name'] : ucfirst($catName),
                'name'           => $component['name'],
                'price_modifier' => floatval($component['price_modifier']),
            ];
            $totalPrice += floatval($component['price_modifier']);
        }

        $orderData = [
            'order_number'    => $orderModel->generateOrderNumber(),
            'customer_id'     => $session->get('customer_id'),
            'customer_name'   => $this->request->getPost('customer_name'),
            'customer_email'  => $this->request->getPost('customer_email'),
            'customer_phone'  => $this->request->getPost('customer_phone'),
            'customer_address'=> $this->request->getPost('customer_address'),
            'level_id'        => $level['id'],
            'level_name'      => $level['name'],
            'level_price'     => $level['base_price'],
            'components_json' => json_encode($selectedComponents),
            'total_price'     => $totalPrice,
            'status'          => 'pending',
            'notes'           => $this->request->getPost('notes'),
        ];

        $orderId = $orderModel->insert($orderData);

        if ($orderId) {
            $session->remove('lp12_config');
            $session->set('last_order_id', $orderId);
            return redirect()->to(base_url('checkout/success'));
        }

        $session->setFlashdata('error', 'Failed to place order. Please try again.');
        return redirect()->back();
    }

    public function success()
    {
        $session = session();
        $orderId = $session->get('last_order_id');

        if (!$orderId) {
            return redirect()->to(base_url('configurator'));
        }

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) {
            return redirect()->to(base_url('configurator'));
        }

        $session->remove('last_order_id');

        $data = [
            'title' => 'Order Confirmed',
            'order' => $order,
            'components' => json_decode($order['components_json'], true) ?? [],
        ];

        return view('checkout/success', $data);
    }
}
