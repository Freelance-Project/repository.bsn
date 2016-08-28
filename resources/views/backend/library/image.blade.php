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
      $().ready(function() {
          var elf = $('#elfinder').elfinder({
              url : '{{ url("backend/elfinder/php/connector.minimal.php") }}'
          }).elfinder('instance');             
      });
  </script>

@endsection