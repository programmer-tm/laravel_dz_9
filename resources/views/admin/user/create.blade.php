@extends('layouts.admin')
@section('title') Добавить пользователя - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить пользователя</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.user.store') }}">
                @csrf
                <div class="form-group">
                    <label for="category_id">Статус</label>
                    <select class="form-control" name="is_admin">
                        <option value="0" selected>Пользователь</option>
                        <option value="1">Админ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    @error('name')<div style="color:red;">{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    @error('email')<div style="color:red;">{{$message}}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}">
                    @error('password')<div style="color:red;">{{$message}}</div>@enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
