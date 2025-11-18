@extends('frontend.layout.index')
@push('title')
Checkout
@endpush
@section('body')
<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('index')}}">Home</a>
                </li>
                <li class="active">Checkout </li>
            </ul>
        </div>
    </div>
</div>
<div class="checkout-main-area pt-120 pb-120">
    <div class="container">
        <div class="checkout-wrap pt-30">
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap mr-50">
                        <div class="d-flex align-items-top justify-content-between">
                            <h3>Billing Details</h3>
                            <div class="button-box">
                                <button class="btn btn-success" title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Location</button>
                            </div>
                        </div>
                        <div class="row">
                            <form action="{{route('user.address.status')}}" method="POST">
                                @csrf
                                @foreach ($addresses as $address)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="address_id"
                                            id="address_{{ $address->id }}"
                                            value="{{ $address->id }}" @if ($address->status == 'active')@checked(true)@endif>

                                        <label class="form-check-label w-100" for="address_{{ $address->id }}">
                                            <span class="d-flex align-items-center justify-content-between w-100">
                                                <strong>{{ $address->address_name }}</strong>
                                                <strong>
                                                   <a href="{{ route('user.address.delete', $address->id) }}" class="btn-delete-address">
                                                        <i class="icon_close"></i>
                                                    </a>
                                                </strong>
                                            </span><br>
                                            {{ $address->name }} <br>
                                            Phone: {{ $address->phone }} <br>
                                            {{ $address->street_address }}
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="row">
                            <div class="cart-content">
                                <h3>Shopping Cart</h3>
                                <ul>
                                    @php
                                        $shipping = 0;
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($carts as $key => $item)
                                        @php
                                            $product = $products[$item['id']] ?? null;
                                            $shipping += $product->shipping_cost;
                                            $subtotal += $item['price'] * $item['quantity'];
                                        @endphp
                                        {{-- @dd($product) --}}
                                        <li class="single-product-cart d-flex justify-content-between w-100 pb-3">
                                            <div class="cart-img d-flex">
                                                <a href="#"><img src="{{asset($item['image'])}}" height="110" alt="{{$item['name']}}"></a>
                                                <div class="cart-title ps-3">
                                                    <h4><a href="{{route('product.details',$item['slug'])}}">{{$item['name']}}</a></h4>
                                                    <span> {{$item['quantity']}} × {{setting('currency_symbol')}} {{$item['price']}} </span> <br>
                                                    <span>Shipping: {{setting('currency_symbol')}}{{ $product->shipping_cost??0 }}</span>
                                                </div>
                                            </div>

                                            <div class="cart-delete">
                                                <a href="{{route('cart.remove',$key)}}">×</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="additional-info-wrap">
                            <label>Order notes</label>
                            <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-info-wrap">
                                <div class="your-order-info">
                                    <ul>
                                        <li>Product <span>Total</span></li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        @foreach ($carts as $key => $item)
                                        <li>{{$item['name']}} X {{$item['quantity']}} <span>{{$item['price'] * $item['quantity']}} </span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="your-order-info order-subtotal">
                                    <ul>
                                        <li>Total <span>{{setting('currency_symbol')}}{{$subtotal}} </span></li>
                                    </ul>
                                </div>
                                <div class="your-order-info order-shipping">
                                    <ul>
                                        <li>Shipping <span>{{setting('currency_symbol')}}{{$shipping}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="your-order-info order-subtotal">
                                    <ul>
                                        <li>Subtotal <span>{{setting('currency_symbol')}}{{$subtotal+$shipping}} </span></li>
                                    </ul>
                                </div>
                                <div class="your-order-info order-subtotal">
                                    <ul>
                                        <li>Discount <span>-{{setting('currency_symbol')}}{{$totalDiscount}} </span></li>
                                    </ul>
                                </div>
                                <div class="your-order-info order-total">
                                    <ul>
                                        <li>Grand total <span> {{setting('currency_symbol')}}{{$subtotal+$shipping-$totalDiscount}}</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="payment-method">
                                <div class="pay-top sin-payment">
                                    <input id="payment_method_1" class="input-radio" type="radio" value="cheque" checked="checked" name="payment_method">
                                    <label for="payment_method_1"> Direct Bank Transfer </label>
                                    <div class="payment-box payment_method_bacs">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                    </div>
                                </div>
                                <div class="pay-top sin-payment">
                                    <input id="payment-method-2" class="input-radio" type="radio" value="cheque" name="payment_method">
                                    <label for="payment-method-2">Check payments</label>
                                    <div class="payment-box payment_method_bacs">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                    </div>
                                </div>
                                <div class="pay-top sin-payment">
                                    <input id="payment-method-3" class="input-radio" type="radio" value="cheque" name="payment_method">
                                    <label for="payment-method-3">Cash on delivery </label>
                                    <div class="payment-box payment_method_bacs">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                    </div>
                                </div>
                                <div class="pay-top sin-payment sin-payment-3">
                                    <input id="payment-method-4" class="input-radio" type="radio" value="cheque" name="payment_method">
                                    <label for="payment-method-4">PayPal <img alt="" src="assets/images/icon-img/payment.png"><a href="#">What is PayPal?</a></label>
                                    <div class="payment-box payment_method_bacs">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order">
                            <a href="#">Place Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="billing-info-wrap mr-50">
                    <div class="d-flex align-items-top justify-content-between">
                        <h3>Add A New Address</h3>
                    </div>
                    <div id="formMessage"></div>
                    <form id="addressForm" action="{{ route('user.address.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-20">
                                    <label>Address Name <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="address_name" placeholder="Home Address / Office Address">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-20">
                                    <label>Name <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="name" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-20">
                                    <label>Phone <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="phone" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-20">
                                    <label>Email Address <abbr class="required" title="required">*</abbr></label>
                                    <input type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-select mb-20">
                                    <label>Shipping Zone<abbr class="required" title="required">*</abbr></label>
                                    <select name="shipping_zone_id">
                                        <option value="">Select an Address</option>
                                        <option value="1">Azerbaijan</option>
                                        <option value="2">Bahamas</option>
                                        <option value="3">Bahrain</option>
                                        <option value="4">Bangladesh</option>
                                        <option value="5">Barbados</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-20">
                                    <label>Street Address <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" name="street_address" class="billing-address" placeholder="House number and street name Apartment, suite, unit etc.">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-select mb-20">
                                    <label>Status<abbr class="required" title="required">*</abbr></label>
                                    <select name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).on("change", "input[name='address_id']", function() {
    $(this).closest("form").submit();
});
$(document).ready(function () {

    $("#addressForm").on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,

            beforeSend: function () {
                $("#formMessage").html(`<div class="alert alert-info">Please wait...</div>`);
            },

            success: function (response) {
                $("#formMessage").html(
                    `<div class="alert alert-success">${response.message}</div>`
                );

                $("#addressForm")[0].reset();
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    $.each(errors, function (key, value) {
                        errorHtml += `<li>${value[0]}</li>`;
                    });

                    errorHtml += '</ul></div>';

                    $("#formMessage").html(errorHtml);
                } else {
                    console.log(xhr);
                    $("#formMessage").html(
                        `<div class="alert alert-danger">Something went wrong!</div>`
                    );
                }
            }
        });

    });

});


$(document).on('click', '.btn-delete-address', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Are you sure?',
        text: "This will delete the address permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = href;
        }
    });
});
</script>

@endpush
