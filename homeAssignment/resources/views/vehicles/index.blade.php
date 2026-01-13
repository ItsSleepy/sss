@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-uppercase fw-bold"><i class="fa-solid fa-tank me-2"></i> Vehicle Fleet</h1>
    <a href="{{ route('vehicles.create') }}" class="btn btn-warning fw-bold">
        <i class="fa-solid fa-plus me-1"></i> New Commission
    </a>
</div>

<div class="card military-card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('vehicles.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label text-muted small text-uppercase">Search</label>
                <input type="text" name="search" class="form-control bg-dark text-light border-secondary" placeholder="Search by model name..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small text-uppercase">Type</label>
                <select name="type" class="form-select bg-dark text-light border-secondary">
                    <option value="">All Types</option>
                    <option value="MBT" {{ request('type') == 'MBT' ? 'selected' : '' }}>MBT</option>
                    <option value="IFV" {{ request('type') == 'IFV' ? 'selected' : '' }}>IFV</option>
                    <option value="APC" {{ request('type') == 'APC' ? 'selected' : '' }}>APC</option>
                    <option value="Artillery" {{ request('type') == 'Artillery' ? 'selected' : '' }}>Artillery</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small text-uppercase">Manufacturer</label>
                <select name="manufacturer" class="form-select bg-dark text-light border-secondary">
                    <option value="">All Manufacturers</option>
                    @foreach($manufacturers as $man)
                        <option value="{{ $man->id }}" {{ request('manufacturer') == $man->id ? 'selected' : '' }}>{{ $man->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small text-uppercase">Sort By</label>
                <select name="sort" class="form-select bg-dark text-light border-secondary">
                    <option value="model_name" {{ request('sort') == 'model_name' ? 'selected' : '' }}>Name</option>
                    <option value="vehicle_type" {{ request('sort') == 'vehicle_type' ? 'selected' : '' }}>Type</option>
                    <option value="unit_cost" {{ request('sort') == 'unit_cost' ? 'selected' : '' }}>Cost</option>
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Added</option>
                </select>
            </div>
            <div class="col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-filter me-1"></i> Apply Filters
                </button>
                <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-rotate-right me-1"></i> Reset
                </a>
                <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">
                <button type="button" class="btn btn-outline-warning" onclick="toggleSort()">
                    @if(request('direction') == 'desc')
                        <i class="fa-solid fa-arrow-up-z-a me-1"></i> Z-A
                    @else
                        <i class="fa-solid fa-arrow-down-a-z me-1"></i> A-Z
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    @foreach($vehicles as $vehicle)
    <div class="col-md-4">
        <div class="card military-card h-100 shadow-sm hover-effect">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-secondary">{{ $vehicle->vehicle_type }}</span>
                    <small class="text-muted">{{ $vehicle->manufacturer->name }}</small>
                </div>
                <h3 class="card-title fw-bold text-light">{{ $vehicle->model_name }}</h3>
                <p class="text-success font-monospace mb-3">Cost: ${{ number_format($vehicle->unit_cost) }}</p>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-outline-light btn-sm">
                        View Spec Sheet <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-outline-warning">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Specs
                    </a>

                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure you want to decommission this vehicle?')">
                            <i class="fa-solid fa-trash me-1"></i> Decommission
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
function toggleSort() {
    const input = document.querySelector('input[name="direction"]');
    input.value = input.value === 'asc' ? 'desc' : 'asc';
    document.querySelector('form').submit();
}
</script>
@endsection