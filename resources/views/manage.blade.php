@extends('layoutdash.admindashboard')
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Home</a></li>
      <li class="breadcrumb-item active">Manage users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
          <h5 class="card-title">Users</h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped table-responsive">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Profile</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                  <img src="{{ asset($user->profile) }}" alt="{{ $user->name_picture }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->user_role }}</td>
                <td>
                  <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-profile="{{ $user->profile }}">Edit</button>
                  <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->id }}">Delete</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="edit-name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="edit-email" class="form-label">Email</label>
            <input type="email" class="form-control" id="edit-email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="edit-profile_image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" id="edit-profile_image" name="profile">
            <img id="edit-profile-img-preview" class="img-thumbnail mt-2" style="width: 100px;">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteForm" action="" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this user?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

</main><!-- End #main -->

<!-- Scripts -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Edit button click handler
    document.querySelectorAll('.edit-btn').forEach(button => {
      button.addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        const userName = this.getAttribute('data-name');
        const userEmail = this.getAttribute('data-email');
        const userProfile = this.getAttribute('data-profile');
        
        // Set form action
        document.getElementById('editForm').action = `/users/${userId}`;
        
        // Populate form fields
        document.getElementById('edit-name').value = userName;
        document.getElementById('edit-email').value = userEmail;
        if (userProfile) {
          document.getElementById('edit-profile-img-preview').src = `/uploads/profile_images/${userProfile}`;
        } else {
          document.getElementById('edit-profile-img-preview').src = '';
        }
        
        // Show modal
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
      });
    });

    // Delete button click handler
    document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        
        // Set form action
        document.getElementById('deleteForm').action = `/users/${userId}`;
        
        // Show modal
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
      });
    });
  });
</script>
@endsection
