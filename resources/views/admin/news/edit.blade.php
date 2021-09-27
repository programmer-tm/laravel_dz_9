@extends('layouts.admin')
@section('title') Изменить новость - @parent @stop

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Изменить новость</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
        @include('inc.messages')
            <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}">
                @csrf
                @method('put')
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
                    <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}">
                    @error('title')<div style="color:red;">{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="author">Автор новости</label>
                    <input type="text" class="form-control" name="author" id="author" value="{{ $news->author }}">
                    @error('author')<div style="color:red;">{{$message}}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="description">Описание новости</label>
                    <textarea class="form-control" name="description" id="description">{!! $news->description !!}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

@endsection