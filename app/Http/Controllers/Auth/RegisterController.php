<?php
namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Agency;
use App\Mail\SendMailable;
use DB;



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
    protected $redirectTo = '/incoming';
    /**
     * Create a new controller instance.
     *
     * @return void
    }
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
            'name' => ['required', 'string', 'max:255'],
            'cid' => ['required', 'string', 'max:11'],
            'eid' => ['required', 'string', 'max:10'],
            'designation' => ['required', 'string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'mphone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],          
        ]);
    }
    /**
     *   'profile_pic' => ['required','image','max:2048'],
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'name' => $data['name'],
            'cid' => $data['cid'],
            'eid' => $data['eid'],
            'designation' => $data['designation'],
            'agency_id' => $data['department'],
            'division_id' => $data['division'],
            'role_id' => $data['role'],
            'phone' => $data['mphone'],
            'officephone' => $data['officephone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

       // Mail::to($data['email'])->send(new SendMailable($user));

        return $user;

    }

    /**
 * Show the application registration form.
 *
 * @return \Illuminate\Http\Response
 */
public function showRegistrationForm()
{
    $agencies = Agency::all();
    $roles = DB::table('tbl_roles')->select('id','Role')->get();

    return view('auth.register', compact('agencies','roles'));
}
}