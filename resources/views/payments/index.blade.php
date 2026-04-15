@extends('layouts.app')
@section('title', 'Payments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-credit-card text-warning me-2"></i>Payments</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
        <a href="{{ route('payments.create') }}" class="btn btn-warning">
            <i class="fas fa-plus me-1"></i>Record Payment
        </a>
    </div>
</div>

<div class="card shadow border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Order</th>
                        <th>Amount Paid</th>
                        <th>Method</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $payment->order->customer_name ?? '-' }}</strong></td>
                            <td>{{ $payment->order->riceItem->name ?? '-' }}</td>
                            <td><span class="badge bg-success">₱{{ number_format($payment->amount, 2) }}</span></td>
                            <td><span class="badge bg-secondary">{{ ucfirst($payment->payment_method) }}</span></td>
                            <td>{{ $payment->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-credit-card fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">No payments recorded yet. <a href="{{ route('payments.create') }}">Add one now!</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $payments->links() }}</div>
    </div>
</div>
@endsection