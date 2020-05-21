@extends('layouts.app')

@section('content')



        <div class="card mb-2">

            @include('partials.header')

            <div class="card-body">
                  <div class="text-center">
                      <strong>{{$discussion->title}}</strong>
                  </div>

                <hr>
                {{$discussion->content}}

                @if($discussion->bestReply)
                    <div class="card bg-success my-4" >
                        <div class="card-header" style="color:white">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <img src="{{gravatar()->image($discussion->bestReply->user->email)}}" alt="" width="40px" height="40px" style="border-radius: 50%" >
                                    <span><strong>{{$discussion->bestReply->user->name}}</strong></span>
                                </div>
                                <div>
                                    Best Reply
                                </div>

                            </div>
                        </div>
                        <div class="card card-body">
                            {{$discussion->bestReply->content}}
                        </div>

                    </div>
                @endif

            </div>

        </div>

        @foreach($replies as $reply)
            <div class="card my-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img src="{{gravatar()->image($reply->user->email)}}" alt="" width="40px" height="40px" style="border-radius: 50%" >
                            <span>{{$reply->user->name}}</span>
                        </div>
                        <div>

                            @if(auth()->user()->id == $discussion->user_id )

                                {!! Form::open(['method'=>'Post', 'route'=>['discussions.reply', $discussion->slug,$reply->id]]) !!}
                                   {!! Form::submit('Mark as Best Reply', ['class'=>'btn btn-info btn-sm']) !!}
                                {!! Form::close() !!}

                            @endif

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{$reply->content}}

                </div>
            </div>

        @endforeach
        {{$replies->links()}}

        <div class="card">
            <div class="card-header">
                Add a Reply
            </div>
            <div class="card-body">
                {!! Form::open(['route'=>['replies.store',$discussion->slug]]) !!}

                    <div class="form-group">
                        {!! Form::textarea('content',null, ['class'=>'form-control', 'rows'=>2]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Reply', ['class'=>'btn btn-success btn-sm']) !!}
                    </div>

                {!! Form::close() !!}

                @include('partials.errors')
            </div>
        </div>
@endsection
