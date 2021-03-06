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
                    {!! helper::buttonCreateCustom(false, 'import','Import Data') !!}
                
                <p>&nbsp;</p>
                <p>&nbsp;</p>

                <table class = 'table' id = 'tableNews'>
                    <thead>
                        <tr>
                            <th width = '40%'>Title</th>
                            <th width = '20%'>Year</th>
                            <th width = '20%'>Bentuk File</th>
                            <th width = '10%'>Status</th>
                            <th width = '10%'>Action</th>
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
                    { data: 'title', name: 'title', render: function(data, type, full, meta){ return '<a href="update/'+full.id+'">'+data+'</a>';}},
                    { data: 'year', name: 'year' },
					{ data: 'availability', name: 'availability' },
					{ data: 'status', name: 'status' },
                    { data: 'action', name: 'action' , searchable :false},
                    
                ]
            });
        });
		
    </script>

@endsection