@include('home.layouts.header')
<body class="reg">
@include('home.layouts.nav')

<div class="container-fluid">
    <div class="row pt-5">
        <div class="card m-auto pt-4 pb-4 pl-4 pr-4">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="exampleInputEmail" aria-describedby="UserHelp" placeholder="請輸入E-mail">
                        <small id="UserHelp" class="form-text text-muted">We'll never share your user info with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="請輸入密碼">

                    </div>
                    <button type="button" class="btn btn-primary">確認登入</button>
                </form>
            </div>
            <div class="card-footer bg-white text-muted">
                <span>沒有賬號，<a href="/sign-up">請前往註冊</a></span>
                <span class="float-right"><a href="/forget">忘記密碼？</a></span>
            </div>
        </div>
    </div>
</div>

@include('home.layouts.js')

<script>
    $(".btn-primary").click(function () {
        let email = $("#exampleInputEmail").val();
        let password = $("#exampleInputPassword1").val();
        let errors = '';

        if(checkEmail(email) == false){
            errors += '<p>' + '請輸入正確的E-mail帳號' + '</p>';
        }

        if(password.length < 6){
            errors += '<p>' + '密碼不能少於6位' + '</p>';
        }

        if(errors != ''){
            swal({
                title: '',
                type: 'error',
                html:'<div class="text-danger">' + errors + '</div>',
                showCloseButton: true,
                showCancelButton: false,
            })
            return false;
        }
        let _this = $(this);
        _this.attr('disabled','disabled').text('提交中...');

        $.post("/api/login", { email: email, password:password },function(data){
                     window.location.href = '/member';
                 }).fail(function (xhr) {
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
                });
            _this.removeAttr('disabled').text('確認登入');
        });

    });
</script>

{!! cache('system_base')->count !!}
</body>
</html>