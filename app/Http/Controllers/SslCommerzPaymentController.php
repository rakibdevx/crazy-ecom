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

        $post_data = [];
        $post_data['total_amount'] = $order->grand_total;
        $post_data['currency'] = $order->currency;
        $post_data['tran_id'] = uniqid();

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
        $post_data['product_name'] = implode(', ', $product_names);
        $post_data['product_category'] = 'Goods';
        $post_data['product_profile'] = 'physical-goods';
        $post_data['value_a'] = $order->id;
        $post_data['value_b'] = $request->order;

        $sslc = new SslCommerzNotification();

        $payment_options = $sslc->makePayment($post_data, 'hosted');
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        // SSLCommerz returns value_b as order_number
        $order = Order::where('order_number', $request->value_b)->first();

        if(!$order){
            return redirect()->route('index')->with('error', 'Order not found!');
        }

        $tran_id  = $request->tran_id;
        $amount   = $request->amount;
        $currency = $request->currency;

        $sslc = new SslCommerzNotification();

        // Check again from database
        $order_details = Order::where('transaction_id', $tran_id)->first();

        if ($order_details->status == 'Pending') {

            // SSLCommerz validation
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {

                // Update order status
                $order_details->status = "Processing";
                $order_details->update();

                return redirect()->route('success.page')
                    ->with('success', 'Transaction successfully completed!');
            }

        } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

            return redirect()->route('success.page')
                ->with('success', 'Transaction successfully completed!');

        } else {

            return redirect()->route('index')->with('error', 'Invalid Transaction!');
        }
    }


    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
