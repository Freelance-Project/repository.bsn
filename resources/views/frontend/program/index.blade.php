@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
	<div class="container">
    	<div class="row table-list">
        	<div class="col-md-12 text-center">
            	<h2 class="mid-title">Daftar Program Pendukung</h2>
                <span style="font-style:italic">Silahkan menghubungi admin untuk mendownload</span>
                <div class="table-responsive">
                	<table class="table table-striped">
                    	<thead> 
                        	<tr>
                            	<th>No</th>
                                <th>Nama Program</th>
                                <th>Status</th>
                            </tr>
                       	</thead>
                        <tbody class="text-left">
                            @if ($program)
                            @foreach($program as $key => $val)
                            <tr>
                            	<td>{{$key+1}}</td>
                                <td>{{$val->name}}</td>
                                <td>{{$val->status}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{--
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>--}}
            </div><!--end.col-->
        </div><!--end.row-->
    </div>
</div>
<!-- end of middle -->
@endsection 