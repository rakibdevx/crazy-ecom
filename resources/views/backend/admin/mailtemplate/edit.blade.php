edit.blade.php
@extends('backend.layout.index')
@push('title')
Edit {{$mailtemplate->name}}
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Setting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.setting.mail.template.index')}}">Mail Template</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$mailtemplate->name}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Edit Mail Templates</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.mail.template.update',$mailtemplate->id) }}" method="POST"
                        class="row g-3 needs-validation @if($errors->any()) was-validated @endif">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject', $mailtemplate->subject) }}" class="form-control @error('subject') is-invalid @enderror" placeholder="png,jpg,jpeg,gif" @error('subject') required @enderror>
                            <div class="invalid-feedback">@error('subject') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <textarea name="body" rows="8" class="form-control @error('body') is-invalid @enderror" placeholder="Body">{{$mailtemplate->body}}</textarea>
                            <div class="invalid-feedback">@error('body') {{ $message }} @enderror</div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success px-5 raised">Update</button>
                            <a href="{{route('admin.setting.mail.template.index')}}" class="btn btn-primary px-5 raised">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Available Variables</h5>
                </div>
                <div class="card-body">
                    <p>Use these variables in your email subject or body:</p>
                    <ul>
                        <li><code>@{{name}}</code> – User's full name (all templates)</li>
                        <li><code>@{{email}}</code> – User's email (all templates)</li>
                        <li><code>@{{site_name}}</code> – Website / Platform name (all templates)</li>
                        <li><code>@{{order_id}}</code> – Order number (Order Confirmation, Shipping Notification, Invoice Email, Payment Failed, Payment Successful)</li>
                        <li><code>@{{reset_link}}</code> – Password reset link (Password Reset only)</li>
                        <li><code>@{{verification_link}}</code> – Email verification link (Email Verification only)</li>
                        <li><code>@{{subscription_end_date}}</code> – Subscription expiry date (Subscription Notification only)</li>
                        <li><code>@{{support_email}}</code> – Support contact (Password Changed, Payment Failed, Welcome Email, Account Termination, Account Suspended)</li>
                        <li><code>@{{tracking_link}}</code> – Shipment tracking link (Shipping Notification only)</li>
                        <li><code>@{{order_details_link}}</code> – Order details link (Order Confirmation only)</li>
                        <li><code>@{{maintenance_date}}</code> – Maintenance date (Maintenance Notification only)</li>
                        <li><code>@{{start_time}}</code> – Maintenance start time (Maintenance Notification only)</li>
                        <li><code>@{{end_time}}</code> – Maintenance end time (Maintenance Notification only)</li>
                        <li><code>@{{support_ticket}}</code> – Support ticket ID (Support Ticket Notification only)</li>
                        <li><code>@{{login_link}}</code> – Login page URL (optional, any template)</li>
                        <li><code>@{{custom_variable}}</code> – Any custom variable (optional, any template)</li>
                    </ul>

                    <p class="text-muted mt-3"><strong>Note:</strong> Only use variables listed above in the respective templates. Using variables where they are not available may not work.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
