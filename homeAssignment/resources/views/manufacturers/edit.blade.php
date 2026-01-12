@extends('layouts.app')
@section('content')
<div class="container w-50">
    <h2 class="text-warning mb-4">Edit Manufacturer</h2>
    <form action="{{ route('manufacturers.update', $manufacturer->id) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control bg-dark text-light" value="{{ $manufacturer->name }}">
        </div>
        <div class="mb-3">
            <label>Country</label>
            <input type="text" name="country_of_origin" class="form-control bg-dark text-light" value="{{ $manufacturer->country_of_origin }}">
        </div>
        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website_url" class="form-control bg-dark text-light" value="{{ $manufacturer->website_url }}">
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="is_prime_contractor" class="form-check-input" id="prime" {{ $manufacturer->is_prime_contractor ? 'checked' : '' }}>
            <label class="form-check-label" for="prime">Prime Contractor</label>
        </div>
        
        <button class="btn btn-warning w-100">Update</button>
    </form>
</div>
@endsection