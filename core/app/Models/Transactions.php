<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model {
    protected $table = "transactions";
    protected $guarded = [];

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

    public function ddlink()
    {
        return $this->belongsTo('App\Models\Paymentlink', 'payment_link');
    }       
    public function inplan()
    {
        return $this->belongsTo('App\Models\Invoice', 'payment_link');
    }
    public function sender()
    {
        return $this->belongsTo('App\Models\User','sender_id');
    }    
    public function receiver()
    {
        return $this->belongsTo('App\Models\User','receiver_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
