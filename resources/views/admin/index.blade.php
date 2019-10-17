@extends('template.template')
@section('content')

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Maintenance User</h1>
		<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#admin_add">Add User</button>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				  <h6 class="m-0 font-weight-bold text-primary">User Table</h6>
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
								<th width="10%"><center>Role</center></th>
								<th width="20%"><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							@foreach($datas as $data)
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $data->name }}</td>
									<td><center>{{ $data->role }}</center></td>
									<td><center>
										<button class="btn btn-primary" data-toggle="modal" data-target="#admin_edit" onclick="edit('{{$data->id}}','{{$data->name}}','{{$data->email}}')">Edit</button>
										<a href="{{ url('admin/delete_user', $data->id) }}">
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete this User?')">
                                            	Delete
                                            </button>
                                        </a>
									</center></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="admin_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document" >
	        <form method="POST" action="{{url('/admin/store')}}" id="admin_add_form" name="admin_add_form">
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
	                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>

	                        <div class="col-md-6">
	                            <select class="form-control" id="role" name="role" required>
	                                <option value="">Select Role</option>
	                                <option value="Admin">Admin</option>
	                                <option value="Member">Member</option>
	                            </select>
	                        </div>
	                    </div>

	                    <div class="form-group row">
	                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

	                        <div class="col-md-6">
	                            <input id="password" type="password" class="form-control" name="password" required>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-primary" id="checkBtnAdd">Submit</button>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>

	<div class="modal fade" id="admin_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document" >
	        <form method="POST" action="{{url('/admin/update')}}" id="admin_edit_form" name="admin_edit_form">
	        {!! csrf_field() !!}
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title" id="exampleModalLongTitle">Edit</h4>
	                </div>
	                <div class="modal-body">
	                	<input type="text" name="id_edit" id="id_edit" hidden>
	                    <div class="form-group row">
	                        <label for="name_edit" class="col-md-4 col-form-label text-md-right">Name</label>

	                        <div class="col-md-6">
	                            <input id="name_edit" type="text" class="form-control" name="name_edit" required>
	                        </div>
	                    </div>

	                    <div class="form-group row">
	                        <label for="email_edit" class="col-md-4 col-form-label text-md-right">Email</label>

	                        <div class="col-md-6">
	                            <input id="email_edit" type="email" class="form-control" name="email_edit" required>
	                        </div>
	                    </div>

	                    <div class="form-group row">
	                        <label for="role_edit" class="col-md-4 col-form-label text-md-right">Role</label>

	                        <div class="col-md-6">
	                            <select class="form-control" id="role_edit" name="role_edit">
	                                <option value="">Select Role</option>
	                                <option value="Admin">Admin</option>
	                                <option value="Member">Member</option>
	                            </select><p style="color: red;"><small>*kosongi jika tidak ada perubahan</small></p>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-primary" style="width: 15%" id="checkBtnAdd">Submit</button>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>

@endsection

@section('script')

	<script type="text/javascript" src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>

	<script type="text/javascript">

		function edit(id, name, email){
	        $('#id_edit').val(id);
	        $('#name_edit').val(name);
	        $('#email_edit').val(email);
        }

	</script>

@endsection