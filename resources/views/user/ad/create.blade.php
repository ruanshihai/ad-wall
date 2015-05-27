@extends('app')

@section('content')
<div class="main panel panel-default">  
  <div class="panel-heading">添加广告</div>

  <div class="panel-body">

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ URL('user/ad') }}" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      标题：
      <input type="text" name="title" class="form-control" required="required">
      <br>
      广告类型：
      <br>
      <select id="type" name="type" class="form-control">
        <option value="0">新品</option>
        <option value="1">促销</option>
        <option value="2">特卖</option>
      </select>
      <br>
      <label for="img">封面图片上传：</label>
      <input type="file" name="img" id="img" class="form-control" required="required"> 
      <br>
      活动起始日期：
      <input type="text" name="begin_at" id="begin_at" class="form-control" required="required">
      <br>
      活动结束日期：
      <input type="text" name="end_at" id="end_at" class="form-control" required="required">
      <br>
      内容：
      <textarea name="content" rows="10" class="form-control" required="required"></textarea>
      <br>
      <input type="submit" class="btn btn-lg btn-info" value="添加广告">
    </form>

  </div>
</div>

<script type="text/javascript">
  $(function() {
    $("#begin_at").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      minDate: 0,
      onClose: function(selectedDate) {
        $("#end_at").datepicker("option", "minDate", selectedDate);
      }
    });
    $("#end_at").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      minDate: 0,
      onClose: function(selectedDate) {
        $("#begin_at").datepicker("option", "maxDate", selectedDate);
      }
    });
  });
</script>
@endsection