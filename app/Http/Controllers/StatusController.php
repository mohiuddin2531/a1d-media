<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Status;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


class StatusController extends Controller
{
    
    // NEWSFEED CODES

    public function newsfeedStatus()
    {
        $statuses = Status::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('newsfeed', ['statuses' => $statuses]);
    }
    
    public function postStatus(Request $request)
    {
        $status = new Status;
        $status->body = $request->status;
        $status->status_id = Str::uuid();
        $status->user_id = Auth::id();
        $status->save();
        $request->session()->flash('status', 'Post successfully updated!');
        return redirect()->back();
    }



    // USER PROFILE CODES


}
