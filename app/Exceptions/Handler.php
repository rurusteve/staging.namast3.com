<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Mail;
use Illuminate\Mail\Mailable;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use \App\Mail\Bug;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            $this->sendEmail($exception); // sends an email
        }
        parent::report($exception);
    }

    public function sendEmail(Exception $exception)
    {
        try {
            $e = FlattenException::create($exception);

            $handler = new SymfonyExceptionHandler();

            $html = $handler->getHtml($e);

            // $id = Auth::user()->nip;

            // Mail::to('admin@rurusteve.com')->send(new Bug($html));
        } catch (Exception $ex) {

            dd($ex);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        if ($exception instanceof Exception) {
//            return view('errors.500')
//                ->with('request',$request)
//                ->with('exception',$exception);
//        }
//
//        return parent::render($request, $exception);

//        if ($exception instanceof Exception) {
//            return view('errors.500')
//                ->with('request',$request)
//                ->with('exception',$exception);
//            return response()->view('errors.500', [], 500);
//        }abort(500, 'Unauthorized action.');

        return parent::render($request, $exception);
//        return view ('errors.404');

    }
}
