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
    public function about()
    {
        return view('frontend.about');
    }
    public function services()
    {
        return view('frontend.services');
    }
    public function faqs()
    {
        return view('frontend.faqs');
    }
    public function contact()
    {
        return view('frontend.contact');
    }

    public function policy()
    {
        return view('frontend.policy');
    }
    
    public function terms()
    {
        return view('frontend.terms');
    }
}
