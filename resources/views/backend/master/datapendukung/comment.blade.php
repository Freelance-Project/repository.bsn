@extends('backend.layout')

@section('content')
    <div id="app_content">
    <div id="content_header">
        <h3 class="user"> Comments Blog : {{ $model->title }}</h3>
    </div>
        <div id="content_body">
            <div id="station-form-wrapper">
                <!-- start form -->
                {!! Form::model($model , ['class' => 'main-editor']) !!}
                    <!-- start element -->
                    <div id="content">
                        <div id="media-content-container" class="media-container active">


                        @foreach($comments as $row)
                            <div style = 'border:1px solid #ccc;height:100px;min-height:30%;'>

                                <table width = '100%'  style = 'margin-top:10px;margin-left:20px;'>
                                    <tr >
                                        <td>{{ $row->user->firstname }} < {{ $row->user->email }} >  , {{ \Carbon\Carbon::parse($row->user->created_at)->format('d-M-Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $row->comment }}</td>
                                    </tr>
                                </table>

                            </div>
                        <p>&nbsp;</p>
                        @endforeach


                        <table style = 'min-width:5%;font-size:12px;'>

                            <tr>
                                @if ($comments->lastPage() > 1)

                                         @if($comments->currentPage() != 1)

                                            <td><a style = 'color:#14c005;' href="{{ str_replace('/?' , '?' , $comments->url($comments->currentPage()-1)) }}">Prev</td>

                                         @endif

                                         @for ($i = 1; $i <= $comments->lastPage(); $i++)
                                            <td>
                                                <a style = "{{ $comments->currentPage() == $i ? 'color:black;' :'color:#14c005' }}"   href="{{ str_replace( '/?' , '?', $comments->url($i) ) }}">

                                                    {{ $i }}
                                                </a>
                                            </td>
                                         @endfor

                                         @if($comments->currentPage() != $comments->lastPage())

                                         <td>
                                            <a style = 'color:#14c005;' href="{{ str_replace('/?' , '?' , $comments->url( $comments->currentPage() + 1 ) ) }}" class="clickable">
                                            next
                                          </a>
                                         </td>
                                         @endif
                                @endif
                            </tr>


                        </table>



                            <div class="center no_label">&nbsp;</div>

                        </div>
                        <!-- End Media Content Container --></div>
                    <!-- End ID Content -->
                    <!--div class="block_right" id="submit_wrapper">
                        <span>Submit</span>
                    </div>
                    <div class=" block_right" id="cancel_wrapper">
                        <button data-link="{{ \Helper::urlAction('index') }}" class="cancel-button" name="cancel_form">Cancel</button>
                    </div-->

                    <div class="break8 clear_left">&nbsp;</div>
                {!! Form::close() !!}
                <!-- end of form --></div>
        </div>
    </div>
@endsection
