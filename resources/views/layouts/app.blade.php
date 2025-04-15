<!DOCTYPE html>
<html>
<head>
    <title>NAXUM Admin Portal</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('dashboard') }}">NAXUM Admin</a>
        @auth
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('accounts.index') }}">Accounts</a>
                <a class="nav-link" href="{{ route('accounts.create') }}">Create Account</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                </form>
            </div>
        @endauth
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>