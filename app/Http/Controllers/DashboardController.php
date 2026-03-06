<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $trucks = Truck::all();

        return view('dashboard', ["trucks" => $trucks, "today" => date('Y-m-d')]);
    }
}
