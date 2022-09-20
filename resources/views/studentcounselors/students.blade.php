@extends('studentcounselors.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex flex-column align-items-start">
                <h4>Daftar Siswa Rayon</h4>
			</div>
			<div class="card-body">
				<table id="table" class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nis</th>
							<th>Nama</th>
							<th>Rombel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupedStudents as $name => $students)
                            <tr>
                                <td class="" colspan="4"><strong>{{$name}}</strong></td>
                            </tr>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->student_group }}</td>
                            </tr>
                        @endforeach
                        @endforeach

                    </tbody>
                </table>
			</div>

@endsection
