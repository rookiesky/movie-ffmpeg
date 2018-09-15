@extends('home.layouts.common')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-watermark@2.0.0/dist/videojs-watermark.css">
    <div class="container-fluid mt-3">
        <div class="row mb-4">
            <div class="col-lg-8">
                <ul class="list-group">
                    <li class="list-group-item rounded-0">
                        <h5 class="text-truncate title">---</h5>
                    </li>
                    <li class="list-group-item rounded-0 p-0">
                        <video id="my-video" class="video-js vjs-big-play-centered"></video>
                        <!-- end video -->
                    </li>
                    <li class="list-group-item bg-secondary text-white tool-share">
                    <span class="float-left mr-3">
                      <span class="oi oi-calendar"></span>
                        <span class="create-time"></span>
                    </span>
                        <span class="float-left">
                      <span class="oi oi-eye"></span>
                      <span class="click-view"></span>
                    </span>
                        <span class="float-right">
                      <!-- AddToAny BEGIN -->
                      <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                      <a class="a2a_button_twitter"></a>
                      <a class="a2a_button_google_plus"></a>
                      <a class="a2a_button_wechat"></a>
                      <a class="a2a_button_email"></a>
                      <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                      </div>
                      <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                    </span>
                        <span class="float-right mr-3 reflect-user">
                            <span class="oi oi-warning"></span>
                            檢舉
                        </span>
                        <span class="float-right mr-3 collect-user">
                            <span class="oi oi-heart"></span>
                            <span>收藏</span>
                        </span>
                    </li>
                </ul>
                <ul class="list-group mt-2">
                    <li class="list-group-item rounded-0 server-line">
                        線路選擇：
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 program-point">
                <div class="point-empty">

                </div>
            </div>
        </div>
        <nav aria-label="sub-nav">
            <ul class="list-group">
                <li class="list-group-item border-top-0 border-right-0 border-left-0 rounded-0">
                    <span class="inline-block" style="font-size: 18px;"><span class="oi oi-list text-primary mr-2"></span>相關視頻</span>
                </li>
            </ul>
        </nav>
        <div class="row mt-3 random-video">

        </div>

    </div>
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/video.js@7.1.0/dist/video.min.js" integrity="sha256-ghYW+EJL1f99ECDJ7QcivpilafSvpQmoYM4Whm4hd74=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-contrib-hls@5.14.1/dist/videojs-contrib-hls.min.js" integrity="sha256-ngHSRzCW6euvtJPYDc6HnWd9UvS7VxXfOcRt5Kt0ZrA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-watermark@2.0.0/dist/videojs-watermark.min.js" integrity="sha256-lMN3bfacEnJYlL4VaDBcgAZ+razfu/gfJ6FfrX4Oj+U=" crossorigin="anonymous"></script>
<script>
    let video_id = {{ $id }};

    window.onload = function () {

        let server_src = '';
        let img_src = "https://dlfj.guankou.cn/niaoyun/niaoyun.gushidaquan.cc/i4/gsdq/jdlingyu/17904/2016-12-04_00-38-57.jpg";
        let video_src= 'https://vjs.zencdn.net/v/oceans.mp4';

        reload_play()

        $.get( "/api/video/"+video_id, function(data) {
                        console.log(data);
                        play_html(data.data);
                        $('.server-line').append(server_line(data.data.server));
                        if(data.data.point){
                            $(".point-empty").append(point_html('本片计次收看'+data.data.point+'點',data.data.link_id,'video-point'));
                        }
                    })
            .fail(function (xhr) {
            });
        $.get('/api/program',function (data) {
            if(data.data != null){

                $(".program-point").append(program_html(data.data));
            }
        });

        $.get('/api/random',function (data) {
            $(".random-video").html(video_body_html(data.data));
        });

        $(".reflect-user").click(function () {
            $.get( "/api/reflect/set/"+video_id, function(data) {
                            swal(
                                data.message,
                                '',
                                'success'
                            )
                        })
                            .fail(function(xhr) {
                                sweetAlert(
                                    xhr.responseJSON.message,
                                    '',
                                    'error'
                                )
                            });
        });

       $('.collect-user').click(function () {
           $.get( "/api/collect/set/"+video_id, function(data) {
               let collect = $(".collect-user span");

               if(data.data == 1){
                   collect.eq(0).addClass('text-danger');
                   collect.eq(1).text('取消收藏');
               }else{
                   collect.eq(0).removeClass('text-danger')
                   collect.eq(1).text('收藏');

               }
           })
               .fail(function(xhr) {
                   sweetAlert(
                       xhr.responseJSON.message,
                       '',
                       'error'
                   )
               });
       });



        function video_js_options()
        {
            return {
                controls:true,
                autoplay:false,
                width:300,
                height:450,
                loop:false,
                preload:"auto",
                bigPlayButton:true,
                textTrackDisplay : true,
                errorDisplay : false,
                control: {
                    captionsButton: false,
                    chaptersButton : false,
                    liveDisplay:false,
                    playbackRateMenuButton: false,
                    subtitlesButton:false
                },
                controlBar: {
                    muteToggle: false,
                    captionsButton: false,
                    chaptersButton: false,
                    playbackRateMenuButton: true,
                    LiveDisplay: false,
                    subtitlesButton: false,
                    remainingTimeDisplay: true,
                    progressControl: true,
                    volumeMenuButton: {
                        inline: false,
                        vertical: true
                    },
                },
            };
        }

        function program_html(data)
        {
            let _html = '';
            $.each(data,function (index,val) {
                let money = val.total;

                if(val.money != 0){
                    money = val.money;
                }

                _html += point_html(val.title + money,val.id,'program-money',val.summary);
            });
            return _html;
        }

        function play_html(data)
        {
            $('.title').text(data.title);
            $(".create-time").text(data.create_time);
            $(".click-view").text(data.click);
            if(data.collect == true){
                let collect = $(".collect-user span");
                collect.eq(0).addClass('text-danger');
                collect.eq(1).text('取消收藏')
            }
            img_src = data.thumb;
            server_src = data.server_link;
            video_src = data.link;
            reload_play();
        }

        function point_html(text,id,style,summary = '')
        {
            return '<div class="row mb-2"><div class="col-lg-9 pt-4 pb-3 text-secondary border border-primary"><h5>'+text+'</h5>'+summary+'</div><button class="col-lg-2 bg-primary pt-3 pb-3 text-white text-center border pointer border-primary '+style+'" data-id="'+id+'">BUY</button><div class="col-lg-1"></div></div>';
        }

        function server_line(server) {
            let _html = '';
            $.each(server,function (index,val) {
                _html += '<span class="badge badge-primary p-2" data-link="'+val.link_id+'">'+ val.title +'</span>';
            });
            return _html;
        }

        function reload_play()
        {
            let myvideo = videojs("#my-video",video_js_options());
            myvideo.poster(img_src);
            myvideo.src(server_src + video_src);
            myvideo.watermark({
                image:'/images/logo.png',
                url:'http://www.japanxav.com'
            });
            myvideo.load();
        }
    }
</script>
@stop