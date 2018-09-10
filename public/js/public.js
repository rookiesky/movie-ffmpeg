
    $.get( "/api/sort/list", function(data) {

        if(data.data.length > 0){
            _html = header_menu_html(data.data);
            $(".header-menu-nav").append(_html);
        }
    });

    function header_menu_html(items)
    {
        let _html = '';
        $.each(items,function (key,val) {
            _html += '<li class="nav-item"><a class="nav-link" href="/sort/'+ val.link_id +'">'+ val.title +'</a></li>';
        });
        return _html;
    }

    function formToJson(data)
    {
        let _json = {};
        $(data).each(function () {
            _json[this.name] = this.value;
        });
        return _json;
    }
    function checkEmail(emailStr){
        let start=0;
        let end=emailStr.length;
        while(start<end){
            let charcode=emailStr.charCodeAt(start);
            if(!(charcode==45||charcode==46||
                (charcode>=48&charcode<=59)||
                (charcode>=64&charcode<=90)||  (charcode>=97&charcode<=122))){
                return false;
            }
            start++;
        }

        let emailStrArr=emailStr.split("@");
        if(emailStrArr.length!=2){
            return false;
        }else if(emailStrArr[0]==''||emailStrArr[1]==''){
            return false;
        }else{
            if(emailStrArr[0].split(".").length>1){
                return false;
            }
            let emailStr2Arr=emailStrArr[1].split(".");
            if(emailStr2Arr.length<2){
                return false;
            }else if(emailStr2Arr[0]==''||emailStr2Arr[emailStr2Arr.length]==''){
                return false;
            }else if(!(emailStr2Arr[emailStr2Arr.length-1]=='com'||
                emailStr2Arr[emailStr2Arr.length-1]=='cn'||
                emailStr2Arr[emailStr2Arr.length-1]=='gov'||
                emailStr2Arr[emailStr2Arr.length-1]=='edu'||
                emailStr2Arr[emailStr2Arr.length-1]=='net'||
                emailStr2Arr[emailStr2Arr.length-1]=='org'||
                emailStr2Arr[emailStr2Arr.length-1]=='int'||
                emailStr2Arr[emailStr2Arr.length-1]=='mil')){
                return false;
            }
        }
        return true;
    }
    function video_list_body(data)
    {
        let _html = '<div class="row mt-2">';
        $.each(data,function (index,val) {
            _html += '<div class="col-lg-3 mb-3"><div class="card"><a href="/v/'+val.link_id+'" class="card-img"><span class="badge badge-info position-absolute video-pixel">'+val.pixel+'</span><img class="card-img-top" src="' + val.thumb + '" alt="' + val.title + '"><span class="badge badge-secondary position-absolute">'+val.length+'</span></a><div class="card-body p-2"><a href="/v/'+ val.link_id +'"><h6 class="card-title mb-0 text-dark text-truncate">' + val.title + '</h6></a></div><div class="card-footer"><small class="text-muted"><span class="float-left"><span class="oi oi-clock mr-1"></span>' + val.create_time + '</span><span class="float-right"><span class="oi oi-eye mr-1"></span>' + val.click + '</span></small></div></div></div>';
        });
        return _html + '</div>';
    }