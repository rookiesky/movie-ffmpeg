@include('home.layouts.header')
<body class="reg">
@include('home.layouts.nav')

<div class="container-fluid">
    <div class="row pt-5">
        <div class="card m-auto pt-4 pb-4 pl-4 pr-4">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="exampleInputUsername" aria-describedby="UserHelp" placeholder="請輸入E-mail賬號">
                        <small id="UserHelp" class="form-text text-muted">We'll never share your user info with anyone else.</small>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" name="captcha" id="examplecaptcha" placeholder="請輸入驗證碼">
                        </div>
                        <div class="col">
                            <img src="{{ captcha_src() }}" alt="" style="cursor: pointer" onclick="this.src='{{ captcha_src() }}'+Math.random() ">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-3">確認送出</button>
                </form>
            </div>

        </div>
    </div>
</div>

@include('home.layouts.js')
<script>
    $(".btn-primary").click(function () {
        let email = $("#exampleInputUsername").val();
        let captcha = $("#examplecaptcha").val();
        let errors = '';

        if(checkEmail(email) == false){
            errors += '<p>請填入正確的郵箱</p>';
        }

        if(captcha.length < 4){
            errors += '<p>請填寫正確的驗證碼</p>';
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

        $.post("/api/forget", { email: email, captcha: captcha },function(data){
                    swal(
                        data,
                        '',
                        'success'
                    )
            _this.removeAttr('disabled').text('確認送出');

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
            })
            _this.removeAttr('disabled').text('確認送出');
        });
    });
</script>
{!! cache('system_base')->count !!}
</body>
</html>