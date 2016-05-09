@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-sm-4 col-md-2 hidden-xs">
				@include('user.global.sidebars._sidebar-left')
			</div>
			<div class="col-md-10">		
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">{{ $page_title }}</h2>
					</header>
					<div class="panel-body">
						{!! Form::model($quiz, ['route' => ['quizzes.update', $quiz], 'method' =>'put', 'role' => 'form']) !!}
							@include('user.quizzes._form', ['model' => $quiz])
						{!! Form::close() !!}
					</div>
				</div>
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">Bagikan ke Tiap Kelas</h2>
					</header>
					<div class="panel-body">
						<div class="share-to">					
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#quizzesModal"><i class="fa fa-share-alt"></i> Bagikan</button>
						</div>
						<table class="table table-stripped">
							<thead>
								<tr>
									<th>Nama Kelas</th>
									<th>Batal</th>
								</tr>
							</thead>
							<tbody>							
								@forelse($quiz->classrooms as $classroom)
									<tr>
										<td>{{ $classroom->classname }}</td>
										<td>
											{!! Form::open(['route' => 'quizzes.detach']) !!}
												{!! Form::hidden('classroom_id', $classroom->id) !!}
												{!! Form::hidden('quiz_id', $quiz->id) !!}
												{!! Form::submit('Batal', ['class' => 'btn btn-danger btn-sm']) !!}
											{!! Form::close() !!}
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="3" class="text-center">Belum pernah dibagikan.</td>
									</tr>
								@endforelse
							</tbody>
							<tfoot>
								<tr>
									<th>Nama Kelas</th>
									<th>Batal</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="quizzesModal" tabindex="-1" role="dialog" aria-labelledby="shareQuiz">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="shareQuiz">Bagikan quiz ini</h4>
				</div>
				{!! Form::open(['route' => ['quizzes.attach'], 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
					<div class="modal-body clearfix">
						<div class="col-md-12">
							{!! Form::hidden('quiz_id', $quiz->id) !!}
							<div class="form-group {{ $errors->has('classrooms') ? 'has-error' : '' }}"> 
							{!! Form::select('classrooms[]', App\Models\Classroom::whereNotIn('id', $ids)->get()->pluck('classname', 'id'), null, ['class' => 'select2 form-control', 'multiple']) !!}
							{!! $errors->first('classrooms', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
					</div>
					<div class="modal-footer">
						{!! Form::button('Batal', ['class' => 'btn btn-link', 'data-dismiss' => 'modal']) !!}
						{!! Form::button('<i class="fa fa-share-alt"></i> Bagikan Quiz', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection