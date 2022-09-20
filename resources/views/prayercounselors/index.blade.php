@extends('prayercounselors.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex flex-column">
                <h4>Jadwal Salat Jumat</h4>
                <p>Bapak terdaftar sebagai pendamping salat jumat untuk rayon {{$regionNames}}</p>
			</div>
			<div class="card-body">
				<table id="table" class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Jadwal</th>
							<th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->name }}</td>
                                <td>{{ Carbon\Carbon::parse($schedule->schedule_date)->locale('id')->isoFormat('dddd, Do MMMM YYYY, h:mm:ss') }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ URL::to('prayercounselors/schedules/detail/'.$schedule->id) }}">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>

@endsection
