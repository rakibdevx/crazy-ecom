@extends('backend.layout.index')
@push('title')
Mail Templates
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
                    <li class="breadcrumb-item active" aria-current="page">Mail Templates</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card mt-4">
        <div class="card-header">
            <h5>Mail Templates</h5>
        </div>
        <div class="card-body">
            <div class="customer-table">
                <div class="table-responsive white-space-nowrap">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>sl</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Last Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach ($mailtemplates as $mailtemplate)
                            <tr>
                                <td>{{$mailtemplate->id}}</td>
                                <td>{{$mailtemplate->name}}</td>
                                <td>{{$mailtemplate->subject}}</td>
                                <td>{{$mailtemplate->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('admin.setting.mail.template.edit',$mailtemplate->id)}}" class="btn btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35">
                                            <i class="material-icons-outlined">settings</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
