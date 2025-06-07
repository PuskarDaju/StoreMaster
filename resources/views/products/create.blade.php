@extends('./layout/layout')
@section('content')
<h1>Create Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" required>
    <br><br>

    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" required>
    <br><br>

    <label for="stock_quantity">Stock Quantity:</label>
    <input type="number" id="stock_quantity" name="stock_quantity" required>
    <br><br>

    <button type="submit">Create Product</button>
</form>

<br>
<a href="{{ route('products.index') }}">Back to Product List</a>

    
@endsection
