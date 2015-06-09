@extends('app')

@section('content')
<div class="main panel panel-default">  
  <div class="panel-heading">修改广告信息</div>

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

    <form action="{{ URL('user/ad').'/'.$ad->id }}" method="POST" enctype="multipart/form-data">
      <input name="_method" type="hidden" value="PUT">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      标题：
      <input type="text" name="title" class="form-control" required="required" value="{{ $ad->title }}">
      <br>
      广告类型：
      <br>
      <select id="type" name="type" class="form-control">
        <?php $type_items = array('新品', '促销') ?>
        <?php for ($i=0; $i<count($type_items); $i++){ ?>
          <option value="{{ $i }}" @if ($ad->type == $i) {{ "selected='selected'" }} @endif >{{ $type_items[$i] }}</option>
        <?php } ?>
      </select>
      <br>
      <label for="img">封面图片上传：</label>
      <input type="file" name="img" id="img" class="form-control"> 
      <br>
      活动起始日期：
      <input type="text" name="begin_at" id="begin_at" class="form-control" required="required" value="{{ $ad->begin_at }}">
      <br>
      活动结束日期：
      <input type="text" name="end_at" id="end_at" class="form-control" required="required" value="{{ $ad->end_at }}">
      <br>
      内容：
      <textarea name="content" rows="10" class="form-control" required="required">{{ $ad->content }}</textarea>
      <br>
      <input type="submit" class="btn btn-lg btn-info" value="提交修改">
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