@extends('users.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Siswa</h4>
                <a class="btn btn-success" href="{{ route('students.create') }}">Add</a>
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
                            <th>Nama</th>
							<th>Rayon</th>
							<th>Rombel</th>
							<th>NIS</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($students as $student)
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $student->name }}</td>
								<td>{{ $student->region->region_name }}</td>
								<td>{{ $student->student_group }}</td>
								<td>{{ $student->nis }}</td>
                                <td>
                                    <form action="{{ route('students.destroy',$student->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </tbody>
					        @endforeach
				</table>
			</div>
		</div>
	</div>
</div>

    {!! $students->links() !!}
        
@endsection