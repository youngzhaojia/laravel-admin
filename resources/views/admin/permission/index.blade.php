@extends('admin.master')

@section('title','权限控制')
@section('pageHeader','权限列表')

@if($cid != 0)
    @section('pageDesc',$firstPermission->label)
@endif


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <form class="form-inline" id="form-list-permissions" method="POST" action="{{ route('api.permission.list') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" class="page" name="page" value="1"/>
                        <input type="hidden" class="page-size" name="page_size" value="20"/>
                        <input type="hidden" name="cid" value="{{ $cid }}"/>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="输入要查询的权限名称">
                        </div>
                        <span class="btn btn-primary" id="btn-search">筛选</span>

                        <a class="btn btn-primary pull-right" href="{{ route('admin.permission.create',['cid'=> $cid]) }}"><i class="fa fa-plus"></i> 新增权限</a>

                        @if($cid != 0)
                            <a href="{{ route('admin.permission.list', ['cid' => 0]) }}"
                               class="btn btn-warning pull-right margin-r-5"><i class="fa fa-mail-reply-all"></i> 返回顶级菜单
                            </a>
                        @endif
                    </form>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="5%">编号</th>
                                        <th class="text-center">规则</th>
                                        <th class="text-center">名称</th>
                                        <th class="text-center">Icon</th>
                                        <th class="text-center">描述</th>
                                        <th class="text-center">创建时间</th>
                                        <th class="text-center">修改时间</th>
                                        <th class="text-center" width="15%">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list">
                                    <tr class="loading text-center">
                                        <td colspan="6">
                                            <img src="{{ url('images/loading/loading.gif')  }}" width="120px" alt="loading"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div id="paginator" class="pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script id="tpl-list" type="javascript/template">
        @{{each permissions permission index }}
        <tr>
            <td class="text-center">@{{ permission.id }}</td>
            <td class="text-center">@{{ permission.name }}</td>
            <td class="text-center">@{{ permission.label }}</td>
            <td class="text-center"><i class="fa @{{ permission.icon }}"></i></td>
            <td class="text-center">@{{ permission.description }}</td>
            <td class="text-center">@{{ permission.created_at }}</td>
            <td class="text-center">@{{ permission.updated_at }}</td>
            <td class="text-center">
                @{{if permission.cid == 0 }}
                <a href="{{ url('admin/permission/list') }}/@{{ permission.id }}" class="btn btn-info  btn-xs">下级菜单</a>
                @{{/if }}
                <a href="{{ url('admin/permission/update') }}/@{{ permission.id }}" class="btn btn-warning btn-xs btn-update">更新</a>
                <span class="btn btn-danger btn-xs btn-remove" data-url="{{ url('api/permission/delete') }}?id=@{{ permission.id }}">
                删除
            </span>
            </td>
        </tr>
        @{{/each}}
    </script>

    <script>
        var options = {
            ajaxForm: $('#form-list-permissions'),
            pg: {page: 1, page_size: 20}
        };
        Bask.List.loadFirstPage($('#paginator'), options);

        options.ajaxForm.find('#btn-search').click(function () {
            Bask.List.loadFirstPage($('#paginator'), options);
        });
        options.ajaxForm.find('#keyword').keydown(function (event) {
            if (event.keyCode == 13) {
                Bask.List.loadFirstPage($('#paginator'), options);
                event.preventDefault();
            }
        });

        $(document).delegate('.btn-remove', 'click', function () {
            var url = $(this).data('url');
            Bask.confirm(function () {
                $.get(url, function (json) {
                    options.pg.page = options.ajaxForm.find('.page').val();
                    Bask.List.load($('#paginator'), options);
                });
            });
        });
    </script>
@endsection