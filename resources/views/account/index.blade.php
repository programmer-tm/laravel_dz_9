@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Панель пользователя') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
		                <h3>Привет, {{ Auth::user()->name }}</h3>
		            @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.index') }}" style="color: red;">В админку</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
