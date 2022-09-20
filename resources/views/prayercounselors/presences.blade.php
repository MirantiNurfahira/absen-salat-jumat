@extends('prayercounselors.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex flex-column align-items-start">
                <h4>{{ $schedule->name}}</h4>
                <a class="btn btn-success" href="{{ URL::to('/prayercounselors/schedules/'.$schedule->id.'/presences/create') }}">Tambah Kehadiran Siswa</a>
			</div>
			<div class="card-body">
				<table id="table" class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Rombel</th>
							<th>Rayon</th>
							<th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->student_group }}</td>
                            <td>{{ $student->region->region_name }}</td>
                            <td>
                                {!! $student->presences->count() > 0 ?
                                $student->presences->first()['status'] === 1 ? '<span class="badge badge-success">Hadir</span>' : '<span class="badge badge-danger">Tidak Hadir</span>'
                                : '<span class="badge badge-warning">Belum Diabsen</span>'!!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>

@endsection
