@extends('home.layouts.common')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-2">
                <!-- menu -->
                @include('home.layouts.member_menu')
                <!-- end menu -->
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-9">
                <!-- content -->
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered user-info">
                            <thead>
                            <tr>
                                <th scope="col" colspan="2" class="bg-light">會員資料</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row" >暱稱：</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">郵箱：</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">現有點數：</th>
                                <td style="letter-spacing: 3px;">{{ $user->point }}點</td>
                            </tr>
                            <tr>
                                <th scope="row">收看方案：</th>
                                <td>
                                    @if($user->is_vip == 1)
                                        {{ $user->program->title }}
                                    @else
                                        無
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">方案到期日：</th>
                                <td>
                                    @if($user->is_vip == 1)
                                        {{ $user->vip_end_time }}
                                    @else
                                        --
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">最後登錄：</th>
                                <td>
                                    {{ $user->updated_at->format('Y-m-d') }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <div class="card rounded-0 message" style="">
                            <div class="card-header font-weight-bold">
                                訊息
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($notices as $val)
                                <li class="list-group-item notice-msg" data-id="{{ $val->id }}">{{ $val->title }}<span class="float-right">{{ $val->created_at->format('Y-m-d') }}</span></li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body notice-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
@stop

@section('script')
<script>
    $(".notice-msg").click(function () {
       let id = $(this).data();

       if(id.id == ''){
           sweetAlert(
               '請選擇信息',
               '',
               'error'
           )
           return false;
       }

        $.get( "/api/notice/find/"+id.id, function(data) {
                        $("#exampleModalLabel").text(data.data.title);
                        $(".notice-content").html(data.data.content);
                        $("#noticeModal").modal('show');
                    })
                        .fail(function(xhr) {
                            sweetAlert(
                                xhr.responseJSON.message,
                                '',
                                'error'
                            )
                        });

    });
</script>
@stop