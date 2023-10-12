<?php

use App\Models\Setting;
use App\Models\VirtualAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;
use App\Models\Logo;
use App\Models\Paymentlink;
use App\Models\Transactions;
use App\Models\Currency;
use App\Models\User;
use App\Models\Plans;
use App\Models\Subscribers;
use App\Models\Invoice;
use App\Models\Exttransfer;
use App\Models\Merchant;
use App\Models\Requests;
use App\Models\Transfer;
use App\Models\Withdraw;
use App\Models\Bank;
use App\Models\Product;
use App\Models\Order;
use App\Models\Subaccounts;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Curl\Curl;
use Illuminate\Support\Facades\Mail;


function send_email($to, $name, $subject, $message)
{


    $set = Settings::first();
    $mlogo = Logo::first();
    $from = env('MAIL_USERNAME');
    $site = $set->site_name;
    $phone = $set->phone;
    $details = $set->whatsapp_contact;
    $email = env('MAIL_USERNAME');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $adv = url('/') . '/asset/' . $mlogo->adv;
    $data = array('adv' => $adv, 'name' => $name, 'subject' => $subject, 'content' => $message, 'website' => $set->site_name, 'phone' => $phone, 'details' => $details, 'email' => $email, 'logo' => $logo);
    Mail::send(['html' => 'emails/mail'], $data, function ($message) use ($name, $to, $subject, $from, $site) {
        $message->to($to, $name);
        $message->subject($subject);
        $message->from($from, $site);
    });
}

function send_paymentlinkreceipt($ref, $type, $token)
{
    $link = Paymentlink::whereref_id($ref)->first();
    $dd = Transactions::whereref_id($token)->first();
    $receiver = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
    $from = env('MAIL_USERNAME');
    $receiver_email = $receiver->email;
    if ($dd->sender_id != null) {
        $bb = User::whereid($dd->sender_id)->first();
        $sender_email = $bb->email;
    } else {
        $sender_email = $dd->email;
    }
    $site = $set->site_name;
    $details = $set->site_desc;
    $method = $type;
    $reference = $token;
    $payment_link = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$dd->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$dd->charge, 2, '.', '');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'New successful transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver->business_name . ' was successful';

    if ($dd->sender_id == null) {
        $sender_name = $dd->first_name . ' ' . $dd->last_name;
        $receiver_text = 'A payment from ' . $dd->first_name . ' ' . $dd->last_name . ' was successfully received';
    } else {
        $xx = User::whereid($dd->sender_id)->first();
        $sender_name = $xx->first_name . ' ' . $xx->last_name;
        $receiver_text = 'A payment from ' . $sender_name . ' was successfully received';
    }

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'details' => $details,
        'amount' => $amount,
        'charges' => $charge,
        'method' => $method,
        'reference' => $reference,
        'payment_link' => $payment_link,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/payment_links/rpmail'], $data, function ($r_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/payment_links/spmail'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function send_productlinkreceipt($ref, $type, $token)
{
    $link = Product::whereref_id($ref)->first();
    $dd = Order::whereref_id($token)->first();
    $receiver = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
    $from = env('MAIL_USERNAME');
    $receiver_email = $receiver->email;
    $sender_email = $dd->email;
    $site = $set->site_name;
    $details = $set->site_desc;
    $method = $type;
    $reference = $token;
    $payment_link = $link->ref_id;
    $quantity = $dd->quantity;
    $address = $dd->address;
    $country = $dd->country;
    $state = $dd->state;
    $town = $dd->town;
    $phone = $dd->phone;
    $email = $dd->email;
    if ($dd->shipping_fee == null) {
        $shipping_fee = ' - ';
    } else {
        $shipping_fee = $currency->name . ' ' . number_format((float)$dd->shipping_fee, 2, '.', '');
    }

    $total = $currency->name . ' ' . number_format((float)$dd->total, 2, '.', '');
    $amount = $currency->name . ' ' . number_format((float)$dd->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$dd->charge, 2, '.', '');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'New successful transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver->business_name . ' was successful';
    $sender_name = $dd->first_name . ' ' . $dd->last_name;
    $receiver_text = 'A payment from ' . $dd->first_name . ' ' . $dd->last_name . ' was successfully received';


    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'details' => $details,
        'amount' => $amount,
        'charges' => $charge,
        'total' => $total,
        'quantity' => $quantity,
        'address' => $address,
        'country' => $country,
        'state' => $state,
        'town' => $town,
        'phone' => $phone,
        'email' => $email,
        'shipping_fee' => $shipping_fee,
        'method' => $method,
        'reference' => $reference,
        'payment_link' => $payment_link,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/product/rpmail'], $data, function ($r_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/product/spmail'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function send_requestreceipt($ref)
{
    $link = Requests::whereref_id($ref)->first();
    $receiver = User::whereid($link->user_id)->first();
    $dd = User::whereemail($link->email)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
    $from = env('MAIL_USERNAME');
    $receiver_email = $receiver->email;
    $sender_email = $dd->email;
    $site = $set->site_name;
    $reference = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$link->charge, 2, '.', '');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'New successful transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver->business_name . ' was successful';

    if ($dd->sender_id == null) {
        $sender_name = $dd->first_name . ' ' . $dd->last_name;
        $receiver_text = 'A payment from ' . $dd->first_name . ' ' . $dd->last_name . ' was successfully received';
    } else {
        $xx = User::whereid($dd->sender_id)->first();
        $sender_name = $xx->first_name . ' ' . $xx->last_name;
        $receiver_text = 'A payment from ' . $sender_name . ' was successfully received';
    }

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'amount' => $amount,
        'charges' => $charge,
        'reference' => $reference,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/request/rpmail'], $data, function ($r_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/request/spmail'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function send_transferreceipt($ref)
{
    $link = Transfer::whereref_id($ref)->first();
    $receiver = User::whereid($link->receiver_id)->first();
    $dd = User::whereid($link->sender_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
    $from = env('MAIL_USERNAME');
    $receiver_email = $receiver->email;
    $sender_email = $dd->email;
    $site = $set->site_name;
    $reference = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$link->charge, 2, '.', '');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'New successful transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver->business_name . ' was successful';

    if ($dd->sender_id == null) {
        $sender_name = $dd->first_name . ' ' . $dd->last_name;
        $receiver_text = 'A payment from ' . $dd->first_name . ' ' . $dd->last_name . ' was successfully received';
    } else {
        $xx = User::whereid($dd->sender_id)->first();
        $sender_name = $xx->first_name . ' ' . $xx->last_name;
        $receiver_text = 'A payment from ' . $sender_name . ' was successfully received';
    }

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'amount' => $amount,
        'charges' => $charge,
        'reference' => $reference,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/transfer/rpmail'], $data, function ($r_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/transfer/spmail'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function send_ntransferreceipt($ref)
{
    $link = Transfer::whereref_id($ref)->first();
    $dd = User::whereid($link->sender_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $from = env('MAIL_USERNAME');
    $receiver_email = $link->temp;
    $sender_email = $dd->email;
    $site = $set->site_name;
    $reference = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$link->charge, 2, '.', '');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'Confirm transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver_email . ' was successful, since ' . $link->temp . ' is not registered, user will have to register with that email address to claim funds, funds will be returned within 5 days if money is not confirmed by recipient';
    $sender_name = $dd->first_name . ' ' . $dd->last_name;
    $receiver_text = 'You are receiving this email because ' . $sender_name . ', sent ' . $amount . ' to this email, but no account was found with this email, click button link to register with this email and confirm transaction, <a href="' . route('register') . '">Register</a>';

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'amount' => $amount,
        'charges' => $charge,
        'reference' => $reference,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/transfer/nrpmail'], $data, function ($r_message) use ($receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/transfer/nspmail'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function send_invoicereceipt($ref, $type, $token)
{
    $link = Invoice::whereref_id($ref)->first();
    $dd = Transactions::whereref_id($token)->first();
    $receiver = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
    $from = env('MAIL_USERNAME');
    $receiver_email = $receiver->email;
    if ($dd->sender_id != null) {
        $bb = User::whereid($dd->sender_id)->first();
        $sender_email = $bb->email;
    } else {
        $sender_email = $dd->email;
    }
    $site = $set->site_name;
    $details = $set->site_desc;
    $method = $type;
    $reference = $token;
    $payment_link = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$dd->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$dd->charge, 2, '.', '');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'New successful transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver->business_name . ' was successful';

    if ($dd->sender_id == null) {
        $sender_name = $dd->first_name . ' ' . $dd->last_name;
        $receiver_text = 'A payment from ' . $dd->first_name . ' ' . $dd->last_name . ' was successfully received';
    } else {
        $xx = User::whereid($dd->sender_id)->first();
        $sender_name = $xx->first_name . ' ' . $xx->last_name;
        $receiver_text = 'A payment from ' . $sender_name . ' was successfully received';
    }

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'details' => $details,
        'amount' => $amount,
        'charges' => $charge,
        'method' => $method,
        'reference' => $reference,
        'payment_link' => $payment_link,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/invoice/receiver/rpmail'], $data, function ($r_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/invoice/sender/spmail'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function send_merchantreceipt($ref, $type, $token)
{
    $link = Merchant::wheremerchant_key($ref)->first();
    $dd = Exttransfer::wherereference($token)->first();
    $receiver = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
    $from = env('MAIL_USERNAME');
    if ($link->email != null) {
        $receiver_email = $link->email;
    } else {
        $receiver_email = $receiver->email;
    }
    if ($dd->sender_id != null) {
        $bb = User::whereid($dd->user_id)->first();
        $sender_email = $bb->email;
    } else {
        $sender_email = $dd->email;
    }
    $site = $set->site_name;
    $details = $set->site_desc;
    $method = $type;
    $reference = $token;
    $payment_link = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$dd->amount * $dd->quantity, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$dd->charge, 2, '.', '');
    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'New successful transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver->business_name . ' was successful';

    if ($dd->sender_id == null) {
        $sender_name = $dd->first_name . ' ' . $dd->last_name;
        $receiver_text = 'A payment from ' . $dd->first_name . ' ' . $dd->last_name . ' was successfully received';
    } else {
        $xx = User::whereid($dd->user_id)->first();
        $sender_name = $xx->first_name . ' ' . $xx->last_name;
        $receiver_text = 'A payment from ' . $sender_name . ' was successfully received';
    }

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'details' => $details,
        'amount' => $amount,
        'charges' => $charge,
        'method' => $method,
        'reference' => $reference,
        'payment_link' => $payment_link,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/merchant/receiver/rpmail'], $data, function ($r_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/merchant/sender/spmail'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function sub_check()
{
    $set = Settings::first();
    if ($set->xperiod == null) {
    } elseif ($set->xperiod == 1) {
        echo redirect()->route('ipn.boompay');
    }
}

function file_write()
{
    $path = url('/') . '/asset/dashboard/js/check.json';
    $data = str_random(4) . '-' . str_random(4) . '-' . str_random(4) . '-' . str_random(4);
    file_put_contents($path, $data);
    $set = Settings::first();
    $set->lock_code = $data;
    $set->save();
}

function new_subscription($ref, $type, $token)
{
    $link = Plans::whereref_id($ref)->first();
    $dd = Subscribers::whereref_id($token)->first();
    $bb = User::whereid($dd->user_id)->first();
    $receiver = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $sender_name = $bb->first_name . ' ' . $bb->last_name;
    $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
    $from = env('MAIL_USERNAME');
    $receiver_email = $receiver->email;
    $sender_email = $bb->email;
    $site = $set->site_name;
    $details = $set->site_desc;
    $method = $type;
    $reference = $token;
    $payment_link = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$dd->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$dd->charge, 2, '.', '');
    $next = $dd->expiring_date;
    $plan_name = $link->name;

    if ($dd->times > 0 && $dd->status == 1) {
        $renewal = 'Yes';
    } else {
        $renewal = 'No';
    }

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'New successful transaction';
    $sender_subject = 'Payment was successful';
    $sender_text = 'Payment to ' . $receiver->business_name . ' was successful';
    $receiver_text = 'A payment from ' . $bb->first_name . ' ' . $bb->last_name . ' was successfully received';

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'receiver_text' => $receiver_text,
        'details' => $details,
        'amount' => $amount,
        'charges' => $charge,
        'next' => $next,
        'plan_name' => $plan_name,
        'renewal' => $renewal,
        'method' => $method,
        'reference' => $reference,
        'payment_link' => $payment_link,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/subscription/receiver/new'], $data, function ($r_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
    Mail::send(['html' => 'emails/subscription/sender/new'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function send_invoice($ref)
{
    $link = Invoice::whereref_id($ref)->first();
    $link->sent = 1;
    $link->save();
    $user = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $from = env('MAIL_USERNAME');
    $sender_email = $link->email;
    $site = $set->site_name;
    $payment_link = $link->ref_id;
    $quantity = $link->quantity;
    $r_d = $link->discount;
    $r_t = $link->tax;
    $total = $currency->name . ' ' . number_format((float)$link->total, 2, '.', '');
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');
    $discount = $currency->name . ' ' . number_format((float)$link->amount * $link->quantity * $r_d / 100, 2, '.', '');
    $tax = $currency->name . ' ' . number_format((float)$link->amount * $link->quantity * $r_t / 100, 2, '.', '');

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $sender_subject = 'Payment for Invoice #' . $link->invoice_no;
    $sender_text = 'Invoice for ' . $link->item . ' will be due by ' . date("h:i:A j, M Y", strtotime($link->due_date));

    $data = array(
        'created' => $link->created_at,
        'sender_subject' => $sender_subject,
        'sender_name' => $site,
        'receiver_name' => $user->first_name . ' ' . $user->last_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'payment_link' => $payment_link,
        'quantity' => $quantity,
        'r_d' => $r_d,
        'r_t' => $r_t,
        'total' => $total,
        'amount' => $amount,
        'discount' => $discount,
        'tax' => $tax,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/invoice/sender/invoice'], $data, function ($s_message) use ($sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email)->subject($sender_subject)->from($from, $site);
    });
}

function send_transferrefund($ref)
{
    $link = Transfer::whereref_id($ref)->first();
    $user = User::whereid($link->sender_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $from = env('MAIL_USERNAME');
    $sender_email = $user->email;
    $sender_name = $user->first_name . ' ' . $user->last_name;
    $site = $set->site_name;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $sender_subject = 'Refund for #' . $link->ref_id;
    $sender_text = 'Account has been credited with ' . $amount . '.  ' . $link->temp . ' failed to claim transfer request within the last 5 days.';

    $data = array(
        'created' => $link->created_at,
        'sender_subject' => $sender_subject,
        'sender_name' => $user->first_name . ' ' . $user->last_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'reference' => $payment_link,
        'amount' => $amount,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/transfer/refund'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function new_withdraw($ref)
{
    $link = Withdraw::wherereference($ref)->first();
    $bank = Bank::whereid($link->bank_id)->first();
    $user = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $from = env('MAIL_USERNAME');
    $sender_email = $user->email;
    $sender_name = $user->first_name . ' ' . $user->last_name;
    $site = $set->site_name;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$link->charge, 2, '.', '');

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $sender_subject = 'Withdraw Request is currently been Processed';
    $sender_text = 'Withdraw Request has been booked. Thanks for working with us.';

    $data = array(
        'created' => $link->created_at,
        'sender_subject' => $sender_subject,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'reference' => $ref,
        'amount' => $amount,
        'charge' => $charge,
        'bank' => $bank->name,
        'acct_name' => $bank->acct_name,
        'acct_no' => $bank->acct_no,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/withdraw/new'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

function new_subwithdraw($ref)
{
    $link = Withdraw::wheresecret($ref)->first();
    $bank = Subaccounts::whereid($link->sub_id)->first();
    $real = Banksupported::whereid($bank->bank_id)->first();
    $user = Subaccounts::whereid($link->sub_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $from = env('MAIL_USERNAME');
    $sender_email = $user->email;
    $sender_name = $user->name;
    $site = $set->site_name;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $sender_subject = 'Payout is currently been Processed';
    $sender_text = 'You have been added to a sub account payout. Thanks for working with us.';

    $data = array(
        'created' => $link->created_at,
        'sender_subject' => $sender_subject,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'reference' => $ref,
        'amount' => $amount,
        'bank' => $real->name,
        'acct_name' => $bank->acct_name,
        'acct_no' => $bank->acct_no,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/withdraw/newsub'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}
function send_withdraw($ref, $status)
{
    $link = Withdraw::whereid($ref)->first();
    $bank = Bank::whereid($link->bank_id)->first();
    $user = User::whereid($link->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    if ($status == 'approved') {
        $charge = $currency->name . ' ' . number_format((float)$link->charge, 2, '.', '');
    } else {
        $charge = ' - ';
    }
    $from = env('MAIL_USERNAME');
    $receiver_email = $user->email;
    $receiver_name = $user->first_name . ' ' . $user->last_name;
    $site = $set->site_name;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $receiver_subject = 'We sent you money';
    $receiver_text = 'Withdrawal request of ' . $amount . ' has been paid out. Thanks for working with us.';

    $data = array(
        'created' => $link->created_at,
        'receiver_subject' => $receiver_subject,
        'receiver_name' => $receiver_name,
        'website' => $set->site_name,
        'receiver_text' => $receiver_text,
        'reference' => $ref,
        'amount' => $amount,
        'charge' => $charge,
        'bank' => $bank->name,
        'acct_name' => $bank->acct_name,
        'acct_no' => $bank->acct_no,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/withdraw/send'], $data, function ($s_message) use ($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $s_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);
    });
}

function send_request($ref)
{
    $link = Requests::whereref_id($ref)->first();
    $user = User::whereid($link->user_id)->first();
    $to = User::whereemail($link->email)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $from = env('MAIL_USERNAME');
    $sender_email = $user->email;
    $receiver_email = $to->email;
    $site = $set->site_name;
    $payment_link = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$link->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$link->charge, 2, '.', '');

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $sender_subject = 'Money request #' . $ref;
    $sender_text = $user->first_name . ' ' . $user->last_name . ' just sent a Money request';

    $data = array(
        'created' => $link->created_at,
        'sender_subject' => $sender_subject,
        'sender_name' => $user->first_name . ' ' . $user->last_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'sender_email' => $sender_email,
        'receiver_email' => $receiver_email,
        'payment_link' => $payment_link,
        'amount' => $amount,
        'charge' => $charge,
        'reference' => $ref,
        'confirm' => $link->confirm,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/request/new'], $data, function ($s_message) use ($receiver_email, $sender_subject, $from, $site) {
        $s_message->to($receiver_email)->subject($sender_subject)->from($from, $site);
    });
}

function insufficient_balance($ref, $type, $token)
{
    $link = Plans::whereref_id($ref)->first();
    $dd = Subscribers::whereref_id($token)->first();
    $dd->notify = 0;
    $dd->save();
    $bb = User::whereid($dd->user_id)->first();
    $currency = Currency::whereStatus(1)->first();
    $set = Settings::first();
    $mlogo = Logo::first();

    $sender_name = $bb->first_name . ' ' . $bb->last_name;
    $from = env('MAIL_USERNAME');
    $sender_email = $bb->email;
    $site = $set->site_name;
    $method = $type;
    $reference = $token;
    $payment_link = $link->ref_id;
    $amount = $currency->name . ' ' . number_format((float)$dd->amount, 2, '.', '');
    $charge = $currency->name . ' ' . number_format((float)$dd->charge, 2, '.', '');
    $plan_name = $link->name;

    if ($dd->times > 0 && $dd->status == 1) {
        $renewal = 'Yes';
    } else {
        $renewal = 'No';
    }

    $logo = url('/') . '/asset/' . $mlogo->image_link;
    $sender_subject = 'Could not renew subscription';
    $sender_text = 'Payment for ' . $plan_name . ' was unsuccessful due to insufficient balance';

    $data = array(
        'created' => $dd->created_at,
        'sender_subject' => $sender_subject,
        'sender_name' => $sender_name,
        'website' => $set->site_name,
        'sender_text' => $sender_text,
        'amount' => $amount,
        'plan_name' => $plan_name,
        'renewal' => $renewal,
        'method' => $method,
        'reference' => $reference,
        'payment_link' => $payment_link,
        'logo' => $logo
    );
    Mail::send(['html' => 'emails/subscription/sender/failed'], $data, function ($s_message) use ($sender_name, $sender_email, $sender_subject, $from, $site) {
        $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);
    });
}

if (!function_exists('user_ip')) {
    function user_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}


if (!function_exists('castrotime')) {

    function castrotime($timestamp)
    {
        $datetime1 = new DateTime("now");
        $datetime2 = date_create($timestamp);
        $diff = date_diff($datetime1, $datetime2);
        $timemsg = '';
        if ($diff->y > 0) {
            $timemsg = $diff->y * 12;
        } else if ($diff->m > 0) {
            $timemsg = $diff->m * 30;
        } else if ($diff->d > 0) {
            $timemsg = $diff->d * 1;
        }
        if ($timemsg == "")
            $timemsg = 0;
        else
            $timemsg = $timemsg;

        return $timemsg;
    }
}

if (!function_exists('timeAgo')) {
    function timeAgo($timestamp)
    {
        //$time_now = mktime(date('h')+0,date('i')+30,date('s'));
        $datetime1 = new DateTime("now");
        $datetime2 = date_create($timestamp);
        $diff = date_diff($datetime1, $datetime2);
        $timemsg = '';
        if ($diff->y > 0) {
            $timemsg = $diff->y . ' year' . ($diff->y > 1 ? "s" : '');
        } else if ($diff->m > 0) {
            $timemsg = $diff->m . ' month' . ($diff->m > 1 ? "s" : '');
        } else if ($diff->d > 0) {
            $timemsg = $diff->d . ' day' . ($diff->d > 1 ? "s" : '');
        } else if ($diff->h > 0) {
            $timemsg = $diff->h . ' hour' . ($diff->h > 1 ? "s" : '');
        } else if ($diff->i > 0) {
            $timemsg = $diff->i . ' minute' . ($diff->i > 1 ? "s" : '');
        } else if ($diff->s > 0) {
            $timemsg = $diff->s . ' second' . ($diff->s > 1 ? "s" : '');
        }
        if ($timemsg == "")
            $timemsg = "Just now";
        else
            $timemsg = $timemsg . ' ago';

        return $timemsg;
    }
}


function convertFloat($floatAsString)
{
    $norm = strval(floatval($floatAsString));

    if (($e = strrchr($norm, 'E')) === false) {
        return $norm;
    }

    return number_format($norm, -intval(substr($e, 1)));
}


if (!function_exists('convertCurrency')) {

    function convertCurrency($amount, $from_currency, $to_currency)
    {
        $gnl = Settings::first();
        $apikey = $gnl->api;
        $from_Currency = urlencode($from_currency);
        $to_Currency = urlencode($to_currency);
        $query =  "{$from_Currency}_{$to_Currency}";
        // change to the free URL if you're using the free version
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);
        $val = floatval($obj["$query"]);
        $total = $val * $amount;
        return $total;
    }
}


if (!function_exists('boomtime')) {
    function boomtime($timestamp)
    {
        //$time_now = mktime(date('h')+0,date('i')+30,date('s'));
        $datetime1 = new DateTime("now");
        $datetime2 = date_create($timestamp);
        $diff = date_diff($datetime1, $datetime2);
        $timemsg = '';
        if ($diff->h > 0) {
            $timemsg = $diff->h * 1;
        }
        if ($timemsg == "")
            $timemsg = 0;
        else
            $timemsg = $timemsg;

        return $timemsg;
    }
}



if (!function_exists('errand_api_key')) {

    function errand_api_key()
    {

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.errandpay.com/epagentauth/api/v1/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
          "loginToken": "info@enkwave.com",
          "password": "Tolulope2580@"
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $var = curl_exec($curl);
            curl_close($curl);


            $var = json_decode($var);



            $response1 = $var->data->accessToken ?? null;
            $exp = $var->data->expiresIn ?? null;

            $respose2 = 'ERA 001 Please try again later';
            $response3 =  $var->error->message ?? null;



            if ($var->code == 200) {
                return $response1;
            }

            if ($var->code == 400) {
                return $response3;
            }

            return $respose2;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}


// if (!function_exists('get_pool')) {

//     function get_pool()
//     {

//         try {

//             $api = errand_api_key();
//             $epKey = env('EPKEY');

//             $curl = curl_init();

//             curl_setopt_array($curl, array(
//                 CURLOPT_URL => 'https://api.errandpay.com/epagentservice/api/v1/ApiGetBalance',
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => '',
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => 'GET',
//                 CURLOPT_HTTPHEADER => array(
//                     'Accept: application/json',
//                     'Content-Type: application/json',
//                     "epKey: $epKey",
//                     "Authorization: Bearer $api",
//                 ),
//             ));

//             $var = curl_exec($curl);


//             curl_close($curl);

//             $var = json_decode($var);


//             $code = $var->code ?? null;

//             if ($code == null) {

//                 return "Network Issue";
//             }

//             if ($var->code == 200) {
//                 return number_format($var->data->balance, 2);
//             }
//         } catch (\Exception $th) {
//             return $th->getMessage();
//         }
//     }
// }




if (!function_exists('get_banks')) {

    function get_banks()
    {


        $errand_key = errand_api_key();

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.errandpay.com/epagentservice/api/v1/ApiGetBanks',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $errand_key",
                ),
            ));

            $var = curl_exec($curl);

            curl_close($curl);
            $var = json_decode($var);

            $result = $var->data ?? null;

            $status = $var->code ?? null;

            if ($status == 200) {

                return $var->data;
            }


            return "Network Error";
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }


    if (!function_exists('send_notification')) {

        function send_notification($message)
        {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.telegram.org/bot6140179825:AAGfAmHK6JQTLegsdpnaklnhBZ4qA1m2c64/sendMessage?chat_id=1316552414',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => "1316552414",
                    'text' => $message,

                ),
                CURLOPT_HTTPHEADER => array(),
            ));

            $var = curl_exec($curl);
            curl_close($curl);

            $var = json_decode($var);
        }
    }



    if (!function_exists('errand_id')) {

        function errand_id()
        {

            try {

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.errandpay.com/epagentauth/api/v1/login',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
              "loginToken": "info@enkwave.com",
              "password": "Tolulope2580@"
            }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $var = curl_exec($curl);
                curl_close($curl);


                $var = json_decode($var);



                $response1 = $var->data->id ?? null;

                $respose2 = 'ERA 001 Please try again later';
                $response3 =  $var->error->message ?? null;



                if ($var->code == 200) {
                    return $response1;
                }

                if ($var->code == 400) {
                    return $response3;
                }

                return $respose2;
            } catch (\Exception $th) {
                return $th->getMessage();
            }
        }
    }


    // if (!function_exists('create_vfd_account')) {

    //     function create_vfd_account($first_name, $last_name, $user_id, $b_name, $cphone, $bvn, $b_phone)
    //     {


    //         $cv =  VirtualAccount::where('user_id', Auth::id())->first() ?? null;

    //         if($cv != null){
    //             return 200;
    //         }

    //         if ($cv == null) {


    //             // $set = Setting::select('*')->first();
    //             // if ($set->bank == 'vfd') {

    //                 //create VFD
    //                 $errand_key = errand_api_key();
    //                 $errand_user_id = errand_id();

    //                 if ($b_name == null) {
    //                     $name = $first_name . " " . $last_name;
    //                 } else {
    //                     $name = $b_name;
    //                 }

    //                 if ($b_phone == null) {
    //                     $phone = $cphone;
    //                 } else {
    //                     $phone = $b_phone;
    //                 }

    //                 $curl = curl_init();
    //                 $data = array(

    //                     "userId" => $errand_user_id,
    //                     "customerBvn" => $bvn,
    //                     "phoneNumber" => "234" . $phone,
    //                     "customerName" => $name,

    //                 );

    //                 $databody = json_encode($data);

    //                 curl_setopt_array($curl, array(
    //                     CURLOPT_URL => 'https://api.errandpay.com/epagentservice/api/v1/CreateVirtualAccount',
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => '',
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 0,
    //                     CURLOPT_FOLLOWLOCATION => true,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => 'POST',
    //                     CURLOPT_POSTFIELDS => $databody,
    //                     CURLOPT_HTTPHEADER => array(
    //                         'Content-Type: application/json',
    //                         'Accept: application/json',
    //                         "Authorization: Bearer $errand_key",
    //                     ),
    //                 ));

    //                 $var = curl_exec($curl);
    //                 curl_close($curl);
    //                 $var = json_decode($var);


    //                 $status = $var->code ?? null;
    //                 $acct_no = $var->data->accountNumber ?? null;
    //                 $acct_name = $var->data->accountName ?? null;
    //                 $error = $var->error->message ?? null;

    //                 $bank = "VFD MICROFINANCE BANK";

    //                 if ($status == 200) {

    //                     $create = new VirtualAccount();
    //                     $create->v_account_no = $acct_no;
    //                     $create->v_account_name = $acct_name;
    //                     $create->v_bank_name = $bank;
    //                     $create->user_id = $user_id;
    //                     $create->fee = "NGN 15";
    //                     $create->save();

    //                     $user = User::find(Auth::id());
    //                     $user->v_account_no = $acct_no;
    //                     $user->v_account_name = $acct_name;
    //                     $user->save();

    //                     // return 200;
    //                 }else{

    //                     $message = "Error from Virtual account creation | $name | $error";
    //                     send_notification($message);

    //                 }


    //                 //create providus

    //                 $client_id = env('CLIENTID');
    //                 $hashkey = env('HASHKEY');

    //                 $curl = curl_init();
    //                 $data = array(

    //                     "customerBvn" => $bvn,
    //                     "phoneNumber" => "234" . $phone,
    //                     "customerName" => $name,

    //                 );

    //                 $databody = json_encode($data);

    //                 curl_setopt_array($curl, array(
    //                     CURLOPT_URL => 'https://vps.providusbank.com/vas/api/PiPCreateReservedAccountNumber',
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => '',
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 0,
    //                     CURLOPT_FOLLOWLOCATION => true,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => 'POST',
    //                     CURLOPT_POSTFIELDS => $databody,
    //                     CURLOPT_HTTPHEADER => array(
    //                         'Content-Type: application/json',
    //                         'Accept: application/json',
    //                         "Client-Id: $client_id",
    //                         "X-Auth-Signature: $hashkey",
    //                     ),
    //                 ));

    //                 $var = curl_exec($curl);
    //                 curl_close($curl);
    //                 $var = json_decode($var);


    //                 $status = $var->responseCode ?? null;
    //                 $acct_no = $var->account_number ?? null;
    //                 $acct_name = $var->account_name ?? null;

    //                 $error = $var->error->message ?? null;

    //                 $bank = "PROVIDUS BANK";


    //                 if ($status == 00) {

    //                     $create = new VirtualAccount();
    //                     $create->v_account_no = $acct_no;
    //                     $create->v_account_name = $acct_name;
    //                     $create->v_bank_name = $bank;
    //                     $create->user_id = $user_id;
    //                     $create->fee = "1%";
    //                     $create->save();

    //                     return 200;

    //                 }else{
    //                     $message = "Error from Virtual account creation | $name | $error";
    //                     send_notification($message);

    //                     return 500;
    //                 }


    //             }


    //         // }

    //         return 200;


    //     }
    // }




    if (!function_exists('create_p_account')) {

        function create_p_account()
        {



            $first_name = Auth::user()->first_name;
            $last_name = Auth::user()->last_name;
            $user_id = Auth::id();
            $b_name =  Auth::user()->b_name;
            $phone = Auth::user()->phone;
            $bvn = Auth::user()->bvn;
            $b_phone = Auth::user()->b_name;
            $pnum = preg_replace('/^./', '', $phone);
            $cphone = $pnum;
            $business_name = Auth::user()->business_name;


            if ($business_name != null) {
                $name = $business_name;
            } else {
                $name = $first_name . " " . $last_name;
            }


            $user_id = User::where('bvn', $bvn)->first()->id ?? null;

            $client = env('CLIENTID');
            $xauth = env('HASHKEY');

            $curl = curl_init();
            $data = array(
                "account_name" => $name,
                "bvn" => $bvn,
            );



            $databody = json_encode($data);
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://vps.providusbank.com/vps/api/PiPCreateReservedAccountNumber',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $databody,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    "Client-Id: $client",
                    "X-Auth-Signature: $xauth",
                ),
            ));

            $var = curl_exec($curl);
            curl_close($curl);
            $var = json_decode($var);



            $status = $var->responseCode ?? null;
            $p_acct_no = $var->account_number ?? null;
            $p_acct_name = $var->account_name ?? null;
            $error = $var->responseMessage ?? null;

            $pbank = "PROVIDUS BANK";

            if ($status == 00) {

                $create = new VirtualAccount();
                $create->v_account_no = $p_acct_no;
                $create->v_account_name = $p_acct_name;
                $create->v_bank_name = $pbank;
                $create->user_id = Auth::id();
                $create->save();

                $message = "Providus Account Created | $name";
                send_notification($message);


                return 200;
            } else {


                $error = "Providus account Error | $name | $error";
                send_notification($error);

                return 500;
            }
        }
    }





    if (!function_exists('vt_balance')) {

        function vt_balance()
        {

            $vtkey = env('VTKEY');
            $pkey = env('VPKEY');


            $key = env('BKEY');
            $curl = curl_init();


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-service.vtpass.com/api/balance',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                "api-key: $vtkey",
                "public-key: $pkey"
                ),
            ));

            $var = curl_exec($curl);
            curl_close($curl);
            $var = json_decode($var);


            $status = $var->code ?? null;


            if($status == 1 ){
                return $var->contents->balance;
            }

            return "Neteork Issue";
        }
    }




























    if (!function_exists('get_issuing_bal')) {

        function get_issuing_bal()
        {

            $key = env('BKEY');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://issuecards.api.bridgecard.co/v1/issuing/cards/get_issuing_wallet_balance',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "token: Bearer $key"
                ),
            ));

            $var = curl_exec($curl);
            curl_close($curl);
            $var = json_decode($var);

            $status = $var->status ?? null;

            if ($status == 'success') {
                return $var->data->issuing_balance_USD / 100;
            }

            return "Network Issue";
        }
    }

    if (!function_exists('get_rate')) {

        function get_rate()
        {

            $key = env('BKEY');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://issuecards.api.bridgecard.co/v1/issuing/cards/fx-rate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "token: Bearer $key"
                ),
            ));

            $var = curl_exec($curl);
            curl_close($curl);
            $var = json_decode($var);

            $status = $var->status ?? null;

            if ($status == 'success') {
                return $var->data->{'NGN-USD'} / 100;
            }

            return "Network Issue";
        }
    }


    if (!function_exists('sendFirebaseNotification')) {



        function sendFirebaseNotification($var, $icon, $title, $message, $click_action)
        {

            $SERVER_API_KEY = env('FCM_SERVER_KEY');
            $authorization_key = $SERVER_API_KEY;
            $finalPostArray = array(
                'registration_ids' => $var,
                'notification' => array(

                    'body' => $message,

                    'title' => $title,

                    "click_action" => $click_action,

                    "icon" => $icon,


                ),
                "data" => array(
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                    "sound" => "default",
                    "status" => "done"

                )
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($finalPostArray));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: key=' . $authorization_key));
            $get_response = curl_exec($ch);
            dd($get_response, $finalPostArray, $authorization_key);
            curl_close($ch);
            //echo $server_output;
        }
    }



    if (!function_exists('send_notification')) {

        function send_notification($message)
        {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.telegram.org/bot6140179825:AAGfAmHK6JQTLegsdpnaklnhBZ4qA1m2c64/sendMessage?chat_id=1316552414',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => "1316552414",
                    'text' => $message,

                ),
                CURLOPT_HTTPHEADER => array(),
            ));

            $var = curl_exec($curl);
            curl_close($curl);

            $var = json_decode($var);
        }
    }
}
