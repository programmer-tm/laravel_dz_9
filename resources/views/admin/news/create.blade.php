@extends('layouts.admin')
@section('title') Добавить новость - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить новость</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.news.store') }}">
                @csrf
                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                            @if(old('category_id') === $category->id) selected @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Заголовок новости</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                    @error('title')<div style="color:red;">{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="author">Автор новости</label>
                    <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}">
                    @error('author')<div style="color:red;">{{$message}}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="description">Описание новости</label>
                    <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection