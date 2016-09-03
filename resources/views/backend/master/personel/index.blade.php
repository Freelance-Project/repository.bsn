@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user">{{ helper::titleActionForm() }}</h3>
    </div>
    <div id="content_body">

        @include('backend.common.flashes')

        <div class = 'row'>
           <div class = 'col-md-12'>

                    {!! helper::buttonCreate() !!}
                
                
                <p>&nbsp;</p>
                <p>&nbsp;</p>

                <table class = 'table' id = 'tableNews'>
                    <thead>
                        <tr>
                            <th width = '40%'>Title</th>
                            <th width = '40%'>Intro</th>
                            <th width = '20%'>Action</th>
                        </tr>
                    </thead>
                    
                </table>

            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
    
    <script type="text/javascript">
        
        $(document).ready(function(){
            $('#tableNews').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'intro', name: 'intro' },
                    { data: 'action', name: 'action' , searchable :false},
                    
                ]
            });
        });
		
    </script>

@endsection