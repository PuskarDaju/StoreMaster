@extends('layout.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Welcome back, <strong>{{ auth()->user()->name }}</strong>!</h2>

    <div class="row mb-4">
        <!-- Quick Stats Cards -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text display-6">{{ number_format($totalSales, 2) }} Rs</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Products Handled</h5>
                    <p class="card-text display-6">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <!-- Add more stats cards if needed -->
    </div>

    <div class="row">
        <!-- Recent Sales Table -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Recent Sales
                </div>
                <div class="card-body p-0">
                    @if($recentSales->isEmpty())
                        <p class="text-center my-3">No recent sales found.</p>
                    @else
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Bill ID</th>
                                <th>Date</th>
                                <th>Total Amount (Rs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSales as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->created_at->format('d M, Y') }}</td>
                                    <td>{{ number_format($sale->total_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stock Alert -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    ⚠️ Low Stock Products
                </div>
                <div class="card-body p-0">
                    @if($lowStockProducts->isEmpty())
                        <p class="text-center my-3">No low stock alerts.</p>
                    @else
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->stock_quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="{{ route('bills.create') }}" class="btn btn-primary btn-lg shadow">Create New Sale</a>
        <a href="{{ route('user.profile.edit') }}" class="btn btn-secondary btn-lg shadow">Update Profile</a>
    </div>
</div>
@endsection
