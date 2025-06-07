<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StoreMaster</title>
    <link rel="stylesheet" href="/css/layout.css"> {{-- If using Vite --}}
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
                <a href="" class="block py-2 px-4 hover:bg-blue-100 rounded">Reports & Analytics</a>
                <a href="" class="block py-2 px-4 hover:bg-blue-100 rounded">User Management</a>
                <form action="{{  route('logout')}}" method="POST">
                    @csrf
                    
                    <button type="submit">Logout</button>
                </form>
                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form> --}}
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="mainContent">
            @yield('content')
        </main>
    </div>

</body>
</html>
