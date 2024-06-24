@extends('layoutdash.admindashboard')
@section('content')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Welcome, {{ auth()->user()->name }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
  <p class="datetime">{{ now()->format('l, jS F Y') }}</p>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Clients Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card clients-card">
            <div class="card-body">
              <h5 class="card-title">Clients</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-badge"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $clientsCount }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Clients Card -->

        <!-- Admins Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card admins-card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-circle"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $adminsCount }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Admins Card -->

        <!-- Visual Sites Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card visual-sites-card">
            <div class="card-body">
              <h5 class="card-title">Visual Sites</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-display"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $visualSitesCount }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Visual Sites Card -->

      </div><!-- End row -->
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">
      <div class="card welcome-card">
        <div class="card-body">
          <h5 class="card-title">Welcome!</h5>
          <p class="card-text">You are logged in as {{ auth()->user()->name }}.</p>
          <p class="card-text">Current Date: {{ now()->format('l, jS F Y') }}</p>
          <p class="card-text">Current Time: {{ now()->format('h:i A') }}</p>
        </div>
      </div>
    </div><!-- End Right side columns -->

  </div><!-- End row -->
</section><!-- End section -->

</main><!-- End #main -->



<style>
  .info-card {
    transition: transform 0.9s ease-in-out;
    cursor: pointer;
  }

  .info-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card-icon {
    width: 50px;
    height: 50px;
    font-size: 1.5rem;
    background-color: #f8f9fa;
    color: #343a40;
  }

  .clients-card .card-icon {
    background-color: #007bff;
    color: #fff;
  }

  .admins-card .card-icon {
    background-color: #28a745;
    color: #fff;
  }

  .visual-sites-card .card-icon {
    background-color: #ffc107;
    color: #fff;
  }

  .welcome-card {
    background-color: #f8f9fa;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.9s ease-in-out;
    cursor: pointer;
    position: relative; /* Ensure position for pseudo-element */
  }

  .welcome-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Adjusted shadow on hover */
  }

  .welcome-card:hover::before {
    content: "";
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    border: 2px solid #007bff; /* Example border color */
    border-radius: 10px; /* Adjust border radius */
    z-index: -1;
    animation: pulse-border 1s infinite alternate; /* Animation effect */
  }

  @keyframes pulse-border {
    0% {
      transform: scale(1);
      opacity: 1;
    }
    100% {
      transform: scale(1.1);
      opacity: 0;
    }
  }

  .welcome-card .card-body {
    padding: 20px;
  }

  .datetime {
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 10px;
  }
</style>
@endsection


