@include('home.layouts.header')
<body class="reg">
@include('home.layouts.nav')

<div class="container-fluid">
    <div class="row pt-5">
        <div class="card m-auto pt-4 pb-4 pl-4 pr-4">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="exampleInputUsername" aria-describedby="UserHelp" placeholder="請輸入用戶暱稱">
                        <small id="UserHelp" class="form-text text-muted">We'll never share your user info with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="請輸入郵箱">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="請輸入密碼">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" id="exampleInputConfirmPassword1" placeholder="確認密碼">
                    </div>
                    <div class="form-check mb-2 text-danger">
                        <input class="form-check-input" type="checkbox" name="is_adult" value="1" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            我已年滿18歲
                        </label>
                    </div>
                    <button type="button" class="btn btn-primary">註冊會員</button>
                </form>
            </div>
            <div class="card-footer bg-white">
                <span class="text-muted">已經註冊賬號，<a href="/login">請前往登陸</a></span>
            </div>
        </div>
    </div>
</div>

@include('home.layouts.js')
<script>
    window.onload = function () {
        $(".btn-primary").click(function () {
            formDATA = $('form').serializeArray();
            errorMsg = checkForm(formToJson(formDATA));
            if(errorMsg != ''){
                swal({
                    title: '',
                    type: 'error',
                    html:'<div class="text-danger">' + errorMsg + '</div>',
                    showCloseButton: true,
                    showCancelButton: false,
                })
                return false;
            }
            let _this = $(this);
            _this.attr('disabled','disabled').text('提交中...');

            $.post("/api/sign-up", formDATA,function(data){
                        window.location.href = '/member';
                     })
                .fail(function (xhr) {
                    let errors = '';
                    $.each(xhr.responseJSON.errors,function (index,val) {
                        errors += '<p>' + val + '</p>';
                    });
                    swal({
                        title: '',
                        type: 'error',
                        html:'<div class="text-danger">' + errors + '</div>',
                        showCloseButton: true,
                        showCancelButton: false,
                    })
                    _this.removeAttr('disabled').text('註冊會員');
            });

        });

        function checkForm(data)
        {
             let errorMsg = '';

             if(data.name.length < 5){
                 errorMsg += "<p>暱稱不能為空或少於5位！</p>";
             }
             if(checkEmail(data.email) == false){
                 errorMsg += "<p>請填寫正確的E-mail！</p>";
             }
             if(data.password.length < 6){
                 errorMsg += "<p>密碼不能為空或少於6位！</p>";
             }
             if(data.password != data.password_confirmation){
                 errorMsg += "<p>兩次密碼不一致！</p>";
             }
             if(data.hasOwnProperty('is_adult') == false){
                 errorMsg += "<p'>請確認您是否已滿18歲，如為滿18歲，請離開本站！感謝合作！</p>";
             }
            return errorMsg;
        }

    }
</script>
{!! cache('system_base')->count !!}
</body>
</html>