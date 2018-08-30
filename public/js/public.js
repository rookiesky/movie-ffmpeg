
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
