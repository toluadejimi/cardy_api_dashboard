<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebhookController extends Controller
{
    public function webhook(request $request)
    {
        $parametersJson = json_encode($request->all());
        $message = 'V Card Log';
        $ip = $request->ip();

        $result = "Body========> " . $parametersJson . "\n\n Message========> " . $message . "\n\nIP========> " . $ip;
        send_notification($result);




        if ($request->event == 'cardholder_verification.successful') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $is_active = $request->data['is_active'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;



            $user = User::where('card_holder_id', $cardholder_id)->first();

            $message = "VCARD NOTIFICATION" . "|" . $user->first_name . "  " . $user->last_name . "has pass VCARD Verification";

            send_notification($message);
        }


        if ($request->event == 'cardholder_verification.failed') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $is_active = $request->data['is_active'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;
            $error_description = $request->data['error_description'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();

            $message = "VCARD ERROR" . "|" . $user->first_name . "  " . $user->last_name . "has failed VCARD Verification | " . $error_description;

            send_notification($message);
        }



        if ($request->event == 'card_creation_event.successful') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();

            $message = "VCARD NOTIFY" . "|" . $user->first_name . "  " . $user->last_name . "has successfully created a VCARD";

            send_notification($message);
        }


        if ($request->event == 'card_creation_event.failed') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;
            $reason = $request->data['reason'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();

            $message = "VCARD ERROR" . "|" . $user->first_name . "  " . $user->last_name . "VCARD Creation Failed |" . $reason;

            send_notification($message);
        }


        if ($request->event == 'card_credit_event.successful') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $amount = $request->data['amount'] ?? null;
            $transaction_reference = $request->data['transaction_reference'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $card_transaction_type = $request->data['card_transaction_type'] ?? null;


            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();


            if ($user->email !== null) {

                $data = array(
                    'fromsender' => 'noreply@enkpayapp.enkwave.com', 'EnkPay',
                    'subject' => "Credit Notification",
                    'toreceiver' => $user->email,
                    'amount' => $amount,
                    'first_name' => $user->first_name,
                );

                Mail::send('emails.vcard.credit', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });

                $message = "VCARD NOTIFY" . "|" . $user->first_name . "  " . $user->last_name . "credited vcard | USD" . $amount;

                send_notification($message);
            }
        }



        if ($request->event == 'card_debit_event.successful') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $amount = $request->data['amount'] ?? null;
            $transaction_reference = $request->data['transaction_reference'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $card_transaction_type = $request->data['card_transaction_type'] ?? null;


            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();


            if ($user->email !== null) {

                $data = array(
                    'fromsender' => 'noreply@enkpay.com', 'EnkPay',
                    'subject' => "Debit Notification",
                    'toreceiver' => $user->email,
                    'amount' => $amount,
                    'first_name' => $user->first_name,
                );

                Mail::send('emails.vcard.spend', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });

                $message = "VCARD NOTIFY" . " | " . $user->first_name . "  " . $user->last_name ."  vcard debited sucessfully | USD" . $amount;

                send_notification($message);
            }
        }


        if ($request->event == 'card_debit_event.declined') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $amount = $request->data['amount'] ?? null;
            $transaction_reference = $request->data['transaction_reference'] ?? null;
            $description = $request->data['description'] ?? null;
            $transaction_date = $request->data['transaction_date'] ?? null;
            $transaction_timestamp = $request->data['transaction_timestamp'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $decline_reason = $request->data['decline_reason'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();


            if ($user->email !== null) {


                $data = array(
                    'fromsender' => 'noreply@enkpayapp.enkwave.com', 'EnkPay',
                    'subject' => "Decline Notification",
                    'toreceiver' => $user->email,
                    'amount' => $amount,
                    'first_name' => $user->first_name,
                    'reason' => $decline_reason
                );

                Mail::send('emails.vcard.decline', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });

                $message = "VCARD ERROR" . "|" . $user->first_name . "  " . $user->last_name . " vcard  declined |" . $decline_reason;

                send_notification($message);
            }
        }




        if ($request->event == 'card_reversal_event.successful') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $amount = $request->data['amount'] ?? null;
            $transaction_reference = $request->data['transaction_reference'] ?? null;
            $description = $request->data['description'] ?? null;
            $transaction_date = $request->data['transaction_date'] ?? null;
            $transaction_timestamp = $request->data['transaction_timestamp'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();


            if ($user->email !== null) {


                $data = array(
                    'fromsender' => 'noreply@enkpayapp.enkwave.com', 'EnkPay',
                    'subject' => "Reversal Notification",
                    'toreceiver' => $user->email,
                    'amount' => $amount,
                    'first_name' => $user->first_name,
                );

                Mail::send('emails.vcard.reversal', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });

                $message = "VCARD NOTIFY" . "|" . $user->first_name . "  " . $user->last_name . " vcard  reversal | USD" .$amount;

                send_notification($message);
            }
        }


        if ($request->event == '3d_secure_otp_event.generated') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $amount = $request->data['amount'] ?? null;
            $otp = $request->data['otp'] ?? null;
            $merchant_name = $request->data['merchant_name'] ?? null;
            $last_four_digits = $request->data['last_four_digits'] ?? null;
            $transaction_reference = $request->data['transaction_reference'] ?? null;
            $description = $request->data['description'] ?? null;
            $transaction_date = $request->data['transaction_date'] ?? null;
            $transaction_timestamp = $request->data['transaction_timestamp'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();


            if ($user->email !== null) {


                $data = array(
                    'fromsender' => 'noreply@enkpayapp.enkwave.com', 'EnkPay',
                    'subject' => "OTP Notification",
                    'toreceiver' => $user->email,
                    'amount' => $amount,
                    'first_name' => $user->first_name,
                    'otp' => $otp
                );

                Mail::send('emails.vcard.otp', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });

                $message = "VCARD NOTIFY" . "|" . $user->first_name . "  " . $user->last_name . " has  OTP |" .$otp;

                send_notification($message);
            }
        }


        if ($request->event == 'card_maintenance_fee_debit_event.successful') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $amount = $request->data['amount'] ?? null;
            $transaction_reference = $request->data['transaction_reference'] ?? null;
            $card_transaction_type = $request->data['card_transaction_type'] ?? null;
            $transaction_date = $request->data['transaction_date'] ?? null;
            $transaction_timestamp = $request->data['transaction_timestamp'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();


            if ($user->email !== null) {


                $data = array(
                    'fromsender' => 'noreply@enkpayapp.enkwave.com', 'EnkPay',
                    'subject' => "Card Maintenance  Notification",
                    'toreceiver' => $user->email,
                    'amount' => $amount,
                    'first_name' => $user->first_name,
                );

                Mail::send('emails.vcard.maintenance', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });

                $message = "VCARD NOTIFY" . "|" . $user->first_name . "  " . $user->last_name . " Vcard  Maintenance Fee |" .$amount;

                send_notification($message);
            }
        }


        if ($request->event == 'card_blocked_due_to_insufficient_funds.activated') {


            $cardholder_id = $request->data['cardholder_id'] ?? null;
            $card_id = $request->data['card_id'] ?? null;
            $block_reason = $request->data['block_reason'] ?? null;
            $transaction_reference = $request->data['transaction_reference'] ?? null;
            $date = $request->data['date'] ?? null;
            $transaction_timestamp = $request->data['transaction_timestamp'] ?? null;
            $livemode = $request->data['livemode'] ?? null;
            $issuing_app_id = $request->data['issuing_app_id'] ?? null;


            $user = User::where('card_holder_id', $cardholder_id)->first();


            if ($user->email !== null) {


                $data = array(
                    'fromsender' => 'noreply@enkpayapp.enkwave.com', 'EnkPay',
                    'subject' => "Card Blocked  Notification",
                    'toreceiver' => $user->email,
                    'reason' => $block_reason,
                    'first_name' => $user->first_name,
                );

                Mail::send('emails.vcard.blocked', ["data1" => $data], function ($message) use ($data) {
                    $message->from($data['fromsender']);
                    $message->to($data['toreceiver']);
                    $message->subject($data['subject']);
                });

                $message = "VCARD ERROR" . "|" . $user->first_name . "  " . $user->last_name . " Vcard  Blocked |" .$block_reason;

                send_notification($message);
            }
        }


















    }
}
