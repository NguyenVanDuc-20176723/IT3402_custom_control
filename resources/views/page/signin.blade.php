@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng kí</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form action="{{route('dangky')}}" method="post" class="beta-form-checkout">

				@csrf
				<div class="row">
					<div class="col-sm-3"></div>

					@if(count($errors)>0)
						<div class="alert alert-danger">
							@foreach($errors->all() as $err)
								{{$err}}&nbsp;
							@endforeach

						</div>

					@endif

	@if(Session::has('thanhcong')) <div class="alert alert-success"> {{Session::get('thanhcong')}}</div>
	@endif

					<div class="col-sm-6">
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Email*</label>
							<input type="email" id="email" name="email" >
						</div>

						<div class="form-block">
							<label for="your_last_name">Họ tên*</label>
							<input type="text" id="your_last_name" name="hoten" >
						</div>

						<div class="form-block">
							<label for="adress">Địa Chỉ</label>
							<input type="text" id="adress" name="diachi"  >
						</div>

						<div class="form-block">
							<label for="phone">Số điện thoại*</label>
							<input type="text" id="phone" name="phone" >
						</div>
						<div class="form-block">
							<label for="phone">Mật khẩu*</label>
							<input type="password" id="phone" name="password" >
						</div>
						<div class="form-block">
							<label for="phone">Nhập lại mật khẩu*</label>
							<input type="password" id="phone" name="re_password" >
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary" style="margin-left: 400px">Đăng ký</button>
						</div>

					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
	
	<script src="source/assets/dest/calendar/js/moment-with-locales.min.js"></script> 
	<script src="source/assets/dest/calendar/js/js/ion.calendar.js"></script> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>	
	
		$("#mydate").ionDatePicker();

	</script>
@endsection