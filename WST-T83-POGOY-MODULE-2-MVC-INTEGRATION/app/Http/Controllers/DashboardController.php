<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total enrollment counts
        $totalStudents = Enrollment::where('is_archived', false)->count();
        $lastYearCount = Enrollment::where('academic_year', '2023-2024')->count();
        $currentYearCount = Enrollment::where('academic_year', '2024-2025')->count();
        
        // Calculate percentage change
        $percentageChange = $lastYearCount > 0 
            ? (($currentYearCount - $lastYearCount) / $lastYearCount) * 100 
            : 0;

        // Get recent enrollments
        $recentEnrollments = Enrollment::where('is_archived', false)
            ->latest()
            ->take(5)
            ->get();

        // Get latest enrolled students
        $latestStudents = Enrollment::where('is_archived', false)
            ->latest()
            ->take(10)
            ->get();

        // Get course statistics
        $courseEnrollments = Enrollment::where('is_archived', false)
            ->select('course', DB::raw('count(*) as total'))
            ->groupBy('course')
            ->get();

        return view('dashboard', compact(
            'totalStudents',
            'percentageChange',
            'recentEnrollments',
            'latestStudents',
            'courseEnrollments',
            'currentYearCount',
            'lastYearCount'
        ));
    }
}