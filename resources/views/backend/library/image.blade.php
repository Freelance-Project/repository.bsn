@extends('backend.layouts.layout')

@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> {{ helper::titleActionForm() }}</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-6'>

                    <div id = 'elfinder'>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
@section('script')
  
  

  <script type="text/javascript" charset="utf-8">
      var validation_upload = "<?php echo sha1(date('Y-m-d').env('APP_SALT'))?>";
      $().ready(function() {
          var urlImage = '{{ url("/backend/elfinder/php/connector.minimal.php") }}';
          var elf = $('#elfinder').elfinder({
              url :  urlImage + '?token='+validation_upload ,
          }).elfinder('instance');             
      });
  </script>

@endsection