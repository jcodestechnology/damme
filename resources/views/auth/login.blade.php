<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Tour</title>
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
        .welcome-text {
            font-size: 1.5rem;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            animation: slideIn 1s ease-in-out, moveLeftRight 2s infinite;
            background-color: #007bff;
            padding: 10px;
            border-radius: 5px;
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
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes moveLeftRight {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(10px); }
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center full-height">
        <div class="text-center">
            <div class="welcome-text">
                Welcome to the Virtual Tour System! <br> Experience seamless navigation and immersive tours.
            </div>
            <div class="card w-100 mt-3" style="max-width: 500px;">
                <div class="card-body">
                    <img src="{{ URL::asset('imports_dashboard/assets/img/udomlg.png') }}" alt="Logo" class="logo">
                    <h5 class="card-title text-center mb-4">Login</h5>

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

                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                            @if ($errors->has('emailPassword'))
                                <span class="text-danger">{{ $errors->first('emailPassword') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Signin</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center">Don't have an account? <a href="registration">Register here</a></p>
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
