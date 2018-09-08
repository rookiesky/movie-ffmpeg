@extends('admin.layouts.common')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">伺服器設置</h3>
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
            <form class="form-horizontal" method="post" action="">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputHost" class="col-sm-2 control-label">Host</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="host" id="inputHosts" value="@if(isset($server)){{ $server->host }}@endif" placeholder="host">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPort" class="col-sm-2 control-label">Port</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="port" id="inputPort" value="@if(isset($server)){{ $server->port }}@else 22 @endif" placeholder="Port">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" value="@if(isset($server)){{ $server->username }}@endif" id="inputUsername" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" value="@if(isset($server)){{ $server->password }}@endif" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFilePath" class="col-sm-2 control-label">File Path</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="@if(isset($server)){{ $server->file_path }}@endif" name="file_path" id="inputFilePath" placeholder="File Path">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="@if(isset($server)){{ $server->id }}@endif" >
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