@extends('layouts.master')

@section('title', 'Create Announcement')

@section('content')
    <div class="container">
        <h2>Post New Announcement</h2>

        <form action="{{ route('announcements.store') }}" method="POST" style="max-width: 500px; display: flex; flex-direction: column; gap: 15px;">
            @csrf

            <select name="subject_id" required>
                <option value="" disabled selected>Select a Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->code }})</option>
                @endforeach
            </select>

            <input type="text" name="title" placeholder="Announcement Title" required>

            <select name="type" required>
                <option value="General">General</option>
                <option value="Assignment">Assignment</option>
                <option value="Exam">Exam</option>
                <option value="Project">Project</option>
            </select>

            <label for="due_date">Due Date (Optional):</label>
            <input type="date" name="due_date" id="due_date">

            <textarea name="content" rows="5" placeholder="Write your announcement details here..." required></textarea>

            <button type="submit" class="btn" style="background: green; color: white; padding: 10px; cursor: pointer;">Post Announcement</button>
            <a href="{{ route('announcements.index') }}" style="text-align: center;">Cancel</a>
        </form>
    </div>
@endsection