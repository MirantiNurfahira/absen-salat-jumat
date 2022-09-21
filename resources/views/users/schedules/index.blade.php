@extends('users.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Jadwal Salat Jumat</h4>
                <a class="btn btn-success" href="{{ URL::to('/schedules/create-page') }}">Add</a>
			</div>
			<div class="card-body">
				@if (session('sukses'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{ session('sukses') }}
				</div>
				@elseif(session('gagal'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{ session('gagal') }}
				</div>
				@endif

				@if (count($errors) > 0)
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<table id="table" class="table">
					<thead>
						<tr>
                            <th>No</th>
                            <th>Nama Jadwal</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $schedule->name }}</td>
                            <td>{{ Carbon\Carbon::parse($schedule->schedule_date)->locale('id')->isoFormat('dddd, Do MMMM YYYY, h:mm:ss') }}</td>
                            <td>
                                <form action="{{ URL::to('schedules/destroy/'.$schedule->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ URL::to('schedules/edit-page/'.$schedule->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

    {!! $schedules->links() !!}

@endsection
