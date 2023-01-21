<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Checkout;
use App\Models\Camp;
use Str;
use Midtrans;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // \Midtrans\Config::$serverkey = env('MIDTRANS_SERVER_KEY');
        // \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        // \Midtrans\Config::$isSantized = env('MIDTRANS_IS_SANITIZED');
        // \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    // menampilkan dashboard checkout
    public function index()
    {
        $data['PARENTTAG'] = "checkout";
        $data['TITLETAG'] = "Checkout List";

        return view('admin.checkout.index', $data);
    }

    public function gridview()
    {
        $checkout = Checkout::get();

        return Datatables::of($checkout)
            ->editColumn('is_paid', function ($cout) {
                if($cout->is_paid == 1){
                    $textpaid = 'Paid';
                }else{
                    $textpaid = 'Not Paid';
                }
                return '<button class="btn btn-warning">'.$textpaid.'</button> ';
            })->addColumn('customer_name', function ($cout) {
                return $cout->users->name;
            })->addColumn('camp_name', function ($cout) {
                return $cout->camps->title;
            })->addColumn('camp_price', function ($cout) {
                return $cout->camps->price;
            })->addColumn('checkout_action', function ($cout) {
                return '<button  data-id="'.$cout->id.'" id="tombol_edit" class="btn btn-primary edit_btn">Edit</button>';
            })->addIndexColumn()->rawColumns(['is_paid','checkout_action'])->make();
    }
    // end

    // melakukan checkout

    public function checkout($slug)
    {
        $camp = Camp::where('slug', $slug)->first();

        $data['camp'] = $camp;

        return view('user.checkout', $data);
    }

    public function buy_camp(Request $request, $id)
    {
        $data = array(
            'camp_id' => $id,
            'user_id' => Auth::user()->id,
            // 'card_number'=> $request->card_number,
            // 'is_paid'=>1,
            // 'cvc'=>'tes',
            // 'expired'=>NULL

        );

        $checkout = Checkout::create($data);
        $this->get_snap_redirect($checkout);

        return redirect(url('/camps/success_checkout/'.$id));
    }

    public function success_checkout($id)
    {
        $camp = Camp::find($id);

        $data['camp'] = $camp;

        return view('user.success_checkout', $data);
    }

    //MIDTRANS Handler
    public function get_snap_redirect(Checkout $checkout)
    {
        $orderID = $checkout->id.'-'.Str::random(5);
        $transaction_details = array(
            "order_id"=> $orderID,
            "gross_amount"=> $checkout->camps->price
        );
        $item_details = array(
            "id"=> $orderID,
            "price"=> $checkout->camps->price,
            "quantity"=> 1,
            "name"=> "Payment For ".$checkout->camps->title
        );

        $user_data = array(
            "first_name"=>$checkout->users->name,
            "last_name"=>"",
            "address"=>$checkout->users->address,
            "city"=>"",
            "postal_code"=>"",
            "country_code"=>"IDN",
        );

        $customer_details = array(
            "first_name"=>$checkout->users->name,
            "last_name"=>"",
            "email"=>$checkout->users->email,
            "phone"=>$checkout->users->phone_number,
            "billing_address"=>$user_data,
            "shipping_address"=>$user_data,
        );

        $midtrans_param = array(
            'transaction_details'=>$transaction_details,
            'customer_details'=>$customer_details,
            'item_details'=>$item_details
        );

        try {
            // Get Snap Payment Code Url
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_param)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            return $paymentUrl;
        } catch (Exception $e) {
            
        }
    }

    public function midtrans_callback(Request $request)
    {
        //script ini diambil dari https://gist.github.com/taufanfadhilah
        $notif = new Midtrans\Notification();

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $checkoutID = explode('-', $notif->order_id)[0];
        $checkout = Checkout::find($checkoutId);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $checkout->payment_status = 'Pending';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $checkout->payment_status = 'Paid';
            }
        }
        else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'Failed';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'Failed';
            }
        }
        else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $checkout->payment_status = 'Failed';
        }
        else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $checkout->payment_status = 'Paid';
        }
        else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $checkout->payment_status = 'Pending';
        }
        else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $checkout->payment_status = 'Failed';
        }

        $checkout->save();

        return redirect(url('/camps/success_checkout/'.$checkoutId));
    }
}
