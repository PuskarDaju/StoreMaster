@extends('layout.layout')

@section('content')

<div class="container mt-4">
    @if ($errors->any())
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
        
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✏️ Edit User</h4>
        </div>
        <div class="card-body">
            <form id="editUserForm" method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">👤 Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">📧 Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">🛡️ Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ (old('role', $user->role) == 'user') ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">← Back to Users</a>

                    <div>
                        <a href="{{route('users.showChangePasswordForm',$user->id) }}" class="btn btn-warning me-2">
                        
                            🔒 Change Password
                        </a>

                        <button type="submit" class="btn btn-primary">💾 Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
