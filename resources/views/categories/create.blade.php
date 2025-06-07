@extends('./layout/layout')
@section('content')
<h1>Create Category</h1>

<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" required>
    <br><br>


    <button type="submit">Create Category</button>
</form>

<br>
<a href="{{ route('category.index') }}">Back to Product List</a>

    
@endsection
