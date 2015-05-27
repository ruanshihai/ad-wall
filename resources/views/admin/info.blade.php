@extends("app")

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Info</div>

				<div class="panel-body">
					<div id="base-view">
						<div class="base-item">
							<span class="col-lg-2">Username</span>
							<span>{{ Auth::user()->name }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
