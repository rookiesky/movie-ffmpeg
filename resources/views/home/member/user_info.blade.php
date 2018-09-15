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
                        <table class="table table-bordered user-info">
                            <thead>
                            <tr>
                                <th scope="col" colspan="2" class="bg-light">會員資料</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row" >暱稱：</th>
                                <td><span class="username">{{ $user->name }}</span><span class="oi oi-pencil ml-4 edit-username"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">郵箱：</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">修改密碼：</th>
                                <td>******<span class="oi oi-pencil ml-4 edit-password" data-toggle="modal" data-target="#exampleModal"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="usernameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">暱稱修改</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body notice-content">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="請輸入暱稱">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="請輸入密碼確認修改">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary put-username">提交修改</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">密碼修改</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body notice-content">
                    <form>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputPassword" aria-describedby="emailHelp" placeholder="請輸入新密碼">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputPasswordConfirmation" placeholder="請再次確認新密碼">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputOldPassword" placeholder="請輸入旧密碼進行驗證">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary put-password">提交修改</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
@stop

@section('script')
<script>
    $(".edit-username").click(function () {
        $("#usernameModal").modal('show');
    });
    $(".edit-password").click(function () {
        $("#passwordModal").modal('show');
    });
    $(".put-password").click(function () {
        let password = $("#inputPassword").val();
        let Confirmation = $("#inputPasswordConfirmation").val();
        let oldPassword = $("#inputOldPassword").val();

        if(password == '' || password.length < 6 || password.length > 10 || Confirmation == '' || Confirmation.length < 6 || Confirmation.length > 10 || oldPassword == '' || oldPassword.length < 6 || oldPassword.length > 10){
            errorMsg('密碼不能為空或小於6位大於10位');
            return false;
        }

        if(password != Confirmation){
            errorMsg('兩次密碼不一致');
            return false;
        }

        $.ajax({
           type: "put",
           url: "/api/member/password/edit",
           data: {password:password,password_confirmation:Confirmation,oldpassword:oldPassword},
           success: function(e){
               $("#passwordModal").modal('hide');
             successMsg(e.message);
           },
            error:function (xhr) {
                let errors = '';
                if(xhr.responseJSON.errors){
                    $.each(xhr.responseJSON.errors,function (index,val) {
                        errors += "<p>" + val[0] + "</p>";
                    });
                }else{
                    errors = xhr.responseJSON.message;
                }

                errorHtmlMsg(errors);
            }
        });


    });
    $(".put-username").click(function () {
        let username = $("#exampleInputUsername").val();
        let password = $("#exampleInputPassword").val();

        if(username == '' || username.length < 5 ){
            errorMsg('用戶暱稱不能為空或小於五位');
            return false;
        }
        if(password == '' || password.length < 6){
            errorMsg('密碼不能為空或不能小於六位');
            return false;
        }

        $.ajax({
           type: "put",
           url: "/api/member/user-info/edit",
           data: {username:username,password:password},
           success: function(e){
               $(".username").text(username);
               $("#usernameModal").modal('hide');
                successMsg(e.message);
           },
            error:function (xhr) {
               let errors = '';
               if(xhr.responseJSON.errors){
                   $.each(xhr.responseJSON.errors,function (index,val) {
                       errors += "<p>" + val[0] + "</p>";
                   });
               }else{
                   errors = xhr.responseJSON.message;
               }

              errorHtmlMsg(errors);
            }
        });

    });
</script>
@stop