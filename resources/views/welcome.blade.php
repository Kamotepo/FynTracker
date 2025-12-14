<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FynTracker - Smart Financial Tracking</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS (optional if you still have it) -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<!-- Navbar -->
<nav id="mainNavbar"
     class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top"
     style="background: linear-gradient(135deg,#0f172a,#1e3a8a);">
     
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">FynTracker</a>

    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="nav-link btn btn-link text-light">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth

      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-section py-5 text-light" style="background: linear-gradient(135deg,#0f172a,#1e3a8a);">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-3 fw-bold">Take Control of Your Finances</h1>
        <p class="lead mb-4">
          Track income, expenses, and goals effortlessly with <strong>FynTracker</strong>.
          Visualize your money, make smarter decisions, and achieve financial freedom.
        </p>

        @auth
          <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg me-2">Go to Dashboard</a>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-outline-light btn-lg">Logout</button>
          </form>
        @else
          <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">Get Started Free</a>
          <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Login</a>
        @endauth

      </div>

      <div class="col-lg-6 text-center">
        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1200&q=80" 
             class="img-fluid rounded shadow-lg"
             alt="Finance Dashboard">
      </div>

    </div>
  </div>
</section>

<!-- Features -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold text-dark">Why Choose FynTracker?</h2>

    <div class="row text-center">
      <div class="col-md-4">
        <div class="card feature-card p-4 border-0 h-100">
          <h5 class="card-title fw-bold text-primary">Smart Tracking</h5>
          <p class="card-text">Log income & expenses easily and keep everything organized.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card feature-card p-4 border-0 h-100">
          <h5 class="card-title fw-bold text-primary">Visual Reports</h5>
          <p class="card-text">See your financial health using charts and summaries.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card feature-card p-4 border-0 h-100">
          <h5 class="card-title fw-bold text-primary">Goal Setting</h5>
          <p class="card-text">Plan savings and achieve your financial goals faster.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-5 text-light" style="background: linear-gradient(135deg,#1e3a8a,#2563eb);">
  <div class="container text-center">
    <h2 class="fw-bold">Ready to Master Your Money?</h2>
    <p class="mb-4">Join thousands already using FynTracker.</p>

    @auth
      <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Go to Dashboard</a>
    @else
      <a href="{{ route('register') }}" class="btn btn-light btn-lg">Get Started Free</a>
    @endauth
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-light text-center py-4">
  <div class="container">
    <p class="mb-2">&copy; 2025 FynTracker. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
