@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-uppercase fw-bold"><i class="fa-solid fa-crosshairs me-2"></i> Armory Inventory</h1>
    <a href="{{ route('weapons.create') }}" class="btn btn-danger fw-bold">
        <i class="fa-solid fa-plus me-1"></i> Add Weapon
    </a>
</div>

<div class="card military-card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('weapons.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label text-muted small text-uppercase">Search</label>
                <input type="text" name="search" class="form-control bg-dark text-light border-secondary" placeholder="Search by weapon name..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small text-uppercase">Type</label>
                <select name="type" class="form-select bg-dark text-light border-secondary">
                    <option value="">All Types</option>
                    <option value="Cannon" {{ request('type') == 'Cannon' ? 'selected' : '' }}>Cannon</option>
                    <option value="Machine Gun" {{ request('type') == 'Machine Gun' ? 'selected' : '' }}>Machine Gun</option>
                    <option value="Missile Launcher" {{ request('type') == 'Missile Launcher' ? 'selected' : '' }}>Missile Launcher</option>
                    <option value="Autocannon" {{ request('type') == 'Autocannon' ? 'selected' : '' }}>Autocannon</option>
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
                    <option value="weapon_name" {{ request('sort') == 'weapon_name' ? 'selected' : '' }}>Name</option>
                    <option value="weapon_type" {{ request('sort') == 'weapon_type' ? 'selected' : '' }}>Type</option>
                    <option value="caliber" {{ request('sort') == 'caliber' ? 'selected' : '' }}>Caliber</option>
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Added</option>
                </select>
            </div>
            <div class="col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-filter me-1"></i> Apply Filters
                </button>
                <a href="{{ route('weapons.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-rotate-right me-1"></i> Reset
                </a>
                <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">
                <button type="button" class="btn btn-outline-danger" onclick="toggleSort()">
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

<script>
function toggleSort() {
    const input = document.querySelector('input[name="direction"]');
    input.value = input.value === 'asc' ? 'desc' : 'asc';
    document.querySelector('form').submit();
}
</script>
@endsection