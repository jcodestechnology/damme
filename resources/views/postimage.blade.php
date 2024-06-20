@extends('layoutdash.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Post image</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
  <div class="row">

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

                    <h5 class="card-title">Post image</h5>
                    <form action="{{ route('postimage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="siteSelect" class="form-label">Select Site</label>
                            <select class="form-select" id="siteSelect" name="site_id" required>
                                @foreach($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imageUpload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="imageUpload" name="image" required>
                        </div>
                        <!-- New Field: Picture Description -->
                        <div class="mb-3">
                            <label for="pictureDescription" class="form-label">Picture Description</label>
                            <input class="form-control" type="text" id="pictureDescription" name="description">
                        </div>
                        <!-- End of New Field -->
                        <button type="submit" class="btn btn-primary">Post Image</button>
                    </form>
                </div>
            </div>
        </div>
</div>
    </section>

</main><!-- End #main -->
@endsection
