<div class="form-group {{ $errors->has('user_type') ? 'has-error' : ''}}">
    <label for="user_type" class="control-label">{{ 'User Type' }}</label>
    <input class="form-control" name="user_type" type="text" id="user_type" value="{{ isset($usertype->user_type) ? $usertype->user_type : ''}}" required>
    {!! $errors->first('user_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"1":"Active","2":"Inactive","0":"Deleted"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($usertype->status) && $usertype->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
