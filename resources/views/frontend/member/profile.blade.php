@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
	<div class="container">
    	<div class="profile_page">
             <div class="panel panel-info">
             	<div class="panel-heading">
                  <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body">
                	<div class="row">
                    	<div class="col-md-3 col-lg-3 " align="center"> <img  alt="User Pic" src="http://thetransformedmale.files.wordpress.com/2011/06/bruce-wayne-armani.jpg" class="img-responsive"> <br><br>
                        </div>
                        <div class=" col-md-9 col-lg-9 "> 
                          <table class="table table-user-information">
                            <tbody>
                              <tr>
                                <td>Nama</td>
                                <td>Ovan Pulu Sunarto</td>
                              </tr>
                              <tr>
                                <td>Username</td>
                                <td>Ovan.pulu77</td>
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td>Ovan.pulu@gmail.com</td>
                              </tr>
                              <tr>
                                <td>Satker</td>
                                <td>121212</td>
                              </tr>
                              
                             
                            </tbody>
                          </table>
                          	<a href="#" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div><!--end.row-->
                </div><!--end.panel-body-->
             </div><!--end.panel-info-->
        </div><!--end.search-detail-->
    </div>
</div>
<!-- end of middle -->

@endsection  