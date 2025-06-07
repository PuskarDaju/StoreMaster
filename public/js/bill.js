$(document).ready(function() {
    // Calculate total and subtotal on product or quantity change
    $('#products-container').on('change input', '.product-select, .quantity', function() {
        let total = 0;

        $('.product-item').each(function() {
            const price = parseFloat($(this).find('.product-select option:selected').data('price'));
            const quantity = parseInt($(this).find('.quantity').val()) || 0;
            const subtotal = price * quantity;

            // Update the subtotal for the current product
            $(this).find('.subtotal').val(subtotal.toFixed(2));
            $(this).find('.rate').val(price.toFixed(2))

            total += subtotal;
        });

        // Update the total amount field
        $('#total_amount').val(total.toFixed(2));
        calculateChange();
    });

    
    // Calculate change when paid amount changes
    $('#paid_amount').on('input', function() {
        calculateChange();
    });

    function calculateChange() {
        const total = parseFloat($('#total_amount').val()) || 0;
        const paidAmount = parseFloat($('#paid_amount').val()) || 0;
        const change = paidAmount - total;
        if(paidAmount==0||paidAmount==null){
            $('#change_amount').val(0);
        }else{
        $('#change_amount').val(change.toFixed(2));
        }
    }
    function checkPaidAmount() {
    const totalAmount = parseFloat($('#total_amount').val()) || 0;
    const paidAmount = parseFloat($('#paid_amount').val()) || 0;

    // Disable the button if the paid amount is less than or equal to the total amount
    if(totalAmount!=0){
    if (paidAmount >= totalAmount) {
        $('#generate-bill-btn').prop('disabled', false); // Enable the button
    } else {
        $('#generate-bill-btn').prop('disabled', true); // Disable the button
    }
}else{
     $('#generate-bill-btn').prop('disabled', true);
}
}

// Trigger checkPaidAmount function whenever the paid amount or total amount changes
$('#paid_amount, #total_amount').on('input', function() {
    checkPaidAmount();
});

// Initial check on page load to handle pre-filled values
checkPaidAmount();
   
       

    // Add a new product row to the form
    $('#add-product-btn').click(function() {
        let productOptions = $('#product-options').html();
        $('#products-container tbody').append(`
            <tr class='product-item'>
                   
                    <td>
                        <select name="product_id[]" class="product-select form-control" required>
                            <option value="">Select Product</option>
                            ${productOptions}
                        </select>
                    </td>

                 
                    <td>
                        <input type="number" name="quantity[]" class="quantity form-control" min="1" value="1" required>
                    </td>

                   
                    <td>
                        <input type="number" name="rate[]" class="rate form-control" readonly>
                    </td>
                  
                    <td>
                        <input type="number" name="subtotal[]" class="subtotal form-control" readonly>
                    </td>

                    
                    <td>
                        <button type="button" class="btn btn-danger remove-product-btn">Remove</button>
                    </td>
                </tr>
        `);
    });
    

    // Remove product row functionality
    $('#products-container').on('click', '.remove-product-btn', function() {
        $(this).closest('tr').remove();
        // Recalculate total after row removal
        $('#products-container').trigger('change');
    });
});