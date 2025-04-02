<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required| max:100',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(), // Optional: User's IP for additional security
        ]);

        $result = $response->json();

        if (!$result['success'] || $result['score'] < 0.5) { // Adjust score threshold based on needs
            return redirect()->back()->withErrors(['captcha' => 'reCAPTCHA verification failed. Please try again.']);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'user_id' => auth()->user()->id ?? null,
        ];

        $message = DB::table('messages')->insert($data);

        if ($message) {
            Mail::to(['ajit@goodiesbakery.ca', 'barbara@gmail.com'])->send(new ContactFormMail($data));
            return redirect()->back()->with('success', 'Message delivered successfully!');
        } else {
            return redirect()->back()->with('error', 'Message failed to be delivered!');
        }
    }
}
