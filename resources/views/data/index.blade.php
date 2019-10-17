@extends('template.template')
@section('content')

@if(session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

@if(session('alert-danger'))
    <div class="alert alert-danger">
        {{ session('alert-danger') }}
    </div>
@endif

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">List Data User</h1>
	@if(Auth::User()->role == 'Admin')
		<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#data_add">Add Data User</button>
	@endif
</div>

<!-- Content Row -->
<div class="row">
	<div class="col-xl-12">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			  <h6 class="m-0 font-weight-bold text-primary">Data User Table</h6>
			  <div class="dropdown no-arrow">
			    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
			    </a>
			  </div>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%"><center>No.</center></th>
							<th><center>Name</center></th>
							<th width="10%"><center>Email</center></th>
							<th width="20%"><center>Birthday</center></th>
							<th width="20%"><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($result as $data)
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $data['name'] }}</td>
								<td><center>{{ $data['email'] }}</center></td>
								<td><center>{{ $data['birthday'] }}</center></td>
								<td><center>
									@if(Auth::User()->role == 'Admin')
										<a href="{{ url('/data_user/detail', $data['name_file']) }}">
											<button class="btn btn-primary">
	                                            Update
	                                        </button>
										</a>
                                        @if($data['image_path'] == 'NULL')
                                            <a href="{{ url('data_user/delete', $data['name_file'].'NULL') }}">
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Data?')">
                                                    Delete {{ $data['name_file'].'NULL' }}
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ url('data_user/delete', $data['image_path']) }}">
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Data?')">
                                                    Delete {{ $data['image_path'] }}
                                                </button>
                                            </a>
                                        @endif
									@else
										<a href="{{ url('/data_user/detail', $data['name_file']) }}">
											<button class="btn btn-primary">
	                                            Detail
	                                        </button>
										</a>
									@endif
								</center></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="data_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <form method="POST" action="{{url('/data_user/store')}}" id="data_add_form" name="data_add_form" enctype="multipart/form-data">
        {!! csrf_field() !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Add</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="birthday" class="col-md-4 col-form-label text-md-right">Birthday</label>

                        <div class="col-md-6">
                            <input id="birthday" type="date" class="form-control" name="birthday" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                        <div class="col-md-6">
                            <input id="phone" type="number" class="form-control" name="phone" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                        <div class="col-md-6">
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="photo" class="col-md-4 col-form-label text-md-right">Upload Photo</label>

                        <div class="col-md-6">
                            <input id="photo" type="file" name="photo">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                	<input type="reset" class="btn btn-default" value="Reset the form">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="checkBtnAdd">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection