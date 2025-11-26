@extends('backend.layout.index')
@push('title')
    Invoice
@endpush
@section('body')
<div class="main-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card radius-10" id="invoice">
        <div class="card-header py-3">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-6">
                    <h5 class="mb-0">{{setting('site_name')}}</h5>
                </div>
                <div class="col-12 col-lg-6 text-md-end">
                    <a href="javascript:;" class="btn btn-danger btn-sm me-2" id="exportPdfBtn" ><i class="bi bi-file-earmark-pdf me-2"></i>Export as PDF</a>
                    <a href="javascript:;" class="btn btn-dark btn-sm" id="printBtn"><i class="bi bi-printer-fill me-2"></i>Print</a>
                </div>
            </div>
        </div>
        <div class="card-header py-2">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col-4">
                    <div class="">
                        <small>From</small>
                        <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">{{setting('site_name')}}</strong><br>
                        {{setting('address')}}<br>
                        Phone: {{setting('support_phone')}}<br>
                        Email: {{setting('support_email')}}<br>
                        </address>
                    </div>
                </div>
                <div class="col-4">
                    <div class="">
                        <small>To</small>
                        <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">{{$order->name}}</strong><br>
                        {{$order->street_address}}<br>
                        {{$order->zone?$order->zone->name:''}}<br>
                        Phone: {{$order->phone}}<br>
                        Email: {{$order->email}}
                        </address>
                    </div>
                </div>
                <div class="col-4">
                    <div class="">
                        <small>Invoice</small>
                        <div class=""><b>{{format_date($order->placed_at) ?? '-';}}</b></div>
                        <div class="invoice-detail">
                        {{$order->order_number}}<br>
                        <img src="{{asset(setting('site_logo'))}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-invoice">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-center" style="width: 10%;">Price</th>
                        <th class="text-center" style="width: 10%;">Quantity</th>
                        <th class="text-right" style="width: 10%;">Subtotal</th>
                        <th class="text-right" style="width: 10%;">Shiping</th>
                        <th class="text-right" style="width: 10%;">Discount</th>
                        <th class="text-right" style="width: 10%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $data)
                        <tr>
                            <td>
                                @if($data->product)
                                    <a href="{{ route('product.details', $data->product->slug) }}" target="_blank" class="text-inverse">
                                        {{ $data->product->name }}
                                    </a><br>
                                @else
                                    <span class="text-inverse">Deleted Item</span><br>
                                @endif
                                <small>
                                    <strong>Category :</strong> {{ $data->product?->category?->name }},
                                    <strong>Brand:</strong>{{ $data->product?->brand?->name }},
                                    <strong>Color:</strong> {{ $data->color?->name}},
                                    <strong>Size:</strong> {{ $data->size?->name}}
                                </small>
                            </td>
                            <td class="text-center">{{setting('currency_symbol')}}{{$data->price}}</td>
                            <td class="text-center">{{$data->quantity}}</td>
                            <td class="text-center">{{setting('currency_symbol')}}{{$data->sub_total}}</td>
                            <td class="text-center">{{setting('currency_symbol')}}{{$data->shipping_cost}}</td>
                            <td class="text-right">{{setting('currency_symbol')}}{{$data->discount}}</td>
                            <td class="text-right">{{setting('currency_symbol')}}{{$data->final_price}}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>

            <div class="row bg-light align-items-center m-0">
                <div class="col col-auto p-4">
                    <p class="mb-0">SUBTOTAL</p>
                    <h4 class="mb-0">{{setting('currency_symbol')}}{{$order->subtotal}}</h4>
                </div>
                <div class="col col-auto p-4">
                    <i class="bi bi-plus-lg text-muted"></i>
                </div>
                <div class="col col-auto p-4">
                    <p class="mb-0">Shipping</p>
                    <h4 class="mb-0">{{setting('currency_symbol')}}{{$order->shipping_amount}}</h4>
                </div>
                <div class="col col-auto p-4">
                    <i class="bi bi-dash-lg text-muted"></i>
                </div>
                <div class="col col-auto me-auto p-4">
                    <p class="mb-0">Discount</p>
                    <h4 class="mb-0">{{setting('currency_symbol')}}{{$order->coupon_discount}}</h4>
                </div>
                <div class="col bg-primary col-auto p-4">
                    <p class="mb-0 text-white">Grand Total</p>
                    <h4 class="mb-0 text-white">{{setting('currency_symbol')}}{{$order->grand_total}}</h4>
                </div>
            </div><!--end row-->

            <hr>
            <!-- begin invoice-note -->
            <div class="my-3">
                * Make all cheques payable to [Your Company Name]<br>
                * Payment is due within 30 days<br>
                * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
            </div>
        <!-- end invoice-note -->
        </div>

        <div class="card-footer py-3 bg-transparent">
            <p class="text-center mb-2">
            THANK YOU FOR YOUR ORDER
            </p>
            <p class="text-center d-flex align-items-center gap-3 justify-content-center mb-0">
            <span class="">
                <i class="bi bi-globe"></i>
                <a href="{{route('index')}}" target="_blank">{{route('index')}}</a>
            </span>
            <span class="">
                <i class="bi bi-telephone-fill"></i>
                <a href="tel:{{ setting('support_phone') }}">{{ setting('support_phone') }}</a>
            </span>

            <span class="">
                <i class="bi bi-envelope-fill"></i>
                <a href="mailto:{{ setting('support_email') }}">{{ setting('support_email') }}</a>
            </span>

            </p>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    const exportPdfBtn = document.getElementById('exportPdfBtn');
    const printBtn = document.getElementById('printBtn');
    const invoice = document.getElementById('invoice');

    // Export as PDF
    exportPdfBtn.addEventListener('click', () => {
        html2canvas(invoice).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');

            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('invoice.pdf');
        });
    });

    // Print
    printBtn.addEventListener('click', () => {
        const printContents = invoice.innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // To reload JS/CSS after print
    });
</script>
@endpush
