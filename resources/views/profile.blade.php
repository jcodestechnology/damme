@extends('layoutdash.userdashboard')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">My profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{ asset(Auth::user()->profile) }}" alt="Profile" class="rounded-circle">
                        <h2>{{ Auth::user()->name }}</h2>
                        <h3>{{ Auth::user()->user_role }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Name</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Designation</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->user_role }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Profile Image -->
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="profileImage" src="{{ asset(Auth::user()->profile) }}" alt="Profile">
                                            <input type="file" id="uploadInput" name="profile" accept="image/*" style="display: none;">
                                            <div class="pt-2">
                                                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" onclick="document.getElementById('uploadInput').click(); return false;"><i class="bi bi-upload"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" onclick="removeProfileImage(); return false;"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Name field -->
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <!-- Save Changes Button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn" style="background:#086808; color:#FFFFFF">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{ route('change.password') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input id="currentPassword" type="password" class="form-control" name="current_password" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input id="newPassword" type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input id="confirmPassword" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn" style="background:#086808; color:#FFFFFF">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>

                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    function removeProfileImage() {
        var profileImage = document.getElementById('profileImage');
        profileImage.src = ''; // Clear the src attribute to remove the image
    }
</script>

@endsection
