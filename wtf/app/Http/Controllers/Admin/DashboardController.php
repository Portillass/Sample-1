<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index(): View
    {
        try {
            if (!Auth::check()) {
                abort(403, 'Unauthorized');
            }

            if (!Auth::user()->isAdmin()) {
                abort(403, 'Unauthorized. Admin access required.');
            }

            return view('admin.dashboard');
        } catch (\Exception $e) {
            abort(500, 'An error occurred while loading the dashboard.');
        }
    }
} 