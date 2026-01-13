@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card military-card shadow-lg">
            <div class="card-header bg-warning text-dark text-uppercase fw-bold">
                <i class="fa-solid fa-file-contract me-2"></i> Commission New Vehicle
            </div>
            <div class="card-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Model Designation</label>
                            <input type="text" name="model_name" class="form-control bg-dark text-light border-secondary" placeholder="e.g. M1A2 Abrams" value="{{ old('model_name') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-warning small text-uppercase">Prime Contractor</label>
                            <select name="manufacturer_id" class="form-select bg-dark text-light border-secondary">
                                <option selected disabled value="">Select Manufacturer...</option>
                                @foreach($manufacturers as $man)
                                    <option value="{{ $man->id }}" {{ old('manufacturer_id') == $man->id ? 'selected' : '' }}>
                                        {{ $man->name }} ({{ $man->country_of_origin }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Classification</label>
                            <select name="vehicle_type" class="form-select bg-dark text-light border-secondary">
                                <option value="MBT">Main Battle Tank (MBT)</option>
                                <option value="IFV">Infantry Fighting Vehicle (IFV)</option>
                                <option value="APC">Armored Personnel Carrier (APC)</option>
                                <option value="Artillery">Self-Propelled Artillery</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase">Unit Cost (USD)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-light">$</span>
                                <input type="number" name="unit_cost" class="form-control bg-dark text-light border-secondary" placeholder="1000000" value="{{ old('unit_cost') }}">
                            </div>
                        </div>
                    </div>

                    <hr class="border-secondary my-4">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning fw-bold text-uppercase">Authorize Commission</button>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection