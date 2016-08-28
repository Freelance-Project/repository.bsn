@extends('backend.layouts.login')
@section('content') 
            <div class="wg-content">
                <div class="wording">
                    {!! Form::open() !!}
                        <div class="fl label username"></div>
                        <div class="fl input">
                            {!! Form::text('username' , null ,  ['placeholder' => 'Username'] ) !!}
                        </div>
                        <div class="clear break15"></div>
                        <div class="fl label password"></div>
                        <div class="fl input">
                             {!! Form::password('password' ,  ['placeholder' => 'Password'] ) !!}
                        </div>
                        <div class="clear break15"></div>
                       
                       <div>
                            <div class="fl">
                                <a class="forgot-password" style="color:#1076bc;font:11px/32px verdana;" href = '{{ url("login/forgot-password") }}'>Forgot password ?</a>
                            </div>
                            <input type="submit" class="submit" value=""/>
                            <div class="clear break1"></div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
@endsection
@section('script')
    
    @if(@$errors->any() || Session::has('message'))

       <script type="text/javascript">
            swal({
              type : "error",
              title: "Error",
              text: "User not Found!",
              html: true
            });
        </script>

    @endif

@endsection