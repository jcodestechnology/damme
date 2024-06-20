@extends('layoutdash.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">View sites</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $key => $site)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $site->name }}</td>
                                <td>{{ $site->description }}</td>
                                <td>
    <form action="{{ route('view_processing', ['site_id' => $site->id]) }}" method="GET" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i>view</button>
    </form>
    <!-- <button class="btn btn-secondary make-visual">Make Visual</button> -->
</td>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

 
    
</main><!-- End #main -->

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Include FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Include Three.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

@endsection
