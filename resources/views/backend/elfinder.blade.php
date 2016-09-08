
<script type="text/javascript" charset="utf-8">
    // Documentation for client options:
    // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
    
	var validation_upload = "<?php echo sha1(date('Y-m-d').env('APP_SALT'))?>";
    $('document').ready(function(){
         $(".cancel-button").click(function(){
            document.location.href = '{{ \helper::urlAction("index") }}';
            return false;
        });
    });
    
	function getUrl(file_url)
    {
        var url = file_url;
        replace = "{{env('APP_URL_REPLACE')}}";
        return replace_url = url.replace(replace, "");
    }
	
	function getUrlParam(paramName) {
		var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
		var match = window.location.search.match(reParam) ;
		return (match && match.length > 1) ? match[1] : '' ;
	}
	
	function browseElfinder(param1 , param2 , param3 , param4)
	{
		var rightUpload = true;
		if(rightUpload == 'true') paramUpload = 'upload';
		else paramUpload = '';
		
		var rightDelete = true;
		if(rightDelete == 'true') paramDelete = 'rm';
		else paramDelete = '';
		
		$(".pop_back").show(); 
		
		var urlImage = '{{ url("/backend/elfinder/php/connector_image.minimal.php") }}';
		var funcNum = getUrlParam('CKEditorFuncNum');
		$('div[id^="elfinder_browse"]').hide();
		$('#elfinder_browse').hide();
		$('#'+param3).show();
		$('#'+ param3).elfinder({
			 url :  urlImage + '?token='+validation_upload ,
			 uiOptions : {
				 toolbar : [
						[paramUpload],
				],
			 },
			 contextmenu : {
			   files  : ['getfile', '|','', paramDelete, '|'],
			   navbar : [],
			 },
			 onlyMimes : ["image" ,"video"],
			 resizable : false , 
			 width : 1000,
			 getFileCallback : function(file) {
				 var file_url = getUrl(file.url);
				 $("#"+param1).val(file_url);
				 $("#"+param2).html("<img src = '"+ file.url +"' width = '200' height = '200' />");
				 $("#" + param4).show();
				 $(".pop_back").hide();

				
			},

			height: 490,
				docked: false,
			dialog: { width: 400, modal: true },
					   
		}).elfinder('instance');
	}
	
	function browseElfinderClose()
	{
		$(".pop_back").hide();
	}
	
	$(document).ready(function() {

        var rightUpload = 'true';
		
        if(rightUpload == 'true') paramUpload = 'upload';
        else paramUpload = '';
        
		var rightDelete = 'true';
        if(rightDelete == 'true') paramDelete = 'rm';
        else paramDelete = '';
        
		// star elfinder image
        var urlImage = '{{ url("/backend/elfinder/php/connector_image.minimal.php") }}';
        $('#elfinder').elfinder({
             url :  urlImage + '?token='+validation_upload ,
             uiOptions : {
                 toolbar : [
                        [paramUpload , 'mkdir'],
                ],
             },
             contextmenu : {
               files  : ['getfile', '|','', paramDelete, '|'],
               navbar : [],
             },
             onlyMimes : ["image", "video"],
             resizable : false , 
                       
        });
        
    });
	
	window.onload = function()
	{
		  CKEDITOR.replace( 'ckeditor_upload',{
		  filebrowserBrowseUrl: '{{ \helper::urlAction("getElfinder")}}'});
	}
</script> 