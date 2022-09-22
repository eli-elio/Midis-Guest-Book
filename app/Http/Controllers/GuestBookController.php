<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GuestBookController extends Controller
{
    public function index()
    {
        $guestBooks = DB::table('guest_books')->paginate(10);
        return view('form-with-captcha', ['guestBooks' => $guestBooks]);
    }

    public function capthcaFormValidate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'text' => 'required',
            'captcha' => 'required|captcha',
        ]);

        $guestBook = new GuestBook([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'link' => $request->get('link'),
            'text' => $request->get('text'),
            'captcha' => $request->get('captcha'),
            'IP' => $request->ip(),
            'browser' => $request->userAgent()
        ]);

        $guestBook->save();

        return Redirect::to('/');

    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
