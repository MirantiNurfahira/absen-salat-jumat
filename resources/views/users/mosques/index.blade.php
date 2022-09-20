@extends('users.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Masjid</h4>
                <a class="btn btn-success" href="{{ route('mosques.create') }}">Add</a>
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
                            <th>Nama Masjid</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($mosques as $mosque)
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $mosque->mosque_name }}</td>
                                <td>{{ $mosque->location }}</td>
                                <td>
                                    <form action="{{ route('mosques.destroy',$mosque->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ route('mosques.edit',$mosque->id) }}">Edit</a>
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

    {!! $mosques->links() !!}
        
@endsection