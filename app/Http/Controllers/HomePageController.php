<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Models\UserWallet;
use App\Notifications\SendVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Djunehor\Sms\BetaSms;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomePageController extends Controller
{
    //
    public function index()
    {
        return view('frontend.index');
    }

}