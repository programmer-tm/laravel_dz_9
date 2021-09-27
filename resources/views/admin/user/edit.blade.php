@extends('layouts.admin')
@section('title') Изменить пользователя - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Изменить пользователя</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
        <form method="post" action="{{ route('admin.user.update', ['user' => $user]) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="category_id">Статус</label>
                    <select class="form-control" name="is_admin">
                        <option value="0" @if (!$user->is_admin) selected @endif>Пользователь</option>
                        <option value="1" @if ($user->is_admin) selected @endif>Админ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                    @error('name')<div style="color:red;">{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    @error('email')<div style="color:red;">{{$message}}</div>@enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
