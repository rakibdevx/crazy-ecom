@extends('backend.layout.index')

@push('title')
    Comment Details
@endpush

@section('body')
<div class="main-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Comments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.comment.index') }}">All Comments</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Comment Details</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.comment.index') }}" class="btn btn-primary px-4">
                    <i class="bx bx-left-arrow-circle"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="card radius-10 shadow-sm border-0">
        <div class="card-header">
            <h5 class="mb-0">Comment Details</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-muted">User Information</h6>
                    <p><strong>Name:</strong> {{ optional($comment->user)->name ?? 'Guest User' }}</p>
                    <p><strong>Email:</strong> {{ optional($comment->user)->email ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6">
                    <h6 class="text-muted">Product Information</h6>
                    <p><strong>Product Name:</strong> {{ optional($comment->product)->name ?? 'N/A' }}</p>
                    <p><strong>Product SKU:</strong> {{ optional($comment->product)->sku ?? 'N/A' }}</p>
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <h6 class="text-muted">Comment Text</h6>
                <p class="border p-3 bg-light rounded">{{ $comment->comment }}</p>
            </div>

            <div class="mb-3">
                <h6 class="text-muted">Rating</h6>
                <p>
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bx {{ $i <= $comment->rating ? 'bxs-star text-warning' : 'bx-star text-muted' }}"></i>
                    @endfor
                </p>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <h6 class="text-muted">Status</h6>
                    <p>
                        <span class="badge bg-{{ $comment->status == 'approved' ? 'success' : 'secondary' }}">
                            {{ ucfirst($comment->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Created At</h6>
                    <p>{{ $comment->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Updated At</h6>
                    <p>{{ $comment->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
