<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Class Announcements')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header class="site-header">
        <div class="logo">
            <h1>{{ auth()->user()->display_name ?? auth()->user()->name }}</h1>
        </div>

        <nav class="navigation">
            <a href="{{ route('subjects.index') }}">Manage Subjects</a>
            <a href="{{ route('announcements.index') }}">Manage Announcements</a>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </nav>
    </header>

    <main class="content-area">
        @yield('content')
    </main>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>