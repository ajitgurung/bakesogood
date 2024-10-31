<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactFormMail;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required| max:100',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $message = DB::table('messages')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'user_id' => auth()->user()->id ?? null
        ]);

        if($message)
        {
            Mail::to('ajit@goodiesbakery.ca')->send(new ContactFormMail($data));
            return redirect()->back()->with('success', 'Message delivered successfully!');
        } else
        {
            return redirect()->back()->with('error', 'Message failed to be delivered!');
        }
    }
}
