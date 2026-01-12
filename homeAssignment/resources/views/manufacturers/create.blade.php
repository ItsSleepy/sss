@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card military-card shadow-lg">
            <div class="card-header bg-success text-white text-uppercase fw-bold">
                <i class="fa-solid fa-handshake me-2"></i> Register Contractor
            </div>
            <div class="card-body p-4">

                <form action="{{ route('manufacturers.store') }}" method="POST" id="contractorForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase">Company Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-light border-secondary" placeholder="e.g. Lockheed Martin" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-warning small text-uppercase">Headquarters Location</label>
                        <div class="input-group">
                            <input type="text" id="countryInput" name="country_of_origin" class="form-control bg-dark text-light border-secondary" placeholder="Type country (e.g. France)..." required>
                            <button type="button" class="btn btn-secondary" id="checkCountryBtn">
                                Verify <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                        <small id="countryStatus" class="form-text mt-2 d-block"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase">Official Website</label>
                        <input type="url" name="website_url" class="form-control bg-dark text-light border-secondary" placeholder="https://...">
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input bg-dark border-secondary" type="checkbox" name="is_prime_contractor" id="primeCheck">
                        <label class="form-check-label text-light" for="primeCheck">
                            Is Prime Contractor? (Major Supplier)
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="submitBtn" class="btn btn-success fw-bold text-uppercase disabled">
                            Register Partner
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

    // Function to call the API
    function validateCountry() {
        const country = countryInput.value.trim();
        if(!country) return;

        statusMsg.innerHTML = '<span class="text-warning"><i class="fa-solid fa-spinner fa-spin"></i> Contacting Global Database...</span>';

        // Fetch from REST Countries API
        fetch(`https://restcountries.com/v3.1/name/${country}`)
            .then(response => {
                if (!response.ok) throw new Error("Country not found");
                return response.json();
            })
            .then(data => {
                // SUCCESS: Country exists
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
            })
            .catch(error => {
                // FAILURE: Country does not exist
                statusMsg.innerHTML = '<span class="text-danger fw-bold"><i class="fa-solid fa-xmark"></i> Invalid Territory. Check spelling.</span>';
                submitBtn.classList.add('disabled');
            });
    }

    // Trigger on button click OR when user leaves the box
    checkBtn.addEventListener('click', validateCountry);
    countryInput.addEventListener('blur', validateCountry);
</script>
@endsection