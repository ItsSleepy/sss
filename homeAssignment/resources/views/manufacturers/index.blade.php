@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-uppercase fw-bold"><i class="fa-solid fa-industry me-2"></i> Defense Contractors</h1>
    <a href="{{ route('manufacturers.create') }}" class="btn btn-success fw-bold">
        <i class="fa-solid fa-plus me-1"></i> Register Partner
    </a>
</div>

<div class="card military-card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('manufacturers.index') }}" class="row g-3">
            <div class="col-md-5">
                <label class="form-label text-muted small text-uppercase">Search</label>
                <input type="text" name="search" class="form-control bg-dark text-light border-secondary" placeholder="Search by name or country..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small text-uppercase">Role</label>
                <select name="role" class="form-select bg-dark text-light border-secondary">
                    <option value="">All Roles</option>
                    <option value="prime" {{ request('role') == 'prime' ? 'selected' : '' }}>Prime Contractor</option>
                    <option value="sub" {{ request('role') == 'sub' ? 'selected' : '' }}>Sub-Contractor</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small text-uppercase">Sort By</label>
                <select name="sort" class="form-select bg-dark text-light border-secondary">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="country_of_origin" {{ request('sort') == 'country_of_origin' ? 'selected' : '' }}>Country</option>
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Added</option>
                </select>
            </div>
            <div class="col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-filter me-1"></i> Apply Filters
                </button>
                <a href="{{ route('manufacturers.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-rotate-right me-1"></i> Reset
                </a>
                <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">
                <button type="button" class="btn btn-outline-success" onclick="toggleSort()">
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

<script>
function toggleSort() {
    const input = document.querySelector('input[name="direction"]');
    input.value = input.value === 'asc' ? 'desc' : 'asc';
    document.querySelector('form').submit();
}
</script>
@endsection