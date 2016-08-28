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

               
                <p>&nbsp;</p>
                <p>&nbsp;</p>

                <table class = 'table' id = 'table'>
                    <thead>
                        <tr>
                            <th>Parent</th>
                            <th>Title</th>
                            <th>Controller</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($model->whereParentId(null)->orderBy('order','asc')->get() as $row)
                            <tr>
                                <td>This Parent</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->controller }}</td>
                                <td>{{ $row->order }}</td>
                                <td>{!! helper::buttons($row->id) !!}</td>
                            </tr>

                            @foreach($row->childs as $child)

                                <tr>
                                    <td style = 'padding-left:40px;'>{{ $row->title }}</td>
                                    <td>{{ $child->title }}</td>
                                    <td>{{ $child->controller }}</td>
                                    <td>{{ $child->order }}</td>
                                    <td>{!! helper::buttons($child->id) !!}</td>
                                </tr>

                            @endforeach

                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        


    </div>
</div>
@endsection

@section('script')
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#table").DataTable({
                ordering :false,
            });
        });
    </script>

@endsection