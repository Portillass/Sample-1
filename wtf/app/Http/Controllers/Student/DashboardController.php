<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show the student dashboard.
     */
    public function index(): View
    {
        return view('student.dashboard');
    }
} 