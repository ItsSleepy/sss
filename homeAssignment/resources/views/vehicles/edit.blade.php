@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card military-card shadow-lg border-warning">
            <div class="card-header bg-warning text-dark text-uppercase fw-bold">
                <i class="fa-solid fa-wrench me-2"></i> Update Configuration: {{ $vehicle->model_name }}
            </div>
            <div class="card-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf 
                    @method('PUT') <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Model Designation</label>
                            <input type="text" name="model_name" class="form-control bg-dark text-light border-secondary" 
                                   value="{{ old('model_name', $vehicle->model_name) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-warning small text-uppercase">Prime Contractor</label>
                            <select name="manufacturer_id" class="form-select bg-dark text-light border-secondary">
                                @foreach($manufacturers as $man)
                                    <option value="{{ $man->id }}" 
                                        {{ $vehicle->manufacturer_id == $man->id ? 'selected' : '' }}>
                                        {{ $man->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Classification</label>
                            <select name="vehicle_type" class="form-select bg-dark text-light border-secondary">
                                @foreach(['MBT', 'IFV', 'APC', 'Artillery'] as $type)
                                    <option value="{{ $type }}" {{ $vehicle->vehicle_type == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Unit Cost</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-light">$</span>
                                <input type="number" name="unit_cost" class="form-control bg-dark text-light border-secondary" 
                                       value="{{ old('unit_cost', $vehicle->unit_cost) }}">
                            </div>
                        </div>
                    </div>

                    <hr class="border-secondary my-4">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning fw-bold text-uppercase">Save Modifications</button>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection