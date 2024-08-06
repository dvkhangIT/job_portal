<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
}
