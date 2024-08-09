<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AcountController extends Controller
{
  //This is method will show user registration page
  public function registration()

  {
    return view('front.acount.registration');
  }
  // This is method will save user
  public function processRegistration(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:5',
      'confirm_password' => 'required|min:5,same:password'
    ]);
    if ($validator->passes()) {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->save();
      session($key = null, $default = null)->flash('success', 'You have registerd successfully!');
      return response()->json([
        'status' => true,
        'error' => []
      ]);
    } else {
      return response()->json([
        'status' => false,
        'error' => $validator->errors()
      ]);
    }
  }

  //This is method will show user login page
  public function login()
  {
    return view('front.acount.login');
  }
  public function authenticate(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if ($validator->passes()) {
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect()->route('acount.profile');
      } else {
        return redirect()->route('acount.login')->with('error', 'Either Email/Password is incorrect');
      }
    } else {
      return redirect()->route('acount.login')->withErrors($validator)->withInput($request->only('email'));
    }
  }
  public function profile()
  {

    return view('front.acount.profile');
  }
  public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect()->route('acount.login');
  }
}
