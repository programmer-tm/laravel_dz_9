@extends('layouts.admin')
@section('title') Добавить отзыв - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить отзыв</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.feedback.store') }}">
                @csrf
                <div class="form-group">
                    <label for="category_id">Новость</label>
                    <select class="form-control" name="news_id">
                        @foreach($NewsList as $News)
                            <option value="{{ $News->id }}"
                            @if(old('news_id') === $News->id) selected @endif>{{ $News->title }}</option>
                        @endforeach
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
                    <label for="feedback">Отзыв</label>
                    <textarea class="form-control" name="feedback" id="feedback">{!! old('feedback') !!}</textarea>
                    @error('feedback')<div style="color:red;">{{$message}}</div>@enderror
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
