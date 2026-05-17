<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $assignments = session('assignments', []);

        if ($request->filled('filter')) {
            $assignments = array_filter($assignments, function($assignment) use ($request) {
                return $assignment['category'] === $request->filter;
            });
        }

        return view('assignments.index', ['assignments' => $assignments]);
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
        $assignments = session('assignments', []);

        foreach ($assignments as &$assignment) {
            if ($assignment['id'] === $id) {
                $assignment['status'] = $request->input('status');
            }
        }

        session(['assignments' => $assignments]);
        return redirect('/assignments');
    }

    public function destroy($id)
    {
        $assignments = session('assignments', []);

        $assignments = array_filter($assignments, function($assignment) use ($id) {
            return $assignment['id'] !== $id;
        });

        // Re-index array keys to avoid numeric session gaps
        session(['assignments' => array_values($assignments)]);
        return redirect('/assignments');
    }
}