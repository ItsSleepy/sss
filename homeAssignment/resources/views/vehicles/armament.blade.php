@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-light">
                <i class="fa-solid fa-crosshairs me-2 text-danger"></i> Manage Armament
            </h1>
            <p class="text-muted mb-0">{{ $vehicle->model_name }}</p>
        </div>
        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Vehicle
        </a>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card military-card">
                <div class="card-header bg-success text-white text-uppercase fw-bold">
                    <i class="fa-solid fa-plus me-2"></i> Add Weapon System
                </div>
                <div class="card-body">
                    <form action="{{ route('vehicles.armament.store', $vehicle->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase">Select Weapon</label>
                            <select name="weapon_id" class="form-select bg-dark text-light border-secondary">
                                <option value="" selected disabled>Choose weapon...</option>
                                @foreach($availableWeapons as $weapon)
                                    <option value="{{ $weapon->id }}">
                                        {{ $weapon->weapon_name }} ({{ $weapon->caliber }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase">Mount Location</label>
                            <input type="text" name="location" class="form-control bg-dark text-light border-secondary" placeholder="e.g., Main Turret, Coaxial Mount">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small text-uppercase">Quantity</label>
                            <input type="number" name="quantity" class="form-control bg-dark text-light border-secondary" value="1">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold">
                                <i class="fa-solid fa-plus me-2"></i> Install Weapon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card military-card">
                <div class="card-header bg-dark text-light border-secondary text-uppercase fw-bold">
                    <i class="fa-solid fa-list me-2"></i> Current Armament
                </div>
                
                @if($vehicle->weapons->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th>Weapon System</th>
                                    <th>Location</th>
                                    <th>Qty</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicle->weapons as $weapon)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-light">{{ $weapon->weapon_name }}</div>
                                        <small class="text-muted">{{ $weapon->weapon_type }} - {{ $weapon->caliber }}</small>
                                    </td>
                                    <td class="text-info">
                                        <i class="fa-solid fa-location-dot me-1"></i> {{ $weapon->pivot->location }}
                                    </td>
                                    <td class="fw-bold">{{ $weapon->pivot->quantity }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('vehicles.armament.destroy', ['vehicle' => $vehicle->id, 'config' => $weapon->pivot->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this weapon from the vehicle?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body">
                        <div class="alert alert-secondary bg-dark border-secondary text-center">
                            <i class="fa-solid fa-circle-info me-2"></i> No weapons installed on this vehicle
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
