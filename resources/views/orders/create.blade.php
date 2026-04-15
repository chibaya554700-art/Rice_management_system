@extends('layouts.app')
@section('title', 'New Order')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-cart-plus text-primary me-2"></i>New Order</h2>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Orders
    </a>
</div>

<div class="card shadow border-0">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Customer Name <span class="text-danger">*</span></label>
                <input type="text" name="customer_name"
                    class="form-control @error('customer_name') is-invalid @enderror"
                    value="{{ old('customer_name') }}" placeholder="e.g. Juan Dela Cruz">
                @error('customer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Rice Item <span class="text-danger">*</span></label>
                <select name="rice_item_id" class="form-select @error('rice_item_id') is-invalid @enderror">
                    <option value="">-- Select Rice Item --</option>
                    @foreach($riceItems as $item)
                        <option value="{{ $item->id }}" {{ old('rice_item_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }} — ₱{{ number_format($item->price, 2) }}/kg ({{ $item->stock }} kg available)
                        </option>
                    @endforeach
                </select>
                @error('rice_item_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Quantity (kg) <span class="text-danger">*</span></label>
                <input type="number" name="quantity" step="0.01" min="0.01"
                    class="form-control @error('quantity') is-invalid @enderror"
                    value="{{ old('quantity') }}" placeholder="e.g. 10">
                @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i>Place Order
                </button>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection