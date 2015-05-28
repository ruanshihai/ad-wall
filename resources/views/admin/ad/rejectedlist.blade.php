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
        <th class="col-lg-2">复审通过</th>
      </tr>
      @foreach ($ads as $ad)
        <tr class="row">
          <td class='col-lg-2'>
            <a href="{{ URL('admin/ad/'.$ad->id) }}">
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
          <td class='col-lg-2'>
            <a href="{{ URL('admin/ad/'.$ad->id.'/pass') }}" class="btn btn-success">复审通过</a>
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