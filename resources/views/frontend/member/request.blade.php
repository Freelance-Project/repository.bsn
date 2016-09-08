@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
	<div class="container">
    	<div class="row table-list">
        	<div class="col-md-12 text-center">
            	<h2 class="mid-title">Daftar Permintaan</h2>
                <div class="table-responsive">
                	<table class="table table-striped">
                    	<thead> 
                        	<tr>
                            	<th>No</th>
                                <th>Col A</th>
                                <th>Col B</th>
                                <th>Col C</th>
                            </tr>
                       	</thead>
                        <tbody class="text-left">
                            <tr>
                            	<td>1</td>
                                <td>Data 1</td>
                                <td>12</td>
                                <td>34</td>
                            </tr>
                            <tr>
                            	<td>2</td>
                                <td>Data 2</td>
                                <td>12</td>
                                <td>34</td>
                            </tr>
                            <tr>
                            	<td>3</td>
                                <td>Data 3</td>
                                <td>12</td>
                                <td>34</td>
                            </tr>
                            <tr>
                            	<td>4</td>
                                <td>Data 4</td>
                                <td>12</td>
                                <td>34</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                </nav>
            </div><!--end.col-->
        </div><!--end.row-->
    </div>
</div>
<!-- end of middle -->

@endsection  