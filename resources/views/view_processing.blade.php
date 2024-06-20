@extends('layoutdash.admindashboard')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $site->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">View Site</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section>
        <div class="row mb-3">
            <div class="col-12">
                <a href="../viewsites" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="row">
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

            <div class="col-lg-4">
                @if($images->count() > 0)
                    <ul class="list-group">
                        @foreach($images as $image)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="#" class="image-link" data-image="{{ asset($image->image_path) }}">
                                {{ $image->description }}
                            </a>
                            <div>
                                <a href="#" class="icon-button edit-button" title="Edit" data-id="{{ $image->id }}" data-description="{{ $image->description }}" data-image-path="{{ asset($image->image_path) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="icon-button delete-button" title="Delete" data-id="{{ $image->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-info">
                        No image posted yet.
                    </div>
                @endif
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div id="image-display" style="width: 100%; height: 500px;">
                            <!-- 360° viewer will be initialized here -->
                        </div>
                        <div class="mt-3 d-flex justify-content-around">
                            <a href="javascript:void(0)" id="rotate-left" class="icon-button" title="Rotate Left">
                                <i class="fas fa-undo"></i>
                            </a>
                            <a href="javascript:void(0)" id="rotate-right" class="icon-button" title="Rotate Right">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Include FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Include Three.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        const links = document.querySelectorAll('.image-link');
        const display = document.getElementById('image-display');
        let camera, scene, renderer;

        function initializeViewer(imageSrc) {
            if (!imageSrc) {
                console.error('Image source is not provided');
                return;
            }

            // Clear any previous content in the display
            display.innerHTML = '';

            // Create the renderer
            renderer = new THREE.WebGLRenderer();
            renderer.setSize(display.clientWidth, display.clientHeight);
            display.appendChild(renderer.domElement);

            // Create the scene
            scene = new THREE.Scene();

            // Create the camera
            camera = new THREE.PerspectiveCamera(75, display.clientWidth / display.clientHeight, 0.1, 1000);
            camera.position.set(0, 0, 0.1);

            // Add the 360° image as a sphere
            const texture = new THREE.TextureLoader().load(imageSrc);
            const geometry = new THREE.SphereGeometry(500, 60, 40);
            geometry.scale(-1, 1, 1); // Invert the geometry on the x-axis so that all of the faces point inward
            const material = new THREE.MeshBasicMaterial({ map: texture });
            const sphere = new THREE.Mesh(geometry, material);
            scene.add(sphere);

            // Render the scene
            animate();
        }

        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
            camera.rotation.y += 0.001; // Adjust rotation speed here (e.g., 0.005 radians per frame)
        }

        // Add click event listeners to each image link
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const imageSrc = this.dataset.image;
                initializeViewer(imageSrc);
            });
        });

        // Initialize viewer with the first image if available
        @if ($images->count() > 0)
        const initialImage = "{{ asset($images->first()->image_path) }}";
        initializeViewer(initialImage);
        @endif

        // Handle window resize
        window.addEventListener('resize', () => {
            camera.aspect = display.clientWidth / display.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(display.clientWidth, display.clientHeight);
        });

        // Rotate left icon
        document.getElementById('rotate-left').addEventListener('click', function() {
            camera.rotation.y -= Math.PI / 4; // Rotate 45 degrees left
        });

        // Rotate right icon
        document.getElementById('rotate-right').addEventListener('click', function() {
            camera.rotation.y += Math.PI / 4; // Rotate 45 degrees right
        });

        // Handle edit button click
        $('.edit-button').on('click', function() {
            const id = $(this).data('id');
            const description = $(this).data('description');
            const imagePath = $(this).data('image-path');

            Swal.fire({
                title: 'Edit Image',
                html:
                `<form id="editImageForm" action="/image/${id}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" value="${description}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Choose new image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <input type="hidden" id="image_id" name="image_id" value="${id}">
                </form>`,
                showCancelButton: true,
                confirmButtonText: 'Update Image',
                preConfirm: () => {
                    $('#editImageForm').submit();
                }
            });
        });

        // Handle delete button click
        $('.delete-button').on('click', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/image/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your image has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(response) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the image.',
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
