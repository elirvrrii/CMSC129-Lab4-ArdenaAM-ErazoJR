<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        // Using Laravel collections to handle filtering fluently
        $assignments = collect(session('assignments', []));

        if ($request->filled('filter')) {
            $assignments = $assignments->where('category', $request->filter);
        }

        return view('assignments.index', compact('assignments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'category' => 'required|in:Final Exam,Long Exam,Quiz,Homework',
            'status' => 'required|in:Not Started,In Progress,Abandoned,Completed',
            'deadline' => 'required|date',
        ]);

        $validated['id'] = uniqid();

        $assignments = session('assignments', []);
        $assignments[] = $validated;

        session(['assignments' => $assignments]);

        return redirect('/assignments');
    }

    public function update(Request $request, $id)
    {
        // Refactored from a custom foreach loop to a clean collection map
        $assignments = collect(session('assignments', []))->map(function ($assignment) use ($id, $request) {
            if ($assignment['id'] === $id) {
                $assignment['status'] = $request->input('status');
            }

            return $assignment;
        })->toArray();

        session(['assignments' => $assignments]);

        return redirect('/assignments');
    }

    public function destroy($id)
    {
        // Refactored custom array_filter to a human-readable collection reject method
        $assignments = collect(session('assignments', []))
            ->reject(fn($assignment) => $assignment['id'] === $id)
            ->values()
            ->toArray();

        session(['assignments' => $assignments]);

        return redirect('/assignments');
    }
}