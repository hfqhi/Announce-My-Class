<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;

class PublicBoardController extends Controller
{
    // Step 1: Handle the form submission from the homepage
    public function lookup(Request $request)
    {
        $request->validate(['class_code' => 'required|string']);

        // Redirect them to the clean URL (e.g., website.com/board/BSCS-3A)
        return redirect()->route('board.show', $request->class_code);
    }

    // Step 2: Display the actual board for that specific code
    public function show($class_code)
    {
        // Find the manager who owns this class code.
        $manager = User::where('class_code', $class_code)->firstOrFail();

        // Fetch ONLY that specific manager's announcements
        $announcements = Announcement::with('subject')
            ->where('user_id', $manager->id)
            ->latest()
            ->get();

        return view('board', compact('manager', 'announcements'));
    }
}
