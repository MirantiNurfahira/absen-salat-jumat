@extends('users.dashboard_admin')
@section('content')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Rayon</h4>
                <a class="btn btn-success" href="{{ route('regions.create') }}">Add</a>
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
                            <th>Rayon</th>
							<th>Masjid</th>
							<th>Pembimbing Rayon</th>
							<th>Guru Pendamping</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($regions as $region)
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $region->region_name }}</td>
								<td>{{ $region->mosque->mosque_name ?? '-' }}</td>
								<td>{{ $region->studentCounselor->name ?? '-' }}</td>
								<td>{{ $region->prayerCounselor->name ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('regions.destroy',$region->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ route('regions.edit',$region->id) }}">Edit</a>
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

    {!! $regions->links() !!}

@endsection
