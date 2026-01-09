<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Simple Layout</title>

@yield('styles')
</head>

<body>

<!-- Header -->
<header>
    <nav>
        <ul class="menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- Main Section -->
<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Sidebar</h2>
        <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <section class="content">
       @yield('content')
    </section>

</div>

<!-- Footer -->
<footer>
    © 2025 My Website. All rights reserved.
</footer>
</body>
@yield('scripts')
</html>
