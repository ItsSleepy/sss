@extends('layouts.app')
@section('content')
<div class="card military-card shadow-lg mb-4 border-danger">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="text-danger fw-bold">{{ $weapon->weapon_name }}</h1>
                <p class="lead">{{ $weapon->weapon_type }} // {{ $weapon->caliber }}</p>
                <p class="text-muted">Manufactured by: {{ $weapon->manufacturer->name }}</p>
            </div>
            <div>
                <a href="{{ route('weapons.edit', $weapon->id) }}" class="btn btn-outline-light">Edit</a>
                <form action="{{ route('weapons.destroy', $weapon->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Remove weapon?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<h4 class="text-uppercase text-muted mb-3">Currently Deployed On:</h4>
<div class="row">
    @forelse($weapon->vehicles as $vehicle)
    <div class="col-md-4">
        <div class="card bg-dark border-secondary">
            <div class="card-body">
                <h5 class="card-title text-light">{{ $vehicle->model_name }}</h5>
                <p class="card-text text-muted small">
                    Mounted: <span class="text-info">{{ $vehicle->pivot->location }}</span><br>
                    Quantity: {{ $vehicle->pivot->quantity }}
                </p>
                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-outline-secondary stretched-link">View Vehicle</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-secondary bg-dark border-secondary text-muted">
            This weapon is not currently installed on any vehicles in the fleet.
        </div>
    </div>
    @endforelse
</div>
@endsection