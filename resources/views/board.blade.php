<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Announcements</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header class="site-header">
        <div class="logo">
            <h1>{{ $manager->class_code }}</h1>
        </div>
        <nav class="navigation">
            <a href="{{ route('home') }}">Logout</a>
        </nav>
    </header>

    <main class="container" style="margin-top: 30px;">
        <h2 style="text-transform: uppercase; letter-spacing: 2px;">Class Announcements</h2>

        <div class="announcements-list" style="margin-top: 20px;">
            @forelse($announcements as $announcement)
                <div class="announcement-card" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; background: white; border-radius: 8px;">
                    <div class="card-header" style="display: flex; justify-content: space-between;">
                        <span class="badge" style="font-weight: bold; color: #d63384;">{{ $announcement->type }}</span>
                        <span class="date" style="color: #666;">
                            Due: {{ $announcement->due_date ? $announcement->due_date->diffForHumans() : 'No Due Date' }}
                        </span>
                    </div>

                    <h3 style="margin: 10px 0;">{{ $announcement->title }}</h3>
                    <small style="color: gray;">Subject: {{ $announcement->subject->name }} ({{ $announcement->subject->schedule_days }} {{ $announcement->subject->schedule_time }})</small>

                    <p style="margin-top: 10px; line-height: 1.6;">{{ $announcement->content }}</p>
                </div>
            @empty
                <p>No announcements posted yet.</p>
            @endforelse
        </div>
    </main>

</body>
</html>