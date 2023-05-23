<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Terminal extends Model
{
    protected $table = "terminals";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    protected $fillable = [
        'user_id',
        'serial_no',
        'business_id',
        'v_account_no',
        'transfer_status',
        'status',
        'description',
        'created_at',
        'updated_at',
       
    ];
    

    // public function user()
    // {
    //     return $this->belongsTo(User::class);

    // }
}
