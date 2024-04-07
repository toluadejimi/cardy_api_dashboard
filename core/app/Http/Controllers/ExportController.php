<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Terminal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Oldtransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public function export_transaction_view()
    {


        $data['transaction'] = Transaction::latest()->take('10')->get();
        $data['users'] = User::all();

        return view('export', $data);
    }



    public function export_trx(request $request)
    {

        $from = Carbon::createFromFormat('Y-m-d', $request->from)->format('m');
        $transaction_ck = Carbon::now()->format('m');



        if ($transaction_ck != $from) {

            $data['total_debit'] = Oldtransaction::where('user_id', $request->id)->where('status', 1)->sum('debit') ?? null;

            if ($request->serial_no != null) {

                $data['transaction'] = Oldtransaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                        'serial_no' => $request->serial_no,
                    ])->get();
            } else {


                $data['transaction'] = Oldtransaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                    ])->get();
            }


            $data['user']  = User::where('id', $request->id)->first() ?? null;
            $data['from'] = $request->from;
            $data['to'] = $request->to;

            $data['total_credit'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'status' => 1,
                ])->sum('credit');

            $data['total_debit'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'status' => 1,
                ])->sum('debit');


            $data['total_cash_out'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'transaction_type' => 'PURCHASE',
                ])->count();

            $data['total_purchace'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'transaction_type' => 'CASHOUT',
                ])->count();


            $data['balance'] = User::where('id', $request->id)->first()->main_wallet ?? 0;
            $data['serial_no'] = $request->serial_no ?? null;
            $data['tranaction_count'] = $data['total_cash_out'] + $data['total_purchace'];

            return view('export-trx', $data);
        } else {


            if ($request->serial_no != null) {

                $data['transaction'] = Transaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                        'serial_no' => $request->serial_no,
                    ])->get();
            } else {


                $data['transaction'] = Transaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                    ])->get();
            }


            $data['user']  = User::where('id', $request->id)->first() ?? null;
            $data['from'] = $request->from;
            $data['to'] = $request->to;

            $data['total_credit'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'status' => 1,
                ])->sum('credit');

            $data['total_debit'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'status' => 1,
                ])->sum('debit');


            $data['total_cash_out'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'transaction_type' => 'PURCHASE',
                    'serial_no' => $request->serial_no,

                ])->count();

            $data['total_purchace'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'transaction_type' => 'CASHOUT',
                    'serial_no' => $request->serial_no,

                ])->count();


            $data['balance'] = User::where('id', $request->id)->first()->main_wallet ?? 0;
            $data['serial_no'] = $request->serial_no ?? null;
            $data['tranaction_count'] = $data['total_cash_out'] + $data['total_purchace'];
            $data['balance'] = User::where('id', $request->id)->first()->main_wallet ?? 0;


            return view('export-trx', $data);
        }
    }


    public function download_pdf(request $request)
    {

        if($request->from == null && $request->to == null){

            return response()->json([
                'status' => false,
                'message' => "Please specify date from and date to"
            ], 422);

        }

        if($request->id == null){
            return response()->json([
                'status' => false,
                'message' => "User ID is required"
            ], 422);

        }

        $from = Carbon::createFromFormat('Y-m-d', $request->from)->format('m');
        $transaction_ck = Carbon::now()->format('m');


        if ($transaction_ck != $from) {


            if ($request->serial_no != null) {


                $data['transaction'] = Oldtransaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                        'serial_no' => $request->serial_no,
                    ])->get();
            } else {


                $data['transaction'] = Oldtransaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                    ])->get();
            }





            $data['user']  = User::where('id', $request->id)->first();
            $id = $data['user']->id;
            $data['from'] = $request->from;
            $data['to'] = $request->to;

            $from = $request->from;
            $to = $request->to;
            $time = date('ymis');



            $data['total_credit'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'status' => 1,
                ])->sum('credit');

            $data['total_debit'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'status' => 1,
                ])->sum('debit');


            $data['total_cash_out'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'transaction_type' => 'PURCHASE',
                    'serial_no' => $request->serial_no,

                ])->count();

            $data['total_purchace'] = Oldtransaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                ->where([
                    'user_id' => $request->id,
                    'transaction_type' => 'CASHOUT',
                    'serial_no' => $request->serial_no,

                ])->count();


            $data['balance'] = User::where('id', $request->id)->first()->main_wallet ?? 0;
            $data['serial_no'] = $request->serial_no ?? null;
            $data['tranaction_count'] = $data['total_cash_out'] + $data['total_purchace'];
            $data['balance'] = User::where('id', $request->id)->first()->main_wallet ?? 0;
            $first_name = User::where('id', $request->id)->first()->first_name;
            $email = User::where('id', $request->id)->first()->email;


            $pdf = Pdf::loadView('pdf', $data);
            $content = $pdf->download()->getOriginalContent();
            Storage::put("/asset/$id/$from-$to/$time" . "statement.pdf", $content);
            $url = url('') . "/core/storage/app/asset/$id/$from-$to/$time" . "statement.pdf";




            $data["email"] = $email;
            $data["title"] = "ENKPAY ACCOUNT STATEMENT";
            $data["from"] = $from;
            $data["to"] = $to;
            $data["first_name"] = $first_name;
            $data["url"] = $url;


            $pdf = PDF::loadView('pdf', $data);

            $file = "/core/storage/app/asset/$id/$from-$to/$time" . "statement.pdf";

            Mail::send('emails.statement', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["email"])
                    ->subject('Account Statement', $data)
                    ->attachData($pdf->output(), "Statement.pdf");
            });

            return response()->json([
                'status' => true,
                'message' => "Transaction Statement has been successfully sent to your email."
            ], 200);

            //return $pdf->stream();



            //return view('export-trx', $data)->with('message', 'Statement sent successfully');




        } else {
            if ($request->serial_no != null) {


                $data['transaction'] = Transaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                        'serial_no' => $request->serial_no,
                    ])->get();
            } else {


                $data['transaction'] = Transaction::latest()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
                    ->where([
                        'user_id' => $request->id,
                        'status' => 1,
                    ])->get();
            }


            $data['user']  = User::where('id', $request->id)->first();
            $id = $data['user']->id;
            $data['from'] = $request->from;
            $data['to'] = $request->to;

            $from = $request->from;
            $to = $request->to;
            $time = date('ymis');


            $data['total_credit'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
            ->where([
                'user_id' => $request->id,
                'status' => 1,
            ])->sum('credit');

        $data['total_debit'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
            ->where([
                'user_id' => $request->id,
                'status' => 1,
            ])->sum('debit');


        $data['total_cash_out'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
            ->where([
                'user_id' => $request->id,
                'transaction_type' => 'PURCHASE',
                'serial_no' => $request->serial_no,

            ])->count();

        $data['total_purchace'] = Transaction::whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59'])
            ->where([
                'user_id' => $request->id,
                'transaction_type' => 'CASHOUT',
                'serial_no' => $request->serial_no,

            ])->count();


            $data['balance'] = User::where('id', $request->id)->first()->main_wallet ?? 0;
            $data['serial_no'] = $request->serial_no ?? null;
            $data['tranaction_count'] = $data['total_cash_out'] + $data['total_purchace'];
            $data['balance'] = User::where('id', $request->id)->first()->main_wallet ?? 0;
            $first_name = User::where('id', $request->id)->first()->first_name;
            $email = User::where('id', $request->id)->first()->email;



            $pdf = Pdf::loadView('pdf', $data);
            $content = $pdf->download()->getOriginalContent();
            Storage::put("/asset/$id/$from-$to/$time" . "statement.pdf", $content);
            $url = url('') . "/core/storage/app/asset/$id/$from-$to/$time" . "statement.pdf";




            $data["email"] = $email;
            $data["title"] = "ENKPAY ACCOUNT STATEMENT";
            $data["from"] = $from;
            $data["to"] = $to;
            $data["first_name"] = $first_name;
            $data["url"] = $url;


            $pdf = PDF::loadView('pdf', $data);

            $file = "/core/storage/app/asset/$id/$from-$to/$time" . "statement.pdf";

            Mail::send('emails.statement', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["email"])
                    ->subject('Account Statement', $data)
                    ->attachData($pdf->output(), "Statement.pdf");
            });



                return response()->json([
                    'status' => true,
                    'message' => "Transaction Statement has been successfully sent to your email."
                ], 200);


            //return $pdf->stream();


            //return view('export-trx', $data)->with('message', 'Statement sent successfully');
        }
    }
}
