<div class="form-group">
    <label class="col-md-2 control-label">用户名</label>
    <div class="col-md-5">
        <input type="text" name="name" class="form-control" value="{{ $admin->name ?? '' }}" placeholder="用户名">
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">邮箱</label>
    <div class="col-md-5">
        <input type="text" name="email" class="form-control" value="{{ $admin->email ?? '' }}" placeholder="邮箱">
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">角色列表</label>
    @if(isset($id)&&$id==1)
        <div class="col-md-4" style="float:left;padding-left:20px;margin-top:8px;"><h2>超级管理员</h2></div>
    @else
        <div class="col-md-6">
            @foreach($roleAll as $v)
                <div class="col-md-4" style="float:left;padding-left:20px;margin-top:8px;">
            <span class="checkbox-custom checkbox-default">
                <i class="fa"></i>
                    <input class="form-actions"
                           @if(in_array($v['id'],$roles))
                           checked
                           @endif
                           id="inputChekbox{{$v['id']}}" type="Checkbox" value="{{$v['id']}}"
                           name="roles[]"> <label for="inputChekbox{{$v['id']}}">
                    {{$v['name']}}
                </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
                </div>
            @endforeach
        </div>
    @endif

</div>