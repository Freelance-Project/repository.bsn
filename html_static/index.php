<?php $page = "home"; ?>
<?php include('inc_header.php');?>
<!-- middle -->
<div id="middle-content" class="intro-landing">
	<div class="container container-table">
    	<div class="row vertical-center-row">
            <div class="text-center col-md-6 col-md-offset-3">
                <div id="imaginary_container">
                	<form action="main_search_result.php"> 
                    <div class="input-group stylish-input-group">
                    	
                        <input type="text" class="form-control"  placeholder="Search" >
                        <span class="input-group-addon">
                            <button type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>  
                        </span>
                       
                    </div><!--end.search--input-->
                     </form>
                    <div class="cat-search text-center">
                    	<a href="search_result.php" class="btn btn-primary">Buku</a>
                        <a href="search_result.php" class="btn btn-success">Jurnal</a>
                        <a href="search_result.php" class="btn btn-info">Penelitian</a>
                        <a href="search_result.php" class="btn btn-warning">Paper</a>
                        <a href="search_result.php" class="btn btn-danger">Majalah</a>
                    </div>
                </div><!--end.imaginary-->
            </div><!--end.col6-->
        </div><!--end.row-->
        <div class="row vertical-center-row">
            <div class="text-center col-md-6 col-md-offset-3">
                <a href="#"  data-toggle="modal" data-target="#advanceForm" class="link-advance">Advance Search</a>
            </div><!--end.col6-->
        </div><!--end.row-->
    </div><!--end.container-->
</div>
<!-- end of middle -->
<script>
$(document).ready(function () {
	$(window).bind("load resize",function(){
		$(".intro-landing").height($(window).height()-30);	
	});
});
</script>

<?php include('popup-login.php');?>
<?php include('popup-advance.php');?>
<?php include('inc_footer.php');?>