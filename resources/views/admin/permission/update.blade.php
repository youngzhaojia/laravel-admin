@extends('admin.master')

@section('title','权限控制')

@section('css')
    @if($cid == 0)
        {{--图标修改--}}
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-iconpicker/icon-fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-iconpicker/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}"/>
    @endif
@endsection

@section('pageHeader','权限修改')
@section('pageDesc','')

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="msg"></div>
                    <form id="form-save" class="form-horizontal" role="form" method="POST" action="{{ route('api.permission.save') }}">
                        <div class="form-body">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ $permission->id }}">

                            @include('admin.permission._permission_form')

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
    @if($cid == 0)
        <script src="{{ asset('bower_components/bootstrap-iconpicker/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.7.0.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap-iconpicker/bootstrap-iconpicker/js/bootstrap-iconpicker.js') }}"></script>
    @endif
    <script>
        $('#btn-save').click(function () {
            $('#form-save').ajaxSubmit({
                dataType: 'json',
                success: function (resp) {
                    console.log(resp);
                    if (resp.code == 0) {
                        $.redirect("{{ route('admin.permission.list',['cid' => $cid]) }}");
                    } else {
                        Bask.errorMsg(resp.msg);
                    }
                }
            });
        });
    </script>
@endsection