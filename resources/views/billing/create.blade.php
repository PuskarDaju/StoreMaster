@extends('./layout/layout')

@section('content')
<div class="container">
    <h2>Create Bill</h2>

    <div id="product-options" style="display: none;">
        @foreach($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
        @endforeach
    </div>
    <!-- Bill Form -->
    <form method="POST" action="{{ route('bills.store') }}">
        @csrf

        <span class="error">
          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



        </span>

        <!-- Product Selection and Quantity -->
        <table class="table table-bordered" id="products-container">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="product-item">
                    <!-- Product Dropdown -->
                    <td>
                        <select name="product_id[]" class="product-select form-control" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <!-- Quantity Input -->
                    <td>
                        <input type="number" name="quantity[]" class="quantity form-control" min="1" value="1" required>
                    </td>

                    <!-- Rate Display (readonly) -->
                    <td>
                        <input type="number" name="rate[]" class="rate form-control" readonly>
                    </td>
                    <!--  SubTotal readonly-->
                    <td>
                        <input type="number" name="subtotal[]" class="subtotal form-control" readonly>
                    </td>

                    <!-- Remove Button -->
                    <td>
                        <button type="button" class="btn btn-danger remove-product-btn">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Add New Product Row Button -->
        <button type="button" id="add-product-btn" data-products="{{ json_encode($products->toArray()) }}" " class="btn btn-secondary mb-3">Add Product</button>


        <!-- Total Amount Calculation -->
        <hr>
        <div class="form-group">
            <label for="total_amount">Total Amount:</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control" value="0" readonly>
        </div>

        <!-- Paid Amount and Change -->
        <div class="form-group">
            <label for="paid_amount">Paid Amount:</label>
            <input type="number" name="paid_amount" id="paid_amount" class="form-control" min="0" value="0" required>
        </div>

        <div class="form-group">
            <label for="change_amount">Change:</label>
            <input type="number" name="change_amount" id="change_amount" class="form-control" value="0" readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="generate-bill-btn" class="btn btn-primary" disabled>Generate Bill</button>
    </form>
</div>

<!-- jQuery for Dynamic Calculations -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('/js/bill.js') }}"></script>
   

@endsection
