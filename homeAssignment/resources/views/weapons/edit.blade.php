@extends('layouts.app')
@section('content')
<div class="container w-50">
    <h2 class="text-danger mb-4">Edit Weapon</h2>
    <form action="{{ route('weapons.update', $weapon->id) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="weapon_name" class="form-control bg-dark text-light" value="{{ $weapon->weapon_name }}" required>
        </div>

        <div class="mb-3">
            <label>Manufacturer</label>
            <select name="manufacturer_id" class="form-select bg-dark text-light" required>
                @foreach($manufacturers as $man)
                    <option value="{{ $man->id }}" {{ $weapon->manufacturer_id == $man->id ? 'selected' : '' }}>
                        {{ $man->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label>Type</label>
                <select name="weapon_type" class="form-select bg-dark text-light">
                    @foreach(['Cannon', 'Machine Gun', 'Missile Launcher', 'Autocannon'] as $type)
                        <option value="{{ $type }}" {{ $weapon->weapon_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 mb-3">
                <label>Caliber</label>
                <input type="text" name="caliber" class="form-control bg-dark text-light" value="{{ $weapon->caliber }}" required>
            </div>
        </div>
        
        <button class="btn btn-danger w-100">Update Weapon System</button>
    </form>
</div>
@endsection