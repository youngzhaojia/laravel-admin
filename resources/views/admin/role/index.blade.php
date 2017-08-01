@extends('admin.master')

@section('title','角色管理')
@section('pageHeader','角色列表')
@section('pageDesc','')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <form class="form-inline" id="form-list-roles" method="POST" action="{{ route('api.role.list') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" class="page" name="page" value="1"/>
                        <input type="hidden" class="page-size" name="page_size" value="20"/>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="输入要查询的权限">
                        </div>
                        <span class="btn btn-primary" id="btn-search">筛选</span>

                        <a class="btn btn-primary pull-right" href="{{ route('admin.role.create') }}"><i class="fa fa-plus"></i> 新增角色</a>
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
                                        <th class="text-center">角色名</th>
                                        <th class="text-center">介绍</th>
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
        @{{each roles role index }}
        <tr>
            <td class="text-center">@{{ role.id }}</td>
            <td class="text-center">@{{ role.name }}</td>
            <td class="text-center">@{{ role.description }}</td>
            <td class="text-center">@{{ role.created_at }}</td>
            <td class="text-center">@{{ role.updated_at }}</td>
            <td class="text-center">
                <a href="{{ url('admin/role/update') }}/@{{ role.id }}" class="btn btn-warning btn-xs btn-update">更新</a>
                <span class="btn btn-danger btn-xs btn-remove" data-url="{{ url('api/role/delete') }}?id=@{{ role.id }}">
                删除
            </span>
            </td>
        </tr>
        @{{/each}}
    </script>

    <script>
        var options = {
            ajaxForm: $('#form-list-roles'),
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