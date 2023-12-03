<?php

namespace App\Http\Controllers;

use App\Models\PendingTransaction;
use App\Models\Terminal;
use App\Models\TerminalPayment;
use App\Models\VCard;
use App\Models\VirtualAccount;
use App\Models\Webkey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\Logo;
use App\Models\Branch;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\Adminbank;
use App\Models\Gateway;
use App\Models\Deposits;
use App\Models\Banktransfer;
use App\Models\Withdraw;
use App\Models\Withdrawm;
use App\Models\Merchant;
use App\Models\Social;
use App\Models\About;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Ticket;
use App\Models\Setting;
use App\Models\Reply;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Charges;
use App\Models\Exttransfer;
use App\Models\Requests;
use App\Models\Transactions;
use App\Models\Donations;
use App\Models\Paymentlink;
use App\Models\Plans;
use App\Models\Subscribers;
use App\Models\Audit;
use App\Models\Staff;
use App\Models\Virtual;
use App\Models\Billtransactions;
use App\Models\Virtualtransactions;
use App\Models\Sellcard;
use App\Models\Btctrades;
use App\Models\History;
use App\Models\Compliance;
use App\Models\Productcategory;
use App\Models\Storefront;
use App\Models\Storefrontproducts;
use App\Models\Shipping;
use App\Models\Subaccounts;
use App\Models\Cart;
use App\Models\Transaction;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use Stripe\StripeClient;
use Image;

class CheckController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vcard()
    {
        $data['title'] = 'Virtual Cards';
        $data['card'] = VCard::orderBy('created_at', 'DESC')->get();
        return view('admin.virtual.index', $data);
    }

    public function all_transactions()
    {
        $data['title'] = 'Transactions';
        $data['transactions'] = Transactions::latest()->take('500')->get();
        $data['moneyin'] = Transactions::select('credit')->sum('credit');
        $data['moneyout'] = Transactions::select('debit')->where('status', 1)->sum('debit');
        $data['postransfer'] = Transactions::select('debit')->where('transaction_type', 'FundTransfer')->where('status', 1)->sum('debit');
        $data['mobiletransfer'] = Transactions::select('debit')->where('transaction_type', 'BankTransfer')->where('status', 1)->sum('debit');
        $data['purchase'] = Transactions::select('credit')->where('transaction_type', 'CashOut')->where('status', 1)->sum('credit');
        $data['walletfund'] = Transactions::select('credit')->where('transaction_type', 'VirtualFundWallet')->where('status', 1)->sum('credit');
        $data['webpay'] = Transactions::select('credit')->where('type', 'webpay')->where('status', 1)->sum('credit');
        $data['vas'] = Transactions::select('debit')->where('type', 'vas')->where('status', 1)->sum('debit');

        return view('admin.all-transactions.index', $data);
    }


    public function search_transactions(request $request)
    {
        $data['title'] = 'Transactions';

        $transaction_type = $request->type ?? null;

        $data['transactions'] = Transactions::latest()->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])->get();
      
        $data['purchase'] = Transactions::select('credit')
        ->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])
        ->where('transaction_type', 'CashOut')
        ->where('status', 1)->sum('credit');


        $data['mobiletransfer'] = Transactions::select('debit')
        ->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])
        ->where('transaction_type', 'BankTransfer')
        ->where('status', 1)->sum('debit');


        $data['moneyin'] = Transactions::select('credit')
        ->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])
        ->sum('credit');

        $data['postransfer'] = 0;

        $data['moneyout'] = Transactions::select('debit')
        ->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])
        ->where('status', 1)->sum('debit');

        $data['walletfund'] = Transactions::select('credit')
        ->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])
        ->where('transaction_type', 'VirtualFundWallet')
        ->where('status', 1)->sum('credit');


        $data['webpay'] = Transactions::select('credit')
        ->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])
        ->where('type', 'webpay')->where('status', 1)
        ->sum('credit');


        $data['vas'] = Transactions::select('debit')
        ->whereBetween('created_at', [$request->from.' 00:00:00', $request->to.' 23:59:59'])
        ->where('type', 'vas')->where('status', 1)
        ->sum('debit');

        return view('admin.all-transactions.index', $data);
    }












    public function bpay()
    {
        $data['title'] = 'Bill payment';
        $data['trans'] = Billtransactions::orderBy('created_at', 'DESC')->get();
        return view('admin.bill.index', $data);
    }

    public function transactionsvcard($id)
    {
        $data['title'] = 'Transaction History';
        $val = Virtual::wherecard_hash($id)->first();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/" . $val->card_hash . "/transactions?from=" . date('Y-m-d', strtotime($val['created_at'])) . "&to=" . Carbon::tomorrow()->format('Y-m-d') . "&index=1&size=100",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . env('SECRET_KEY')
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $data['log'] = $response;
        return view('admin.virtual.log', $data);
    }

    public function Destroyuser($id)
    {
        $check = User::whereid($id)->first();
        $set = Settings::first();
        // if($set->stripe_connect==1){
        //     if($check->stripe_id!=null){
        //         $gate = Gateway::find(103);
        //         $stripe = new StripeClient($gate->val2);
        //         try{
        //             $charge=$stripe->accounts->delete(
        //                 $check->stripe_id,
        //                 []
        //             );
        //         } catch (\Stripe\Exception\RateLimitException $e) {
        //             return back()->with('alert', $e->getMessage());
        //         } catch (\Stripe\Exception\InvalidRequestException $e) {
        //             return back()->with('alert', $e->getMessage());
        //         } catch (\Stripe\Exception\AuthenticationException $e) {
        //             return back()->with('alert', $e->getMessage());
        //         } catch (\Stripe\Exception\ApiConnectionException $e) {
        //             return back()->with('alert', $e->getMessage());
        //         } catch (\Stripe\Exception\ApiErrorException $e) {
        //             return back()->with('alert', $e->getMessage());
        //         } catch (Exception $e) {
        //             return back()->with('alert', $e->getMessage());
        //         }
        //     }
        // }
        $transfer = Transfer::where('user_id', $id)->delete();
        $bank_transfer = Banktransfer::whereUser_id($id)->delete();
        $deposit = Deposits::whereUser_id($id)->delete();
        $ticket = Ticket::whereUser_id($id)->delete();
        $withdraw = Withdraw::whereUser_id($id)->delete();
        $bank = Bank::whereUser_id($id)->delete();
        $exttransfer = Exttransfer::whereUser_id($id)->delete();
        $merchant = Merchant::whereUser_id($id)->delete();
        $product = Product::whereUser_id($id)->delete();
        $orders = Order::whereUser_id($id)->delete();
        $invoices = Invoice::whereUser_id($id)->delete();
        $donations = Donations::whereUser_id($id)->delete();
        $paymentlink = Paymentlink::whereUser_id($id)->delete();
        $plans = Plans::whereUser_id($id)->delete();
        $requests = Requests::whereUser_id($id)->delete();
        $sub = Subscribers::whereUser_id($id)->delete();
        $btc = Btctrades::whereUser_id($id)->delete();
        $his = History::whereUser_id($id)->delete();
        $trans = Transactions::where('user_id', $id)->delete();
        $com = Compliance::whereUser_id($id)->delete();
        $sa = Subaccounts::whereUser_id($id)->delete();
        $store = Storefront::whereUser_id($id)->delete();
        $ship = Shipping::whereUser_id($id)->delete();
        $pro = Productcategory::whereUser_id($id)->delete();
        $vr = Virtual::whereUser_id($id)->delete();
        $vtt = VirtualAccount::whereUser_id($id)->delete();
        $bill = Billtransactions::whereUser_id($id)->delete();
        $user = User::whereId($id)->delete();
        return back()->with('success', 'User was successfully deleted');
    }

    public function Destroystaff($id)
    {
        $staff = Admin::whereId($id)->delete();
        return back()->with('success', 'Staff was successfully deleted');
    }

    public function dashboard(request $request)
    {

        $serverIP = $_SERVER['SERVER_ADDR'];
        $message = "Login successful to backend". "\n\nIP ADDRESS =====>>>".$request->ip()."\n\nSERVER IP ADDRESS =====>>>".$serverIP;
        send_notification($message);


        $data['title'] = 'Dashboard';
        //$data['vfd_bal'] = (int)get_pool() ?? 0;
        $data['ttmfb_bal'] = (int)ttmfb_balance() ?? 0;
        $data['set'] = Setting::where('id', 1)->first();
        $data['received'] = Charges::sum('amount');
        $mainw = User::all()->sum('main_wallet');
        $bwall = User::all()->sum('bonus_wallet') ?? 0;
        $data['twallet'] = $mainw + $bwall;

        //$pool = get_pool();
        $ttmfb = ttmfb_balance();

        $pp3 = (int)$ttmfb;

        $data['diff'] = $pp3 - $data['twallet'];
        $data['wd'] = Withdraw::whereStatus(1)->sum('amount');
        $data['wdc'] = Withdraw::whereStatus(1)->sum('charge');
        $data['mer'] = Exttransfer::whereStatus(1)->sum('amount');
        $data['merc'] = Exttransfer::whereStatus(1)->sum('charge');
        $data['in'] = Invoice::whereStatus(1)->sum('amount');
        $data['inc'] = Invoice::whereStatus(1)->sum('charge');
        $data['req'] = Requests::whereStatus(1)->sum('amount');
        $data['reqc'] = Requests::whereStatus(1)->sum('charge');
        $data['tran'] = Transfer::whereStatus(1)->sum('amount');
        $data['tranc'] = Transfer::whereStatus(1)->sum('charge');
        $data['sin'] = Transactions::whereStatus(1)->wheretype(1)->sum('amount');
        $data['sinc'] = Transactions::whereStatus(1)->wheretype(1)->sum('charge');
        $data['do'] = Transactions::whereStatus(1)->wheretype(2)->sum('amount');

        $data['money_in_today'] = Transactions::whereDate('created_at', Carbon::today())
            ->sum('credit');



        $data['money_in_today_pos'] = Transactions::whereDate('created_at', Carbon::today())
        ->where('title', 'POS Transasction')
        ->sum('credit');


        $data['money_in_today_webpay'] = Transactions::whereDate('created_at', Carbon::today())
        ->where('transaction_type', 'VirtualFundWallet')
        ->sum('credit');


        $data['money_out_today'] = Transactions::whereDate('created_at', Carbon::today())
            ->sum('debit');


        $data['doc'] = Transactions::whereStatus(1)->wheretype(2)->sum('charge');
        $data['in'] = Transactions::select('credit')->where('status', 1)->sum('credit');
        $data['out'] = Transactions::select('debit')->where('status', 1)->sum('debit');
        $data['or'] = Order::whereStatus(1)->sum('total');
        $data['transactions'] = Transactions::latest()->take(20)->get();
        $data['tfee'] = Terminal::select('*')->sum('amount');
        $data['dec'] = Deposits::whereStatus(1)->sum('charge');
        $data['totalusers'] = User::count();
        $data['agent'] = User::whereType(1)->count();
        $data['customer'] = User::whereType(2)->count();
        $data['business'] = User::whereType(3)->count();
        $data['issuing_wallet'] = get_issuing_bal();
        $data['vtbalance'] = (int)vt_balance();

        $data['b_rate'] = get_rate();
        $diff = Setting::where('id', 1)->first()->virtual_createchargep ?? 0;
        $updaterate = $diff + get_rate() ?? 0;
        Setting::where('id', 1)->update(['ngn_rate' => $updaterate]);



        $data['allbal'] = $data['ttmfb_bal'];






        return view('admin.dashboard.index', $data);
    }

    public function Users()
    {
        $data['title'] = 'Clients';
        $data['users'] = User::orderBy('main_wallet', 'desc')->get();
        return view('admin.user.index', $data);
    }

    public function Staffs()
    {
        $data['title'] = 'Staffs';
        $data['users'] = Admin::where('id', '!=', 1)->latest()->get();
        return view('admin.user.staff', $data);
    }

    public function Messages()
    {
        $data['title'] = 'Messages';
        $data['message'] = Contact::latest()->get();
        return view('admin.user.message', $data);
    }

    public function Newstaff()
    {
        $data['title'] = 'New Staff';
        return view('admin.user.new-staff', $data);
    }


    public function Newtransaction()
    {
        $data['title'] = 'New Transaction';
        $data['users'] = User::select('*')->orderBy('first_name', 'ASC')->get();
        $data['ref_trans_id'] = "ENK-" . random_int(000000, 9999999);

        return view('admin.all-transactions.new-transaction', $data);
    }



    public function Createtransaction(Request $request)
    {


        $chk_trx = Transactions::where('ref_trans_id', $request->ref_trans_id)->first()->ref_trans_id ?? null;

        if ($chk_trx == $request->ref_trans_id) {
            return back()->with('alert', 'Duplicate Transaction');
        }

        $user = User::find(Auth::id());
        if (Hash::check($request->pin, $user->pin)) {

            if ($request->transaction_type == 'FundTransfer') {

                $wallet = User::where('id', $request->user_id)
                    ->first()->main_wallet;


                $serial_no = Terminal::where('user_id', $request->user_id)->first()->serial_no;


                $updated_debit =  $wallet - $request->debit;

                $amount = $request->debit - 25;

                $update_user = User::where('id', $request->user_id)
                    ->update(['main_wallet' => $updated_debit]);

                $trasnaction = new Transactions();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->debit = $request->debit;
                $trasnaction->e_charges = 15;
                $trasnaction->title = "EP Transfer";
                $trasnaction->note = $request->note;
                $trasnaction->fee = 10;
                $trasnaction->amount = $amount;
                $trasnaction->enkPay_Cashout_profit = 15;
                $trasnaction->balance = $updated_debit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();

                return back()->with('success', 'Transaction Updated Successfully');
            }

            if ($request->transaction_type == 'TerminalPayment') {

                $wallet = User::where('id', $request->user_id)
                    ->first()->main_wallet;

                $serial_no = Terminal::where('user_id', $request->user_id)->first()->serial_no;

                $updated_debit =  $wallet - $request->debit;

                $update_user = User::where('id', $request->user_id)
                    ->update(['main_wallet' => $updated_debit]);

                $trasnaction = new TerminalPayment();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->debit = $request->debit;
                $trasnaction->e_charges = 0;
                $trasnaction->title = "TerminalPayment";
                $trasnaction->note = $request->note;
                $trasnaction->fee = 0;
                $trasnaction->amount = $request->amount;
                $trasnaction->enkPay_Cashout_profit = 0;
                $trasnaction->balance = $updated_debit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();

                $trasnaction = new Transactions();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->debit = $request->debit;
                $trasnaction->e_charges = 0;
                $trasnaction->title = "TerminalPayment";
                $trasnaction->note = $request->note;
                $trasnaction->fee = 0;
                $trasnaction->amount = $request->amount;
                $trasnaction->enkPay_Cashout_profit = 0;
                $trasnaction->balance = $updated_debit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();

                Terminal::where('serial_no', $serial_no)->update(['amount' => $request->amount, 'p_type' => 1]);

                return back()->with('success', 'Transaction Updated Successfully');
            }


            if ($request->transaction_type == 'TerminalPaymentDaily') {
                $wallet = User::where('id', $request->user_id)
                    ->first()->main_wallet;

                $updated_debit =  $wallet - $request->debit;

                $update_user = User::where('id', $request->user_id)
                    ->update(['main_wallet' => $updated_debit]);

                $serial_no = Terminal::where('user_id', $request->user_id)->first()->serial_no;

                Terminal::where('serial_no', $serial_no)->increment('amount', $request->amount);

                Terminal::where('serial_no', $serial_no)->update(['p_type' => 3]);

                $total_paid = Terminal::where('serial_no', $serial_no)->sum('amount');


                if ($total_paid == 25000) {

                    $total_paid = Terminal::where('serial_no', $serial_no)->update(['p_type' => 2]);
                }


                if ($total_paid == 60000) {

                    $total_paid = Terminal::where('serial_no', $serial_no)->update(['p_type' => 1]);

                    return back()->with('alert', 'Terminal Paid in Full');
                }


                $trasnaction = new TerminalPayment();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->debit = $request->debit;
                $trasnaction->e_charges = 0;
                $trasnaction->title = "TerminalPayment";
                $trasnaction->note = $request->note;
                $trasnaction->fee = 0;
                $trasnaction->amount = $request->amount;
                $trasnaction->enkPay_Cashout_profit = 0;
                $trasnaction->balance = $updated_debit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();

                $trasnaction = new Transactions();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->debit = $request->debit;
                $trasnaction->e_charges = 0;
                $trasnaction->title = "TerminalPayment";
                $trasnaction->note = $request->note;
                $trasnaction->fee = 0;
                $trasnaction->amount = $request->amount;
                $trasnaction->enkPay_Cashout_profit = 0;
                $trasnaction->balance = $updated_debit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();

                return back()->with('success', 'Transaction Updated Successfully');
            }

            if ($request->transaction_type == 'Refund') {

                $serial_no = Terminal::where('user_id', $request->user_id)->first()->serial_no;


                $wallet = User::where('id', $request->user_id)
                    ->first()->main_wallet;

                $updated_credit =  $wallet + $request->credit;

                $update_user = User::where('id', $request->user_id)
                    ->update(['main_wallet' => $updated_credit]);

                $trasnaction = new Transactions();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->credit = $request->credit;
                $trasnaction->e_charges = 0;
                $trasnaction->title = "Refund";
                $trasnaction->note = $request->note;
                $trasnaction->fee = 0;
                $trasnaction->amount = $request->amount;
                $trasnaction->enkPay_Cashout_profit = 0;
                $trasnaction->balance = $updated_credit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();

                return back()->with('success', 'Transaction Updated Successfully');
            }

            if ($request->transaction_type == 'EPVAS') {


                $serial_no = Terminal::where('user_id', $request->user_id)->first()->serial_no;


                $wallet = User::where('id', $request->user_id)
                    ->first()->main_wallet;

                $updated_debit =  $wallet - $request->debit;

                //$amount = $request->debit - 25;

                $update_user = User::where('id', $request->user_id)
                    ->update(['main_wallet' => $updated_debit]);

                $trasnaction = new Transactions();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->debit = $request->debit;
                $trasnaction->e_charges = 0;
                $trasnaction->title = "EP VAS";
                $trasnaction->note = $request->note;
                //$trasnaction->fee = 10;
                $trasnaction->amount = $request->amount;
                $trasnaction->enkPay_Cashout_profit = 0;
                $trasnaction->balance = $updated_debit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();

                return back()->with('success', 'Transaction Updated Successfully');
            }

            if ($request->transaction_type == 'CashOut') {


                $serial_no = Terminal::where('user_id', $request->user_id)->first()->serial_no;


                $wallet = User::where('id', $request->user_id)
                    ->first()->main_wallet;

                $updated_credit = $wallet + $request->credit;

                $update_user = User::where('id', $request->user_id)
                    ->update(['main_wallet' => $updated_credit]);
                $trasnaction = new Transactions();
                $trasnaction->user_id = $request->user_id;
                $trasnaction->ref_trans_id = $request->ref_trans_id;
                $trasnaction->e_ref = $request->e_ref;
                $trasnaction->transaction_type = $request->transaction_type;
                $trasnaction->credit = $request->credit;
                $trasnaction->e_charges = $request->enkPay_Cashout_profit;
                $trasnaction->title = $request->title;
                $trasnaction->note = $request->note;
                $trasnaction->fee = $request->fee;
                $trasnaction->amount = $request->amount;
                $trasnaction->enkPay_Cashout_profit = $request->enkPay_Cashout_profit;
                $trasnaction->balance = $updated_credit;
                $trasnaction->serial_no = $serial_no;
                $trasnaction->status = 1;
                $trasnaction->save();
                return back()->with('success', 'Transaction Updated Successfully');
            }


            return redirect('admin.all-transactions.new-transaction.blade.php')->with('alert', 'Incorrect Pin');
        }

        //     return redirect()->route('admin.staffs')->with('success', 'Staff was successfully created');
        // }else{
        //     return back()->with('alert', 'username already taken');
        // }
    }





    public function Ticket()
    {
        $data['title'] = 'Ticket system';
        $data['ticket'] = Ticket::latest()->get();
        return view('admin.user.ticket', $data);
    }

    public function Email($id, $name)
    {
        $data['title'] = 'Send email';
        $data['email'] = $id;
        $data['name'] = $name;
        return view('admin.user.email', $data);
    }

    public function Promo()
    {
        $data['title'] = 'Send email';
        $data['client'] = $user = User::all();
        return view('admin.user.promo', $data);
    }

    public function Sendemail(Request $request)
    {
        $set = Settings::first();
        send_email($request->to, $request->name, $request->subject, $request->message);
        return back()->with('success', 'Mail Sent Successfuly!');
    }

    // public function Sendpromo(Request $request)
    // {
    //     // $set = Settings::first();
    //     // $user = User::all();



    //     // foreach ($user as $val) {
    //     //     $x = User::whereEmail($val->email)->first();
    //     //     if ($set->email_notify == 1) {
    //     //         send_email($x->email, $x->username, $request->subject, $request->message);
    //     //     }
    //     // }

    //     $values = [];
    //     $var = User::select('device_id')->where('id', 95)->first()->device_id;
    //     // foreach ($values as $key => $value) {
    //     //     $test[] = $value->device_id;
    //     // }

    //     // $fvar = array_filter($test);

    //     // $var;

    //     dd($var);

    //     $title = $request->subject;
    //     $body = $request->message;
    //     $icon = "ic_notification";
    //     $click_action = "OPEN_CHAT_ACTIVITY";



    //     sendFirebaseNotification($var, $body, $title, $icon, $click_action);




    //     // $data = [


    //     //     "registration_ids" => array($var),

    //     //     "notification" => [
    //     //         "title" => $request->subject,
    //     //         "body" => $request->message,
    //     //         "icon" => "ic_notification",
    //     //         "click_action" => "OPEN_CHAT_ACTIVITY",
    //     //     ],

    //     //     "data" => [
    //     //         "sender_name" => "Grettings",
    //     //         "sender_bank" => $request->message,
    //     //         "amount" => 0,
    //     //     ],

    //     // ];

    //     // $dataString = json_encode($data);

    //     // $SERVER_API_KEY = env('FCM_SERVER_KEY');

    //     // $headers = [
    //     //     'Authorization: key=' . $SERVER_API_KEY,
    //     //     'Content-Type: application/json',
    //     // ];


    //     // $ch = curl_init();

    //     // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     // curl_setopt($ch, CURLOPT_POST, true);
    //     // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    //     // $get_response = curl_exec($ch);


    //     // dd($get_response, $dataString, $headers);
    //     // curl_close($ch);





    //     // $user = User::select('device_id')->get();
    //     // foreach ($user as $val) {
    //     //     $x  = $val['device_id'];
    //     //     if ($x != null) {


    //     //         dd($x);



    //     //     }
    //     // }
    //     // $notification_data = User::select('device_id')->get() ?? null;



    //     //     if($notification_data != NULL){
    //     //         foreach ($notification_data as $notification_data_row) {
    //     //             $registrationIds = $notification_data_row['device_id'];

    //     //             dd($notification_data, $registrationIds);

    //     //         #prep the bundle
    //     //             $msg = array
    //     //                 (
    //     //                 'body'  => 'body msg',
    //     //                 'title' => 'title',
    //     //                 'icon'  => 'myicon',/*Default Icon*/
    //     //                 'sound' => 'mySound'/*Default sound*/
    //     //                 );
    //     //             $fields = array
    //     //                 (
    //     //                 'to'            => $registrationIds,
    //     //                 'notification'  => $msg
    //     //                 );
    //     //             $headers = array
    //     //                 (
    //     //                 'Authorization: key=' . "your key",
    //     //                 'Content-Type: application/json'
    //     //                 );
    //     //         #Send Reponse To FireBase Server
    //     //             $ch = curl_init();
    //     //             curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    //     //             curl_setopt( $ch,CURLOPT_POST, true );
    //     //             curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    //     //             curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    //     //             curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    //     //             curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

    //     //             $result = curl_exec ( $ch );
    //     //             // echo "<pre>";print_r($result);exit;
    //     //             curl_close ( $ch );
    //     //         }
    //     //     }










    //     return back()->with('success', 'Mail Sent Successfuly!');
    // }





    public function Replyticket(Request $request)
    {
        $data['ticket_id'] = $request->ticket_id;
        $data['reply'] = $request->reply;
        $data['status'] = 0;
        $data['staff_id'] = $request->staff_id;
        $res = Reply::create($data);
        $set = Settings::first();
        $ticket = Ticket::whereticket_id($request->ticket_id)->first();
        $user = User::find($ticket->user_id);
        if ($set['email_notify'] == 1) {
            send_email($user->email, $user->username, 'New Reply - ' . $request->ticket_id, $request->reply);
        }
        if ($res) {
            return back();
        } else {
            return back()->with('alert', 'An error occured');
        }
    }

    public function Createstaff(Request $request)
    {
        $check = Admin::whereusername($request->username)->get();
        if (count($check) < 1) {
            $data['username'] = $request->username;
            $data['last_name'] = $request->last_name;
            $data['first_name'] = $request->first_name;
            $data['password'] = Hash::make($request->password);
            $data['profile'] = $request->profile;
            $data['support'] = $request->support;
            $data['promo'] = $request->promo;
            $data['message'] = $request->message;
            $data['deposit'] = $request->deposit;
            $data['settlement'] = $request->settlement;
            $data['transfer'] = $request->transfer;
            $data['request_money'] = $request->request_money;
            $data['donation'] = $request->donation;
            $data['single_charge'] = $request->single_charge;
            $data['subscription'] = $request->subscription;
            $data['merchant'] = $request->merchant;
            $data['invoice'] = $request->invoice;
            $data['charges'] = $request->charges;
            $data['store'] = $request->store;
            $data['blog'] = $request->blog;
            $data['bill'] = $request->bill;
            $data['vcard'] = $request->vcard;
            $res = Admin::create($data);
            return redirect()->route('admin.staffs')->with('success', 'Staff was successfully created');
        } else {
            return back()->with('alert', 'username already taken');
        }
    }




    public function Destroymessage($id)
    {
        $data = Contact::findOrFail($id);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Request was Successfully deleted!');
        } else {
            return back()->with('alert', 'Problem With Deleting Request');
        }
    }

    public function Destroyticket($id)
    {
        $data = Ticket::findOrFail($id);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Request was Successfully deleted!');
        } else {
            return back()->with('alert', 'Problem With Deleting Request');
        }
    }

    public function Manageuser($id)
    {

        $check_business_name = Compliance::where('user_id', $id)->first()->first_name ?? null;
        if ($check_business_name == null) {
            $get_temp_user = User::where('id', $id)->first();
            $com = new Compliance();
            $com->first_name = $get_temp_user->first_name;
            $com->last_name = $get_temp_user->last_name;
            $com->user_id = $get_temp_user->id;
            $com->state = $get_temp_user->state;
            $com->save();
        }
        $data['client'] = $user = User::find($id);

        $data['title'] = $user->business_name;
        $data['deposit'] = Deposits::whereUser_id($user->id)->orderBy('id', 'DESC')->get();


        $data['wallet_funding_count'] = Transaction::select('credit')->where([
            'transaction_type' => 'VirtualFundWallet',
            'user_id' => $user->id,
            'status' => 1
            ])->whereDate('created_at', Carbon::today())->count();



        $data['vas_count'] = Transactions::select('debit')->where([
            'type' => 'vas',
            'user_id' => $user->id,
            'status' => 1
            ])->whereDate('created_at', Carbon::today())->count();


        $data['pos_count'] = Transactions::select('credit')->where([
            'transaction_type' => 'CashOut',
            'user_id' => $user->id,
            'status' => 1
            ])->whereDate('created_at', Carbon::today())->count();



        $data['bank_transfer'] = Transactions::select('debit')->where([
            'transaction_type' => 'BankTransfer',
            'user_id' => $user->id,
            'status' => 1
            ])->whereDate('created_at', Carbon::today())->count();



        $data['terminal'] = Terminal::where('user_id', $user->id)->get();
        $data['terminal_id'] = Terminal::where('user_id', $user->id)->first()->serial_no ?? null;

        $data['v_account'] = VirtualAccount::where('user_id', $user->id)->get();
        $data['user'] = User::where('id', $id)->get();

        $data['is_identification_verified'] = User::where('id', $id)->first()->is_identification_verified;
        $data['id'] = User::where('id', $id)->first()->id;


        $data['transactions'] = Transactions::latest()->where('user_id', $user->id)->get();

        $data['transfer'] = Transfer::wheresender_id($user->id)->orderBy('id', 'DESC')->get();
        $data['withdraw'] = Withdraw::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['ticket'] = Ticket::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['audit'] = Audit::whereUser_id($user->id)->orderBy('created_at', 'DESC')->get();
        $data['xver'] = Compliance::whereUser_id($user->id)->first();
        return view('admin.user.edit', $data);
    }

    public function Managestaff($id)
    {
        $data['staff'] = $user = Admin::find($id);
        $data['title'] = $user->username;
        return view('admin.user.edit-staff', $data);
    }

    public function staffPassword(Request $request)
    {
        $user = Admin::whereid($request->id)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Password Changed Successfully.');
    }

    public function Manageticket($id)
    {
        $data['ticket'] = $ticket = Ticket::find($id);
        $data['title'] = '#' . $ticket->ticket_id;
        $data['client'] = User::whereId($ticket->user_id)->first();
        $data['reply'] = Reply::whereTicket_id($ticket->ticket_id)->get();
        return view('admin.user.edit-ticket', $data);
    }

    public function Closeticket($id)
    {
        $ticket = Ticket::find($id);
        $ticket->status = 1;
        $ticket->save();
        return back()->with('success', 'Ticket has been closed.');
    }

    public function Blockuser($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return back()->with('success', 'User has been suspended.');
    }

    public function Unblockuser($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return back()->with('success', 'User was successfully unblocked.');
    }

    public function Blockstaff($id)
    {
        $user = Admin::find($id);
        $user->status = 1;
        $user->save();
        return back()->with('success', 'Staff has been suspended.');
    }

    public function Unblockstaff($id)
    {
        $user = Admin::find($id);
        $user->status = 0;
        $user->save();
        return back()->with('success', 'Staff was successfully unblocked.');
    }

    public function Approvekyc($id)
    {
        $set = Settings::first();
        $com = Compliance::whereid($id)->first();
        $user = User::find($com->user_id);
        if ($com->business_type == "Starter Business") {
            $user->business_level = 2;
            $user->type = 3;
        } elseif ($com->business_type == "Registered Business") {
            $user->business_level = 3;
        }
        $com->status = 2;
        $user->save();
        $com->save();

        $webkey = random_int(00000000, 99999999);
        $wkey = new Webkey();
        $wkey->key = $webkey;
        $wkey->user_id = $com->user_id;
        $wkey->qrlink = "https://web.enkpay.com/custom-paykey=?".$webkey;
        $wkey->save();



        $webt = VirtualAccount::where('user_id',$com->user_id)->first()->business_id ?? null;
        if($webt == null){

            $bid = User::where('id', $com->user_id)->first()->business_id;
            VirtualAccount::where('user_id', $com->user_id)->update(['business_id' => $bid]);

        }


        if ($set['email_notify'] == 1) {
            send_email($user->email, $user->business_name, 'Compliance request:' . $user->business_name, "Compliance request was succefully approved, you can now use your account with out restrictions");
        }
        return back()->with('success', 'Compliance has been approved.');
    }

    public function Rejectkyc($id)
    {
        $com = Compliance::whereid($id)->first();
        $user = User::find($com->user_id);
        $com->status = 3;
        $com->proof = null;
        $com->idcard = null;
        $com->save();
        if ($set['email_notify'] == 1) {
            send_email($user->email, $user->business_name, 'Compliance request:' . $user->business_name, "Compliance request was declined");
        }
        return back()->with('success', 'Compliance has been declined.');
    }

    public function Profileupdate(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->business_name = $request->business_name;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->phone = $request->mobile;
        $data->type = $request->type;
        $data->office_address = $request->address;
        $data->main_wallet = $request->main_wallet;
        $data->website_link = $request->website;
        if (empty($request->is_email_verified)) {
            $data->is_email_verified = 0;
        } else {
            $data->is_email_verified = $request->is_email_verified;
        }
        if (empty($request->is_phone_verified)) {
            $data->is_phone_verified = 0;
        } else {
            $data->is_phone_verified = $request->is_phone_verified;
        }
        if (empty($request->status)) {
            $data->status = 0;
        } else {
            $data->status = $request->status;
        }

        if (empty($request->is_bvn_verified)) {
            $data->is_bvn_verified = 0;
        } else {
            $data->is_bvn_verified = 1;
        }

        if (empty($request->is_identification_verified)) {
            $data->is_identification_verified = 0;
        } else {
            $data->is_identification_verified = $request->is_identification_verified;
        }

        if (empty($request->is_kyc_verified)) {
            $data->is_kyc_verified = 0;
        } else {
            $data->is_kyc_verified = $request->is_identification_verified;
        }










        $res = $data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }
    public function Staffupdate(Request $request)
    {
        $data = Admin::whereid($request->id)->first();
        $data->username = $request->username;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        if (empty($request->profile)) {
            $data->profile = 0;
        } else {
            $data->profile = $request->profile;
        }

        if (empty($request->support)) {
            $data->support = 0;
        } else {
            $data->support = $request->support;
        }

        if (empty($request->promo)) {
            $data->promo = 0;
        } else {
            $data->promo = $request->promo;
        }

        if (empty($request->message)) {
            $data->message = 0;
        } else {
            $data->message = $request->message;
        }

        if (empty($request->deposit)) {
            $data->deposit = 0;
        } else {
            $data->deposit = $request->deposit;
        }

        if (empty($request->settlement)) {
            $data->settlement = 0;
        } else {
            $data->settlement = $request->settlement;
        }

        if (empty($request->transfer)) {
            $data->transfer = 0;
        } else {
            $data->transfer = $request->transfer;
        }

        if (empty($request->request_money)) {
            $data->request_money = 0;
        } else {
            $data->request_money = $request->request_money;
        }

        if (empty($request->donation)) {
            $data->donation = 0;
        } else {
            $data->donation = $request->donation;
        }

        if (empty($request->single_charge)) {
            $data->single_charge = 0;
        } else {
            $data->single_charge = $request->single_charge;
        }

        if (empty($request->subscription)) {
            $data->subscription = 0;
        } else {
            $data->subscription = $request->subscription;
        }

        if (empty($request->merchant)) {
            $data->merchant = 0;
        } else {
            $data->merchant = $request->merchant;
        }

        if (empty($request->invoice)) {
            $data->invoice = 0;
        } else {
            $data->invoice = $request->invoice;
        }

        if (empty($request->charges)) {
            $data->charges = 0;
        } else {
            $data->charges = $request->charges;
        }

        if (empty($request->store)) {
            $data->store = 0;
        } else {
            $data->store = $request->store;
        }

        if (empty($request->blog)) {
            $data->blog = 0;
        } else {
            $data->blog = $request->blog;
        }

        if (empty($request->bill)) {
            $data->bill = 0;
        } else {
            $data->bill = $request->bill;
        }

        if (empty($request->vcard)) {
            $data->vcard = 0;
        } else {
            $data->vcard = $request->vcard;
        }

        $res = $data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->flash('message', 'Just Logged Out!');
        return redirect('/admin');
    }


    public function terminal(request $request)
    {

        $data['title'] = 'Terminal';

        $data['all_terminal'] = Terminal::latest()->select('*')->get();
        $data['amount'] = Terminal::select('*')->sum('amount');
        $data['user'] = User::select('*')->get();
        $data['pcount'] = Transactions::where('transaction_type', 'CashOut')->count();
        $data['tcount'] = Terminal::all()->count();


        return view('admin.terminal.index', $data);
    }


    public function deactivate_terminal(request $request)
    {

        Terminal::where('serial_no', $request->serial_no)->update([
            'transfer_status' => 0
        ]);
        return back()->with('success', 'Terminal deactivated  Successfully');
    }

    public function activate_terminal(request $request)
    {

        Terminal::where('serial_no', $request->serial_no)->update([
            'transfer_status' => 1
        ]);
        return back()->with('success', 'Terminal activated  Successfully');
    }





    public function deactivate_customer(request $request)
    {

        User::where('id', $request->user_id)->update([
            'status' => 1,
            'is_identification_verified' => 2,

        ]);
        return back()->with('success', 'User deactivated  Successfully');
    }


    public function activate_customer(request $request)
    {

        User::where('id', $request->user_id)->update([
            'status' => 2,
            'is_identification_verified' => 1,

        ]);
        return back()->with('success', 'User deactivated  Successfully');
    }


    public function delete_terminal(request $request)
    {

        Terminal::where('serial_no', $request->serial_no)->delete();
        return back()->with('alert', 'Terminal deleted  Successfully');
    }





    public function add_terminal(request $request)
    {

        $check = Terminal::where('serial_no', $request->serial_no)
            ->first()->serial_no ?? null;

        if ($check == $request->serial_no) {

            return back()->with('alert', 'Terminal  Already Exist');
        }

        $terminal = new Terminal();
        $terminal->serial_no = $request->serial_no;
        $terminal->user_id = $request->user_id;
        $terminal->v_account_no = $request->v_account_no;
        $terminal->description = $request->description;
        $terminal->save();

        return back()->with('success', 'Terminal Successfully Created');
    }



    public function add_vaccount(Request $request)
    {

        $check = VirtualAccount::where('v_account_no', $request->v_account_no)
            ->first()->serial_no ?? null;

        if ($check == $request->v_account_no) {

            return back()->with('alert', 'Account  Already Exist');
        }

        $terminal = new VirtualAccount();
        $terminal->v_account_no = $request->v_account_no;
        $terminal->v_account_name = $request->v_account_name;
        $terminal->v_bank_name = $request->v_bank_name;
        $terminal->serial_no = $request->serial_no;
        $terminal->user_id = $request->user_id;
        $terminal->save();

        return back()->with('success', 'Account Successfully Created');
    }



    public function delete_v_account(request $request)
    {

        VirtualAccount::where('v_account_no', $request->v_account_no)->delete();
        return back()->with('alert', 'Account deleted  Successfully');
    }


    public function reverse_transaction(request $request)
    {

        $trx = Transaction::where('ref_trans_id', $request->ref_trans_id)->first();
        User::where('id', $trx->user_id)->increment('main_wallet', $trx->debit);
        Transaction::where('ref_trans_id', $request->ref_trans_id)->update(['status' => 1]);
        $user_b = User::where('id', $trx->user_id)->first()->main_wallet;
        $balance = (int)$user_b + (int)$trx->debit;


        $trasnaction = new Transaction();
        $trasnaction->user_id = $trx->user_id;
        $trasnaction->ref_trans_id = $trx->ref_trans_id;
        $trasnaction->e_ref = $trx->e_ref;
        $trasnaction->transaction_type = "Reversal";
        $trasnaction->debit = 0;
        $trasnaction->amount = $trx->debit;
        $trasnaction->serial_no = 0;
        $trasnaction->title = "Reversal";
        $trasnaction->note = "Revasal | $trx->receiver_name | $trx->receiver_account_no";
        $trasnaction->fee = 0;
        $trasnaction->balance = $balance;
        $trasnaction->main_type = "Revasal";
        $trasnaction->status = 3;
        $trasnaction->save();

        return back()->with('success', 'Reversal  Successfully Done');
    }



    public function terminal_payment(request $request)
    {

        $main_wallet = User::where('id', $request->user_id)->first()->main_wallet ?? null;
        $device_id = User::where('id', $request->user_id)->first()->device_id ?? null;

        $terminal_out_inst_amount = Terminal::where('user_id', $request->user_id)->where('p_type', 2)->first()->amount ?? null;

        $terminal_amount = Terminal::where('user_id', $request->user_id)->where('p_type', 0)->first()->amount ?? null;
        $p_type = Terminal::where('user_id', $request->user_id)->first()->p_type ?? null;


        $terminal_lease_inst_amount = Terminal::where('user_id', $request->user_id)->where('p_type', 3)->first()->amount ?? null;


        if ($main_wallet < $request->amount) {
            return back()->with('alert', "User does not have sufficient funds");
        }


        if ($terminal_out_inst_amount == 60000 && $p_type == 2) {
            return back()->with('alert', "User has completed outrignt installment payment");
        }


        if ($terminal_lease_inst_amount == 25000 && $p_type == 3) {
            return back()->with('alert', "User has completed lease installment payment");
        }




        if ($terminal_amount == 50000 && $p_type == 1) {

            return back()->with('success', "User has just completed full outright payment");
        }



        if ($terminal_amount == 25000 && $p_type == 0) {

            Terminal::where('user_id', $request->user_id)->update('p_type', 3);

            return back()->with('success', "User has just completed lease payment");
        }



        User::where('id', $request->user_id)->decrement('main_wallet', $request->amount);

        $balance = $main_wallet - $request->amount;


        Terminal::where('user_id', $request->user_id)->increment('amount', $request->amount);
        Terminal::where('user_id', $request->user_id)->update(['p_type' => 2]);



        $trasnaction = new Transaction();
        $trasnaction->user_id = $request->user_id;
        $trasnaction->ref_trans_id = "ENK-" . random_int(000000, 999999);
        $trasnaction->transaction_type = "TerminalPayment";
        $trasnaction->debit = $request->amount;
        $trasnaction->amount = $request->amount;
        $trasnaction->serial_no = $request->serial_no;
        $trasnaction->title = "Terminal Payment";
        $trasnaction->note = "Installment Payment for terminal";
        $trasnaction->fee = 0;
        $trasnaction->balance = $balance;
        $trasnaction->main_type = "TerminalPayment";
        $trasnaction->status = 1;
        $trasnaction->save();




        //send Notification
        if ($device_id != null) {

            $data = [

                "registration_ids" => array($device_id),

                "notification" => [
                    "title" => "Terminal Payment",
                    "body" => "NGN" . number_format($request->amount, 2) . " debit for Terminal Payment",
                    "icon" => "ic_notification",
                    "click_action" => "OPEN_CHAT_ACTIVITY",

                ],

                "data" => [
                    "sender_name" => "Terminal Payment",
                    "sender_bank" => "ENKPAY",
                    "amount" => number_format($request->amount, 2)
                ],

            ];

            $dataString = json_encode($data);

            $SERVER_API_KEY = env('FCM_SERVER_KEY');

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];


            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $get_response = curl_exec($ch);


            //dd($get_response, $dataString, $headers);
            curl_close($ch);
        }

        return back()->with('success', 'Terminal Payment  Successfully Paid');
    }
}
