@extends('app')

@section('content')
<div class="main panel panel-default">
  <div class="panel-heading">已回绝广告列表</div>

  <div class="panel-body">

    <table class="table table-striped">
      <tr class="row">
        <th class="col-lg-2">标题</th>
        <th class="col-lg-2">创建日期</th>
        <th class="col-lg-4">内容</th>
        <th class="col-lg-2">状态</th>
        <th class="col-lg-1">编辑</th>
        <th class="col-lg-1">删除</th>
      </tr>
      @foreach ($ads as $ad)
        <tr class="row">
          <td class='col-lg-2'>
            <a href="{{ URL('user/ad/'.$ad->id) }}">
              {{ $ad->title }}
            </a>
          </td>
          <td class='col-lg-2'>
            {{ $ad->created_at }}
          </td>
          <td class='col-lg-4'>
            {{ mb_substr($ad->content, 0, 100) }}
          </td>
          <td class='col-lg-2'>
            <?php $status_items = array('待审核', '已通过', '已回绝', '待复核') ?>
            {{ $status_items[$ad->status] }}
          </td>
          <td class='col-lg-1'>
            <a href="{{ URL('user/ad/'.$ad->id.'/edit') }}" class="btn btn-success">编辑</a>
          </td>
          <td class='col-lg-1'>
            <form action="{{ URL('user/ad/'.$ad->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">删除</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>
    <div style="text-align:right; padding-right:15px;">
      <?php echo $ads->render(); ?>
    </div>
  </div>
</div> 
@endsection