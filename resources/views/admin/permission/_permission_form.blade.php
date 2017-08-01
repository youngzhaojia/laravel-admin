<div class="form-group">
    <label for="tag" class="col-md-3 control-label">权限规则</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="name" id="tag" value="{{ $permission->name ?? '' }}" autofocus>
        <input type="hidden" class="form-control" name="cid" id="tag" value="{{ $cid ?? 0 }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">权限名称</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="label" id="tag" value="{{ $permission->label ?? '' }}" autofocus>
    </div>
</div>
@if($cid == 0 )
    <div class="form-group">
        <label for="tag" class="col-md-3 control-label">图标</label>
        <div class="col-md-6">
            <!-- Button tag -->
            <button class="btn btn-default" name="icon" data-iconset="fontawesome" data-icon="{{ $permission->icon ?? 'fa-sliders' }}" role="iconpicker"></button>
        </div>
    </div>
@endif
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">权限概述</label>
    <div class="col-md-6">
        <textarea name="description" class="form-control" rows="3">{{ $permission->description ?? '' }}</textarea>
    </div>
</div>

