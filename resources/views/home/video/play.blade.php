@extends('home.layouts.common')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-watermark@2.0.0/dist/videojs-watermark.css">
    <div class="container-fluid mt-3">
        <div class="row mb-4">
            <div class="col-lg-8">
                <ul class="list-group">
                    <li class="list-group-item rounded-0">
                        <h5 class="text-truncate">---</h5>
                    </li>
                    <li class="list-group-item rounded-0 p-0">
                        <video id="my-video" class="video-js vjs-big-play-centered"><track kind="captions" src="/test/captions.vtt" srclang="en" label="English" default></video>
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
                        <span class="float-right mr-3">
                      <span class="oi oi-warning"></span>
                      檢舉
                    </span>
                        <span class="float-right mr-3">
                      <span class="oi oi-heart"></span>
                      收藏
                    </span>
                    </li>
                </ul>
                <ul class="list-group mt-2">
                    <li class="list-group-item rounded-0">
                        線路選擇：
                        <span class="badge badge-primary p-2">亞洲一線</span>
                        <span class="badge badge-primary p-2">亞洲二線</span>
                        <span class="badge badge-primary p-2">美洲一線</span>
                        <span class="badge badge-primary p-2">亞洲二線</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="row mb-2">
                    <div class="col-lg-9 pt-4 pb-3 text-secondary border border-primary">
                        <h5>本片计次收看20点</h5>
                    </div>
                    <a class="col-lg-2 bg-primary pt-3 pb-3 text-white text-center border border-primary" href="#">
                        BUY
                    </a>
                    <div class="col-lg-1"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-9 pt-4 pb-3 text-secondary border border-primary">
                        <h5>全站包日79点</h5>
                        <p class="text-primary">全站无限收看24小时</p>
                    </div>
                    <a class="col-lg-2 bg-primary pt-4 pb-3 text-white text-center border border-primary" href="#">
                        BUY
                    </a>
                    <div class="col-lg-1"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-9 pt-4 pb-3 text-secondary border border-primary">
                        <h5>全站包周199点</h5>
                        <p class="text-primary">全站无限收看7天</p>
                    </div>
                    <a class="col-lg-2 bg-primary pt-4 pb-3 text-white text-center border border-primary" href="#">
                        BUY
                    </a>
                    <div class="col-lg-1"></div>
                </div>
                <div class="row">
                    <div class="col-lg-9 pt-4 pb-3 text-secondary border border-primary">
                        <h5>全站包月399点</h5>
                        <p class="text-primary">全站无限收看30天</p>
                    </div>
                    <a class="col-lg-2 bg-primary pt-4 pb-2 text-white text-center border border-primary" href="#">
                        BUY
                    </a>
                    <div class="col-lg-1"></div>
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
        <div class="row mt-3">
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card">
                    <a href="#" class="card-img">
                        <img class="card-img-top" src="./test/1.jpeg" alt="Card image cap">
                        <span class="badge badge-secondary position-absolute">01:11:23</span>
                    </a>
                    <div class="card-body p-2">
                        <a href="#"><h6 class="card-title mb-0 text-dark text-truncate">Card titleCard titleCard titleCard titleCard titleCard titleCard titleCard titleCard title</h6></a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                          <span class="float-left">
                            <span class="oi oi-clock mr-1"></span>
                            2018-08-19
                          </span>
                            <span class="float-right">
                            <span class="oi oi-eye"></span>
                            123789
                          </span>
                        </small>
                    </div>
                </div>
            </div>
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


        let options = {
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

        reload_play()

        $.get( "/api/video/"+video_id, function(data) {
                        console.log(data);
                        play_html(data.data);
                    })
            .fail(function (xhr) {
                console.log(xhr);
            });
        function play_html(data)
        {
            $('h5').text(data.title);
            $(".create-time").text(data.create_time);
            $(".click-view").text(data.click);
            img_src = data.thumb;
            server_src = data.server[0].link;
            video_src = data.link;
            reload_play();
        }

        function reload_play()
        {
            let myvideo = videojs("#my-video",options);
            myvideo.poster(img_src);
            myvideo.src(server_src + video_src);
            myvideo.watermark({
                image:'https://img0.bdstatic.com/static/searchresult/img/logo-2X_b99594a.png',
                url:'http://baidu.com'
            });
            myvideo.load();
        }
    }
</script>
@stop