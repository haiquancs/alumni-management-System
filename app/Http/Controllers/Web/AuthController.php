<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/26/2018
 * Time: 10:07 AM
 */

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends AppController
{
    protected $dirView = 'Web.Auth.';

    public function login(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == User::ROLE_ADMIN) {
                return redirect()->route('web.surveys.manage-surveys');
            }
            if (Auth::user()->role == User::ROLE_STUDENT) {
                return redirect()->route('web.surveys.index');
            }
        }
        if ($request->isMethod('POST')) {
            //Xu li login
            $code = $request['code'];
            $password = $request['password'];
            $remember = empty($request['remember']) ? $request['remember'] : 0;
            if (Auth::attempt(['code' => $code, 'password' => $password], $remember)) {
                if (Auth::user()->role == User::ROLE_ADMIN) {
                    return redirect()->route('web.surveys.manage-surveys');
                }
                if (Auth::user()->role == User::ROLE_STUDENT) {
                    return redirect()->route('web.surveys.index');
                }
            }
            return redirect()->route('web.auth.login')
                ->withErrors(['MSV hoặc mật khẩu không chính xác!'])
                ->withInput();
        }
        return view($this->dirView . 'login');
    }

    public function register(Request $request)
    {
        return view($this->dirView . 'login');
    }

    public function forgetPassword(Request $request)
    {
        return view($this->dirView . 'login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('web.auth.login');
    }

    public function create()
    {
        User::create([
            'code' => 1,
            'first_name' => 'Trịnh Hải',
            'last_name' => 'Quân',
            'full_name' => 'Trịnh Hải Quân',
            'sex' => 1,
            'email' => null,
            'phone' => null,
            'graduation_year' => null,
            'graduation_business' => null,
            'job_id' => null,
            'role' => User::ROLE_ADMIN,
            'last_access_at' => date('Y-m-d H:i:s', time()),
            'remember_token' => null,
            'password' => Hash::make(123456),
            'created_id' => 1,
            'updated_id' => 1,
        ]);
        return redirect()->route('web.auth.login');
    }
}