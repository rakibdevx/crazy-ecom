 @extends('backend.layout.index')
@push('title')
    Commission Rules
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Commission Rules</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Commission Rules</li>
                    </ol>
                </nav>
            </div>
            @can('Commission-create')
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.commission-rule.create')}}" class="btn btn-primary">Create</a>
                </div>
            </div>
            @endcan
        </div>

    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Commission</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Commission</th>
                                    <th>Applies To</th>
                                    <th>Item</th>
                                    <th>Condition</th>
                                    <th>Priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rules as $rule)
                                    <tr>
                                        <td>{{ $rule->id }}</td>
                                        <td>{{ $rule->commission->name ?? '-' }}</td>
                                        <td>{{ ucfirst($rule->applies_to) }}</td>
                                        <td>
                                            @if($rule->applies_id)
                                                @php
                                                    $item = match($rule->applies_to){
                                                        'category' => \App\Models\Category::find($rule->applies_id)?->name,
                                                        'subcategory' => \App\Models\SubCategory::find($rule->applies_id)?->name,
                                                        'seller' => \App\Models\Vendor::find($rule->applies_id)?->name,
                                                        // 'product' => \App\Models\Product::find($rule->applies_id)?->name,
                                                        default => $rule->applies_id
                                                    };
                                                @endphp
                                                {{ $item ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $rule->condition ? json_encode($rule->condition) : '-' }}</td>
                                        <td>{{ $rule->priority }}</td>
                                        <td>
                                            <a href="{{ route('admin.commission-rule.edit', $rule->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.commission-rule.destroy', $rule->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                       <div class="mt-3">
                            {{ $rules->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteCommission(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        ).then(() => {
                           location.reload();
                        });
                    },
                    error: function(err) {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
