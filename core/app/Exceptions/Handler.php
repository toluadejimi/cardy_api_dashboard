<?php

namespace App\Exceptions;

use Auth; 
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        } 
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/admin');
        }
        if ($request->is('user') || $request->is('user/*')) {
            return redirect()->guest('/login');
        }
        return redirect()->guest(route('login'));
    }




    public function sendEmail(Throwable $exception)
    {
       try {

            $message = $content['message'] = $exception->getMessage();
            $file = $content['file'] = $exception->getFile();
            $line = $content['line'] = $exception->getLine();
            $trace = $content['trace'] = $exception->getTrace();

            $url = $content['url'] = request()->url();
            $body = $content['body'] = request()->all();
            $ip = $content['ip'] = request()->ip();



            $message2 = "Error Message on ENKPAY";
            $message = $message2. "\n\nMessage========>" . $message . "\n\nLine========>" . $line . "\n\nFile========>" . $file . "\n\nURL========>" . $url . "\n\nIP========> " . $ip;
            send_notification($message);


        } catch (Throwable $exception) {
            Log::error($exception);
        }
    }




}
