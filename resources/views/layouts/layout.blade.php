<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mini-CRM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

    <nav class="navbar navbar-expand-sm bg-light navbar-light">
    <!-- Brand -->
    <a class="navbar-brand" href="/dashboard">Mini CRM</a>
    
    @if (Auth::check())
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">    
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/client">Clients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transaction">Transactions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
        </ul>
    </div>
    @else
    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">    
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
        </ul>
    </div>
    @endif
</nav>

<div class="container">
    @yield('content')
</div>


</body>
</html>