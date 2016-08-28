@extends('backend.layouts.layout')
@section('content')

<?php
  $checked = function($id,$roleId){
      $model = injectModel('Right');
      $cek = $model->whereMenuActionId($id)->whereRoleId($roleId)->first();

      if(!empty($cek->id))
      {
        return 'checked';
      }
  };
?>


<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> {{ helper::titleActionForm() }}</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-6'>

                    @include('backend.common.errors')

                     {!! Form::model($model) !!} 

                        <div class="form-group">
                          <label>Role</label>
                          {!! Form::text('role' , null ,['class' => 'form-control','readonly']) !!}
                        </div>
                      
                        <table class = 'table table-bordered'>
                          
                            @foreach($menu->whereParentId(null)->orderBy('order','asc')->get() as $parent)
                              @if($parent->childs->count() > 0)
                                <thead>
                                  <tr class = 'danger'>
                                    <th >{{ $parent->title }}</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($parent->childs as $child)

                                      @foreach($child->actions as $action)
                                        
                                          

                                          <tr class = 'success'>
                                          
                                            <td><input <?= @$checked($action->pivot->id,$model->id) ?> name ='menu_action_id[]' value = '{{  $action->pivot->id }}' type = 'checkbox'> {{ $action->title }} {{ $child->title }}</td>
                                          
                                          </tr>

                                      @endforeach
                                  
                                  @endforeach
                                </tbody>  
                              @endif
                            @endforeach
                          
                        
                        </table>

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

                </div>

            </div>

        </div>
    </div>
@endsection