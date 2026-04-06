@extends('layouts.master')

@section('title', 'Class Announcements')

@section('content')
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Announcements Board</h2>
            <a href="{{ route('announcements.create') }}" class="btn" style="background: blue; color: white; padding: 10px; text-decoration: none;">+ New Announcement</a>
        </div>

        @if(session('success'))
            <div class="alert success" style="color: green; margin-top: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="announcements-list" style="margin-top: 20px;">
            @forelse($announcements as $announcement)
                <div class="announcement-card" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">
                    <div class="card-header" style="display: flex; justify-content: space-between;">
                        <span class="badge">{{ $announcement->type }}</span>
                        <span class="date" style="color: #666;">
                            Due: {{ $announcement->due_date ? $announcement->due_date->diffForHumans() : 'No Due Date' }}
                        </span>
                    </div>

                    <h3 style="margin: 10px 0;">{{ $announcement->title }}</h3>
                    <small style="color: gray;">Subject: {{ $announcement->subject->name }}</small>

                    <p style="margin-top: 10px;">{{ $announcement->content }}</p>
                </div>
            @empty
                <p>No announcements posted yet.</p>
            @endforelse
        </div>
    </div>
@endsection