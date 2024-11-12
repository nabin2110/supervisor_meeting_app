<?php

namespace App\Http\Controllers;

use App\Jobs\MeetingJob;
use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeetingController extends Controller
{
    public function create(){
        return view('meeting');
    }

    public function store(Request $request)
    {
        $meeting_created = Meeting::create([
            'meeting_subject' => $request->meeting_subject,
            'meeting_time' => $request->meeting_time,
        ]);

        $meetingTime = Carbon::parse($meeting_created->meeting_time);

        if ($meetingTime->isPast()) {
            Log::info('Meeting time is in the past: ' . $meetingTime);
            return redirect()->back()->with('error', 'Meeting time cannot be in the past.');
        }
        $delay = Carbon::now()->diffInSeconds($meetingTime);

        Log::info('Meeting time: ' . $meetingTime);
        Log::info('Current time: ' . Carbon::now());
        Log::info('Calculated delay: ' . $delay);

        MeetingJob::dispatch($meeting_created)->delay(now()->addSeconds($delay));

        return redirect()->back()->with('success', 'Meeting scheduled and reminder set!');
    }

    public function updateResponse(Request $request){
        dd($request->all());
    }


}
