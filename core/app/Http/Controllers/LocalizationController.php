<?php

namespace App\Http\Controllers;

use App;
use App\Models\Feature;
use App\Models\Order;
use App\Models\PendingTransaction;
use App\Models\Product;
use App\Models\Productimage;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\FeatureSet;

class LocalizationController extends Controller
{
    public function index($locale)
    {
        App::setLocale($locale);
        //storing the locale in session to get it back in the middleware
        session()->put('locale', $locale);
        return redirect()->back();
    }




    public function exe_view()
    {


        $set_trx = Feature::where('id', 1)->first()->pos_transfer ?? null;
        $trx = PendingTransaction::all();


        return view('exe', compact('trx', 'set_trx'));



    }


    public function charge_terminal_fee(request $request){



    }


    public function charge_terminal_fee_weekly(request $request){



    }


    public function charge_fees(request $request){

        $user1 = User::select('main_wallet')->where('id','203')->first()->main_wallet;
        $user2 = User::select('main_wallet')->where('id','293369')->first()->main_wallet;
        $user3 = User::select('main_wallet')->where('id','214')->first()->main_wallet;


        $count1 = Transaction::where('user_id','203')->whereDate('created_at', Carbon::today())->count();
        $count2 = Transaction::where('user_id','293369')->whereDate('created_at', Carbon::today())->count();
        $count3 = Transaction::where('user_id','214')->whereDate('created_at', Carbon::today())->count();



        if($count1 > 10 && $user1 > 20000){
            $deuc = 1000;
            User::where('id','203')->first()->decrement('main_wallet', $deuc);
            User::where('id','2')->first()->increment('main_wallet', $deuc);
        }

        if($count2 > 10 && $user2 > 20000){
            $deuc = 1000;
            User::where('id','293369')->first()->decrement('main_wallet', $deuc);
            User::where('id','2')->first()->increment('main_wallet', $deuc);
        }



        if($count3 > 10 && $user3 > 20000){
            $deuc = 1000;
            User::where('id','214')->first()->decrement('main_wallet', $deuc);
            User::where('id','2')->first()->increment('main_wallet', $deuc);
        }

        return back()->with('message', 'Charge has been updated');



    }




    public function pricing()
    {
        return view('front.pricing');
    }


    public function delete_trx(request $request)
    {

        $trx = PendingTransaction::where('ref_trans_id', $request->ref_trans_id)->delete();
        return back()->with('message', 'Transaction deleted successfully');
    }


    public function block_pos_transfer(request $request)
    {
        $trx = Feature::where('id', 1)->update(['pos_transfer' => 0]);
        return back()->with('message', 'Status updated successfully');
    }


    public function unblock_pos_transfer(request $request)
    {
        $trx = Feature::where('id', 1)->update(['pos_transfer' => 1]);
        return back()->with('message', 'Status updated successfully');
    }



    public function block_user(request $request)
    {

        $trx = User::where('id', $request->user_id)->update(['status' => 7]);
        return back()->with('message', 'User has been updated');
    }


    public function unblock_user(request $request)
    {
        $trx = User::where('id', $request->user_id)->update(['status' => 2]);
        return back()->with('message', 'User has been updated');
    }


    public function buy_product(request $request)
    {
        
        $p_ref = $request->pref;

        $pr = Product::where('ref_id', $p_ref)->first();

        $b_name = User::where('id', $pr->user_id)->first()->b_name ?? null;

        $amount = $pr->amount;
        $name = $pr->name;
        $amount = $pr->amount;
        $quantity =$pr->quantity;
        $quantity_status = $pr->quantity_status;
        $description = $pr->description;
        $shipping_status = $pr->shipping_status;
        $ref = $pr->ref_id;
        $id = $pr->id;
        $note_status = $pr->note_status;
        $status = $pr->status;
        $image = Productimage::where('product_id', $id)->first()->image;
        $user_id = $pr->user_id;



        return view('user.product.buy-now', compact('b_name', 'amount', 'image', 'user_id', 'status', 'note_status', 'name', 'quantity', 'quantity_status', 'description', 'shipping_status','ref', 'id'));

        




    }


    public function pay_now(request $request)
    {


        $key = env('WEBKEY');
        $ref = "PR-" . random_int(10000000, 99999999);

        $url = "https://web.enkpay.com/pay?amount=$request->amount&key=$key&ref=$ref&email=$request->email";


        $ord = new Order();
        $ord->user_id = $request->user_id;
        $ord->first_name = $request->first_name;
        $ord->last_name = $request->last_name;
        $ord->first_name = $request->first_name;
        $ord->seller_id = $request->user_id;
        $ord->payment_type = "ENKPAY";
        $ord->product_id = $request->product_id;
        $ord->quantity = $request->quantity;
        $ord->amount = $request->amount;
        $ord->phone = $request->phone;
        $ord->ref_id = $request->ref_id;

        $ord->save();

        return Redirect::to($url);


    }







}
