@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-uppercase fw-bold"><i class="fa-solid fa-industry me-2"></i> Defense Contractors</h1>
    <a href="{{ route('manufacturers.create') }}" class="btn btn-success fw-bold">
        <i class="fa-solid fa-plus me-1"></i> Register Partner
    </a>
</div>

<div class="card military-card shadow-sm">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th>Company Name</th>
                    <th>HQ Location</th>
                    <th>Role</th>
                    <th>Website</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($manufacturers as $man)
                <tr>
                    <td class="fw-bold">{{ $man->name }}</td>
                    <td>
                        <i class="fa-solid fa-earth-americas text-muted me-2"></i> {{ $man->country_of_origin }}
                    </td>
                    <td>
                        @if($man->is_prime_contractor)
                            <span class="badge bg-warning text-dark">Prime Contractor</span>
                        @else
                            <span class="badge bg-secondary">Sub-Contractor</span>
                        @endif
                    </td>
                    <td>
                        @if($man->website_url)
                            <a href="{{ $man->website_url }}" target="_blank" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-link"></i></a>
                        @else - @endif
                    </td>
                    
                    <td class="text-end">
                        <a href="{{ route('manufacturers.show', $man->id) }}" class="btn btn-sm btn-primary">
                            View Profile
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection