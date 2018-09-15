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
                        <div class="row collect">
                            @foreach($collects as $val)
                            <div class="col-lg-3 mb-3">
                                <div class="card">
                                    <span class="badge badge-danger pointer delete-collect" data-id="{{ $val->id }}" ><span class="oi oi-x"></span></span>
                                    <a href="/v/{{ $val->id }}" class="card-img">
                                        <img class="card-img-top" src="{{ $imgServer }}{{ $val->thumbnail }}" alt="{{ $val->name }}">
                                        <span class="badge badge-secondary position-absolute">{{ $val->time_limit }}</span>
                                    </a>
                                    <div class="card-body p-2">
                                        <a href="/v/{{ $val->id }}"><h6 class="card-title mb-0 text-dark text-truncate">{{ $val->name }}</h6></a>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">
                                  <span class="float-left">
                                    <span class="oi oi-clock mr-1"></span>
                                    {{ $val->created_at->format('Y-m-d') }}
                                  </span>
                                            <span class="float-right">
                                    <span class="oi oi-eye"></span>
                                    {{ $val->view }}
                                  </span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <nav aria-label="Page navigation example mt-4">
                            <ul class="pagination justify-content-center">
                                {{ $collects->links('vendor.pagination.bootstrap-4') }}
                            </ul>
                        </nav>


                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
    </div>
@stop
@section('script')
<script>
    $(".delete-collect").click(function () {
        let _this = $(this);
        let id = _this.data('id');
        if(id == ''){
            errorMsg('請選擇收藏');
            return false;
        }
        $.ajax({
           type: "delete",
           url: "/api/member/collect/" + id,
           data: "name=John&location=Boston",
           success: function(e){
               _this.parent().parent().remove();
                successMsg(e.message);
           },
            error:function (xhr) {
                errorMsg(xhr.responseJSON.message);
            }
        });
    });
</script>
@stop
