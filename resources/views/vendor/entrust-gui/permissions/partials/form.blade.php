<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group mt-3">
    <label for="name">Permission Key</label>
    <input type="input" class="form-control" id="name" placeholder="office_view" name="name" value="{{ (Session::has('errors')) ? old('name', '') : $model->name }}">
</div>
<div class="form-group mt-3">
    <label for="display_name">Display Name</label>
    <input type="input" class="form-control" id="display_name" placeholder="Display Name" name="display_name" value="{{ (Session::has('errors')) ? old('display_name', '') : $model->display_name }}">
</div>
<div class="form-group mt-3">
    <label for="description">Description</label>
    <input type="input" class="form-control" id="description" placeholder="Description" name="description" value="{{ (Session::has('errors')) ? old('description', '') : $model->description }}">
</div>
<div class="form-group mt-3">
    <label for="roles" class="mb-1">Roles</label>
    <br />
    {{--    <select name="roles[]" multiple class="form-control">--}}
    @foreach($relations as $index => $relation)
        {{--            <option value="{{ $index }}" {{ ((in_array($index, old('roles', []))) || ( ! Session::has('errors') && $model->roles->contains('id', $index))) ? 'selected' : '' }}>{{ $relation }}</option>--}}
        <input type="checkbox" class="checkable" name="permissions[]" value="{{$index}}" {{ ((in_array($index, old('roles', []))) || ( ! Session::has('errors') && $model->roles->contains('id', $index))) ? 'checked' : '' }}/> {{$relation}} <br/>
    @endforeach
    {{--    </select>--}}
</div>
