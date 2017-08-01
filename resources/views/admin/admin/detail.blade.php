@extends('admin.master')

@section('title','管理员')
@section('pageHeader','管理员详情')
@section('pageDesc','')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal">
                        <div class="form-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4">用户名</label>
                                    <div class="col-md-8">
                                        {{ $admin->name }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">邮箱</label>
                                    <div class="col-md-8">
                                        {{ $admin->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4">创建时间</label>
                                    <div class="col-md-8">
                                        {{ $admin->created_at }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4">更新时间</label>
                                    <div class="col-md-8">
                                        {{ $admin->updated_at }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a class="btn btn-default margin-r-5" href="{{ route('admin.admin.list') }}">返回列表</a>
            <a class="btn btn-success" href="{{ route('admin.admin.update',['id'=>$admin->id]) }}">编辑</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#btn-save').click(function () {
            $('#form-save').ajaxSubmit({
                dataType: 'json',
                success: function (resp) {
                    console.log(resp);
                    if (resp.code == 0) {
                        $.redirect("{{ route('admin.admin.list') }}");
                    } else {
                        Bask.errorMsg(resp.message);
                    }
                }
            });
        });
    </script>
@endsection