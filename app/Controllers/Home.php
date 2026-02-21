<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('storefront_backup');
    }

    public function test(): string
    {
        return "CodeIgniter is working! Routes are functional.";
    }
}
