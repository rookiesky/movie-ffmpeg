@extends('home.layouts.common')
@section('content')
    <!-- top host -->
    <div class="container-fluid">
        <div class="row carousel-main mt-3">
            <div class="col-lg-8">
                <!-- carousel start -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators banner_nav">
                    </ol>
                    <div class="carousel-inner banner-body">
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- end carousel -->
            </div>
            <div class="col-lg-4 host">
                <!-- host start -->
                <div class="card bg-dark text-dark mb-3 border-0">
                    <img class="card-img w-100 h-100" src="./test/4.jpeg" alt="Card image">
                    <div class="card-img-overlay">
                        <h5 class="card-title card-top">Card title</h5>
                    </div>
                </div>
                <div class="card bg-dark text-dark border-0">
                    <img class="card-img w-100 h-100" src="./test/2.jpeg" alt="Card image">
                    <div class="card-img-overlay">
                        <h5 class="card-title card-top">Card title</h5>
                    </div>
                </div>
                <!-- end host -->
            </div>
        </div>
    </div>
    <!-- end top host -->
    <div class="video-list">
    </div>
    <!-- links -->
    <div class="container-fluid mt-4">
        <nav aria-label="sub-nav">
            <ul class="list-group">
                <li class="list-group-item border-top-0 border-right-0 border-left-0 rounded-0">
                    <span class="inline-block" style="font-size: 18px;"><span class="oi oi-link-intact text-primary mr-2"></span>友情鏈接</span>
                </li>
            </ul>
        </nav>
        <div class="row mt-2 links-list" style="font-size:12px;">
        </div>
    </div>
    <!-- end links -->
@stop
@section('script')
<script>
window.onload = function () {
    $.get( "/api/banner", function(data) {
        $('.banner-body').html(banner_html(data.data));
        $(".banner_nav").html(banner_nav(data.data));
    });

    $.get( "/api/sort/video", function(data) {
        $(".video-list").html(video_list_common(data.data));
    });

    $.get( "/api/links", function(data) {
            $('.links-list').html(links_list(data.data));
                });
    function links_list(links)
    {
        let _html = '';
        $.each(links,function (index,val) {
            _html += '<div class="col-lg-1"><a href="' + val.link + '" class="text-muted">' + val.name + '</a></div>'
        });
        return _html;
    }
    function video_list_common(data)
    {
        let _html = '';
        $.each(data,function (index,val) {

            _html += '<div class="container-fluid  mt-4"><nav aria-label="sub-nav"><ul class="list-group"><li class="list-group-item border-top-0 border-right-0 border-left-0 rounded-0"><span class="inline-block" style="font-size: 18px;"><span class="oi oi-video text-primary mr-2"></span>' + val.title + '</span><a class="float-right" href="/sort/' + val.link_id + '">More<span class="oi oi-chevron-right ml-2"></span></a></li></ul></nav>';
            if( val.video.length > 0 ){
                _html += video_list_body(val.video);
            }
            _html += '</div>';
        });
        return _html;
    }

    function banner_nav(data) {
        let _html = '';
        for (i = 0; i < data.length; i++){
            if( i == 0 ){
                _active = 'active';
            }else{
                _active = '';
            }
            _html += '<li data-target="#carouselExampleIndicators" data-slide-to="' + i + '" class="' + _active + '"></li>';
        }
        return _html;
    }

    function banner_html(data)
    {
        let _html = '';

        $.each(data,function (index,val) {

            if(index == 0){
                _active = 'active';
            }else{
                _active = '';
            }

            _html += '<div class="carousel-item '+ _active +'"><a href="/v/' + val.link_id + '"><img class="d-block w-100" style="height: 380px;" src="'+ val.thumb +'" alt="'+ val.title +'"><div class="carousel-caption d-none d-md-block"><h5 class="text-dark">' + val.title + '</h5></div></a></div>';

        });

        return _html;

    }
}
</script>
@stop