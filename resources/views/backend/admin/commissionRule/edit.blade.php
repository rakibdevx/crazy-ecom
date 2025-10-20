@extends('backend.layout.index')
@push('title')
    Edit Commission Rule
@endpush
@section('body')
<div class="main-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Commission Rules</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.commission-rule.index') }}">Commission</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.commission-rule.index') }}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-xl-8 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Edit Commission Rule</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.commission-rule.update', $commissionRule->id) }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        @method('PUT')

                        <!-- Commission -->
                        <div class="mb-3">
                            <label class="form-label">Commission:</label>
                            <select name="commission_id" class="form-control" required>
                                <option value="">-- Select --</option>
                                @foreach($commissions as $commission)
                                    <option value="{{ $commission->id }}" {{ ($commissionRule->commission_id == $commission->id) ? 'selected' : '' }}>
                                        {{ $commission->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger">@error('commission_id') {{ $message }} @enderror</div>
                        </div>

                        <!-- Applies To -->
                        <div class="mb-3">
                            {{$commissionRule->applies_to}}
                            <label class="form-label">Applies To:</label>
                            <select name="applies_to" id="applies_to" class="form-control" required>
                                @php $types = ['category','subcategory','vendor','product','custom']; @endphp
                                <option value="">-- Select --</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ ($commissionRule->applies_to == $type) ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">@error('applies_to') {{ $message }} @enderror</div>
                        </div>

                        <!-- Select Item -->
                        <div class="mb-3" id="applies_id_div">
                            <label class="form-label" for="items">Select Item:</label>
                            <select name="applies_id" id="items" class="form-control">
                                <option value="">-- Select --</option>
                            </select>
                            <div class="text-danger">@error('applies_id') {{ $message }} @enderror</div>
                        </div>

                        <!-- Condition -->
                        <div class="mb-3">
                            <label class="form-label">Condition (JSON):</label>
                            <input type="text" name="condition" value="{{ json_encode($commissionRule->condition) }}" class="form-control">
                            <div class="text-danger">@error('condition') {{ $message }} @enderror</div>
                        </div>

                        <!-- Priority -->
                        <div class="mb-3">
                            <label class="form-label">Priority:</label>
                            <input type="number" name="priority" value="{{ $commissionRule->priority }}" class="form-control" required>
                            <div class="text-danger">@error('priority') {{ $message }} @enderror</div>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-success px-5 raised">Update</button>
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
    <script>
        const appliesSelect = document.getElementById('applies_to');
        const appliesDiv = document.getElementById('applies_id_div');
        const appliesDropdown = appliesDiv.querySelector('select[name="applies_id"]');

        // Backend data
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
                populateItems(type);
            } else {
                appliesDiv.style.display = 'none';
            }
        });

        // On load, populate selected item
        if(appliesSelect.value) {
            populateItems(appliesSelect.value, '{{ $commissionRule->applies_id }}');
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
