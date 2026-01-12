@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-uppercase fw-bold"><i class="fa-solid fa-crosshairs me-2"></i> Armory Inventory</h1>
    <a href="{{ route('weapons.create') }}" class="btn btn-danger fw-bold">
        <i class="fa-solid fa-plus me-1"></i> Add Weapon
    </a>
</div>

<div class="row g-4">
    @foreach($weapons as $weapon)
    <div class="col-md-6">
        <div class="card military-card h-100 border-danger">
            <div class="card-body d-flex align-items-center justify-content-between"> <div class="d-flex align-items-center">
                    <div class="bg-dark p-3 rounded me-3 text-danger">
                        <i class="fa-solid fa-person-rifle fa-2x"></i>
                    </div>
                    <div>
                        <h4 class="card-title fw-bold text-light mb-1">{{ $weapon->weapon_name }}</h4>
                        <div class="d-flex gap-2">
                            <span class="badge bg-secondary">{{ $weapon->weapon_type }}</span>
                            <span class="badge bg-dark border border-secondary">{{ $weapon->caliber }}</span>
                        </div>
                        <small class="text-muted d-block mt-2">Mfr: {{ $weapon->manufacturer->name }}</small>
                    </div>
                </div>

                <div class="ms-3">
                    <a href="{{ route('weapons.show', $weapon->id) }}" class="btn btn-outline-danger">
                        Details <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection