<!-- resources/views/bills/create.blade.php -->

@extends('./layout/layouts')

@section('content')
<div class="container">
    <h2>Create Bill</h2>

    <form method="POST" action="{{ route('bills.store') }}">
        @csrf

        <!-- Product Selection -->
        <div id="products-container">
            <div class="product-item">
                <label for="product">Product</label>
                <select name="product_id[]" class="product-select" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>

                <label for="quantity">Quantity</label>
                <input type="number" name="quantity[]" class="quantity" min="1" value="1" required>

                <label for="subtotal">Subtotal</label>
                <input type="number" name="subtotal[]" class="subtotal" readonly>
            </div>
        </div>

        <!-- Add New Product Row Button -->
        <button type="button" id="add-product-btn" class="btn btn-secondary">Add Product</button>

        <!-- Total Amount Calculation -->
        <hr>
        <div>
            <label for="total">Total Amount:</label>
            <input type="number" name="total_amount" id="total_amount" value="0" readonly>
        </div>

        <!-- Paid Amount and Change -->
        <div>
            <label for="paid_amount">Paid Amount:</label>
            <input type="number" name="paid_amount" id="paid_amount" min="0" value="0" required>
        </div>

        <div>
            <label for="change_amount">Change:</label>
            <input type="number" name="change_amount" id="change_amount" value="-1" readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submitBtn" class="btn btn-primary">Generate Bill</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    let myBtn = document.getElementById("submitBtn");
    let change = document.getElementById("change_amount");

    change.addEventListener("input", function () {
        let changeValue = parseFloat(change.value);

        if (changeValue < 0) {
            myBtn.disabled = true;
        } else {
            myBtn.disabled = false;
        }
    });
</script>

@endsection
