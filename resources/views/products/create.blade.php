@extends('layout.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">➕ Create New Product</h4>
        </div>
        <div class="card-body">
            <form id="productForm" action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">🛍️ Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter product name">
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">📁 Category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">💲 Price (Rs.)</label>
                    <input type="number" class="form-control" id="price" name="price" required placeholder="Enter price" min="1">
                </div>

                <div class="mb-3">
                    <label for="stock_quantity" class="form-label">📦 Stock Quantity</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required placeholder="Enter stock quantity" min="1">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        ← Back to Product List
                    </a>
                    <button type="submit" class="btn btn-primary">
                        ✅ Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const price = parseFloat(document.getElementById('price').value);
        const stock = parseInt(document.getElementById('stock_quantity').value);

        if (price <= 0) {
            alert("Price must be greater than 0.");
            e.preventDefault();
        }

        if (stock <= 0) {
            alert("Stock quantity must be greater than 0.");
            e.preventDefault();
        }
    });
</script>
@endsection
