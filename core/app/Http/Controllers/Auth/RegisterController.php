<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Settings;
use App\Models\Audit;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Countrysupported;
use App\Models\Compliance;
use App\Models\Gateway;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use Session;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Token;
use Stripe\Charge;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:user');
    }

    public function register()
    {
        $data['title']='Register';
        $data['country']=Countrysupported::wherestatus(1)->get();
        return view('/auth/register', $data);
    }

    public function submitregister(Request $request)
    {

        $set=Settings::first();
        // if($set->recaptcha==1){
        //     $validator = Validator::make($request->all(), [
        //         'first_name' => 'required|string|max:255',
        //         'last_name' => 'required|string|max:255',
        //         'business_name' => 'required|string|max:255|unique:users',
        //         'email' => 'required|string|email|max:255|unique:users',
        //         'phone' => 'required|numeric|unique:users',
        //         'password' => 'required|string|min:6',
        //         'pin' => 'required|number|min:4',
        //         'g-recaptcha-response' => 'required|captcha'
        //     ]);
        // }else{
        //     $validator = Validator::make($request->all(), [
        //         'first_name' => 'required|string|max:255',
        //         'last_name' => 'required|string|max:255',
        //         'email' => 'required|string|email|max:255|unique:users',
        //         'phone' => 'required|numeric|unique:users',
        //         'pin' => 'required|numeric|min:4',
        //         'password' => 'required|string',
        //     ]);
        // }
        // if ($validator->fails()) {
        //     // adding an extra field 'error'...
        //     $data['title']='Register';
        //     $data['errors']=$validator->errors();
        //     $data['country']=Countrysupported::wherestatus(1)->get();
        //     return view('/auth/register', $data);
        // }


      

        if ($set->email_verification == 1) {
            $email_verify = 0;
        } else {
            $email_verify = 1;
        }
        $country=Country::whereid($request->country)->first();
        $country_supported=Countrysupported::wherecountry_id($request->country)->first();
        $currency=Currency::whereStatus(1)->first();


        $public_key = random_int(100000000000, 99999999999999);
        $secret_key = random_int(100000000000, 99999999999999);

        $tpublic_key = random_int(100000000000, 9999999999999);
        $tsecret_key = random_int(100000000000, 9999999999999);

        $otp = random_int(1000, 9999);


        
        User::where('email', $request->email)->update([

            'image' => 'person.png',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'business_name' => $request->business_name,
            'country' => $request->country,
            'pay_support' => 8,
            'phone' => $request->phone,
            'pin' => Hash::make($request->pin),
            'email' => $request->email,
            'email_verify' => $email_verify,
            'verification_code' => $otp,
            'email_time' => Carbon::parse()->addMinutes(5),
            'balance' => $set->balance_reg,
            'ip_address' => user_ip(),
            'password' => Hash::make($request->password),
            'last_login'=> Carbon::now(),
            'business_email' => $request->email,
            'public_key'=> "live-".$public_key,
            'secret_key' => "live-".$secret_key,
            'tpublic_key'=> "test-".$tpublic_key,
            'tsecret_key' => "test-".$tsecret_key,
            'business_id' => random_int(100000, 999999),
            'business_email'=> $request->email

    

        ]);
            // $data = array(
            //     'fromsender' => 'noreply@enkpay.com', 'EnkPay',
            //     'subject' => "OTP EMAIL",
            //     'toreceiver' => $request->email,
            //     'remail' => $request->email,
            //     'first_name' => $request->first_name,
            //     'otp' => $otp,

            // );

            // Mail::send('emails.vcard.emailotp', ["data1" => $data], function ($message) use ($data) {
            //     $message->from($data['fromsender']);
            //     $message->to($data['toreceiver']);
            //     $message->subject($data['subject']);
            // });

            $message = "NEW USER | " . $request->first_name . "  " . $request->last_name . "| Signed up on ENKPAY WEB ";

            send_notification($message);


            return redirect('login');





        }


    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
