<?php

namespace App\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_name=='Super Admin')
        {
            $data = DB::table('users')->get();
            return view('user.index',compact('data'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'avatar'    => 'mimes:jpg,png,jpeg',
            'email'     => 'required|string|email|max:255|unique:users',
            'phone'     => 'required|min:12|numeric',
            'role_name' => 'required|string',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ])->validate();

        $user = new User;
        $user->name         = $request->get('name');
        $user->email        = $request->get('email');
        $user->phone_number = $request->get('phone');
        $user->role_name    = $request->get('role_name');
        $user->password     = Hash::make($request->get('password'));

        if($request->file('avatar')){
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        $user->save();

        Toastr::success('Create new account successfully :)','Success');
        return view('user.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('user.show', ['user'=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->role_name=='Super Admin')
        {
            $data = DB::table('users')->where('id',$id)->get();
            $roleName = DB::table('role_type_users')->get();
            $userStatus = DB::table('user_types')->get();
            return view('user.edit',compact('data','roleName','userStatus'));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        if (Auth::user()->role_name=='Super Admin')
        {
            $data = \App\Models\User::findOrFail($id);
            return view('user.editPassword',compact('data'));
            // return view('user.editPassword');
        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function updatePassword(Request $request, $id)
     {
        $validation = \Validator::make($request->all(),[
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required',
            'password_confirmation' => ['required', 'same:new_password'],
        ])->validate();

        $user = \App\Models\User::findOrFail($id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        Toastr::success('Data updated successfully :)','Success');
        return redirect()->route('user.editPassword', [$id]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validation = \Validator::make($request->all(),[
            'name'      => "required|min:5|max:100",
            'email'     => "required|email",
            'role_name' => "required",
            'status'    => "required",
        ])->validate();

        $user = \App\Models\User::findOrFail($id);

        $user->name         = $request->get('name');
        $user->email        = $request->get('email');
        $user->phone_number = $request->get('phone_number');
        $user->status       = $request->get('status');
        $user->role_name    = $request->get('role_name');

        if($request->file('avatar')){
            if($user->avatar && file_exists(storage_path('app/public/' .
                $user->avatar))){
                    \Storage::delete('public/'.$user->avatar);
                }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }

        $user->save();

        $name         = $request->get('name');
        $email        = $request->get('email');
        $phone_number = $request->get('phone_number');
        $status       = $request->get('status');
        $role_name    = $request->get('role_name');

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $activityLog = [
            'user_name'    => $name,
            'email'        => $email,
            'phone_number' => $phone_number,
            'status'       => $status,
            'role_name'    => $role_name,
            'modify_user'  => 'Update',
            'date_time'    => $todayDate,
        ];

        DB::table('user_activity_logs')->insert($activityLog);
        Toastr::success('Data updated successfully :)','Success');
        return redirect()->route('user.edit',[$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');

        $fullName     = $user->name;
        $email        = $user->email;
        $phone_number = $user->phone_number;
        $status       = $user->status;
        $role_name    = $user->role_name;

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $activityLog = [

            'user_name'    => $fullName,
            'email'        => $email,
            'phone_number' => $phone_number,
            'status'       => $status,
            'role_name'    => $role_name,
            'modify_user'  => 'Delete',
            'date_time'    => $todayDate,
        ];

        DB::table('user_activity_logs')->insert($activityLog);

        $delete = User::find($id);
        $delete->delete();
        Toastr::success('Data deleted successfully :)','Success');
        return redirect()->route('user.index');
    }


     // use activity log
     public function activityLog()
     {
         $activityLog = DB::table('user_activity_logs')->get();
         return view('user.user_activity_log',compact('activityLog'));
     }
     // activity log
     public function activityLogInLogOut()
     {
         $activityLog = DB::table('activity_logs')->get();
         return view('user.activity_log',compact('activityLog'));
     }

}
