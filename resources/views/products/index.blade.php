@php
    use App\Http\Controllers\BubbleSortController;

     $sortedProducts = BubbleSortController::getSorted($products->toArray(), 'asc');
@endphp

@extends('./layout/layout')
<style>
    .active{
        background-color: pink;
    }
</style>

@section('content')

    <h1>Product List</h1>
    <a href="{{ route('products.create') }}">Add New Product</a>
    <form method="GET" action="{{ route('products.search') }}">
        
    <input type="text" name="query" placeholder="Search products..." required>
    <button type="submit">Search</button>
</form>
    
    <table border="1">
        <thead>
            <tr>
                <th>
                    
                        Name
                    
                </th>
               <th>
                     Category
                </th>
              <th>
                       Price
                </th>
                <th>Stock Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- //using buuble sort to sort according to alphabets --}}
          <script>
    function setActiveButton(clickedButton) {
      // Get all buttons
      const buttons = document.querySelectorAll('.btn');

      // Remove 'active' class from all buttons
      buttons.forEach(button => {
        button.classList.remove('active');
      });

      // Add 'active' class to clicked button
      clickedButton.classList.add('active');
    }
    </script>
            

@php
    use App\Models\Product;

$eloquentCollection = Product::hydrate($sortedProducts);

@endphp

            @foreach ($eloquentCollection as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}">View</a>|
                        <a href="{{ route('products.edit', $product->id)}}">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
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
