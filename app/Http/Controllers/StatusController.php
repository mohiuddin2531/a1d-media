<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

use App\Models\Status;
use App\Models\React;

class StatusController extends Controller
{
    
    // NEWSFEED CODES

    public function newsfeedStatus()
    {
        $statuses = Status::with('user')->orderBy('created_at', 'desc')->paginate(10);
        $statusIds = $statuses->pluck('status_id');

        $user_reactions = React::whereIn('status_id', $statuses->pluck('id'))
        ->where('user_id', Auth::id())
        ->get()
        ->keyBy('status_id');
        return view('newsfeed', ['statuses' => $statuses, 'statusIds' => $statusIds, 'user_reactions' => $user_reactions]);
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


        // REACTS CODES

        public function postReact(Request $request, $status)
        {
            $user_id = Auth::id();
            $react = React::where('status_id', $status)->where('user_id', $user_id)->first();
            if ($react) {
                $react->reaction = $request->reaction;
                $react->save();
            } else {
                $react = new React;
                $react->status_id = $status;
                $react->user_id = $user_id;
                $react->reaction = $request->reaction;
                $react->save();
            }
            return redirect()->back();
        }
        



    



    // USER PROFILE CODES


}
