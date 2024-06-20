@extends('layoutdash.admindashboard')
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Post Site</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
         <!-- Display messages -->
         @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

        <h5 class="card-title">Post Site</h5>

        <!-- Vertical Form -->
        <form class="row g-3" action="{{ route('sites.store') }}" method="POST">
          @csrf
          <div class="col-12">
            <label for="siteName" class="form-label">Site Name</label>
            <input type="text" class="form-control" id="siteName" name="siteName" placeholder="Enter site name">
          </div>
          <div class="col-12">
            <label for="siteDescription" class="form-label">Site Description</label>
            <textarea class="form-control" id="siteDescription" name="siteDescription" rows="4" placeholder="Enter site description"></textarea>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form><!-- Vertical Form -->

      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

@endsection
