@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Rice Items</h6>
                    <h2 class="mb-0">{{ $totalRiceItems }}</h2>
                </div>
                <i class="fas fa-boxes fa-2x opacity-75"></i>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="{{ route('rice-items.index') }}" class="text-white text-decoration-none small">View all →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Total Orders</h6>
                    <h2 class="mb-0">{{ $totalOrders }}</h2>
                </div>
                <i class="fas fa-shopping-cart fa-2x opacity-75"></i>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="{{ route('orders.index') }}" class="text-white text-decoration-none small">View all →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow text-white bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Total Payments</h6>
                    <h2 class="mb-0">{{ $totalPayments }}</h2>
                </div>
                <i class="fas fa-credit-card fa-2x opacity-75"></i>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="{{ route('payments.index') }}" class="text-white text-decoration-none small">View all →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow text-white bg-danger">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Total Revenue</h6>
                    <h2 class="mb-0">₱{{ number_format($totalRevenue, 2) }}</h2>
                </div>
                <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-header bg-white fw-bold">
        <i class="fas fa-clock text-primary me-2"></i>Recent Orders
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Rice Item</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $order->customer_name }}</strong></td>
                            <td>{{ $order->riceItem->name ?? '-' }}</td>
                            <td>{{ $order->quantity }} kg</td>
                            <td>₱{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection