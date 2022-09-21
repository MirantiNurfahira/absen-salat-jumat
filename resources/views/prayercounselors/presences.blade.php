@extends('prayercounselors.dashboard_admin')
@section('content')

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex flex-column align-items-start">
                <h4>{{ $schedule->name}}</h4>
                <a class="btn btn-success d-none" href="{{ URL::to('/prayercounselors/schedules/'.$schedule->id.'/presences/create') }}">Tambah Kehadiran Siswa</a>
			</div>
			<div class="card-body">
                <div class="alert alert-success d-none" id="update-alert" role="alert">
                    Data berhasil disimpan
                    <button type="button" class="close" id="close-alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                        @foreach ($groupedStudents as $regionName => $students)
                        <tr>
                            <td colspan="5" class=" text-dark"><h6>Rayon {{$regionName}}</h6></td>
                        </tr>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->student_group }}</td>
                                <td>{{ $student->region->region_name }}</td>
                                <td class="d-flex align-items-center justify-content-start">
                                    @if($student->presences->count() === 0)
                                        <div class="form-check mr-2">
                                            <input class="form-check-input" data-student-id="{{$student->id}}" value="1" type="radio" name="flexRadio{{$student->id}}" id="flexRadioTrue{{$student->id}}">
                                            <label class="form-check-label" for="flexRadioTrue{{$student->id}}">
                                                <span class="badge badge-success">Hadir</span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" data-student-id="{{$student->id}}" value="0" type="radio" name="flexRadio{{$student->id}}" id="flexRadioFalse{{$student->id}}">
                                            <label class="form-check-label" for="flexRadioFalse{{$student->id}}">
                                                <span class="badge badge-danger">Tidak Hadir</span>
                                            </label>
                                        </div>
                                    @else
                                        <div class="form-check mr-2">
                                            <input class="form-check-input" data-student-id="{{$student->id}}" value="1" type="radio" name="flexRadio{{$student->id}}" id="flexRadioTrue{{$student->id}}" @if($student->presences->first()['status'] === 1) checked @endif>
                                            <label class="form-check-label" for="flexRadioTrue{{$student->id}}">
                                                <span class="badge badge-success">Hadir</span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" data-student-id="{{$student->id}}" value="0" type="radio" name="flexRadio{{$student->id}}" id="flexRadioFalse{{$student->id}}" @if($student->presences->first()['status'] === 0) checked @endif>
                                            <label class="form-check-label" for="flexRadioFalse{{$student->id}}">
                                                <span class="badge badge-danger">Tidak Hadir</span>
                                            </label>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
			</div>

@endsection

@section('javascript')

<script type="text/javascript">
  const scheduleId = "{{ $schedule->id}}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#close-alert').click(() => {
        $('#update-alert').addClass('d-none');
    });


  $('.form-check-input').change((e) => {
      let studentId = e.currentTarget.dataset.studentId;
      let status = e.currentTarget.value;

      let baseUrl = "{!! URL::to('/prayercounselors/schedules/update') !!}"

      $('#update-alert').addClass('d-none');

      $.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: baseUrl,
                data: {
                    studentId,
                    status,
                    scheduleId
                },
				success: function(data){
                    $('#update-alert').removeClass('d-none');
				},
				error: function(error){
					console.log(error);
				}
			})

// ─────▄██▀▀▀▀▀▀▀▀▀▀▀▀▀██▄─────
// ────███───────────────███────
// ───███─────────────────███───
// ──███───▄▀▀▄─────▄▀▀▄───███──
// ─████─▄▀────▀▄─▄▀────▀▄─████─
// ─████──▄████─────████▄──█████
// █████─██▓▓▓██───██▓▓▓██─█████
// █████─██▓█▓██───██▓█▓██─█████
// █████─██▓▓▓█▀─▄─▀█▓▓▓██─█████
// ████▀──▀▀▀▀▀─▄█▄─▀▀▀▀▀──▀████
// ███─▄▀▀▀▄────███────▄▀▀▀▄─███
// ███──▄▀▄─█──█████──█─▄▀▄──███
// ███─█──█─█──█████──█─█──█─███
// ███─█─▀──█─▄█████▄─█──▀─█─███
// ███▄─▀▀▀▀──█─▀█▀─█──▀▀▀▀─▄███
// ████─────────────────────████
// ─███───▀█████████████▀───████
// ─███───────█─────█───────████
// ─████─────█───────█─────█████
// ───███▄──█────█────█──▄█████─
// ─────▀█████▄▄███▄▄█████▀─────
// ──────────█▄─────▄█──────────
// ──────────▄█─────█▄──────────
// ───────▄████─────████▄───────
// ─────▄███████───███████▄─────
// ───▄█████████████████████▄───
// ─▄███▀───███████████───▀███▄─
// ███▀─────███████████─────▀███
// ▌▌▌▌▒▒───███████████───▒▒▐▐▐▐
// ─────▒▒──███████████──▒▒─────
// ──────▒▒─███████████─▒▒──────
// ───────▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒───────
// ─────────████░░█████─────────
// ────────█████░░██████────────
// ──────███████░░███████───────
// ─────█████──█░░█──█████──────
// ─────█████──████──█████──────
// ──────████──████──████───────
// ──────████──████──████───────
// ──────████───██───████───────
// ──────████───██───████───────
// ──────████──████──████───────
// ─██────██───████───██─────██─
// ─██───████──████──████────██─
// ─███████████████████████████─
// ─██─────────████──────────██─
// ─██─────────████──────────██─
// ────────────████─────────────
  })
</script>
@endsection
