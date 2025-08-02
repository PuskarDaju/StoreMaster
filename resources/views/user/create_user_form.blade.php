@extends('layout.layout')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">➕ Create New User</h4>
        </div>
        <div class="card-body">
            <form id="userForm" method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">👤 Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">📧 Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">🔒 Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required minlength="6">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">🔒 Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter password" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Back to Users</a>
                    <button type="submit" class="btn btn-primary">✅ Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('userForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirmation').value;

        if (password.length < 6) {
            alert("Password must be at least 6 characters.");
            e.preventDefault();
        }

        if (password !== confirm) {
            alert("Passwords do not match.");
            e.preventDefault();
        }
    });
</script>
@endsection
