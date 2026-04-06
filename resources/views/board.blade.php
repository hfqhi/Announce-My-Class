<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Announcements</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container d-flex justify-content-center text-center">
            <span class="navbar-brand mb-0 h1 fw-bold tracking-wider" style="letter-spacing: 1px;">
                {{ $manager->class_code }}
            </span>
            <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm position-absolute end-0 me-3">Logout</a>
        </div>
    </nav>

    <main class="container mb-5">

        <div class="d-flex justify-content-between align-items-end border-bottom pb-2 mb-4">
            <div>
                <h2 class="fw-bold text-uppercase tracking-widest mb-0" style="letter-spacing: 3px;">Class Announcements</h2>
                <p class="text-danger font-monospace mb-0 mt-1">{{ now()->format('M d, Y (l) | h:i:s A') }}</p>
            </div>

            <div class="btn-group" role="group">
                <button type="button" class="btn btn-dark active">Cards</button>
                <button type="button" class="btn btn-outline-dark">Calendar</button>
            </div>
        </div>

        <h4 class="text-danger mb-3">Upcoming Deadlines</h4>

        <div class="row g-4">
            @forelse($announcements as $announcement)
                @php
                    // Map the Subject Code/Name to your specific CSS classes
                    // We make it lowercase and strip spaces to match your CSS perfectly
                    $subjectKey = strtolower(str_replace(' ', '', $announcement->subject->name ?? $announcement->subject->code));

                    // Default to bg-other if we can't find a match
                    $bgClass = 'bg-other';

                    if (str_contains($subjectKey, 'sciets')) $bgClass = 'bg-sciets';
                    elseif (str_contains($subjectKey, 'contwo')) $bgClass = 'bg-contwo';
                    elseif (str_contains($subjectKey, 'eneco')) $bgClass = 'bg-eneco';
                    elseif (str_contains($subjectKey, 'eceng')) $bgClass = 'bg-eceng';
                    elseif (str_contains($subjectKey, 'softdes')) $bgClass = 'bg-softdes';
                    elseif (str_contains($subjectKey, 'numerical')) $bgClass = 'bg-numerical';
                    elseif (str_contains($subjectKey, 'rizal')) $bgClass = 'bg-rizal';
                    elseif (str_contains($subjectKey, 'pehef')) $bgClass = 'bg-pehef2';
                @endphp

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card announcement-card h-100 shadow-sm border-0">

                        <div class="card-header text-center fw-bold text-uppercase fs-5 py-3 border-0 {{ $bgClass }}">
                            {{ $announcement->subject->name }}
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="text-muted small mb-3">
                                <div><i class="bi bi-person"></i> 🧑‍🏫 {{ $manager->display_name ?? $manager->name }}</div>
                                <div><i class="bi bi-clock"></i> ⏱️ {{ $announcement->subject->schedule_days }} | {{ $announcement->subject->schedule_time }}</div>
                            </div>

                            <h5 class="card-title fw-bold">{{ $announcement->title }}</h5>
                            <p class="card-text text-secondary mb-4 flex-grow-1">{{ $announcement->content }}</p>

                            <hr class="mt-auto mb-2">

                            <div class="d-flex justify-content-between align-items-end mt-2">
                                <div>
                                    <span class="badge text-danger bg-danger bg-opacity-10 mb-1 border border-danger border-opacity-25 py-2 px-3">
                                        📅 {{ $announcement->due_date ? $announcement->due_date->format('D, M d') : 'No Due Date' }}
                                    </span>
                                    <div class="small fw-bold text-dark mt-1 ms-1">
                                        ⏰ {{ $announcement->due_date ? $announcement->due_date->format('h:i A') : '' }}
                                    </div>
                                </div>

                                @if($announcement->due_date)
                                    <span class="badge bg-white border border-warning text-warning rounded-pill px-3 py-2 fs-6 shadow-sm">
                                        {{ $announcement->due_date->diffInDays() }} days left
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light text-center py-5 border">
                        <p class="text-muted mb-0">No announcements posted yet.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>