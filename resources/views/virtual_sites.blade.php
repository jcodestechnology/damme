@extends('layoutdash.userdashboard')

@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Virtual Sites</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  @if ($sites->isEmpty())

  <div class="alert alert-info">
                        No visualization site posted.
                    </div>
   
  @else
    <div class="row">
      @foreach($sites as $site)
      <div class="col-md-6">
        <a href="{{ route('site.images', $site->id) }}" class="card-link">
          <div class="card text-center card-hoverable">
            <div class="card-body">
              <h5 class="card-title">{{ $site->name }}</h5>
              <p class="card-text">{{ $site->description }}</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  @endif
</section>

</main><!-- End #main -->

<style>
  .card-hoverable {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  .card-hoverable:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 16px rgba(0,0,0,0.2);
  }
  .card-link {
    text-decoration: none;
    color: inherit;
  }
  .card {
    margin: 20px;
  }
</style>
@endsection
