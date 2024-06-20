@extends('layoutdash.admindashboard')
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"></a>
              
            </div>

            <div class="card-body">
              <h5 class="card-title">Users</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>145</h6>
          

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->
    <!-- Sales Card -->
    <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"></a>
              
            </div>

            <div class="card-body">
              <h5 class="card-title">Sites</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-geo-alt"></i>


                </div>
                <div class="ps-3">
                  <h6>10</h6>
          

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

       
      </div>
    </div><!-- End Left side columns -->


</section>

</main><!-- End #main -->


@endsection