<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StoreMaster - Bill #{{ $bill->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 20px;
            color: #000;
        }

        .invoice-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #333;
            padding: 20px;
        }

        .store-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .store-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .bill-details, .customer-details {
            margin-bottom: 20px;
        }

        .bill-details table,
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .items-table th {
            background-color: #f0f0f0;
        }

        .totals {
            margin-top: 20px;
            text-align: right;
        }

        .totals div {
            margin-bottom: 6px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Store Header -->
        <div class="store-header">
            <h2>🛒 StoreMaster</h2>
            <p>123 Main Street, City, Country<br>Phone: (123) 456-7890</p>
        </div>

        <!-- Bill Details -->
        <div class="bill-details">
            <table>
                <tr>
                    <td><strong>Bill ID:</strong> {{ $bill->id }}</td>
                    <td><strong>Date:</strong> {{ $bill->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <!-- Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price (Rs.)</th>
                    <th>Subtotal (Rs.)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bill->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->product->price, 2) }}</td>
                        <td>{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals">
            <div><strong>Total:</strong> Rs. {{ number_format($bill->total_amount, 2) }}</div>
            <div><strong>Paid:</strong> Rs. {{ number_format($bill->paid_amount, 2) }}</div>
            <div><strong>Change:</strong> Rs. {{ number_format($bill->change_amount, 2) }}</div>
        </div>

        <!-- Print Button -->
        <div class="text-center no-print" style="margin-top: 20px;">
            <button onclick="window.print()" class="btn btn-primary">🖨️ Print Bill</button>
        </div>
    </div>
</body>
</html>
