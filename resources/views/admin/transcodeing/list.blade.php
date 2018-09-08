@extends('admin.layouts.common')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Bordered Table</h3>
            </div>
            @if ($trans['status'] == false)
                <div class="alert alert-danger">
                    <ul>
                            <li>{{ $trans['error'] }}</li>
                    </ul>
                </div>
            @endif
            <a href="" class="btn btn-block btn-success">轉碼</a>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                    </tr>
                    @if($trans['status'] == true)
                        @foreach($trans['data'] as $key=>$val)
                        <tr>
                            <td>{{ $key }}.</td>
                            <td>{{ $val }}</td>
                        </tr>
                        @endforeach
                    @endif
                </table>
            </div>

        </div>
    </div>
</div>
@stop