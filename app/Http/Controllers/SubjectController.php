<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        // SAAS SECURITY: Fetch ONLY the subjects belonging to the logged-in user
        $subjects = Subject::where('user_id', auth()->id())->latest()->get();

        // We will build this view in Phase 4!
        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        // 1. Validate the incoming form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'schedule_time' => 'nullable|string',
            'schedule_days' => 'nullable|string',
        ]);

        // 2. The Regex Parser (Translated from your Vanilla PHP)
        // Let's clean up the schedule time formatting.
        // Example: Changes "10:00 AM   -  11:30 AM" into a clean "10:00 AM - 11:30 AM"
        if (isset($validated['schedule_time'])) {
            $validated['schedule_time'] = preg_replace('/\s*-\s*/', ' - ', $validated['schedule_time']);
        }

        // 3. SAAS MAGIC: Automatically attach this new subject to the logged-in admin!
        $validated['user_id'] = auth()->id();

        // 4. Save to the database
        Subject::create($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }
}
