<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'gender',
        'address_line1',
        'lga',
        'state',
        'serial_no',
        'v_account_no',
        'device_id',
        'v_account_name',
        'v_bank_name',
        'c_account_number',
        'c_account_name',
        'c_bank_name',
        'v_account_no',
        'email',
        'password',
        'v_account_no',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function deposit()
    {
        return $this->hasMany('App\Model\Deposit', 'user_id');
    }


    public function terminal()
    {
        return $this->hasMany('App\Model\Terminal', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Model\Transactions', 'user_id');
    }



    public function pending_transactions()
    {
        return $this->hasMany('App\Model\PendingTransaction', 'user_id');
    }

    public function v_card()
    {
        return $this->hasMany('App\Model\VCard', 'user_id');
    }


    public function country()
    {
        return $this->hasMany('App\Model\Country', 'id');
    }


    // public function terminal()
    // {
    //     return $this->hasMany(Terminal::class, 'user_id');
    // }




	/**
	 * The attributes that are mass assignable.
	 *
	 * @return array
	 */
	public function getFillable() {
		return $this->fillable;
	}
}
