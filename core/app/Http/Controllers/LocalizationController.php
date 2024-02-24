<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\FeatureSet;
use App\Exports\ExportClass;
use App\Models\Productimage;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Oldtransaction;
use Laravel\Passport\Passport;
use App\Models\OauthAccessToken;
use App\Models\PendingTransaction;
use App\Rules\AllowedEmailDomains;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class LocalizationController extends Controller
{
    public function index($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }


    public function delete_transaction(request $request)
    {

        $pin = env('PIN');
        if ($request->pass != $pin) {
            return back()->with('error', 'Pin not correct');
        }

        Transactions::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
            ->delete();

        return back()->with('error', 'Transaction Table Deleted');


    }


    public function get_transaction(request $request)
    {

        $pin = env('PIN');
        if ($request->pass != $pin) {
            return back()->with('error', 'Pin not correct');
        }

        $dataToMove = Transactions::where('status', 1)->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])->get();
        foreach ($dataToMove as $item) {
            Oldtransaction::updateOrCreate(['id' => $item->id], $item->toArray());
        }


        return back()->with('error', 'Transaction Table Deleted');


    }


    public function downloadExcelData(request $request)
    {
        $tableName = 'transactions';

        $data = DB::table($tableName)->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])->get();
        $fileName = 'excel_data_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ExportClass($data), $fileName);
    }


    public function backup_transaction(request $request)
    {

        $tableName = 'transactions';
        $data = DB::table($tableName)->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])->get();

        $sqlContent = '';
        foreach ($data as $row) {
            $values = implode("', '", (array)$row);
            $sqlContent .= "INSERT INTO {$tableName} VALUES ('{$values}');\n";
        }

        $fileName = 'Transaction_' . $request->from . '-' . $request->to . '.sql';
        $headers = [
            'Content-Type' => 'application/sql',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ];


        return response($sqlContent, Response::HTTP_OK, $headers);

    }


    public function backup_user(request $request)
    {

        $tableName = 'users';
        $data = DB::table($tableName)->get();

        $sqlContent = '';
        foreach ($data as $row) {
            $values = implode("', '", (array)$row);
            $sqlContent .= "INSERT INTO {$tableName} VALUES ('{$values}');\n";
        }

        $fileName = 'Users_' . date('Y-m-d_H-i-s') . '.sql';
        $headers = [
            'Content-Type' => 'application/sql',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ];
        return response($sqlContent, Response::HTTP_OK, $headers);

    }


    public function exe_view()
    {


        $set_trx = Feature::where('id', 1)->first()->pos_transfer ?? null;
        $trx = PendingTransaction::all();


        return view('exe', compact('trx', 'set_trx'));


    }

    public function business_register(request $request)
    {

        $user = User::where('email', $request->email)->first() ?? null;

        if ($user != null && $user->email == $request->email && $user->status == 2) {
            return back()->with('error', "Email Already Exist");
        }


        if ($user != null && $user->email == $request->email && $user->status == 0) {

            $get_code = random_int(1000, 9999);
            User::where('email', $request->email)->update(['sms_code' => $get_code]);
            $code = User::where('email', $request->email)->first()->sms_code;


            $data = array(
                'fromsender' => 'noreply@enkpay.com', 'EnkPay',
                'subject' => "Email Verification",
                'toreceiver' => $request->email,
                'code' => $code,
            );

            Mail::send('emails.email-verify', ["data1" => $data], function ($message) use ($data) {
                $message->from($data['fromsender']);
                $message->to($data['toreceiver']);
                $message->subject($data['subject']);
            });


            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['message'] = null;

            return view('auth.business-verify-email', $data);
        }

        $usr = new User();
        $usr->first_name = $request->first_name;
        $usr->last_name = $request->last_name;
        $usr->business_name = $request->business_name;
        $usr->b_name = $request->business_name;
        $usr->phone = $request->phone;
        $usr->email = $request->email;
        $usr->save();


        $get_code = random_int(1000, 9999);
        User::where('email', $request->email)->update(['sms_code' => $get_code]);
        $code = User::where('email', $request->email)->first()->sms_code;


        $data = array(
            'fromsender' => 'noreply@enkpay.com', 'EnkPay',
            'subject' => "Email Verification",
            'toreceiver' => $request->email,
            'code' => $code,
        );

        Mail::send('emails.email-verify', ["data1" => $data], function ($message) use ($data) {
            $message->from($data['fromsender']);
            $message->to($data['toreceiver']);
            $message->subject($data['subject']);
        });


        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['message'] = null;

        return view('auth.business-verify-email', $data);


    }


    public function charge_terminal_fee(request $request)
    {


    }


    public function charge_terminal_fee_weekly(request $request)
    {


    }


    public function charge_fees(request $request)
    {


        $pool_b = get_pool();


        if ($pool_b < 25) {

            $result = " Message========> Amount is less than NGN 10";
            send_notification($result);

        }

        if ($pool_b > 250025) {


            $erran_api_key = errand_api_key();

            $epkey = env('EPKEY');

            $curl = curl_init();
            $data = array(

                "amount" => 250000,
                "destinationAccountNumber" => "7932591343",
                "destinationBankCode" => "35",
                "destinationAccountName" => "Enkwave",

            );

            $post_data = json_encode($data);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.errandpay.com/epagentservice/api/v1/ApiFundTransfer',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $post_data,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $erran_api_key",
                    "EpKey: $epkey",
                    'Content-Type: application/json',
                ),
            ));

            $var = curl_exec($curl);

            curl_close($curl);

            $var = json_decode($var);


            $error = $var->error->message ?? null;
            $TransactionReference = $var->data->reference ?? null;
            $status = $var->code ?? null;


            if ($status == 200) {

                $result = " Message========> 250,000 has been sent out" . "\nRef ======> $TransactionReference";
                send_notification($result);
            }

            $result = " Message========> $error";
            send_notification($result);


        }

        if ($pool_b < 250020) {

            $amount = $pool_b - 25;

            $erran_api_key = errand_api_key();

            $epkey = env('EPKEY');

            $curl = curl_init();
            $data = array(

                "amount" => $amount,
                // "destinationAccountNumber" => "5401005443",
                // "destinationBankCode" => "101",
                "destinationAccountNumber" => "7932591343",
                "destinationBankCode" => "35",
                "destinationAccountName" => "Enkwave",

            );

            $post_data = json_encode($data);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.errandpay.com/epagentservice/api/v1/ApiFundTransfer',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $post_data,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $erran_api_key",
                    "EpKey: $epkey",
                    'Content-Type: application/json',
                ),
            ));

            $var = curl_exec($curl);

            curl_close($curl);

            $var = json_decode($var);


            $error = $var->error->message ?? null;
            $TransactionReference = $var->data->reference ?? null;
            $status = $var->code ?? null;


            if ($status == 200) {

                $result = " Message========> $amount has been sent out" . "\nRef ======> $TransactionReference";
                send_notification($result);
            }

            $result = " Message========> $error";
            send_notification($result);


        }

        return back()->with('message', 'Charge has been updated');

    }

    // $user1 = User::select('main_wallet')->where('id','203')->first()->main_wallet;
    // $user2 = User::select('main_wallet')->where('id','293369')->first()->main_wallet;
    // $user3 = User::select('main_wallet')->where('id','214')->first()->main_wallet;


    // $count1 = Transaction::where('user_id','203')->whereDate('created_at', Carbon::today())->count();
    // $count2 = Transaction::where('user_id','293369')->whereDate('created_at', Carbon::today())->count();
    // $count3 = Transaction::where('user_id','214')->whereDate('created_at', Carbon::today())->count();


    // if($count1 > 10 && $user1 > 20000){
    //     $deuc = 1000;
    //     User::where('id','203')->first()->decrement('main_wallet', $deuc);
    //     User::where('id','2')->first()->increment('main_wallet', $deuc);
    // }

    // if($count2 > 10 && $user2 > 20000){
    //     $deuc = 1000;
    //     User::where('id','293369')->first()->decrement('main_wallet', $deuc);
    //     User::where('id','2')->first()->increment('main_wallet', $deuc);
    // }


    // if($count3 > 10 && $user3 > 20000){
    //     $deuc = 1000;
    //     User::where('id','214')->first()->decrement('main_wallet', $deuc);
    //     User::where('id','2')->first()->increment('main_wallet', $deuc);
    // }


    public function pricing()
    {
        return view('front.pricing');
    }


    public function delete_trx(request $request)
    {

        $trx = PendingTransaction::where('ref_trans_id', $request->ref_trans_id)->delete();
        return back()->with('message', 'Transaction deleted successfully');
    }

    public function complete_trx(request $request)
    {

        $trx = PendingTransaction::where('ref_trans_id', $request->ref_trans_id)->first();
        $t = new Transaction();
        $t->user_id = $trx->user_id;
        $t->ref_trans_id = $trx->ref_trans_id;
        $t->transaction_type = "BankTransfer";
        $t->title = "Bank Transfer";
        $t->type = "InterBankTransfer";
        $t->main_type = "Transfer";
        $t->amount = $trx->amount;
        $t->debit = $trx->debit;
        $t->balance = $trx->receiver_name ?? $trx->balance;
        $t->receiver_account_no = $trx->receiver_account_no;
        $t->status = 1;
        $t->save();
        $trx = PendingTransaction::where('ref_trans_id', $request->ref_trans_id)->delete();
        return back()->with('message', 'Transaction completed successfully');

    }


    public function refund_trx(request $request)
    {

        $trx = PendingTransaction::where('ref_trans_id', $request->ref_trans_id)->first();
        User::where('id', $trx->user_id)->increment('main_wallet', $trx->debit);

        $t = new Transaction();
        $t->user_id = $trx->user_id;
        $t->ref_trans_id = $trx->ref_trans_id;
        $t->transaction_type = "BankTransfer";
        $t->title = "Bank Transfer";
        $t->type = "InterBankTransfer";
        $t->main_type = "Transfer";
        $t->note = "Refunded";
        $t->amount = $trx->amount;
        $t->debit = $trx->debit;
        $t->balance = $trx->receiver_name ?? $trx->balance;
        $t->receiver_account_no = $trx->receiver_account_no;
        $t->status = 3;
        $t->save();
        $trx = PendingTransaction::where('ref_trans_id', $request->ref_trans_id)->delete();
        return back()->with('message', 'Transaction Refunded successfully');

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
        $quantity = $pr->quantity;
        $quantity_status = $pr->quantity_status;
        $description = $pr->description;
        $shipping_status = $pr->shipping_status;
        $ref = $pr->ref_id;
        $id = $pr->id;
        $note_status = $pr->note_status;
        $status = $pr->status;
        $image = Productimage::where('product_id', $id)->first()->image;
        $user_id = $pr->user_id;


        return view('user.product.buy-now', compact('b_name', 'amount', 'image', 'user_id', 'status', 'note_status', 'name', 'quantity', 'quantity_status', 'description', 'shipping_status', 'ref', 'id'));


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


    public function check_email(request $request)
    {


        $email = User::where('email', $request->email)->first()->email ?? null;

        if ($email == null) {
            return back()->with('error', 'Email not found on our platform');
        } else {

            $email = $request->email;
            return view('auth.password-page', compact('email'));
        }


    }


    public function password_page(request $request)
    {

        $email = $request->email;
        return view('auth.password-page', compact('email'));


    }

    public function choose_type(request $request)
    {

        if ($request->user_type == 1) {
            return redirect('company-register');
        } else {

            return redirect('personal-register');

        }


    }

    public function personal_register(request $request)
    {

        return view('auth.personal-register');

    }

    public function company_register(request $request)
    {

        return view('auth.company-register');

    }

    public function vtpasscallback(request $request)
    {

        $message = json_encode($request->all());
        send_notification($message);

        return response()->with()->json([
            'response' => 'success'
        ]);


    }


    public function verify_email(request $request)
    {

        $usr = User::where('email', $request->email)->first();

        $data['first_name'] = $usr->first_name;
        $data['last_name'] = $usr->last_name;
        $data['email'] = $usr->email;
        $data['phone'] = $usr->phone;
        $data['message'] = " ";


        return view('auth.verify-email', $data);

    }


}
