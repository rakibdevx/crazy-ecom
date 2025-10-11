@extends('backend.layout.index')
@push('title')
    Contact & Support Setting
@endpush
@section('body')
    <div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Setting</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Contact & Support Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="col-6 col-xl-6 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Update Contact & Support Info</h5>
                </div>
            <div class="card-body">
                <form action="{{ route('admin.setting.contact.update') }}" method="POST" enctype="multipart/form-data"
                    @class([
                        'row g-3 needs-validation',
                        'was-validated' => $errors->any()
                    ])>

                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Support Email:</label>
                        <input type="email" name="support_email" value="{{ old('support_email', setting('support_email')) }}" class="form-control @error('support_email') is-invalid @enderror" placeholder="Support Email"  @error('support_email') required @enderror>
                        <div class="invalid-feedback">
                            @error('support_email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Support phone:</label>
                        <input type="text" name="support_phone" value="{{ old('support_phone', setting('support_phone')) }}" class="form-control @error('support_phone') is-invalid @enderror" placeholder="Support Phone"  @error('support_phone') required @enderror>
                        <div class="invalid-feedback">
                            @error('support_phone')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Form Enabled:</label>
                        <select name="contact_form_enabled" class="form-control @error('contact_form_enabled') is-invalid @enderror" @error('contact_form_enabled') required @enderror>
                            <option value="1" {{ old('contact_form_enabled', setting('contact_form_enabled')) == '1' ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ old('contact_form_enabled', setting('contact_form_enabled')) == '0' ? 'selected' : '' }}>Disabled</option>
                        </select>
                        <div class="invalid-feedback">
                            @error('contact_form_enabled')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Live Chat Enabled:</label>
                        <select name="live_chat_enabled" class="form-control @error('live_chat_enabled') is-invalid @enderror" @error('live_chat_enabled') required @enderror>
                            <option value="1" {{ old('live_chat_enabled', setting('live_chat_enabled')) == '1' ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ old('live_chat_enabled', setting('live_chat_enabled')) == '0' ? 'selected' : '' }}>Disabled</option>
                        </select>
                        <div class="invalid-feedback">
                            @error('live_chat_enabled')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Working Hours:</label>
                        <input type="text" name="working_hours" value="{{ old('working_hours', setting('working_hours')) }}" class="form-control @error('working_hours') is-invalid @enderror" placeholder="Working Hours"  @error('working_hours') required @enderror>
                        <div class="invalid-feedback">
                            @error('working_hours')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Embeded Map:</label>
                        <input type="url" name="map_embed" value="{{ old('map_embed', setting('map_embed')) }}" class="form-control @error('map_embed') is-invalid @enderror" placeholder="Enter Google Map embed URL"  @error('map_embed') required @enderror>
                        <div class="invalid-feedback">
                            @error('map_embed')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-success px-5 raised">Update</button>
                        <a href="{{route('admin.dashboard')}}" class="btn btn-primary px-5 raised">back</a>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div><!--end row-->
    </div>
@endsection
