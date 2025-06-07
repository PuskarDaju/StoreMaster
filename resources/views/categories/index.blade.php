
@extends('./layout/layout')

@section('content')

    <h1>Category List</h1>
    <a href="{{ route('category.create') }}">Add New Category</a>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    
                    <td>
                        
                        <a href="{{ route('category.edit', $category->id) }}">Edit</a>
                        <form action="{{ route('products.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endsection
