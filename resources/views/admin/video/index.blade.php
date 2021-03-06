@extends('admin.layouts.common')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Bordered Table</h3>
                    <a type="button" class="btn btn-info" href="/setAdmin/video/create">添加視頻</a>
                </div>
                <div class="row">
                    <form action="/setAdmin/video/search">
                    <div class="col-md-8 col-md-offset-1">
                        <input type="text" class="form-control" name="keyword" placeholder="請輸入關鍵字">
                    </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info">搜索</button>
                        </div>
                    </form>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>名稱</th>
                            <th>分類</th>
                            <th>標籤</th>
                            <th>VIP</th>
                            <th>點數</th>
                            <th>時長</th>
                            <th>Banner</th>
                            <th>伺服器</th>
                            <th>封面</th>
                            <th>點擊</th>
                            <th>狀態</th>
                            <th>添加時間</th>
                            <th style="">操作</th>
                        </tr>
                        @foreach($videos as $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->videoSort->name }}</td>
                                <td>
                                    @foreach($val->tags as $tag)
                                    <small class="label bg-green">{{ $tag->title }}</small>
                                    @endforeach
                                </td>
                                <td>{{ ($val->is_vip == 1) ? '是' : '否' }}</td>
                                <td>{{ $val->point }}</td>
                                <td>{{ $val->time_limit }}</td>
                                <td>{{ ($val->banner == 1) ? '推薦' : '否' }}</td>
                                <td>
                                    @foreach($val->servers as $server)
                                    <small class="label bg-yellow">{{ $server->name }}</small>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ isset(cache('system_base')->imgServer) ? cache('system_base')->imgServer : '' }}{{ $val->thumbnail }}" target="_blank"><img src="{{ isset(cache('system_base')->imgServer) ? cache('system_base')->imgServer : '' }}{{ $val->thumbnail }}" width="40" height="30" alt=""></a>
                                </td>
                                <td>{{ $val->view }}</td>
                                <td>
                                    {{ ($val->status == 1) ? '已上架' : '待上架' }}
                                </td>
                                <td>{{ $val->created_at }}</td>
                                <td width="200">
                                    <a type="button" class="btn btn-info" href="/setAdmin/video/{{ $val->id }}/edit">編輯</a>
                                    @if($val->status == 1)
                                        <button type="button" data-id="{{ $val->id }}" class="btn btn-success bt-put-status">下架</button>
                                    @else
                                        <button type="button" data-id="{{ $val->id }}" class="btn btn-warning bt-put-status">上架</button>
                                    @endif
                                    <button type="button" data-id="{{ $val->id }}" class="btn btn-danger btn-delete-video">刪除</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{ $videos->links() }}
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop
@section('script')
<script>
$(function () {
    $(".bt-put-status").click(function () {
        id = $(this).data();
        _this = $(this);

        if(!id){
            $(".modal-message-body").html('請選擇視頻');
            $("#modal-message").removeClass('modal-info').addClass('modal-danger').modal('show');
            return false;
        }
        $.get( "/api/setAdmin/video/updateStatus/"+id.id, function(data) {
                $(".modal-message-body").html(data.message);
                $("#modal-message").modal('show');
                _this.parent().parent().remove();
                    })
            .fail(function (xhr) {
                $(".modal-message-body").html(xhr.responseJSON.message);
                $("#modal-message").removeClass('modal-info').addClass('modal-danger').modal('show');
            });
    });

    $(".btn-delete-video").click(function () {
        _this = $(this);
        id = _this.data();

        if(!id){
            $(".modal-message-body").html('請選擇視頻');
            $("#modal-message").removeClass('modal-info').addClass('modal-danger').modal('show');
            return false;
        }

        $.ajax({
           type: "delete",
           url: "/api/setAdmin/video/" + id.id,
           data: "",
           success: function(data){
               $(".modal-message-body").html(data.message);
               $("#modal-message").modal('show');
               _this.parent().parent().remove();
           },
            error: function (xhr) {
                $(".modal-message-body").html(xhr.responseJSON.message);
                $("#modal-message").removeClass('modal-info').addClass('modal-danger').modal('show');
            }
        });

    });
});
</script>
@stop