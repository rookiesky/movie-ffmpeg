@extends('home.layouts.common')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-2">
                <!-- menu -->
                <div class="card rounded-0" style="width: 18rem;">
                    <div class="card-header rounded-0 font-weight-bold" style="letter-spacing: 6px;">
                        欄目
                    </div>
                    <ul class="list-group list-group-flush">
                        <a href="">
                            <li class="list-group-item rounded-0 active">會員專區<span class="oi oi-chevron-right float-right"></span></li>
                        </a>
                        <a href="">
                            <li class="list-group-item rounded-0">修改個人資料<span class="oi oi-chevron-right float-right"></span></li>
                        </a>
                        <a href="">
                            <li class="list-group-item rounded-0">儲值點數／點數兌換<span class="oi oi-chevron-right float-right"></span></li>
                        </a>
                        <a href="">
                            <li class="list-group-item rounded-0">消費紀錄<span class="oi oi-chevron-right float-right"></span></li>
                        </a>
                        <a href="">
                            <li class="list-group-item rounded-0">收藏影片<span class="oi oi-chevron-right float-right"></span></li>
                        </a>
                    </ul>
                </div>
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
                                <td>小白的</td>
                            </tr>
                            <tr>
                                <th scope="row">郵箱：</th>
                                <td>xxxxxx@cc.com</td>
                            </tr>
                            <tr>
                                <th scope="row">現有點數：</th>
                                <td style="letter-spacing: 3px;">0點</td>
                            </tr>
                            <tr>
                                <th scope="row">收看方案：</th>
                                <td>無</td>
                            </tr>
                            <tr>
                                <th scope="row">方案到期日：</th>
                                <td>--</td>
                            </tr>
                            <tr>
                                <th scope="row">最後登錄：</th>
                                <td>--</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <div class="card rounded-0 message" style="">
                            <div class="card-header font-weight-bold">
                                訊息
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" data-toggle="modal" data-target="#exampleModal">Cras justo odio <span class="float-right">2018-09-16</span></li>
                                <li class="list-group-item" data-toggle="modal" data-target="#exampleModal">Dapibus ac facilisis in <span class="float-right">2018-09-16</span></li>
                                <li class="list-group-item" data-toggle="modal" data-target="#exampleModal">Vestibulum at eros <span class="float-right">2018-09-16</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
@stop