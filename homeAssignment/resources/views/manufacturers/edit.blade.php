@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card military-card shadow-lg">
            <div class="card-header bg-warning text-dark text-uppercase fw-bold">
                <i class="fa-solid fa-pen-to-square me-2"></i> Update Contractor
            </div>
            <div class="card-body p-4">

                <form action="{{ route('manufacturers.update', $manufacturer->id) }}" method="POST" id="editContractorForm">
                    @csrf 
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase">Company Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-light border-secondary" placeholder="e.g. Lockheed Martin" value="{{ old('name', $manufacturer->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-warning small text-uppercase">Headquarters Location</label>
                        <div class="input-group">
                            <input type="text" id="countryInput" name="country_of_origin" class="form-control bg-dark text-light border-secondary" placeholder="Type country (e.g. France)..." value="{{ old('country_of_origin', $manufacturer->country_of_origin) }}">
                            <button type="button" class="btn btn-secondary" id="checkCountryBtn">
                                Verify <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                        <small id="countryStatus" class="form-text mt-2 d-block"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase">Official Website</label>
                        <input type="url" name="website_url" class="form-control bg-dark text-light border-secondary" placeholder="https://..." value="{{ old('website_url', $manufacturer->website_url) }}">
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input bg-dark border-secondary" type="checkbox" name="is_prime_contractor" id="primeCheck" value="1" {{ old('is_prime_contractor', $manufacturer->is_prime_contractor) ? 'checked' : '' }}>
                        <label class="form-check-label text-light" for="primeCheck">
                            Is Prime Contractor? (Major Supplier)
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="submitBtn" class="btn btn-warning fw-bold text-uppercase">
                            Update Partner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const countryInput = document.getElementById('countryInput');
    const checkBtn = document.getElementById('checkCountryBtn');
    const statusMsg = document.getElementById('countryStatus');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('editContractorForm');
    
    let isCountryValidated = true; // Start as true since we have existing data
    let originalCountry = "{{ $manufacturer->country_of_origin }}";

    // Function to call the API
    function validateCountry() {
        const country = countryInput.value.trim();
        if(!country) {
            statusMsg.innerHTML = '<span class="text-muted"><i class="fa-solid fa-info-circle"></i> Please enter a country name</span>';
            submitBtn.classList.add('disabled');
            isCountryValidated = false;
            return;
        }

        statusMsg.innerHTML = '<span class="text-warning"><i class="fa-solid fa-spinner fa-spin"></i> Contacting Global Database...</span>';
        submitBtn.classList.add('disabled');
        isCountryValidated = false;

        // Fetch from REST Countries API
        fetch(`https://restcountries.com/v3.1/name/${encodeURIComponent(country)}?fullText=true`)
            .then(response => {
                if (!response.ok) {
                    return fetch(`https://restcountries.com/v3.1/name/${encodeURIComponent(country)}`);
                }
                return response;
            })
            .then(response => {
                if (!response.ok) throw new Error("Country not found");
                return response.json();
            })
            .then(data => {
                const officialName = data[0].name.common;
                const flag = data[0].flags.svg;
                
                statusMsg.innerHTML = `
                    <span class="text-success fw-bold">
                        <img src="${flag}" style="width: 20px; margin-right:5px;"> 
                        Verified: ${officialName}
                    </span>`;
                
                // Auto-fix the spelling in the box
                countryInput.value = officialName;
                
                // Unlock the Submit Button
                submitBtn.classList.remove('disabled');
                isCountryValidated = true;
            })
            .catch(error => {
                // FAILURE: Country does not exist
                statusMsg.innerHTML = '<span class="text-danger fw-bold"><i class="fa-solid fa-xmark"></i> Invalid Territory. Check spelling.</span>';
                submitBtn.classList.add('disabled');
                isCountryValidated = false;
            });
    }

    // Prevent form submission if country is not validated
    form.addEventListener('submit', function(e) {
        if (!isCountryValidated) {
            e.preventDefault();
            statusMsg.innerHTML = '<span class="text-danger fw-bold"><i class="fa-solid fa-exclamation-triangle"></i> Please verify the country first!</span>';
            countryInput.focus();
        }
    });

    // Reset validation when country input changes
    countryInput.addEventListener('input', function() {
        // Only require revalidation if the country actually changed
        if (countryInput.value.trim() !== originalCountry) {
            submitBtn.classList.add('disabled');
            isCountryValidated = false;
            statusMsg.innerHTML = '<span class="text-muted"><i class="fa-solid fa-info-circle"></i> Country changed - please verify again</span>';
        } else {
            // If user reverts to original, accept it
            submitBtn.classList.remove('disabled');
            isCountryValidated = true;
            statusMsg.innerHTML = '<span class="text-success"><i class="fa-solid fa-check"></i> Original value</span>';
        }
    });

    // Trigger on button click OR when user leaves the box
    checkBtn.addEventListener('click', validateCountry);
    countryInput.addEventListener('blur', function() {
        // Only validate if value changed from original
        if (countryInput.value.trim() !== originalCountry && countryInput.value.trim() !== '') {
            validateCountry();
        }
    });

    // Show initial status for existing country
    if (originalCountry) {
        statusMsg.innerHTML = '<span class="text-success"><i class="fa-solid fa-check"></i> Current value - edit to verify new country</span>';
    }
</script>
@endsection