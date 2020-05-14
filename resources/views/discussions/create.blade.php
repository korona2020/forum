@extends('layouts.app')

@section('content')


    <div class="card">

        <div class="card-header">Add Discussion</div>

        <div class="card-body">
           {!! Form::open(['route'=>'discussions.store']) !!}
            <div class="form-group">
                {!! Form::label('title','Title') !!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content','Content') !!}
                {!! Form::textarea('content',null,['class'=>'form-control','rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('channel','Channel') !!}
                <select name="channel" id="channel" class="form-control">
                    @foreach($channels as $channel)
                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::submit('Add Discussion',['class'=>'btn btn-success']) !!}
            </div>
                @include('partials.errors')

            {!! Form::close() !!}


        </div>
    </div>

@endsection


