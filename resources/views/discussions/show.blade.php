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
            </div>

        </div>


@endsection
