@extends('layout.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">📈 Analytics Dashboard</h2>

    <!-- Progress Circle centered on top -->
    <div class="d-flex justify-content-center mb-5 bg-white">
    @php
    $progressPercent = $predictedSales > 0 ? round(($actualSales / $predictedSales) * 100, 2) : 0;
    $circumference = 2 * 3.1416 * 45; // circle circumference
    $offset = $circumference - ($circumference * $progressPercent / 100);
@endphp

<div style="position: relative; width: 180px; height: 180px;">
    <svg width="180" height="180" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" stroke="#eee" stroke-width="10" fill="none" />
        <circle
            id="progressCircle"
            cx="50" cy="50" r="45"
            stroke="#36b9cc"
            stroke-width="10"
            fill="none"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $circumference }}"
            stroke-linecap="round"
            transform="rotate(-90 50 50)"
            style="transition: stroke-dashoffset 1.5s ease-out;"
        />
    </svg>

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        text-align: center; font-weight: bold; font-size: 1.2rem; width: 120px;">
        <div>Predicted</div>
        <div>Rs. {{ number_format($predictedSales, 2) }}</div>
        <div style="font-size: 1.4rem; color: #36b9cc;" id="progressPercent">0%</div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const circle = document.getElementById('progressCircle');
        const percentText = document.getElementById('progressPercent');
        const circumference = {{ $circumference }};
        const offset = {{ $offset }};
        const finalPercent = {{ $progressPercent }};

        // Animate circle progress
        setTimeout(() => {
            circle.style.strokeDashoffset = offset;
        }, 200);

        // Animate number count from 0 to finalPercent
        let current = 0;
        const duration = 1500; // animation duration in ms
        const intervalTime = 15; // update every 15ms
        const steps = duration / intervalTime;
        const increment = finalPercent / steps;

        const counter = setInterval(() => {
            current += increment;
            if (current >= finalPercent) {
                current = finalPercent;
                clearInterval(counter);
            }
            percentText.textContent = current.toFixed(0) + '%';
        }, intervalTime);
    });
</script>

    </div>

    <!-- Two tables side-by-side below -->
    <div class="row">
       {{-- alert table here --}}
       <div class="col-md-6">
    <h4 class="mb-3 text-danger">⚠️ Stock Alert (Qty < 10)</h4>
    @if ($stockAlerts->isEmpty())
        <p class="text-muted fst-italic">All products have sufficient stock.</p>
    @else
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th class="text-center">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockAlerts as $product)
                <tr>
                    <td class="fw-semibold">{{ $product->name }}</td>
                    <td class="text-center text-danger fw-bold">{{ $product->stock_quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

        <div class="col-md-6">
    <h4 class="mb-3 text-secondary">❌ Undemanded Products (No sales for last 30 days)</h4>
    @if ($undemandedProducts->isEmpty())
        <p class="text-muted fst-italic">All products have been sold recently.</p>
    @else
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover table-bordered mb-0">
            <thead class="table-secondary">
                <tr>
                    <th>Product</th>
                    <th class="text-center">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($undemandedProducts as $product)
                <tr>
                    <td class="fw-semibold">{{ $product->name }}</td>
                    <td class="text-center text-muted fw-semibold">{{ $product->stock_quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
    </div>
</div>
@endsection
