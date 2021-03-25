<button type="button" name="view" id="{{$id}}" class="view btn btn-primary btn-sm"><i class="icofont-ui-zoom-in"></i></button>
&nbsp;&nbsp;
<button type="button" name="edit" id="{{$id}}" class="edit btn btn-primary btn-sm"><i class="icofont-ui-edit"></i></button>
&nbsp;&nbsp;
@can('call-center-leader')
    <button type="button" name="delete" id="{{$id}}" class="delete btn btn-danger btn-sm change{{$id}}"><i class="icofont-ui-delete"></i></button>
@endcan
