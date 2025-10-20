
@extends('backend.layout.index')
@push('title')
    Update Shiping Rate
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Update Shiping Rate</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.shipping_zone.index')}}">Update Shiping Rate</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="row">
            @can('Shipping-rate')
            <div class="col-md-6 col-xl-6 d-flex">
                <div class="row w-100">
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Update Shiping</h5>
                            </div>
                            <div class="card-body">
                               <form action="{{ route('admin.shipping.store') }}" method="POST">
                                    @csrf
                                    @foreach ($shippingzones as $shippingzone)
                                        <div class="mb-3">
                                            <label class="form-label">{{ $shippingzone->name }}:</label>

                                            <input type="number"
                                                name="shipping_prices[{{ $shippingzone->id }}]"
                                                value="{{ old('shipping_prices.'.$shippingzone->id, $shippingzone->shippingRate->cost ?? '') }}"
                                                class="form-control @error('shipping_prices.'.$shippingzone->id) is-invalid @enderror"
                                                placeholder="Enter Price"
                                                required>

                                            <div class="invalid-feedback">
                                                @error('shipping_prices.'.$shippingzone->id)
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Save Prices</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             @endcan
            @can('Default-shiping')
            <div class="col-md-6 col-xl-6 d-flex">
                <div class="row w-100">
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Update Shiping</h5>
                            </div>
                            <div class="card-body">
                               <form action="{{ route('admin.shipping.default') }}" method="POST">
                                    @csrf
                                    @method('get')
                                        <div class="mb-3">
                                            <label class="form-label">Default Shipping:</label>
                                            <input
                                                type="number"
                                                name="default_shiping"
                                                value="{{ old('default_shiping', $default_shiping) }}"
                                                class="form-control @error('default_shiping') is-invalid @enderror"
                                                placeholder="Enter Price"
                                                required
                                            >
                                            <div class="invalid-feedback">
                                                @error('default_shiping')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    <button type="submit" class="btn btn-primary">Save Prices</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
@endsection
