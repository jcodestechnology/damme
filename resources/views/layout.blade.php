<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Virtual Tour System</title>
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
                <h5 class="card-title text-center mb-4">Virtual Tour System</h5>
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p class="mt-3 text-center">Don't have an account? <a href="{{ route('register-user') }}">Register here</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
