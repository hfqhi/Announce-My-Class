<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Subject;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Fetch announcements ONLY for this admin, and load the related Subject name
        $announcements = Announcement::with('subject')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // NOTE ON DATE MATH: Because of Carbon, we don't need to do date math in the controller anymore!
        // In our Blade view later, we will literally just type: {{ $announcement->due_date->diffForHumans() }}
        // and it will output things like "2 days from now" or "3 days ago" automatically.

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        // We need to pass the admin's subjects to the form so they can select one from a dropdown
        $subjects = Subject::where('user_id', auth()->id())->get();
        return view('announcements.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'due_date' => 'nullable|date',
            'type' => 'required|string',
        ]);

        // SAAS SECURITY: Attach the announcement to the logged-in admin
        $validated['user_id'] = auth()->id();

        Announcement::create($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement posted!');
    }
}
