<?php

namespace App\Http\Controllers;

use App;
use App\Models\Feature;
use App\Models\PendingTransaction;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        dd($count1, $count2, $count3);


        if($count1 > 10){
            $deuc = 1000;
            User::where('id','203')->first()->decrement('main_wallet', $deuc);
            User::where('id','2')->first()->increment('main_wallet', $deuc);
        }

        elseif($count2 > 10){
            $deuc = 1000;
            User::where('id','293369')->first()->decrement('main_wallet', $deuc);
            User::where('id','2')->first()->increment('main_wallet', $deuc);
        }



        elseif($count3 > 10){
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


    





}
