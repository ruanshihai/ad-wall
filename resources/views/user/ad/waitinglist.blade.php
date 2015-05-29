@extends('app')

@section('content')
<div class="main panel panel-default">
  <div class="panel-heading">待审核广告列表</div>

  <div class="panel-body">

    <table class="table table-striped table-break">
      <tr class="row">
        <th class="col-lg-2">标题</th>
        <th class="col-lg-2">起始日期</th>
        <th class="col-lg-2">结束日期</th>
        <th class="col-lg-3">内容</th>
        <th class="col-lg-1">状态</th>
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
            {{ $ad->begin_at }}
          </td>
          <td class='col-lg-2'>
            {{ $ad->end_at }}
          </td>
          <td class='col-lg-3'>
            {{ mb_substr($ad->content, 0, 100) }}
          </td>
          <td class='col-lg-1'>
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