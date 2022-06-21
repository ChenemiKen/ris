<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // pagination no of rows per page
        session(['per_page' => $request->get('per_page', 10)]);
        if(Gate::allows('is-admin')){
            return view('messages', [
                'messages' => Message::with('recipient')->paginate(session('per_page'))
            ]);
        }else{
            return view('messages', [
                'messages' => Message::where('recipient_id', auth()->user()->id)->paginate(session('per_page'))
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('is-staff');
        $parents = User::where('type_type', "App\\Models\\PupilParent")->pluck('fullname','id');
        return view('add-message',['parents'=>$parents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'parent' => ['required', 'exists:users,id'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
        ]);
        $user = User::find($request->parent);
        
        $message = new Message();
        $message->date = Carbon::now()->format('Y-m-d');
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->sender_id = Auth::user()->id;

        // persist
        $user = $user->messages()->save($message);

        return redirect()->route('messages')->with('success','Message sent successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        // $message = DB::table('messages')->find($message);
        return view('view-message',[
            'message' => $message,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
