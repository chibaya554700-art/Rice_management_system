@extends('layouts.app')
@section('title', 'Record Payment')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-money-bill text-warning me-2"></i>Record Payment</h2>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Payments
    </a>
</div>

<div class="card shadow border-0">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('payments.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Order <span class="text-danger">*</span></label>
                <select name="order_id" class="form-select @error('order_id') is-invalid @enderror">
                    <option value="">-- Select Order --</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}"
                            {{ old('order_id', request('order_id')) == $order->id ? 'selected' : '' }}>
                            #{{ $order->id }} — {{ $order->customer_name }}
                            (₱{{ number_format($order->total_price, 2) }})
                        </option>
                    @endforeach
                </select>
                @error('order_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Amount Paid (₱) <span class="text-danger">*</span></label>
                <input type="number" name="amount" step="0.01" min="0"
                    class="form-control @error('amount') is-invalid @enderror"
                    value="{{ old('amount') }}" placeholder="e.g. 500.00">
                @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Payment Method <span class="text-danger">*</span></label>
                <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="gcash" {{ old('payment_method') == 'gcash' ? 'selected' : '' }}>GCash</option>
                    <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                </select>
                @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save me-1"></i>Save Payment
                </button>
                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection