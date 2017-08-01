@extends('admin.master')

@section('title','管理员')
@section('pageHeader','管理员编辑')
@section('pageDesc','')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="msg"></div>
                    <form id="form-save" class="form-horizontal" role="form" method="POST" action="{{ route('api.admin.save') }}">
                        <div class="form-body">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="@if(isset($admin)){{ $admin->id }}@endif">

                            @include('admin.admin._admin_form')

                            <div class="form-actions fluid">
                                <div class="text-center col-md-10">
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
                        $.redirect("{{ route('admin.admin.list') }}");
                    } else {
                        Bask.errorMsg(resp.msg);
                    }
                }
            });
        });
    </script>
@endsection