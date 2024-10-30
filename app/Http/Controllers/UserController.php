<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function UserLogin(Request $request):JsonResponse{
        try{
            $UserEmail=$request->UserEmail;
            $OTP=rand(100000,999999);
            $details=['code'=>$OTP];
            Mail::to($UserEmail)->send(new OTPMail($details));
            User::updateOrCreate(['email'=>$UserEmail], ['email'=>$UserEmail,'otp'=>$OTP]);
            return ResponseHelper::Out('success',"A 6 Digit OTP has been sent to your email",200);
        } catch (Exception $e) {
            return ResponseHelper::Out('fail',$e,400);
        }
    }
}
