@extends('layouts.app')

@section('content')
    <h3>Подкасты:</h3>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Название</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($podcasts as $podcast)
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
                                <form method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$podcast->id}}" name="podcast" id="podcast"/>
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
<h3>Пользователи:</h3>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                            <th scope="row">{{++$loop->index}}</th>
                            <td>
                                <img src="{{
                                    $user->user_image ? asset('images/' . $user->user_image) : asset('images/user.svg')
                                    }}" alt="" style="width: 50px; height:50px; border-radius: 50%;">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>
                                <form method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$user->id}}" name="user" id="user"/>
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
<h3>Комментарии:</h3>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Текст</th>
                        <th scope="col">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                            <th scope="row">{{++$loop->index}}</th>
                            <td>
                                <img src="{{
                                    $comment->user->user_image ? asset('images/' . $comment->user->user_image) : asset('images/user.svg')
                                    }}" alt="" style="width: 50px; height:50px; border-radius: 50%;">
                            </td>
                            <td>{{$comment->user->name}}</td>
                            <td>{{$comment->text}}</td>
                            <td>
                                <form method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$comment->id}}" name="comment" id="comment"/>
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
@endsection