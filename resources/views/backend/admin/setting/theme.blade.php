@extends('backend.layout.index')
@push('title')
    Theme
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
                    <li class="breadcrumb-item active" aria-current="page">Theme</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-md-6 col-xl-6 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Update Theme</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.theme.update') }}" method="POST"
                        class="row g-3 needs-validation @if($errors->any()) was-validated @endif">
                        @csrf

                        <div class="mb-3">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="best_selling_enable" name="best_selling_enable" value="1"
                                {{ setting('best_selling_enable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="best_selling_enable">Best Selling Products</label>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hot_deals_enable" name="hot_deals_enable" value="1"
                                {{ setting('hot_deals_enable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="hot_deals_enable">Hot Deals Products</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="featured_products_enable" name="featured_products_enable" value="1"
                                {{ setting('featured_products_enable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured_products_enable">Featured Products</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="trending_products_enable" name="trending_products_enable" value="1"
                                {{ setting('trending_products_enable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="trending_products_enable">Trending Products</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="popular_categories_enable" name="popular_categories_enable" value="1"
                                {{ setting('popular_categories_enable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="popular_categories_enable">Popular Categories</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="suggest_today_enable" name="suggest_today_enable" value="1"
                                {{ setting('suggest_today_enable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="suggest_today_enable">Suggest Today</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="brands_enable" name="brands_enable" value="1"
                                {{ setting('brands_enable') ? 'checked' : '' }}>
                            <label class="form-check-label" for="brands_enable">Brands Enable</label>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-success px-5 raised">Update</button>
                            <a href="{{route('admin.dashboard')}}" class="btn btn-primary px-5 raised">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
