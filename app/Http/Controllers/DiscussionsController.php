<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use App\Http\Requests\CreateDiscussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','show']);
    }

    public function index()
    {
        //
        return view('discussions.index')->with('discussions', Discussion::paginate(1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateDiscussion $request)
    {
        //
        auth()->user()->discussions()->create([
            'title'=>$request->title,
            'content'=>$request['content'],
            'channel_id'=>$request->channel,
            'slug'=>Str::slug($request->title)
        ]);

        session()->flash('success','Discussion was succesfully created');

        return redirect(route('discussions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Discussion $discussion)
    {
        //
        return view('discussions.show')->with('discussion',$discussion)
            ->with('replies',$discussion->replies()->paginate(2));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDiscussion $request)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);

        session()->flash('success','This reply was marked as best reply');

        return redirect()->back();

    }
}
