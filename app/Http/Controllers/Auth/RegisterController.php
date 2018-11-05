<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\UserInfo;
use App\UserActivity;
use Illuminate\Http\Request;
use Response;
use Auth;
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
   // protected $redirectTo = '/home';
    //protected $redirectTo = redirect()->back();
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
            'password' => bcrypt($data['password']),
			'type' => 2,   
            'referel_code' => uniqid(),    
        ]);
 
    }
    public function register11(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $input = $request->all();

        if ($validator->passes()) {
            return User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'type' => 2,   
                'referel_code' => uniqid(),    
            ]);
            // Store your user in database 

            //return Response::json(['success' => '1']);

        }
        
        return Response::json(['errors' => $validator->errors()]);
    }

    public function authenticatedCustomRegister(Request $request)
    {
        //die('ashishsh');

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $input = $request->all();

        if ($validator->passes()) {
            return User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'type' => 2,   
                'referel_code' => uniqid(),    
            ]);
            // Store your user in database 

            /*$profile = Auth::user();
            $profile->name = $request->get('name');
            $profile->email =  $request->get('email');
            $profile->password = bcrypt($request->get('password'));
            $profile->type = '2';
            $profile->referel_code = uniqid();
            $profile->save();*/

            return Response::json(['success' => '1']);

        }
        
        return Response::json(['errors' => $validator->errors()]);
    }

    protected function redirectTo()
    {
        return url()->previous();
    }
}
