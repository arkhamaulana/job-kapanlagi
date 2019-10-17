@extends('template.template')
@section('content')

@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Detail Data User</h1>
</div>

<!-- Content Row -->
<div class="row">
	<div class="col-xl-12">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			  <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
			  <div class="dropdown no-arrow">
			    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
			    </a>
			  </div>
			</div>
			<!-- Card Body -->
			<div class="card-body">
                <form method="POST" action="{{url('/data_user/update')}}" id="data_add_form" name="data_add_form" enctype="multipart/form-data">
                    @if(Auth::User()->role == 'Admin')
                        <fieldset>
                    @else
                        <fieldset disabled>
                    @endif
                        {!! csrf_field() !!}
                        @foreach($result as $detail)
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLongTitle">Update</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="id_file" id="id_file" value="{{ $name_file }}" hidden>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ $detail['name'] }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $detail['email'] }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="birthday" class="col-md-4 col-form-label text-md-right">Birthday</label>

                                        <div class="col-md-6">
                                            <input id="birthday" type="date" class="form-control" name="birthday" value="{{ $detail['birthday'] }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="number" class="form-control" name="phone" value="{{ $detail['phone'] }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                                        <div class="col-md-6">
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="">Select Gender</option>
                                                @if($detail['gender'] == 'Male')
                                                    <option value="Male" selected="">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                @elseif($detail['gender'] == 'Female')
                                                    <option value="Male">Male</option>
                                                    <option value="Female" selected="">Female</option>
                                                    <option value="Other">Other</option>
                                                @else
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other" selected="">Other</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    @if(Auth::User()->role == 'Admin')
                                        <div class="form-group row">
                                            <label for="photo" class="col-md-4 col-form-label text-md-right">Upload Photo</label>

                                            <div class="col-md-6">
                                                <input id="photo" type="file" name="photo">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="photos" class="col-md-4 col-form-label text-md-right">Photo</label>

                                        <div class="col-md-6">
                                            @if($detail['name_file'] == 'NULL')
                                                <img src="{{url('/image/default.jpg')}}" width="50%">
                                            @else
                                                <img src="{{url('/image/'.$detail['name_file'])}}" width="50%">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::User()->role == 'Admin')
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="checkBtnAdd">Update</button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </fieldset>
                </form>
			</div>
		</div>
	</div>
</div>

@endsection