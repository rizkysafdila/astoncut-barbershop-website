<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.index', [
            'title' => 'Settings',
            'methods' => PaymentMethod::all(),
        ]);
    }
}
