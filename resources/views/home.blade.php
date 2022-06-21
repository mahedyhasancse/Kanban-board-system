@extends('layouts.backend.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Dashboard') }}</div>

				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<form action="{{route('store.board')}}" method="POST">
						@csrf
						<div class="col-md-12 bg-primary p-4 text-white text-center">
							<h3>Add Board</h3>
						</div>
						<hr>
						<div class="form-group">
							<div class="col-md-8">
								<label for="name">Board Name:</label>
								<input type="text" name="name" id="name" class="form-control" required>
							</div>
							<div class="col-md-8">
								<label for="access_id">Access ID:</label>
								<input type="text" name="access_id" id="access_id" class="form-control" requireds>
							</div>
							<div class="col-md-4">
								<label for="access_id">Blog Color:</label>
								<input type="color" name="color" id="color" class="form-control" required>
							</div>
							<input type="submit" value="Submit" class="btn btn-primary mt-4">
						</div>
					</form>

					<div class="row">
						<div class="col-md-12">
							<hr>
							<h4>All Boards</h4>
							<hr>
							<div class="col-md-12 mt-4">
								<table id="myTable" class="table  text-center table-responsive" cellpadding="8">
									<thead>
										<tr>
											<th>Board Name</th>
											<th>Access ID</th>
											<th>Color</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										@foreach(App\Board::where('user_id',auth()->user()->id)->latest()->get() as $board)
										<tr>
											<td>{{ $board->name }}</td>
											<td>{{ $board->access_id }}</td>
											<td>{{ $board->color }}</td>
											<td>
												<a class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal{{$board->id}}">Edit</a>
												<!-- Modal -->
												<div class="modal fade" id="exampleModal{{$board->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Edit Board</h5>

															</div>
															<div class="modal-body">
																<form action="{{route('update.board',$board->id)}}" method="POST">
																	@csrf
																	@method('patch')
																	<div class="col-md-12 bg-primary p-4 text-white text-center">
																		<h3>Add Board</h3>
																	</div>
																	<hr>
																	<div class="form-group">
																		<div class="col-md-8">
																			<label for="name">Board Name:</label>
																			<input type="text" name="name" id="name" value="{{$board->name}}" class="form-control" required>
																		</div>
																		<div class="col-md-8">
																			<label for="access_id">Access ID:</label>
																			<input type="text" name="access_id" id="access_id" class="form-control" value="{{$board->access_id}}" requireds>
																		</div>
																		<div class="col-md-4">
																			<label for="access_id">Blog Color:</label>
																			<input type="color" name="color" id="color" class="form-control" value="{{$board->color}}" required>
																		</div>
																		<button type="submit" class="btn btn-primary">Save changes</button>
																	</div>
																</form>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>


												<form action="{{route('delete.board',$board->id)}}" method="Post">
													@csrf
													@method('Delete')
													<button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>

												</form>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>
</div>
</div>
@endsection
