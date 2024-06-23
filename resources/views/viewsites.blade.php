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
                    @if ($sites->isEmpty())
                    <div class="alert alert-info">
                        No visualization site posted.
                    </div>
                    @else
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
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i> View</button>
                                    </form>
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $site->id }}" data-name="{{ $site->name }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Message Display Area -->
    <div id="messageArea" class="mt-3">
        <!-- Messages will be displayed here -->
    </div>

</main><!-- End #main -->

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap JS (including Popper.js) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        // Delete button click handler
        $('.delete-button').on('click', function() {
            const siteId = $(this).data('id');
            const siteName = $(this).data('name');

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${siteName}". This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX request to delete the site
                    $.ajax({
                        url: `{{ route('delete_site', ['site_id' => ':site_id']) }}`.replace(':site_id', siteId),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Update message area with success message
                            $('#messageArea').html(`<div class="alert alert-success">${response.message}</div>`);
                            
                            // Reload the page after 1 second (adjust time as needed)
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the site.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
