<!DOCTYPE html>
<html>
<head>
    <title>Login - {{ tenant('company_name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Login to {{ tenant('company_name') }}</div>
                    <div class="card-body">
                        <form action="{{ route('tenant.login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <hr>
                        <a href="{{ route('tenant.register') }}">Register new account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
