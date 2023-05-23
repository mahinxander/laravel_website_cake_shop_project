<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Notifications\RegistrationEmailNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return Application|Factory|View
     */

    public function loginPage()
    {

        return view('login');
    }

    public function aboutus()
    {

        return view('aboutus');
    }

    public function loginProcess(Request $request): \Illuminate\Http\RedirectResponse
    {

        $this->validate($request, [

            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->except(['_token']);
        if (auth()->attempt($credentials)) {
            if(Auth::user()->role_as == '1') //1 = Admin Login
            {
                $request->session()->regenerate(); // to prevent session fixation

                return redirect()->intended();
            }
            elseif(Auth::user()->role_as == '0') // Normal or Default User Login
            {
                $request->session()->regenerate();
                return redirect()->intended() ;// intended will redirect back to the attempted route of user before facing validation
           }

        }
        else{
            $this->setErrorMessage('Invalid user id or password!');

            return redirect()->back();
        }


    }
    public function registerPage()
    {
        return view('register');
    }
    public function registerProcess(Request $request): \Illuminate\Http\RedirectResponse
    {
        //===================validation===================
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone_number' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $callingCode = $request->input('calling_code');
                    $phoneNumber = '+88-' . $value;
                    $exists = User::where('phone_number', $phoneNumber)->exists();

                    if ($exists) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                },
            ],
            'password'=>'required|min:4|confirmed',
        ]);

        //=======================insert into database=================
        $data=[
            'name'=>$request->input('name'),
            'email'=>strtolower(trim($request->input('email'))),
//            'phone_number'=>trim($request->input('phone_number')),
            'phone_number'=>'+88'. '-' .trim($request->input('phone_number')),
            'password'=>bcrypt($request->input('password')),
            'email_verification_token'=> uniqid(now('Asia/Dhaka').$request->input('email'),true).Str::random(40)

        ];
        try {
            $user = User::create($data);

            session()->flash('message','Submitted!');
            session()->flash('type','success');
            return redirect()->route('login');
        }catch(\Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('type','danger');
            return redirect()->back();
        }
    }
    public function showDash()
    {
        $data['categories'] = Category::all()->take(5);
        $data['products'] = Product::all()->take(20);
        $data['latests'] = Product::latest()->take(5)->get();

        return view('welcome', $data);
    }
    public function logout()
    {
        Auth::logout();

        \session()->invalidate();
        $this->setSuccessMessage('User logged out!');
        return redirect()->intended();

    }


}
