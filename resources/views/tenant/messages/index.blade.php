<!DOCTYPE html>
<html>
<head>
    <title>Messages - {{ tenant('company_name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">{{ tenant('company_name') }} - Internal Messaging</span>
            <div class="d-flex">
                <span class="text-white me-3">Hello, {{ Auth::user()->name }}</span>
                <form action="{{ route('tenant.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Send Message</div>
                    <div class="card-body">
                        <form action="{{ route('tenant.messages.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Recipient</label>
                                <select name="receiver_id" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Message</label>
                                <textarea name="content" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Conversation History</div>
                    <div class="card-body">
                        @foreach($messages as $msg)
                            <div class="mb-3 p-2 border-bottom">
                                <strong>{{ $msg->sender->name }}</strong> to <strong>{{ $msg->receiver->name }}</strong>
                                <p class="mb-1">{{ $msg->content }}</p>
                                <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
