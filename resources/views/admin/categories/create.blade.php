@extends('admin.layouts.main')


@section('content')

<div class="col-lg-6 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">create category</h5>
												</div>
												<div class="panel-body">
													<form role="form" action="{{url('/admin/categories')}}" method="POST">
                                                   @csrf
														<div class="form-group">
															<label for="exampleInputEmail1">
																name
															</label>
															<input type="text" class="form-control" name="name" placeholder="Enter name">
														</div>

                                                        @error('name')
                                                            <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
														
														<button type="submit" class="btn btn-o btn-primary">
															Submit
														</button>
                                                        <a href="{{url('/admin/categories')}}" class="btn btn-info">back</a>
													</form>
												</div>
											</div>
										</div>
@endsection