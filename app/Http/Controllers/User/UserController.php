<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFeedbackRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function add()
    {
        return view('user.add');
    }

    public function store(CreateFeedbackRequest $request)
    {
        $feedback = new Feedback([
            'title' => $request->title,
            'message' => $request->text,
            'user_id' => Auth::user()->id,
        ]);
        if($request->has('file')) {
            $path = $request->file('file')->store('public');
            $feedback->attach = $path;
            $feedback->save();
        }
        else {echo 'no file';}
        $feedback->save();
        return redirect()->route('addedSuccessful');
    }

    public function addedSuccessful()
    {
        return view('user.success');
    }

}
