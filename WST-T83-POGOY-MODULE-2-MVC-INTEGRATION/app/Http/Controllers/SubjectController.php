<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::where('is_archived', false);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('code', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('course', 'LIKE', "%{$search}%");
            });
        }

        $subjects = $query->orderBy('code')->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:subjects,code|max:20',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'units' => 'required|integer|min:1',
            'course' => 'required|string',
            'year_level' => 'required|integer|between:1,4',
            'semester' => 'required|string|in:1,2,summer'
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:subjects,code,' . $subject->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'units' => 'required|integer|min:1|max:6',
            'course' => 'required|string',
            'year_level' => 'required|integer|min:1|max:4',
            'semester' => 'required|string'
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }
    public function archive(Subject $subject)
    {
        $subject->update(['is_archived' => true]);
        return redirect()->route('subjects.index')
            ->with('success', 'Subject archived successfully.');
    }
    public function archived()
    {
        $subjects = Subject::where('is_archived', true)
            ->orderBy('code')
            ->paginate(10);
        return view('admin.subjects.archived', compact('subjects'));
    }
    public function restore(Subject $subject)
    {
        $subject->update(['is_archived' => false]);
        return redirect()->route('subjects.archived')
            ->with('success', 'Subject restored successfully.');
    }
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}