@extends('layouts.app')

@section('content')
<div class="container">
   <h1>Изменение профиля</h1>

   <form method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
  <div class="form-group">
    <label for="formGroupExampleInput">Имя пользователя</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror " id="formGroupExampleInput" placeholder="Введите новое имя" name="name" value="{{$user->name}}">
    @error('name')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Описание профиля</label>
    <textarea type="text" class="form-control @error('about') is-invalid @enderror " id="formGroupExampleInput2" placeholder="Введите новое описание профиля" name="about">{{$user->about}}</textarea>
    @error('about')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
  <label for="image" class="form-label">Загрузка аватарки</label>
  <input class="form-control @error('image') is-invalid @enderror " type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif">
  @error('image')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
</div>
<button class="btn btn-primary mt-3">Загрузить</button>
</form>
</div>
@endsection