<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1>Super Admin - Manage Companies</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-header">Create New Company (Tenant)</div>
            <div class="card-body">
                <form action="{{ route('superadmin.tenants.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Tenant ID (Subdomain)</label>
                        <input type="text" name="id" class="form-control" placeholder="e.g. company1" required>
                    </div>
                    <div class="mb-3">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Domain</label>
                        <input type="text" name="domain" class="form-control" placeholder="e.g. company1.localhost" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Tenant</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Existing Companies</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Domain</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenants as $tenant)
                            <tr>
                                <td>{{ $tenant->id }}</td>
                                <td>{{ $tenant->company_name }}</td>
                                <td>{{ $tenant->domains->first()->domain ?? 'N/A' }}</td>
                                <td>{{ $tenant->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
