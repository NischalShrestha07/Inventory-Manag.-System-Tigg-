<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function form()
    {
        return view('admin.form');
    }
    public function table()
    {
        return view('admin.table');
    }
    public function login()
    {
        return view('admin.login');
    }
    public function uom()
    {
        return view('admin.uom.index');
    }
    public function variant_product()
    {
        return view('admin.variant_products.index');
    }
    public function variant_attribute()
    {
        return view('admin.variant_attributes.index');
    }
    public function product_category()
    {
        return view('admin.product_category.index');
    }
    public function products()
    {
        return view('admin.products.index');
    }
}
