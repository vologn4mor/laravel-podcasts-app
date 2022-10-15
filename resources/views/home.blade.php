@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card col-md-8">
                <div class="card-header">{{ __('Поиск автора или подкаста') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('search.store')}}">
                        @csrf
                        <div class="input-group mb-3">
                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search" id="search" @if (isset($search))
                    value={{$search}}
                @endif>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Искать</button>
                </div>
                </div>
                    </form>
                </div>
            </div>
            @if (isset($users) && isset($podcasts))
                @if (count($users))
                    <h1 class="mt-3">Новые профили:</h1>
                @endif
            <div class="row mb-3">
            @foreach ($users as $user)
                <div class="col-sm-4">
                <div class="card p-3" style="width: 18rem;">
                <img src="
                    {{
                    $user->user_image ? asset('images/' . $user->user_image) : asset('images/user.svg')
                    }}
                " class="card-img-top img-thumbnail" style="width: 250px; height:250px; border-radius:50%;" alt="{{$user->name}}">
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <a href='{{route('profileId', ['id' => $user->id])}}' class="btn btn-primary">смотреть профиль</a>
                </div>
                </div>
                </div>
                
            @endforeach
            @if (count($podcasts))
                    <h1 class="mt-3">Новые подкасты:</h1>
                @endif
            
            <div class="row mb-3">
            @foreach ($podcasts as $podcast)
                <div class="col-sm-4">
                <div class="card p-3" style="width: 18rem;">
                <img src="{{
                    $podcast->podcast_img ? asset('images/' . $podcast->podcast_img) : asset('images/user.svg')
                    }}" class="card-img-top img-thumbnail" style="width: 250px; height:250px;" alt="{{$podcast->name}}">
                <div class="card-body">
                    <h5 class="card-title">{{$podcast->name}}</h5>
                    <p>{{$podcast->user->name}}</p>
                    <a href='{{route('podcast', ['id' => $podcast->id])}}' class="btn btn-primary">Слушать подкаст</a>
                </div>
                </div>
                </div>
                
            @endforeach
            
            </div>
        </div>
            @endif
            @if (isset($search))
                @if (count($searchUsers))
                    <h3 class="mt-3">Пользователи:</h3>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Ссылка</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($searchUsers as $user)
                            <tr>
                            <th scope="row">{{++$loop->index}}</th>
                            <td>
                                <img src="{{
                                    $user->user_image ? asset('images/' . $user->user_image) : asset('images/user.svg')
                                    }}" alt="" style="width: 50px; height:50px; border-radius: 50%;">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>
                                <a href='{{route('profileId', ['id' => $user->id])}}' class="btn btn-primary">Открыть</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @endif
                @if (count($searchPodcasts))
                <h3>Подкасты:</h3>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Название</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Ссылка</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($searchPodcasts as $podcast)
                            <tr>
                            <th scope="row">{{++$loop->index}}</th>
                            <td>
                                <img src="{{
                                    $podcast->podcast_img ? asset('images/' . $podcast->podcast_img) : asset('images/user.svg')
                                    }}" alt="" style="width: 50px; height:50px; border-radius: 50%;">
                            </td>
                            <td>{{$podcast->name}}</td>
                            <td>{{$podcast->user->name}}</td>
                            <td>
                                <a href='{{route('podcast', ['id' => $podcast->id])}}' class="btn btn-primary">Открыть</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @endif
                @if (!count($searchPodcasts) && !count($searchUsers))
                    <h1>По вашему запросу ничего не найдено</h1>
                @endif
            @endif
    </div>
</div>
@endsection
