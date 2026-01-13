@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-uppercase fw-bold"><i class="fa-solid fa-tank me-2"></i> Vehicle Fleet</h1>
    <a href="{{ route('vehicles.create') }}" class="btn btn-warning fw-bold">
        <i class="fa-solid fa-plus me-1"></i> New Commission
    </a>
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
@endsection