@extends('layouts.app')
@section('title', 'Rice Items')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-boxes text-success me-2"></i>Rice Items</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
        <a href="{{ route('rice-items.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i>Add New Item
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
                        <th>Name</th>
                        <th>Price (₱/kg)</th>
                        <th>Stock (kg)</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riceItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td><span class="badge bg-primary">₱{{ number_format($item->price, 2) }}</span></td>
                            <td>
                                @if($item->stock == 0)
                                    <span class="badge bg-danger">Out of Stock</span>
                                @elseif($item->stock < 10)
                                    <span class="badge bg-warning">{{ $item->stock }} kg</span>
                                @else
                                    <span class="badge bg-success">{{ $item->stock }} kg</span>
                                @endif
                            </td>
                            <td>{{ $item->description ? Str::limit($item->description, 30) : '-' }}</td>
                            <td>
                                <a href="{{ route('rice-items.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('rice-items.destroy', $item) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this item?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-boxes fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">No rice items found. <a href="{{ route('rice-items.create') }}">Add one now!</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $riceItems->links() }}</div>
    </div>
</div>
@endsection