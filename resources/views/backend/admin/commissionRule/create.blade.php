@extends('backend.layout.index')
@push('title')
    Create Commission Rule
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Commission Rules</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.commission-rule.index') }}">Commission</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.commission-rule.index') }}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-8 col-xl-8 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Create Commission Rule</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.commission-rule.store') }}" method="POST" class="row g-3 needs-validation">
                        @csrf

                        <!-- Commission -->
                        <div class="mb-3">
                            <label class="form-label">Commission:</label>
                            <select name="commission_id" class="form-control @error('commission_id') is-invalid @enderror" required>
                                <option value="">-- Select --</option>
                                @foreach($commissions as $commission)
                                    <option value="{{ $commission->id }}" {{ old('commission_id')==$commission->id ? 'selected' : '' }}>
                                        {{ $commission->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger">@error('commission_id') {{ $message }} @enderror</div>
                        </div>

                        <!-- Applies To -->
                        <div class="mb-3">
                            <label class="form-label">Applies To:</label>
                            <select name="applies_to" id="applies_to" class="form-control @error('applies_to') is-invalid @enderror" required>
                                <option value="">-- Select --</option>
                                @php $types = ['category','subcategory','vendor','product','custom']; @endphp
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ old('applies_to')==$type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">@error('applies_to') {{ $message }} @enderror</div>
                        </div>

                        <!-- Select Item -->
                        <div class="mb-3" id="applies_id_div" style="{{ old('applies_to') ? '' : 'display:none;' }}">
                            <label class="form-label">Select Item:</label>
                            <select name="applies_id" id="items" class="form-control">
                                <option value="">-- Select --</option>
                            </select>
                            <div class="text-danger">@error('items') {{ $message }} @enderror</div>
                        </div>

                        <!-- Condition -->
                        <div class="mb-3">
                            <label class="form-label">Condition (JSON):</label>
                            <input type="text" name="condition" value="{{ old('condition') }}" class="form-control" placeholder='{"min_order":100}'>
                            <div class="text-danger">@error('condition') {{ $message }} @enderror</div>
                        </div>

                        <!-- Priority -->
                        <div class="mb-3">
                            <label class="form-label">Priority:</label>
                            <input type="number" name="priority" value="{{ old('priority', 0) }}" class="form-control" required>
                            <div class="text-danger">@error('priority') {{ $message }} @enderror</div>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-success px-5 raised">Create</button>
                            <a href="{{ route('admin.commission-rule.index') }}" class="btn btn-primary px-5 raised">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('plugins')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- JS for dynamic Select Item -->
    <script>
        const appliesSelect = document.getElementById('applies_to');
        const appliesDiv = document.getElementById('applies_id_div');
        const appliesDropdown = appliesDiv.querySelector('select[name="applies_id"]');

        // Data from backend
        const items = {
            category: @json($categories),
            subcategory: @json($subcategories),
            vendor: @json($vendors),
        };

        function populateItems(type, selectedId = null) {
            appliesDropdown.innerHTML = '<option value="">-- Select --</option>';
            if(items[type]) {
                items[type].forEach(item => {
                    const selected = (selectedId == item.id) ? 'selected' : '';
                    appliesDropdown.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });
            }
        }

        appliesSelect.addEventListener('change', function() {
            const type = this.value;
            if(type) {
                appliesDiv.style.display = '';
                populateItems(type, null);
            } else {
                appliesDiv.style.display = 'none';
            }
        });

        // On load, populate if old value exists
        if(appliesSelect.value) {
            populateItems(appliesSelect.value, '{{ old("applies_id") }}');
            appliesDiv.style.display = '';
        }
    </script>

    <script>
        $('#items').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: "Select an option"
        });
    </script>
@endpush
