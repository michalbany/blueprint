<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Workspace::switch(1);

        return Inertia::render('Dashboard', [
            // 'projects' => Workspace::current()->projects,
        ]);
    }
}
