@extends('layout.layout')

@section('content')
   @if ($errors->any())
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
        
    @endif
<div class="container mt-4">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>👥 User Management</h2>
        {{-- Optional Add User button --}}
        <a href="{{ route('user.showCreate') }}" class="btn btn-primary">Add New User</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table id="usersTable" class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-sm btn-warning fixed-width-btn">Edit</a>
   
@if ($user->id === auth()->id())
    <button class="btn btn-sm btn-secondary" style="min-width: 85px" disabled>This is You</button>
@else
    <form method="POST" action="{{ route('user.status', $user->id) }}" class="d-inline-block status-form">
        @csrf
        <button type="button"
                class="btn btn-sm {{ $user->status == 'active' ? 'btn-danger' : 'btn-success' }} confirm-status-btn"
                style="min-width: 85px"
                data-username="{{ $user->name }}"
                data-status="{{ $user->status }}">
            {{ $user->status == 'active' ? 'Deactivate' : 'Activate' }}
        </button>
    </form>
@endif


</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.querySelectorAll('.confirm-status-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const userName = this.getAttribute('data-username');
            const currentStatus = this.getAttribute('data-status');
            const newStatus = currentStatus === 'active' ? 'deactivate' : 'activate';

            Swal.fire({
                title: `Are you sure?`,
                text: `You are about to ${newStatus} ${userName}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${newStatus}`,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });


    $(document).ready(function () {
        $('#usersTable').DataTable({
            responsive: true,
            language: {
                search: "🔍 Search:",
                lengthMenu: "Show _MENU_ users per page",
                zeroRecords: "No users found",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                infoEmpty: "No users available",
                infoFiltered: "(filtered from _MAX_ total users)"
            }
        });
    });
</script>
@endsection
