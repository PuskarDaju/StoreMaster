@extends('.layout/layout')
@section('content')
<h1>Edit Category</h1>

<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" value="{{$category->name}}" required>
    <br><br>

    <button type="submit">Update Category</button>
</form>

<br>
<a href="{{ route('products.index') }}">Back to Product List</a>


    
@endsection
  