@extends('frontend.layout.index')
@push('title')
Cart
@endpush
@section('body')
<div class="cart-main-area pt-115 pb-120">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Subtotal</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($cartItems as $key => $item)
                                    <input type="hidden" class="cart-key" value="{{ $key }}">
                                    @php $subtotal = $item['price'] * $item['quantity']; @endphp
                                    @php $total += $subtotal; @endphp
                                    <tr data-key="{{$key}}">
                                        <td class="product-thumbnail">
                                            <a href="{{route('product.details',$item['slug'])}}"><img src="{{$item['image']}}" alt="" width="80"></a>
                                        </td>
                                        <td class="product-name"><a href="{{route('product.details',$item['slug'])}}">{{$item['name']}}</a></td>
                                        <td class="product-price-cart"><span class="amount">{{setting('currency_symbol')}}{{$item['price']}}</span></td>
                                        <td class="product-price-cart"><span class="color px-3 py-2" style="background-color: {{$item['color']}}">{{$item['color']?'':'-'}}</span></td>
                                        <td class="product-size"><span class="size p-2 text-white bg-info">{{$item['size']?$item['size']:'-'}}</span></td>
                                        <td class="product-quantity pro-details-quality">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="{{$item['quantity']}}">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">{{setting('currency_symbol')}} <span class="total_price">{{$item['price'] * $item['quantity']}}</span></td>
                                        <td class="product-subtotal">{{setting('currency_symbol')}} <span class="Product_discount">0</span></td>
                                        <td class="product-subtotal">{{setting('currency_symbol')}} <span class="product-subtotal-after">{{$item['price'] * $item['quantity']}}</span> </td>
                                        <td class="product-remove">
                                            <a href="{{route('cart.remove',$key)}}"><i class="icon_close"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{route('product.index')}}">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <a href="{{route('cart.clear')}}">Clear Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 offset-lg-4 offset-md-6">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <form target="#" id="couponForm">
                                    <input type="text" required name="name" id="coupon_code" placeholder="Enter coupon code">
                                    <button class="cart-btn-2" id="applyCoupon" type="button">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total price : <span>{{setting('currency_symbol')}}<span id="total_price">{{$total}}</span></span></h5>
                            <div class="total-shipping">
                                <h5>Discount : <span>-{{setting('currency_symbol')}}<span id="discount_amount">0</span></span></h5>
                            </div>
                            <h4 class="grand-totall-title">Grand Total <span id="grand-total">$260.00</span></h4>
                            <a href="{{route('user.checkout')}}">Proceed to Checkout</a>
                        </div>
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
    $("#couponForm").on("keydown", function(e){
        if (e.key === "Enter") {
            e.preventDefault();
        }
    });

    var CartPlusMinus = $('.cart-plus-minus');
    CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
    CartPlusMinus.append('<div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() === "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);
    });


    $('#applyCoupon').click(function(e){
        e.preventDefault();

        var code = $('#coupon_code').val();

        $.ajax({
            url: "{{ route('cart.ajax.coupon') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                code: code
            },
            success: function(response){
                if(response.status == 'success'){
                    $('.Product_discount').text(0);
                    $('.product-subtotal-after').each(function(){
                        let subtotal = $(this).closest('tr').find('.total_price').text();
                        $(this).text(subtotal);
                    });

                    let items = response.items;
                    Object.keys(items).forEach(function(key) {
                        let item = items[key];
                        let row = $('tr[data-key="' + key + '"]');
                        row.find('.Product_discount').text(item.discount);
                        row.find('.product-subtotal-after').text(item.final_price);
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Coupon Applied!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#discount_amount').text(response.total_discount.toFixed(2));
                    let totalPrice = parseFloat($('#total_price').text());
                    let newTotal = totalPrice - parseFloat(response.total_discount);
                    $('#grand-total').text(newTotal.toFixed(2));
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: response.message
                    });
                }
            },
            error: function(){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Something went wrong!'
                });
            }
        });
    });
</script>
@endpush
