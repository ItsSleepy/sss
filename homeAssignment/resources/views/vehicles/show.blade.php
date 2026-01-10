@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="card military-card mb-4 shadow-lg border-secondary">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-danger mb-2 text-uppercase">{{ $vehicle->vehicle_type }}</span>
                <h1 class="display-5 fw-bold text-light mb-0">{{ $vehicle->model_name }}</h1>
                <p class="text-muted font-monospace mb-0">
                    <i class="fa-solid fa-barcode me-1"></i> ID: {{ $vehicle->slug }}
                </p>
            </div>
            <div class="text-end">
                <div class="text-muted small text-uppercase">Prime Contractor</div>
                <div class="fs-4 text-warning fw-bold">{{ $vehicle->manufacturer->name }}</div>
                <div class="badge bg-secondary mt-1">
                    <i class="fa-solid fa-flag me-1"></i> {{ $vehicle->manufacturer->country_of_origin }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card military-card h-100">
                <div class="card-header bg-dark text-light border-secondary text-uppercase fw-bold">
                    <i class="fa-solid fa-gears me-2"></i> Technical Specs
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent text-light border-secondary d-flex justify-content-between">
                        <span class="text-muted">Unit Cost</span>
                        <span class="font-monospace text-success fw-bold">${{ number_format($vehicle->unit_cost) }}</span>
                    </li>
                    <li class="list-group-item bg-transparent text-light border-secondary d-flex justify-content-between">
                        <span class="text-muted">Commission Date</span>
                        <span>{{ $vehicle->created_at->format('d M Y') }}</span>
                    </li>
                    <li class="list-group-item bg-transparent text-light border-secondary d-flex justify-content-between">
                        <span class="text-muted">Last Updated</span>
                        <span>{{ $vehicle->updated_at->diffForHumans() }}</span>
                    </li>
                </ul>
                
                <div class="card-body mt-auto">
                    <div class="d-grid gap-2">
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning fw-bold">
                            <i class="fa-solid fa-wrench me-2"></i> Modify Specs
                        </a>
                        
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-grid">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" onclick="return confirm('WARNING: Are you sure you want to decommission this vehicle? This cannot be undone.')">
                                <i class="fa-solid fa-trash me-2"></i> Decommission
                            </button>
                        </form>

                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-2"></i> Return to Fleet
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card military-card h-100">
                <div class="card-header bg-dark text-light border-secondary text-uppercase fw-bold d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-crosshairs me-2 text-danger"></i> Armament Configuration</span>
                    <button class="btn btn-sm btn-outline-secondary disabled" title="Feature coming soon">Manage Loadout</button>
                </div>
                
                @if($vehicle->weapons->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th>Weapon System</th>
                                    <th>Type</th>
                                    <th>Mount Location</th> <th class="text-center">Qty</th> </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicle->weapons as $weapon)
                                <tr>
                                    <td class="fw-bold text-light">
                                        {{ $weapon->weapon_name }}
                                        <div class="small text-muted">{{ $weapon->manufacturer->name }}</div>
                                    </td>
                                    <td><span class="badge bg-secondary">{{ $weapon->weapon_type }}</span></td>
                                    
                                    <td>
                                        <span class="text-info">
                                            <i class="fa-solid fa-bullseye me-1"></i> {{ $weapon->pivot->location }}
                                        </span>
                                    </td>
                                    <td class="text-center fw-bold fs-5">{{ $weapon->pivot->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-5 text-center text-muted">
                        <i class="fa-solid fa-ban fa-3x mb-3"></i>
                        <p>No armament configuration found for this chassis.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection