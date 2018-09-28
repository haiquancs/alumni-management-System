<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];
    protected $mesError = '';
    const  STATUS_SERVER_RESPONSE = array(
        100 => 'Continue',
        101 => 'Switching Protocols',

        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',

        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',

        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        511 => 'Network Authentication Required',
    );

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {

        if (method_exists($exception, 'getStatusCode')) {
            $this->mesError = $exception->getStatusCode() . ' : ' . (!empty(self::STATUS_SERVER_RESPONSE[$exception->getStatusCode()]) ? self::STATUS_SERVER_RESPONSE[$exception->getStatusCode()] : '');
            \Log::useDailyFiles(storage_path() . '/logs/debug.log');
            \Log::info($this->mesError);
        }

        parent::report($exception);

    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if ($this->isHttpException($exception)) {

            switch ($exception->getStatusCode()) {

                // internal error
                case '500':
                    return \Response::view('errors.500', array('mesError' => $this->mesError, 'statusCode' => $exception->getStatusCode()), 500);
                    break;
                case '400':
                    return \Response::view('errors.400', array('mesError' => $this->mesError, 'statusCode' => $exception->getStatusCode()), 400);
                    break;
                case '403':
                    return \Response::view('errors.403', array('mesError' => $this->mesError, 'statusCode' => $exception->getStatusCode()), 403);
                    break;
                case '404':
                    return \Response::view('errors.404', array('mesError' => $this->mesError, 'statusCode' => $exception->getStatusCode()), 404);
                    break;
                case '408':
                    return \Response::view('errors.408', array('mesError' => $this->mesError, 'statusCode' => $exception->getStatusCode()), 408);
                    break;

                default:
                    return \Response::view('errors.errorStatusCode', array('statusCode' => $exception->getStatusCode()), $exception->getStatusCode());
                    break;
            }
        } else {

            return parent::render($request, $exception);
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
