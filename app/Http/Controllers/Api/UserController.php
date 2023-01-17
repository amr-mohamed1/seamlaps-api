<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiTrait;

    /*
    |--------------------------------------------------------------------------
    | Get All Users in the Project
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $users = User::get();
        if ($users) {
            return $this->ApiResponse($users,200,'Data Returned Successfully');
        }
        return $this->ApiResponse(null,404,'Error Occur While Returning the data');

    }

    /*
    |--------------------------------------------------------------------------
    | Register a User
    |--------------------------------------------------------------------------
    */
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150|min:3',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'birthday' => 'required',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return $this->ApiResponse('null',400,$validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'password' => Hash::make($request->password),
        ]);
        if($user){
            return $this->ApiResponse($user,200,'You are Successfully Registered');
        }

        return $this->ApiResponse(null,400,'Error Occur While Register');

    }

    /*
    |--------------------------------------------------------------------------
    | Login a User
    |--------------------------------------------------------------------------
    */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->ApiResponse('null',400,$validator->errors());
        }
        $user = User::where('name',$request->username)->first();
        if($user) {
            if (Hash::check($request->password, $user->password)) {
                return $this->ApiResponse($user,200,'You are Successfully Login');
            }else{
                return $this->ApiResponse('null',404,'Username or Password is Incorrect');
            }
        }
        return $this->ApiResponse('null',404,'Error Occur While Login');
    }

    /*
    |--------------------------------------------------------------------------
    | Get Specific User Data With his ID
    |--------------------------------------------------------------------------
    */
    public function get_user($id){
        $user = User::find($id);
        if($user){
            return $this->ApiResponse($user,200,'User Data Returned Successfully');
        }
        return $this->ApiResponse('null',404,'Error Occur While Returning Data');

    }

    /*
    |--------------------------------------------------------------------------
    | Update User Data by his ID
    |--------------------------------------------------------------------------
    */
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150|min:3',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->ApiResponse('null',400,$validator->errors());
        }
        $user = User::find($id);
        if($user){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'password' => Hash::make($request->password),
            ]);
            return $this->ApiResponse($user,200,'User Data Updated Successfully');
        }
        return $this->ApiResponse('null',404,'Error Occur While Returning Data');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete User by his ID
    |--------------------------------------------------------------------------
    */
    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user->destroy($id);
            return $this->ApiResponse('null',200,'User Data Deleted Successfully');
        }
        return $this->ApiResponse('null',404,'Error Occur While Returning Data');
    }

}
