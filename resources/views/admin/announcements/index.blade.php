@extends('admin.app')

@section('page_description')
    <a href="{{ route('lms-admin.announcements.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')

<div class="row">
	<div class="pull-right col-xs-6 col-sm-4 col-md-3">
		{!! Form::open(['method' => 'get']) !!}
			<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					{!! Form::text( 'q', isset($q) ? $q : null, ['class' => 'form-control', 'placeholder' => 'Cari pengumuman...']) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tabel Pengumuman</h3>
			</div>
			<div class="box-body">
				<table id="announcement-datatable" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Judul</th>
							<th>Konten</th>
							<th>Urgensi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($announcements as $announcement)
							<tr>
	              <td>
	              	<div>
	              		<a href="{{ route('lms-admin.announcements.edit', $announcement->id) }}">{{ $announcement->title }}</a>
	              	</div>
	              	<div>
	              		<a href="{{ route('lms-admin.announcements.edit', $announcement->id) }}" class="btn btn-flat btn-link btn-xs">Edit</a>
										{!! Form::open(['route' => ['lms-admin.announcements.destroy', $announcement->id], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
	  									{!! Form::submit('Hapus', ['class'=>'btn btn-flat btn-link btn-link-danger btn-xs warning-delete']) !!}
	  								{!! Form::close() !!}
	              	</div>
	              </td>
	              <td>
	              	{!! substr($announcement->content, 0, 120) !!} 
	             		@if( strlen($announcement->content) > 120 ) 
	             			{{ '...' }}
	           			@endif
	         			</td>
	                <td>{{ $announcement->urgensi }}</td>
	            </tr>
            @endforeach
	        </tbody>
	        <tfoot>
						<tr>
							<th>Judul</th>
							<th>Konten</th>
							<th>Urgensi</th>
						</tr>
					</tfoot>
				</table>
				<div class="pull-right"> 
					{!! $announcements->links() !!}
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection