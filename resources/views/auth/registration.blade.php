<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Virtual Tour System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .full-height {
            height: 100%;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center full-height">
        <div class="card w-100" style="max-width: 400px;">
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
                <h5 class="card-title text-center mb-4">Virtual Tour System - Register</h5>
                <form action="{{ route('register.custom') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                    </div>
                    <input type="hidden" name="user_role" value="client">
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                    </div>
                </form>
                <p class="mt-3 text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
