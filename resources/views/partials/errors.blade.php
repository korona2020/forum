
    <ul class="list-group text-danger">
        @foreach($errors->all() as $error)
            <li class="list-group-item">{{$error}}</li>
        @endforeach
    </ul>


