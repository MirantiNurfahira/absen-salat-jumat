@extends('users.dashboard_admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('regions.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('regions.update',$region->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Rayon</strong>
                    <input type="text" name="region_name" class="form-control" value="{{$region->region_name}}" placeholder="Rayon">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Masjid:</strong>
               <select class="form-control" name="mosque_id">
                <option value="-" selected disabled>-</option>

                  @foreach ($mosques as $mosque)
                     <option value="{{ $mosque->id }}" @if ($region->mosque_id === $mosque->id) selected @endif >{{ $mosque->mosque_name }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Pembimbing Rayon:</strong>
               <select class="form-control" name="student_counselor_id">
                <option value="-" selected disabled>-</option>

                  @foreach ($studentCounselors as $studentcounselor)
                     <option value="{{ $studentcounselor->id }}" @if ($region->student_counselor_id === $studentcounselor->id) selected @endif>{{ $studentcounselor->name }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Guru Pendamping:</strong>
               <select class="form-control" name="prayer_counselor_id">
                <option value="-" selected disabled>-</option>

                  @foreach ($prayerCounselors as $prayercounselor)
                     <option value="{{ $prayercounselor->id }}" @if ($region->prayer_counselor_id === $prayercounselor->id) selected @endif>{{ $prayercounselor->name }}</option>
                  @endforeach
               </select>
            </div>
         </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
