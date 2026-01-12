@extends('layouts.app')

@section('content')
<div class="card military-card shadow-lg mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h1 class="display-5 fw-bold text-light">{{ $manufacturer->name }}</h1>
                <p class="fs-5 text-muted"><i class="fa-solid fa-earth-americas me-2"></i> {{ $manufacturer->country_of_origin }}</p>
                @if($manufacturer->website_url)
                    <a href="{{ $manufacturer->website_url }}" target="_blank" class="text-warning">Official Website <i class="fa-solid fa-arrow-up-right-from-square small"></i></a>
                @endif
            </div>
            <div class="text-end">
                <a href="{{ route('manufacturers.edit', $manufacturer->id) }}" class="btn btn-outline-warning btn-sm me-2">Edit</a>
                <form action="{{ route('manufacturers.destroy', $manufacturer->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this company?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h4 class="text-uppercase border-bottom border-secondary pb-2 mb-3">Vehicle Contracts</h4>
        <div class="list-group">
            @forelse($manufacturer->vehicles as $vehicle)
                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="list-group-item list-group-item-action bg-dark text-light border-secondary">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $vehicle->model_name }}</h5>
                        <small>${{ number_format($vehicle->unit_cost) }}</small>
                    </div>
                    <small class="text-muted">{{ $vehicle->vehicle_type }}</small>
                </a>
            @empty
                <p class="text-muted">No vehicles registered.</p>
            @endforelse
        </div>
    </div>

    <div class="col-md-6">
        <h4 class="text-uppercase border-bottom border-secondary pb-2 mb-3">Weapon Systems</h4>
        <div class="list-group">
            @forelse($manufacturer->weapons as $weapon)
                <a href="{{ route('weapons.show', $weapon->id) }}" class="list-group-item list-group-item-action bg-dark text-light border-secondary">
                    <h5 class="mb-1">{{ $weapon->weapon_name }}</h5>
                    <small class="text-muted">{{ $weapon->weapon_type }} ({{ $weapon->caliber }})</small>
                </a>
            @empty
                <p class="text-muted">No weapons registered.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection