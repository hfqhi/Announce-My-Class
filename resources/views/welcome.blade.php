<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Class</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f7f6;">

    <div class="login-container" style="text-align: center; padding: 40px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <div class="login-container" style="text-align: center; padding: 40px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2>Class Portal</h2>
        <p>Enter your class code to view announcements.</p>

        <form action="{{ route('board.lookup') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <input type="text" name="class_code" placeholder="e.g., BSCS-3A" required style="padding: 10px; width: 80%; margin-bottom: 15px;">
            <br>
            <button type="submit" class="btn" style="background: blue; color: white; padding: 10px 20px; border: none; cursor: pointer;">View Board</button>
        </form>
    </div>

</body>
</html>