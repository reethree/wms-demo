<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();   
    }
    
    public function index()
    {
        $data['page_title'] = "Welcome to Dashboard";
        $data['page_description'] = "This is Admin Page Primanata WMS!";
        
        $data['sor'] = \App\Models\SorYor::where('type', 'sor')->first();
        $data['yor'] = \App\Models\SorYor::where('type', 'yor')->first();
        
        return view('welcome')->with($data);
    }
}
