<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Http\Requests\CreateFeedbackRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class UserController extends Controller
{
    //


    /**
     * Получаем лимиты времени и формат в человеческом виде
     * @return array
     */
    public function getRateLimits(): array
    {
        return  ['availableIn'=>RateLimiter::availableIn(sha1(Auth::user()->getAuthIdentifier())),
            'humanTime' =>Carbon::now()->addSeconds(RateLimiter::availableIn(sha1(Auth::user()->getAuthIdentifier())))->diffForHumans(),];
    }




    public function add()
    {
        return view('user.add', $this->getRateLimits());
    }

    /**
     * Saves feedback and redirects to success page
     * @param CreateFeedbackRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateFeedbackRequest $request): \Illuminate\Http\RedirectResponse
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
        $feedback->save();
        return redirect()->route('addedSuccessful', $this->getRateLimits());
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addedSuccessful()
    {
        return view('user.success');
    }

}
