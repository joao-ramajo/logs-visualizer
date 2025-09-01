<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $services = Service::all();
        return view('home', compact('services'));
    }

    public function service(string $id): View
    {
        return view('services.index');
    }
}
