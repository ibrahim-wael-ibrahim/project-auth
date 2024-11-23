{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>

    {{-- Display the token, if present --}}
    @if(session('token'))
        <p>Your token: {{ session('token') }}</p>
    @endif

    {{-- Example: If user role exists, show different content --}}
    @if(auth()->user()->role === 'admin')
        <p>You are an admin. You can manage users here.</p>
    @else
        <p>You are a regular employee.</p>
    @endif
</body>
</html>
