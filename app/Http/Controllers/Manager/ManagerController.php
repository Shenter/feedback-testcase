<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function show()
    {
        $feedbacks = Feedback::with('user')->simplePaginate();
        return view(  'manager.feedbacks', ['feedbacks'=>$feedbacks]);
    }
}
