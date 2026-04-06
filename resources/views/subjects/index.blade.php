@extends('layouts.master')

@section('title', 'Manage Subjects')

@section('content')
    <div class="container">
        <h2>My Subjects</h2>

        @if(session('success'))
            <div class="alert success" style="color: green; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-card" style="margin-bottom: 30px; padding: 20px; border: 1px solid #ddd;">
            <h3>Add New Subject</h3>
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf <input type="text" name="name" placeholder="Subject Name (e.g. Web Dev)" required>
                <input type="text" name="code" placeholder="Class Code (e.g. BSCS-3A)">
                <input type="text" name="schedule_time" placeholder="Time (e.g. 10:00 AM - 11:30 AM)">
                <input type="text" name="schedule_days" placeholder="Days (e.g. MWF)">

                <button type="submit" class="btn">Add Subject</button>
            </form>
        </div>

        <div class="subjects-list">
            @forelse($subjects as $subject)
                <div class="subject-item" style="padding: 10px; border-bottom: 1px solid #eee;">
                    <strong>{{ $subject->name }}</strong> ({{ $subject->code }}) <br>
                    <small>{{ $subject->schedule_days }} | {{ $subject->schedule_time }}</small>
                </div>
            @empty
                <p>You haven't added any subjects yet.</p>
            @endforelse
        </div>
    </div>
@endsection