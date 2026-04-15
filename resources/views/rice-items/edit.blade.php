@extends('layouts.app')
@section('title', 'Edit Rice Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit text-primary me-2"></i>Edit Rice Item</h2>
    <a href="{{ route('rice-items.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to List
    </a>
</div>

<div class="card shadow border-0">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('rice-items.update', $riceItem) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Rice Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $riceItem->name) }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Price per kg (₱) <span class="text-danger">*</span></label>
                <input type="number" name="price" step="0.01" min="0"
                    class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price', $riceItem->price) }}">
                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Stock (kg) <span class="text-danger">*</span></label>
                <input type="number" name="stock" step="0.01" min="0"
                    class="form-control @error('stock') is-invalid @enderror"
                    value="{{ old('stock', $riceItem->stock) }}">
                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $riceItem->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i>Update Item
                </button>
                <a href="{{ route('rice-items.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection