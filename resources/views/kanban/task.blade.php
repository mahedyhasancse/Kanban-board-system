@extends('layouts.backend.app')

@section('content')
<div class="row">
	<div class="container">
	<div class="card p-4 m-4">
			<div class="col-md-12">
				<form action="{{route('store.task')}}" method="POST">
					@csrf
					<div class="col-md-12 bg-primary p-4 text-white text-center">
						<h3>Add Board</h3>
					</div>
					<hr>
					<div class="form-group">
						<div class="col-md-8">
							<label for="">Board:</label>
							<select name="board_id" id="board_id" class="form-control" required>
								<option value="">Choose a Board</option>
								@foreach(App\Board::where('user_id',auth()->user()->id)->get() as $board)
								<option value="{{$board->id}}">{{$board->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-8">
							<label for="name">Project Name:</label>
							<input type="text" name="name" id="name" class="form-control" required>
						</div>
						<div class="col-md-8">
							<label for="name"> Description:</label> <br>

							<textarea name="description" id="" cols="50" rows="8" class="form-control" required></textarea>
						</div>

						<input type="submit" value="Submit" class="btn btn-primary mt-4">
					</div>
				</form>
			</div>
			<div class="col-md-12">
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
										<th>Title</th>
										<th>Description</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									@foreach(auth()->user()->tasks as $t)
									<tr>
										<td>{{$t->board->name}}</td>
										<td>{{$t->title}}</td>
										<td>{{$t->description}}</td>
										<td>
											<p>{{$t->status->title}}</p>
										</td>
										<td>
											<a href="" class="btn btn-success btn-sm m-2" data-toggle="modal" data-target="#exampleModal{{$t->id}}">Edit</a>

											<!-- Button trigger modal -->


											<!-- Modal -->
											<div class="modal fade" id="exampleModal{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>

														</div>
														<div class="modal-body">
															<form action="{{route('task.update',$t->id)}}" method="POST">
																@csrf
																@method('patch')
																<div class="col-md-12 bg-primary p-4 text-white text-center">
																	<h3>Add Board</h3>
																</div>
																<hr>
																<div class="form-group">
																	<div class="col-md-8">
																		<label for="">Board:</label>
																		<select name="board_id" id="board_id" class="form-control" required>
																			<option value="">Choose a Board</option>
																			@foreach(App\Board::where('user_id',auth()->user()->id)->get() as $board)
																			<option value="{{$board->id}}" {{$board->id==$t->board->id ? 'selected': ''}}>{{$board->name}}</option>
																			@endforeach
																		</select>
																	</div>
																	<div class="col-md-8">
																		<label for="name">Project Name:</label>
																		<input type="text" name="name" id="name" class="form-control" value="{{$t->title}}" required>
																	</div>
																	<div class="col-md-8">
																		<label for="name"> Description:</label> <br>

																		<textarea name="description" id="" cols="50" rows="8" class="form-control" value="{{$t->description}}" required>{{$t->description}}</textarea>
																	</div>

																	<button type="submit" class="btn btn-primary mt-2">Save changes</button>

																</div>
															</form>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>

											<form action="{{route('delete.task',$t->id)}}" method="POST">
												@csrf
												@method('delete')
												<button type="submit" class="btn btn-danger btn-sm m-2">Delete</button>

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
@endsection
