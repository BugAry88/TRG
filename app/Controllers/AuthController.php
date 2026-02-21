<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\OrderModel;

class AuthController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function login()
    {
        if ($this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('account'));
        }

        if ($this->request->getMethod() === 'POST') {
            $email    = trim($this->request->getPost('email'));
            $password = $this->request->getPost('password');

            $customerModel = new CustomerModel();
            $customer = $customerModel->findByEmail($email);

            if ($customer && password_verify($password, $customer['password'])) {
                $this->session->set([
                    'customer_logged_in' => true,
                    'customer_id'        => $customer['id'],
                    'customer_name'      => $customer['name'],
                    'customer_email'     => $customer['email'],
                ]);

                $redirect = $this->session->get('redirect_after_login') ?? base_url('account');
                $this->session->remove('redirect_after_login');

                return redirect()->to($redirect)->with('success', 'Welcome back, ' . $customer['name'] . '!');
            }

            return redirect()->back()->with('error', 'Invalid email or password.')->withInput();
        }

        return view('auth/login', ['title' => 'Login']);
    }

    public function register()
    {
        if ($this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('account'));
        }

        if ($this->request->getMethod() === 'POST') {
            $customerModel = new CustomerModel();

            $name     = trim($this->request->getPost('name'));
            $email    = trim($this->request->getPost('email'));
            $phone    = trim($this->request->getPost('phone'));
            $password = $this->request->getPost('password');
            $confirm  = $this->request->getPost('password_confirm');

            if ($password !== $confirm) {
                return redirect()->back()->with('error', 'Passwords do not match.')->withInput();
            }

            if ($customerModel->findByEmail($email)) {
                return redirect()->back()->with('error', 'This email is already registered.')->withInput();
            }

            $data = [
                'name'     => $name,
                'email'    => $email,
                'phone'    => $phone,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];

            if ($customerModel->insert($data)) {
                $customerId = $customerModel->getInsertID();

                $this->session->set([
                    'customer_logged_in' => true,
                    'customer_id'        => $customerId,
                    'customer_name'      => $name,
                    'customer_email'     => $email,
                ]);

                return redirect()->to(base_url('account'))->with('success', 'Account created successfully! Welcome, ' . $name . '!');
            }

            return redirect()->back()->with('error', 'Registration failed. Please try again.')->withInput();
        }

        return view('auth/register', ['title' => 'Register']);
    }

    public function logout()
    {
        $this->session->remove(['customer_logged_in', 'customer_id', 'customer_name', 'customer_email']);
        return redirect()->to(base_url())->with('success', 'You have been logged out.');
    }

    public function account()
    {
        if (!$this->session->get('customer_logged_in')) {
            $this->session->set('redirect_after_login', current_url());
            return redirect()->to(base_url('login'))->with('error', 'Please login to view your account.');
        }

        $customerId = $this->session->get('customer_id');

        $customerModel = new CustomerModel();
        $customer = $customerModel->find($customerId);

        $orderModel = new OrderModel();
        $orders = $orderModel->where('customer_id', $customerId)->orderBy('created_at', 'DESC')->findAll();

        return view('auth/account', [
            'title'    => 'My Account',
            'customer' => $customer,
            'orders'   => $orders,
        ]);
    }

    public function updateProfile()
    {
        if (!$this->session->get('customer_logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $customerId = $this->session->get('customer_id');
        $customerModel = new CustomerModel();

        $data = [
            'name'    => trim($this->request->getPost('name')),
            'email'   => trim($this->request->getPost('email')),
            'phone'   => trim($this->request->getPost('phone')),
            'address' => trim($this->request->getPost('address')),
        ];

        $newPassword = $this->request->getPost('new_password');
        if (!empty($newPassword)) {
            if (strlen($newPassword) < 6) {
                return redirect()->back()->with('error', 'Password must be at least 6 characters.');
            }
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if ($customerModel->update($customerId, $data)) {
            $this->session->set([
                'customer_name'  => $data['name'],
                'customer_email' => $data['email'],
            ]);
            return redirect()->to(base_url('account'))->with('success', 'Profile updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update profile.');
    }
}
