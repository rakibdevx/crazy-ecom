<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class SslCommerzPaymentController extends Controller
{
    public function pay(Request $request)
    {
        $order = Order::with(['zone', 'details.product.category'])
            ->where('user_id', auth()->guard('user')->id())
            ->where('order_number', $request->order)
            ->first();

        $product_names = $order->details->map(function($item){
            return $item->product->name . ' x ' . $item->qty;
        })->toArray();
        $inx_id =  uniqid();

        $post_data = [];
        $post_data['total_amount'] = $order->grand_total;
        $post_data['currency'] = $order->currency;
        $post_data['tran_id'] =$inx_id;

        $post_data['cus_name'] = $order->name;
        $post_data['cus_email'] = $order->email;
        $post_data['cus_add1'] = $order->street_address;
        $post_data['cus_city'] = $order->zone->name;
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $order->phone;

        $post_data['ship_name'] = $order->name;
        $post_data['ship_add1'] = $order->street_address;
        $post_data['ship_city'] = $order->zone->name ?? '';
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = implode(', ', $product_names)??"Product";
        $post_data['product_category'] = 'Goods';
        $post_data['product_profile'] = 'physical-goods';
        $post_data['value_a'] = $order->id;
        $post_data['value_b'] = $request->order;
        $order->update([
            'transaction_id'=>$inx_id,
        ]);
        $sslc = new SslCommerzNotification();

        $payment_options = $sslc->makePayment($post_data, 'hosted');
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $tran_id  = $request->tran_id;
        $amount   = $request->amount;
        $currency = $request->currency;
        // SSLCommerz returns value_b as order_number
        $order = Order::where('order_number', $request->value_b)->where('transaction_id', $tran_id)->first();


        if(!$order){
            return redirect()->route('index')->with('error', 'Order not found!');
        }

        if ($order->payment_status == 'pending') {
                // Update order status
                $order->payment_status = "paid";
                $order->card_type = $request->card_type;
                $order->card_issuer = $request->card_issuer;
                $order->card_brand = $request->card_brand;
                $order->paid_amount = $request->amount;
                $order->store_amount = $request->store_amount;
                $order->getway_charge = $request->amount - $request->store_amount;
                $order->currency_rate = $request->currency_rate;
                $order->paid_at = $request->tran_date;
                $order->bank_tran_id = $request->bank_tran_id;
                $order->update();
                return redirect()->route('success.page')
                    ->with('success', 'Transaction successfully completed!');


        } elseif ($order->payment_status == 'paid') {
            return redirect()->route('index')
                ->with('success', 'Transaction successfully completed!');

        } elseif ($order->payment_status == 'failed') {
            return redirect()->route('index')
                ->with('error', 'Transaction Failed!');

        } elseif ($order->payment_status == 'refunded') {
            return redirect()->route('index')
                ->with('error', 'Transaction Successfully Refunded!');
        } else {

            return redirect()->route('index')->with('error', 'Invalid Transaction!');
        }
    }


    public function fail(Request $request)
    {
        $tran_id = $request->tran_id;

        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->route('index')->with('error', 'Invalid Transaction!');
        }

        if ($order->payment_status == 'pending') {

            $order->update(['payment_status' => 'failed']);

            return redirect()->route('index')
                ->with('error', 'Transaction Failed!');
        }

        if ($order->payment_status == 'paid') {

            return redirect()->route('index')
                ->with('success', 'Transaction was already successful!');
        }

        return redirect()->route('index')->with('error', 'Invalid Transaction!');
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->tran_id;

        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->route('index')->with('error', 'Invalid Transaction!');
        }

        if ($order->payment_status == 'pending') {

            $order->update(['payment_status' => 'canceled']);

            return redirect()->route('index')
                ->with('error', 'Transaction Canceled!');
        }

        if ($order->payment_status == 'paid') {

            return redirect()->route('index')
                ->with('success', 'Transaction was already successful!');
        }

        return redirect()->route('index')->with('error', 'Invalid Transaction!');
    }


    public function ipn(Request $request)
    {
        if (!$request->tran_id) {
            return "Invalid Data";
        }

        $tran_id = $request->tran_id;

        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return "Invalid Transaction";
        }

        if ($order->payment_status == 'pending') {

            $sslc = new SslCommerzNotification();
            $is_valid = $sslc->orderValidate(
                $request->all(),
                $tran_id,
                $order->amount,
                $order->currency
            );

            if ($is_valid === true) {

                $order->update(['payment_status' => 'processing']);

                return "Transaction is successfully completed (IPN)";
            }

            return "Validation Failed";
        }

        if ($order->payment_status == 'processing' || $order->payment_status == 'paid') {
            return "Transaction already completed";
        }

        return "Invalid Transaction";
    }

}
