@extends("app")

@section('content')
<div id="info-container" class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span>Info</span>
					<div class='pull-right'>
						<a id="edit-bt" href="javascript:void(0)" onclick="edit()" class="btn btn-success" event-type="0">编辑</a>
					</div>
				</div>

				<div class="panel-body">
					<div id="base-view">
						<div class="base-item">
							<span class="col-lg-2">登录名</span>
							<span>{{ Auth::user()->email }}</span>
						</div>
						<div class="base-item">
							<span class="col-lg-2">商家名称</span>
							<span>{{ Auth::user()->name }}</span>
						</div>
						<div class="base-item">
							<span class="col-lg-2">地址</span>
							<span>{{ Auth::user()->address }}</span>
						</div>
						<div class="base-item">
							<span class="col-lg-2">注册时间</span>
							<span>{{ Auth::user()->created_at }}</span>
						</div>
					</div>
					<div id="base-edit" style="display: none">
						<form name="info-form" id="info-form" action="{{ URL('user/info') }}" method="POST">
      						<input type="hidden" name="_token" value="{{ csrf_token() }}">
      						<input type="hidden" name="id" value="{{ Auth::user()->id }}">
							<div class="base-item">
								<span class="col-lg-2">登录名</span>
								<span>{{ Auth::user()->email }}</span>
							</div>
							<div class="base-item">
								<span class="col-lg-2">商家名称</span>
								<span>{{ Auth::user()->name }}</span>
							</div>
							<div class="base-item">
								<span class="col-lg-2">地址</span>
								<span>
									<input type="text" id="address" name="address" style="width:250px" required="required" value="{{ Auth::user()->address }}">
									<input type="hidden" name="longitude" id="longitude" value="" />
									<input type="hidden" name="latitude" id="latitude" value="" />
									<a id="locate" href="javascript:void(0)" onclick="locate()" class="btn btn-primary">定位</a>
									<span id="warm-warning" class="alert alert-danger">用户必须先进行定位才能录入广告！</span>
								</span>
							</div>
							<div class="base-item">
								<span class="col-lg-2">注册时间</span>
								<span>{{ Auth::user()->created_at }}</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="map-container" class="container" style="display:none">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div id="r-result">
						搜索地点：
						<input type="text" id="suggestId" size="20" value="" style="width:300px;" />
						<a href="javascript:void(0)" onclick="locateCompleted()" class="btn btn-success" style="float:right">选择地址</a>
					</div>
					<div id="searchResultPanel" style="border:1px solid #C0C0C0;width:300px;height:auto; display:none;"></div>
				</div>
				<div class="panel-body">
					<div id="map" style="width:100%;height:400px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function edit() {
		if ($("#edit-bt").attr("event-type") == 0) {
			$("#base-view").css("display", "none");
			$("#base-edit").css("display", "block");
			$("#edit-bt").attr("event-type", "1").html("保存");
		} else {
			$("#info-form").submit();
		}
	}

	function locateCompleted() {
		$("#info-container").css("display", "block");
		$("#map-container").css("display", "none");
		$("#warm-warning").html("已定位成功！");
	}

	function locate() {
		G("info-container").style.display = "none";
		G("map-container").style.display = "block";

		var map = new BMap.Map("map");                // 创建地图实例  
		var point = new BMap.Point(113.394, 23.408);  // 创建初始点坐标  
		map.centerAndZoom(point, 11);                 // 初始化地图，设置中心点坐标和地图级别
		map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
		map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用 

		var geolocation = new BMap.Geolocation();
		geolocation.getCurrentPosition(function(r){
			if(this.getStatus() == BMAP_STATUS_SUCCESS){
				var mk = new BMap.Marker(r.point);
				map.panTo(r.point);
				/*
				window.setTimeout(function(){  
				    map.panTo(r.point);
				}, 2000);
				map.addOverlay(mk);
				*/
			}
			else {
				alert('failed'+this.getStatus());
			}        
		}, {enableHighAccuracy: true})
		//关于状态码
		//BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
		//BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
		//BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
		//BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
		//BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
		//BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
		//BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
		//BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1 新增)
		//BMAP_STATUS_TIMEOUT	超时。对应数值“8”。(自 1.1 新增)

		// 添加带有定位的导航控件
		var navigationControl = new BMap.NavigationControl({
			// 靠左上角位置
			anchor: BMAP_ANCHOR_TOP_LEFT,
			// LARGE类型
			type: BMAP_NAVIGATION_CONTROL_LARGE,
			// 启用显示定位
			//enableGeolocation: true
		});
		map.addControl(navigationControl);

		// 添加定位控件
		var geolocationControl = new BMap.GeolocationControl();
		geolocationControl.addEventListener("locationSuccess", function(e){
			// 定位成功事件
			var address = '';
			address += e.addressComponent.province;
			address += e.addressComponent.city;
			address += e.addressComponent.district;
			address += e.addressComponent.street;
			address += e.addressComponent.streetNumber;
			alert("当前定位地址为：" + address);
		});
		geolocationControl.addEventListener("locationError",function(e){
			// 定位失败事件
			alert(e.message);
		});
		map.addControl(geolocationControl);

		//单击获取点击的经纬度
		map.addEventListener("click", function(e){
	      	var myGeo = new BMap.Geocoder();      
			// 根据坐标得到地址描述    
			myGeo.getLocation(new BMap.Point(e.point.lng, e.point.lat), function(result){      
				if (result){
					point = e.point;
					//var addComp = result.addressComponents;
					//alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
					map.clearOverlays();    //清除地图上所有覆盖物
					var marker = new BMap.Marker(point);  // 创建标注
					map.addOverlay(marker);              // 将标注添加到地图中
					map.centerAndZoom(point, 18);
					var opts = {
						width : 200,     // 信息窗口宽度
						height: 100,     // 信息窗口高度
						title : "当前地址" , // 信息窗口标题
						enableMessage:true,//设置允许信息窗发送短息
						message: "我的地址："+result.address+"<br/>"
					}
					var infoWindow = new BMap.InfoWindow(result.address, opts);  // 创建信息窗口对象 
					map.openInfoWindow(infoWindow,point); //开启信息窗口
					G("address").value = result.address;
					G("longitude").value = point.lng;
					G("latitude").value = point.lat;

					/*
					// 获取附近全部POI
					var allPois = result.surroundingPois;
					text = "";
					for(i=0;i<allPois.length;++i){
						text += "" + (i+1) + "、" + allPois[i].title + ",地址:" + allPois[i].address + "\n";
						map.addOverlay(new BMap.Marker(allPois[i].point));                
					}
					*/
				}
			});
		});

		// 输入提示
		var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
			{"input" : "suggestId"
			,"location" : map
		});
		ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
			var str = "";
			var _value = e.fromitem.value;
			var value = "";
			if (e.fromitem.index > -1) {
				value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
			}    
			str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;
			
			value = "";
			if (e.toitem.index > -1) {
				_value = e.toitem.value;
				value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
			}    
			str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
			G("searchResultPanel").innerHTML = str;
		});

		var myValue;
		ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
		var _value = e.item.value;
			myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
			G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
			
			setPlace();
		});

		function setPlace(){
			map.clearOverlays();    //清除地图上所有覆盖物
			function myFun(){
				var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
				var marker = new BMap.Marker(pp);  // 创建标注
				map.centerAndZoom(pp, 18);
				map.addOverlay(marker);    //添加标注
				var myGeo = new BMap.Geocoder();      
				// 根据坐标得到地址描述    
				myGeo.getLocation(pp, function(result){      
					if (result){
						var opts = {
							width : 200,     // 信息窗口宽度
							height: 100,     // 信息窗口高度
							title : "当前地址" , // 信息窗口标题
							enableMessage:true,//设置允许信息窗发送短息
							message: "我的地址："+result.address+"<br/>"
						}
						var infoWindow = new BMap.InfoWindow(result.address, opts);  // 创建信息窗口对象 
						map.openInfoWindow(infoWindow,pp); //开启信息窗口
						G("address").value = result.address;
						G("longitude").value = pp.lng;
						G("latitude").value = pp.lat;
					}
				});
			}
			var local = new BMap.LocalSearch(map, { //智能搜索
			  onSearchComplete: myFun
			});
			local.search(myValue);
		}

		function G(id) {
			return document.getElementById(id);
		}
	}
</script>
<script src="http://api.map.baidu.com/api?v=2.0&ak=gvaZZT3NAfVeoHIUKC6aiYS2" type="text/javascript"></script>
@endsection
