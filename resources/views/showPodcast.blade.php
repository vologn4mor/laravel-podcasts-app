@extends('layouts.app')

@section('content')
    {{-- {{dd($data);}} --}}
    <div class="container">
        <div style="display:flex; justify-content: space-around;">
            <div>
                <img src="{{asset('images/' . $data->podcast_img)}}" style="width: 300px; height:300px" alt="{{$data->name}}">
            </div>
             <div>
                <h3><a href='{{route('profileId', ['id' => $data->user_id])}}' class="p-1 text-info text-muted" style="text-decoration:none;">{{$data->user->name}}</a> - {{$data->name}}</h3>
             <audio controls>
                <source src="{{asset('podcasts/' . $data->podcast_file)}}" type="audio/mp3">
            </audio>
            <p>{{$data->about}}</p>
             </div>
        </div>
        @auth
            <h3 class="mt-3">Оставить комментарий</h3>
            <form method="POST">
                @csrf
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea type="text" class="form-control" name="comment" id="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Отправить</button>
            </form>
        @endauth
        @guest
            <h3 class="mt-3">Для того, чтобы оставить комментарий необходимо авторизоваться</h3>
            <a href="{{route('register')}}" class="btn btn-primary">Регистрация</a>
            <a href="{{route('login')}}" class="btn btn-primary">Авторизация</a>
        @endguest
        <div class="comments mt-3">
            <h3>Комментарии ({{$comments->total()}}):</h3>
            @foreach ($comments as $comment)
                {{-- <div>{{$comment->user->name}}: {{$comment->text}}</div> --}}
                <div class="comment mt-3 mb-3" style="display: flex; border: 1px solid gray; border-radius: 5px; padding: 5px">
                    <div style="margin-right: 15px;">
                        {{-- <img src="{{asset('images/' . $comment->user->user_image)}}" alt="{{$comment->user->name}}" style="width: 50px; height:50px; border-radius:50%"> --}}
                        @if ($comment->user->user_image !== null)
                        <img src="{{asset('images/' . $comment->user->user_image)}}" alt="{{$comment->user->name}}" style="width: 50px; height:50px; border-radius:50%">
                        @else
                        <img src="{{asset('images/user.png')}}" alt="{{$comment->user->name}}" style="width: 50px; height:50px; border-radius:50%">
                        @endif
                    </div>
                    <div style="display: flex; justify-content:space-between; width: 100%">
                        <div>
                            <strong>{{$comment->user->name}}</strong>
                            <p>{{$comment->text}}</p>
                        </div>
                        <div>
                            {{$comment->created_at}}
                        </div>
                    </div>
                </div>
            @endforeach
            {{$comments->links()}}
        </div>
    </div>
@endsection