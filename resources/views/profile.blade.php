@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
   <div class="alert alert-success" role="alert">
  Подкаст успешно загружен!
</div>
   @endif
   @if (session('error'))
   <div class="alert alert-danger" role="alert">
  Имя пользователя занято!
</div>
   @endif
   <h1>Профиль пользователя {{$user['name']}}</h1>
   <div style="display: flex; justify-content:space-around; margin:50px 0 50px 0;">
    @if ($user['image'] !== null)
       <img src="{{asset('images/' . $user['image'])}}" style="width: 300px; height:300px; border-radius:50%" alt="{{$user['name']}}">
   @else
       <img src="{{asset('images/user.svg')}}" style="width: 300px; height:300px; border-radius:50%" alt="{{$user['name']}}">
   @endif
   <div>
    <h3>О пользователе:</h3>
    <p>{{$user['about']}}</p>
    @auth
        @if (Auth::user()->id === $user['id'])
       <a href="{{route('profile.edit')}}" class="btn btn-primary mb-3">Редактировать профиль</a>
   @endif
    @endauth
   </div>
   </div>
   <h1>Подкасты:</h1>
   <div class="row mb-3">
   @foreach ($user['podcasts'] as $item)
      <div class="col-sm-4">
    <div class="card" style="width: 18rem;">
      <img src="{{asset('images/' . $item->podcast_img)}}" class="card-img-top img-thumbnail" style="width: 300px; height:300px" alt="{{$item->name}}">
      <div class="card-body">
        <h5 class="card-title">{{$item->name}}</h5>
        <p class="card-text">{{$item->about}}</p>
        <a href='{{route('podcast', ['id' => $item->id])}}' class="btn btn-primary">слушать</a>
      </div>
    </div>
      </div>
    
   @endforeach
   
   </div>
   {{$user['podcasts']->links()}}
</div>
@endsection

{{-- {{dd($user->id)}} --}}