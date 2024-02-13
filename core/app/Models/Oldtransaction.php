<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oldtransaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'user_id',
        'ref_trans_id',
        'e_ref',
        'transaction_type',
        'title',
        'type',
        'main_type',
        'amount',
        'debit',
        'credit',
        'balance',
        'fee',
        'charge',
        'enkPay_Cashout_profit',
        'from_user_id',
        'terminal_id',
        'to_user_id',
        'created_at',
        'updated_at',
        'note',
        'p_sessionId',
        'status',
        'serial_no',
        'e_charges',
        'trx_date',
        'trx_time',
        'sender_name',
        'sender_bank',
        'sender_account_no',
        'receiver_name',
        'receiver_account_no',
        'receiver_bank',
        'sender_id',
        'receiver_id',
        'resolve',
        'super_agent_id',
        'register_under_id'

    ];


}
