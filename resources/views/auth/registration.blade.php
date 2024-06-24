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
            background-color: #f8f9fa;
        }
        .full-height {
            height: 100%;
        }
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 10px;
            max-width: 500px; /* Adjusted width to match the login page */
            margin-top: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 100px;
            animation: fadeIn 1s;
        }
        .powered-by {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: center;
            margin-top: 20px;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center full-height">
        <div class="text-center">
            <div class="card w-100">
                <div class="card-body">
                    <img src="{{ URL::asset('imports_dashboard/assets/img/udomlg.png') }}" alt="Logo" class="logo">
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
                            <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                        </div>
                        <input type="hidden" name="user_role" value="client">
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center">Already have an account? <a href="/">Login here</a></p>
                </div>
            </div>
            <div class="powered-by">
                Powered by University of Dodoma
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
