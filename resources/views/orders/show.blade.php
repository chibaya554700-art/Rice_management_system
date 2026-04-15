@extends('layouts.app')
@section('title', 'Order Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-receipt text-info me-2"></i>Order Details</h2>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Orders
    </a>
</div>

<div class="card shadow border-0">
    <div class="card-body p-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h6 class="text-muted">Customer Name</h6>
                <p class="fw-bold fs-5">{{ $order->customer_name }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted">Order Date</h6>
                <p class="fw-bold fs-5">{{ $order->created_at->format('F d, Y h:i A') }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <h6 class="text-muted">Rice Item</h6>
                <p class="fw-bold fs-5">{{ $order->riceItem->name ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted">Price per kg</h6>
                <p class="fw-bold fs-5">₱{{ number_format($order->riceItem->price ?? 0, 2) }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <h6 class="text-muted">Quantity</h6>
                <p class="fw-bold fs-5">{{ $order->quantity }} kg</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted">Total Price</h6>
                <p class="fw-bold fs-5 text-primary">₱{{ number_format($order->total_price, 2) }}</p>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted">Status</h6>
                @if($order->status === 'pending')
                    <span class="badge bg-warning fs-6">Pending</span>
                @elseif($order->status === 'completed')
                    <span class="badge bg-success fs-6">Completed</span>
                @else
                    <span class="badge bg-danger fs-6">Cancelled</span>
                @endif
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('payments.create') }}?order_id={{ $order->id }}" class="btn btn-warning px-4">
                <i class="fas fa-money-bill me-1"></i>Record Payment
            </a>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary px-4">Back</a>
        </div>
    </div>
</div>
@endsection