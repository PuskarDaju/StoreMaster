@extends('layout.layout')

@section('content')
<div class="container mt-4">
     @if ($errors->any())
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
        
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">🔒 Change Password for {{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.updatePassword', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" id="password" name="password" class="form-control" required minlength="6" placeholder="Enter new password">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Confirm new password">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-secondary">← Back to Edit User</a>
                    <button type="submit" class="btn btn-warning">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
