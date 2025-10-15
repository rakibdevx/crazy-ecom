@extends('backend.layout.index')
@push('title')
    {{$vendor->name}}
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.vendor.index')}}">Vendor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$vendor->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="{{ route('admin.vendor.update',$vendor->id) }}" method="POST" class="row g-3 needs-validation">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name"
                                    value="{{ old('name', $vendor->name) }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Name" required>
                                <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email"
                                    value="{{ old('email', $vendor->email) }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter Email" required>
                                <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone:</label>
                                <input type="text" name="phone"
                                    value="{{ old('phone', $vendor->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter Phone">
                                <div class="invalid-feedback">@error('phone') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bio:</label>
                                <textarea name="bio" rows="3"
                                        class="form-control @error('bio') is-invalid @enderror"
                                        placeholder="Write something about yourself...">{{ old('bio', $vendor->bio) }}</textarea>
                                <div class="invalid-feedback">@error('bio') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status:</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="pending" {{ old('status', $vendor->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ old('status', $vendor->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="suspend" {{ old('status', $vendor->status) == 'suspend' ? 'selected' : '' }}>suspend</option>
                                </select>
                                <div class="invalid-feedback">@error('status') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Verified:</label>
                                <select name="verified" class="form-control @error('verified') is-invalid @enderror" required>
                                    <option value="0" {{ old('verified', $vendor->verified) == 0 ? 'selected' : '' }}>Disabled</option>
                                    <option value="1" {{ old('verified', $vendor->verified) == 1 ? 'selected' : '' }}>Enabled</option>
                                </select>
                                <div class="invalid-feedback">@error('verified') {{ $message }} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password:</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter password">
                                <div class="invalid-feedback">@error('password') {{ $message }} @enderror</div>
                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                <a href="{{ route('admin.vendor.index') }}" class="btn btn-primary px-5 raised">Back</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
