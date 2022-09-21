@extends('users.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex flex-column align-items-start">
                <h4>{{ $schedule->name}}</h4>
                <p>Detail pendamping solat yang sudah dan belum melakukan absensi di jadwal ini</p>
			</div>
			<div class="card-body">
				<table id="table" class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Pendamping Untuk</th>
							<th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prayerCounselors as $counselor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $counselor->name }}</td>
                            <td>{{ $counselor->prayerCounselorRegions->pluck('region_name')->join(',')}}</td>
                            <td>{!! $counselor->presences->count() > 0 ? '<span class="badge badge-success">Sudah</span>' : '<span class="badge badge-danger">Belum</span>'!!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>

@endsection
