<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use Illuminate\Http\Request;
use Response;
use URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

      protected function authenticated($request, $user)
    {
        if($user->type == '1') {
            return redirect('/admin');
        }

       
        else 
        {
            //return redirect('/user');
            return redirect()->back();


        } 

    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function logout()
    {
    	$user = Auth::user();

        Session::flush();
        Auth::logout();
        return redirect('/');
    }
    protected function authenticatedCustomLogin(Request $request)
    {
        $validator = \Validator::make($request->all() , [
          'email' => 'required|email|max:255',
          'password' => 'required|min:6',
        ]);

      if($validator->fails()) { 
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        } else {
            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                return response()->json(['success' => true, 'redirectto' => 'dashboard']);
            } else {
                return response()->json(['success' => false, 'error' => ['Login Failed! Username and password is incorrect.']]);
            }
        }
    }
}
