@extends('admin.layouts.common')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">系統設置</h3>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="/api/setAdmin/system">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputWebsite" class="col-sm-2 control-label">網站名稱</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="website" id="inputWebsite" placeholder="網站名稱" value="{{ isset(cache('system_base')->website) ? cache('system_base')->website : '' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUrl" class="col-sm-2 control-label">網站地址</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="url" id="inputUrl" value="{{ isset(cache('system_base')->url) ? cache('system_base')->url : '' }}" placeholder="網站地址">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">聯繫E-mail</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="{{ isset(cache('system_base')->email) ? cache('system_base')->email : '' }}" id="inputEmail" placeholder="聯繫E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputImagesServer" class="col-sm-2 control-label">圖片服務器</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="imgServer" value="{{ isset(cache('system_base')->imgServer) ? cache('system_base')->imgServer : '' }}" id="inputImagesServer" placeholder="圖片服務器">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCount" class="col-sm-2 control-label">網站統計</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="count" placeholder="網站統計">{{ isset(cache('system_base')->count) ? cache('system_base')->count : '' }}</textarea>
                                {{ csrf_field() }}
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
@stop
