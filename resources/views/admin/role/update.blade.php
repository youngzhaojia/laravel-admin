@extends('admin.master')

@section('title','角色管理')
@section('pageHeader','角色编辑')
@section('pageDesc','')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="msg"></div>
                    <form id="form-save" class="form-horizontal" role="form" method="POST" action="{{ route('api.role.save') }}">
                        <div class="form-body">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ $role->id ?? 0 }}">

                            @include('admin.role._role_form')

                            <div class="form-actions fluid">
                                <div class="text-center col-md-10">
                                    <div id="msg"></div>
                                    <span class="btn btn-success" id="btn-save">保存</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                        $.redirect("{{ route('admin.role.list') }}");
                    } else {
                        Bask.errorMsg(resp.msg);
                    }
                }
            });
        });
    </script>
@endsection