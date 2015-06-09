@extends('app')

@section('content')
<div class="main panel panel-default">  
  <div class="panel-heading">
    {{ $ad->title }}
    <a href="javascript:history.back(-1)" class="btn btn-success" style="float:right">返回</a>
  </div>

  <div class="panel-body">
    <div id="base-view">
      <div style="float:right;">
        {{ HTML::image('uploads/pictures/'.$ad->img_path, $ad->img_path) }}
      </div>
      <div class="base-item">
        <span class="col-lg-2">商家名称</span>
        <span>{{ $user->name }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">电话</span>
        <span>{{ $user->phone }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">地址</span>
        <span>{{ $user->address }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">广告类型</span>
        <span><?php $type_items = array('新品', '促销') ?> {{ $type_items[$ad->type] }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">状态</span>
        <span><?php $status_items = array('待审核', '已通过', '已回绝', '待复核') ?> {{ $status_items[$ad->status] }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">活动起始日期</span>
        <span>{{ $ad->begin_at }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">活动结束日期</span>
        <span>{{ $ad->end_at }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">创建时间</span>
        <span>{{ $ad->created_at }}</span>
      </div>
      <div class="base-item">
        <span class="col-lg-2">内容</span>
        <br>
        <pre class="col-lg-11" style="margin-left:16px">{{ $ad->content }}</pre>
      </div>
    </div>
  </div>
</div>
@endsection