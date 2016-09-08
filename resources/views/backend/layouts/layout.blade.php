@include('backend.layouts.header')
@include('backend.elfinder')
    <div id="app_navigation">
        <link type="text/css" href="{{ asset(null) }}backend/css/style.css" rel="stylesheet"/>
        <script type="text/javascript" src="{{ asset(null) }}backend/js/script.js"></script>
        <div id="slick-navigation">
            @include('backend.layouts.menu')
            <div style="height: 40px;background-color:#fff;width:100%">&nbsp;</div>
            @yield('content')
            <div id="app_footer">
                <div class="logo_"></div>
                <div class="clear"></div>
            </div>
        </div>
        </body>
@if(Session::has('infos'))
<script type="text/javascript">
    swal({
        type: 'warning',
        title : 'Warning',
        text : '{{ Session::get("infos") }}',
    });
</script>

@endif
@yield('script')
</html>
