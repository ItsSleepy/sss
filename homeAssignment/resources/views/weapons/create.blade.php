@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card military-card shadow-lg border-danger">
            <div class="card-header bg-danger text-white text-uppercase fw-bold">
                <i class="fa-solid fa-fire me-2"></i> Register New Weapon
            </div>
            <div class="card-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('weapons.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label text-muted small text-uppercase">Weapon Designation</label>
                            <input type="text" name="weapon_name" class="form-control bg-dark text-light border-secondary" placeholder="e.g. 120mm Smoothbore" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Manufacturer</label>
                            <select name="manufacturer_id" class="form-select bg-dark text-light border-secondary">
                                @foreach($manufacturers as $man)
                                    <option value="{{ $man->id }}">{{ $man->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Type</label>
                            <select name="weapon_type" class="form-select bg-dark text-light border-secondary">
                                <option>Cannon</option>
                                <option>Machine Gun</option>
                                <option>Missile Launcher</option>
                                <option>Autocannon</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Caliber</label>
                            <input type="text" name="caliber" class="form-control bg-dark text-light border-secondary" placeholder="e.g. 120mm, 7.62mm" required>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-danger fw-bold text-uppercase">Add to Armory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection