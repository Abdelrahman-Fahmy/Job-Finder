@extends('admin.layouts.main')


@section('content')

<div class="container-fluid container-fullw">
							<div class="row">
							@foreach(['success','danger','info'] as $atype)
							@if(Session::has('alert-'.$atype))
							<div class="col-md-12 mb-4">
							<div class="alert alert-{{$atype}}">
							{{Session::get('alert-'.$atype)}}
							</div>
							</div>
							@endif	
							@endforeach

							@if($categories->count()===0)

							<div class="col-md-12">
								<div class="alert alert-danger">
									<div class="text-danger">
										there in no categories
									</div>
								</div>
							</div>
							@else

								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">CAT<span class="text-bold">egories</span></h5>

									<form action="{{url('/admin/categories')}}" method="GET">
										@csrf
										<div class="input-group">
										<input type="text" name="keywords" placeholder="search" class="form-control" value="{{(request()->has('keywords'))?request()->input()['keywords']: ''}}">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">search</button>
										</span>
										</div>
									</form>

									<table class="table table-striped table-hover" id="sample-table-2">
										<thead>
											<tr>
												<th class="center">Id</th>
												@if(request()->has('orderBy') && request('orderBy')=='name' && !request()->has('sortOrder'))

												<th><a href="{{url('/admin/categories')}}?orderBy=name&sortOrder=desc&{{(request()->has('keywords'))?'keywords='.request()->input()['keywords']: ''}}">Name</a> </th>
												@else
												<th><a href="{{url('/admin/categories')}}?orderBy=name&{{(request()->has('keywords'))?'keywords='.request()->input()['keywords']: ''}}">Name</a> </th>
												@endif


												@if(request()->has('orderBy') && request('orderBy')=='created_at' && !request()->has('sortOrder'))
												<th><a href="{{url('/admin/categories')}}?orderBy=created_at&sortOrder=desc&{{(request()->has('keywords'))?'keywords='.request()->input()['keywords']: ''}}">Created At</a> </th>
												@else
												<th><a href="{{url('/admin/categories')}}?orderBy=created_at&{{(request()->has('keywords'))?'keywords='.request()->input()['keywords']: ''}}">Created At</a> </th>
												@endif
												

												@if(request()->has('orderBy') && request('orderBy')=='updated_at' && !request()->has('sortOrder'))
												<th><a href="{{url('/admin/categories')}}?orderBy=updated_at&sortOrder=desc&{{(request()->has('keywords'))?'keywords='.request()->input()['keywords']: ''}}">Updated At</a> </th>
												@else
											<th><a href="{{url('/admin/categories')}}?orderBy=updated_at&{{(request()->has('keywords'))?'keywords='.request()->input()['keywords']: ''}}">Updated At</a> </th>
												@endif
												
											<th></th>
											</tr>
										</thead>
										<tbody>

                                        @foreach($categories as $category)
											<tr>
												<td class="center">{{$category->id}}</td>
												<td>{{$category->name}}</td>
												<td class="hidden-xs">{{$category->created_at}}</td>
												<td class="hidden-xs">
												
                                                {{$category->updated_at}}
												</td>
											
												<td class="center">
												<div class="visible-md visible-lg hidden-sm hidden-xs">
													<a href="{{url('/admin/categories/'.$category['id'].'/edit')}}" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
													

													<form action="{{url('/admin/categories/'.$category['id'])}}" method="POST" >

													@csrf
													{{method_field('DELETE')}}
													<button   onclick="return confirm('are you sure?');" class="btn btn-danger btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></button>
													</form>
													
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group" dropdown="">
														<button type="button" class="btn btn-primary btn-sm dropdown-toggle" dropdown-toggle="">
															<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
														</button>
														<ul class="dropdown-menu pull-right dropdown-light" role="menu">
															<li>
																<a href="#">
																	Edit
																</a>
															</li>
															
															<li>
																<a href="#">
																	Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
											@endforeach
										</tbody>
									</table>
									{{$categories->appends(request()->input())->links()}}
								</div>
								@endif
							</div>
						</div>
@endsection
