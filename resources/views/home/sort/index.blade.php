@extends('home.layouts.common')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row">

            <div class="col-lg-12">
                <!-- list -->
                <div class="video_list"></div>
                <!-- end list -->
                <div class="col-lg-12 mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">

                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
@stop
@section('script')
<script>
    window.onload = function () {

        let sort_id = 0;
        let limit = GetUrlParam('limit');
        let keyword = "@if(isset($keyword)){{ $keyword }}@endif";
        if(keyword == ''){
            sort_id =  sort_url_iD();
        }
        let api_url = api_url_html();

        $.get( api_url, function(data) {
            $(".video_list").html(video_list_body(data.data.videos))
            $(".justify-content-center").html(page_html(data.data.current_page,data.data.last_page))
        });

        function url_html()
        {
            _a_href = '/sort/' + sort_id + '?limit=' + limit;
            return _a_href;
        }

        function api_url_html()
        {
            url = '/api/video/list?sort=' + sort_id + '&limit=' + limit;
            if(keyword != ''){
                url = url + '&keyword=' + keyword;
            }
            return url;
        }

        function page_html(current,last)
        {
            let _page_html = '';
            current = parseInt(current);
            last = parseInt(last);

            for (i = 1; i <= last; i++){

                let _active = '';
                limit = i;

                if(current == i){
                    _active = 'active';
                }

                _page_html += '<li class="page-item '+_active+'"><a class="page-link" href="'+url_html()+'">'+ i +'</a></li>';
            }
            if(_page_html == ''){
                return '';
            }
            return page_up(current) + _page_html + page_next(current,last);
        }

        function page_up(current)
        {
            let is_active = '';
            let a_link = '#';
            if(current == 1){
                is_active = 'disabled';
            }else{
                a_link = '?limit=' + ( current - 1 );
            }
            return '<li class="page-item '+ is_active +'"><a class="page-link" href="'+ a_link +'" tabindex="-1">Previous</a></li>';
        }
        function page_next(current,last)
        {
            let is_active = '';
            let a_link = '#';

            if(current == last){
                is_active = 'disabled';
            }else{
                a_link = '?limit=' + ( current + 1 );
            }
            return '<li class="page-item '+ is_active +'"><a class="page-link" href="'+ a_link +'">Next</a></li>';
        }

        function GetUrlParam(paraName) {
            var url = document.location.toString();
            var arrObj = url.split("?");

            if (arrObj.length > 1) {
                var arrPara = arrObj[1].split("&");
                var arr;

                for (var i = 0; i < arrPara.length; i++) {
                    arr = arrPara[i].split("=");

                    if (arr != null && arr[0] == paraName) {
                        return arr[1];
                    }
                }
                return "";
            }
            else {
                return "";
            }
        }

        function sort_url_iD(){
            let sort_id = document.location.toString().split('//')[1].split('/')[2].split('?')[0];

            if(sort_id <= 0){
                return window.location.href = '/';
            }
            return sort_id;
        }

    }
</script>
@stop