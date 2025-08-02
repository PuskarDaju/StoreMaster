<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StoreMaster</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/layout.css">

    @yield('css')
</head>
<body class="bg-gray-100 text-gray-900">

    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-2xl font-bold">🛒 StoreMaster</h1>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-4 min-h-screen">
            <nav class="space-y-3">
                <a href="{{ route('products.index') }}" class="block py-2 px-4 hover:bg-blue-100 rounded">Dashboard</a>
                <a href="{{ route('products.index') }}" class="block py-2 px-4 hover:bg-blue-100 rounded">Manage Products</a>
                <a href="{{ route('category.index') }}" class="block py-2 px-4 hover:bg-blue-100 rounded">Manage Categories</a>
                <a href="{{ route('bills.create') }}" class="block py-2 px-4 hover:bg-blue-100 rounded">Billing </a>
                <a href="{{ route('sell') }}" class="block py-2 px-4 hover:bg-blue-100 rounded">Sales </a>
                <a href="{{ route('analytics') }}" class="block py-2 px-4 hover:bg-blue-100 rounded">Reports & Analytics</a>
                <a href="{{ route('user.dashboard') }}" class="block py-2 px-4 hover:bg-blue-100 rounded">User Management</a>
                <form action="{{ route('logout') }}" method="POST" class="pt-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="mainContent p-4 w-full">
            @yield('content')
        </main>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Page-specific JS -->
    @yield('scripts')
</body>
</html>
