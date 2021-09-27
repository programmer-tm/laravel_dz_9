@extends('layouts.admin')
@section('content')
@section('title') Список пользователей - @parent @stop

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Список пользователей</h1>
		<a href="{{ route('admin.user.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
					class="fas fa-plus fa-sm text-white-50"></i> Добавить пользователя</a>
	</div>
<div class="row">
<div class="col-md-12">
@include('inc.messages')
<div class="table-responsive">
 <table class="table table-bordered">
	<thead>
	 <tr>
	  <th>#ID</th>
	  <th>Имя</th>
	  <th>E-mail</th>
	  <th>Роль на сайте</th>
	  <th>Управление</th>
	 </tr>
	</thead>

		 <tbody>
		 @forelse($UserList as $User)
		 <tr>
			 <td>{{ $User->id }}</td>
			 <td>{{ $User->name }}</td>
			 <td>{{ $User->email }}</td>
			 <td>@if ($User->is_admin)
				 Админ
				 @else 
				 Пользователь
				 @endif
			</td>
			 <td>
				  <a href="{{ route('admin.user.edit', ['user' => $User->id]) }}">Ред.</a>
				  &nbsp;
				  <a href="javascript:;" class="delete" rel="{{ $User->id }}">Уд.</a>
			 </td>
		 </tr>
		 @empty
			 <h2>Отзывов нет</h2>
		 @endforelse
		 </tbody>

 </table>
</div>
</div>
</div>
@endsection
@push('js')
<script type="text/javascript">
        $(function(){    
			$(".delete").on('click', function(){
			var id = $(this).attr("rel");
				if (confirm("Подтвердите удаление записи с id: "+id)){
					$.ajax({
						type: "delete",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: "/admin/user/"+id,
						success: function(response){
							alert("Киллер отработал!");
							location.reload();
						},
						error: function(){
							console.log(error);
						}
					});
				}
			});
        });
    </script>
@endpush