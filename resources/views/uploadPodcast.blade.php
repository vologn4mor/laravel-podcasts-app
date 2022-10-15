@extends('layouts.app')

@section('content')
<div class="container">
   <h1>Upload</h1>

   <form method="POST" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="formGroupExampleInput">Название подкаста</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror " id="formGroupExampleInput" placeholder="Введите название подкаста" name="name">
    @error('name')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Описание подкаста</label>
    <textarea type="text" class="form-control @error('about') is-invalid @enderror " id="formGroupExampleInput2" placeholder="Введите описание подкаста" name="about"></textarea>
    @error('about')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
  </div>
 <div class="mb-3">
  <label for="image" class="form-label">Загрузка обложки подкаста</label>
  <input class="form-control @error('image') is-invalid @enderror " type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif">
  @error('image')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
  <label for="image" class="form-label">Загрузка файла подкаста</label>
  <input class="form-control @error('podcast') is-invalid @enderror " type="file" id="podcast" name="podcast" accept="audio/mp3, audio/wav">
  @error('podcast')
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @enderror
</div>
<button class="btn btn-primary">Загрузить</button>
</form>
</div>
@endsection