@extends('.layout/layout')
@section('content')
<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
   @method('PUT')
    
    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" value="{{ $product->name }}" required>
    <br><br>

    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" value="{{ $product->price }}" required>
    <br><br>

    <label for="stock_quantity">Stock Quantity:</label>
    <input type="number" id="stock_quantity" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
    <br><br>

    <button type="submit">Update Product</button>
</form>

<br>
<a href="{{ route('products.index') }}">Back to Product List</a>


    
@endsection
  