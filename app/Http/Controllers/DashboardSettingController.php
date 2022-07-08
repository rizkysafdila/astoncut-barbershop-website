<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.index', [
            'title' => 'Settings',
        ]);
    }
}
