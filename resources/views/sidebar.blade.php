<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">

        <div class="sidebar-left">
          @if(Auth::user()->type == 0)
            <a class="item" href="{{ url('admin/ad/waiting-list') }}">待审核列表</a>
            <a class="item" href="{{ url('admin/ad/rejected-list') }}">已回绝列表</a>
            <a class="item" href="{{ url('admin/ad/passed-list') }}">已通过列表</a>
          @elseif (Auth::user()->type == 1)
            <a class="item {{ strpos(URL::current(), 'user/ad/create') !== false ? 'item-current' : '' }}" href="{{url('user/ad/create') }}">录入广告</a>
            <a class="item {{ strpos(URL::current(), 'user/ad/waiting-list') !== false ? 'item-current' : '' }}" href="{{ url('user/ad/waiting-list') }}">待审核列表</a>
            <a class="item {{ strpos(URL::current(), 'user/ad/rejected-list') !== false ? 'item-current' : '' }}" href="{{ url('user/ad/rejected-list') }}">已回绝列表</a>
            <a class="item {{ strpos(URL::current(), 'user/ad/passed-list') !== false ? 'item-current' : '' }}" href="{{ url('user/ad/passed-list') }}">已通过列表</a>
          @endif
        </div>

        @yield('content')
        
      </div>
    </div>
  </div>
</div>
