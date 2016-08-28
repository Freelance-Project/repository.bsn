@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>





 <div class = 'row'>

    <div class = 'col-md-8'>
        <div id="app_content">
            <div id="content_header">
                <h3 class="user">Chart</h3>
            </div>
            <div id="content_body">
                {!! Chart::display("chart", $charts) !!}
                   
            </div>
        </div>
    </div>

     <div class = 'col-md-4'>
        <div id="app_content">
            <div id="content_header">
                <h3 class="user">Last Activities</h3>
            </div>
            <div id="content_body">

                <table class = 'table table-bordered'>
                    <tbody>
                        @foreach($last as $row)
                            
                            <tr class = "{{ $row->id % 2 == 0 ? 'success' : 'danger' }}">
                                <td>{{ $row->action }}</td>
                                <td>{{ Carbon\Carbon::parse($row->created_at)->format("d F ,Y H:i:s") }}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
                   
            </div>
        </div>
    </div>

</div>
    

@endsection