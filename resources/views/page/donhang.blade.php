@extends('master')
@section('content')


	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form method="post" class="beta-form-checkout" >
				 {{ csrf_field() }}
					<div class="col-sm-6">
						<h4>Đặt hàng</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">Họ tên*</label>
							<input type="text" id="name" name="name" placeholder="Họ tên" required>
						</div>
						<div class="form-block">
							<label>Giới tính </label>
							<input id="gender" type="radio" class="input-radio" name="gender" value="Nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="Nữ" style="width: 10%"><span>Nữ</span>
										
						</div>

						<div class="form-block">
							<label for="email">Email</label>
							<input type="email" id="email" name="email" placeholder="expample@gmail.com" required>
						</div>

						<div class="form-block">
							<label for="address">Địa chỉ*</label>
							<input type="text" id="address" name="address" placeholder="Street Address" required>
						</div>
						

						<div class="form-block">
							<label for="phone">Điện thoại*</label>
							<input type="text" id="phone" name="phone" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="note"></textarea>
						</div>
						<!-- show ket qua -->
						<div id="show"></div>
						<!-- end show -->
					</div>
					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
										<!-- product get server-->
										<div class="media" id="product_bill">
											
										</div>
										<!-- end product -->
	
									</div>
								<div class="clearfix"></div>
							</div>
							<div class="your-order-item">
								<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
								<div class="pull-right"><h5 class="color-black"><div id="totalPrice_"></div></h5>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
							
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
							
							<div class="your-order-body">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>						
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
										<label for="payment_method_cheque">Chuyển khoản </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
											Chuyển tiền đến tài khoản sau:
											<br>- Số tài khoản: 7357757
											<br>- Chủ TK: Nguyễn Tuấn Anh
											<br>- Ngân hàng ACB, Chi nhánh Hà Nội
										</div>						
									</li>
									
								</ul>
							</div>

							<div class="text-center">
							 <button type="submit" id="dathang" class="beta-btn primary" onclick="dathang_()" >Đặt hàng <i class="fa fa-chevron-right"> </i></button></div>
							

						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->

	
<script type="text/javascript">
var obj,totalPrice, xmlhttp, product;
//dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
  	product=JSON.parse(this.responseText);
  	obj = "";
  	totalPrice = "";
  	if(product != null){
	  	for (var pro in product.items){
	  		obj += '<div class="media"><img width="25%" src="source/image/product/' + product.items[pro].item.image + '" alt="" class="pull-left">'
	  		 + '<div class="media-body"><p class="font-large">' + product.items[pro].item.name 
	  		 + '</p><span class="color-gray your-order-info">Đơn giá: ' + product.items[pro].price 
	  		 + ' Đồng</span><span class="color-gray your-order-info">Số lượng: ' + product.items[pro].qty
	  		 + '</span></div></div>'
	  		
	  	}

	  	totalPrice += product.totalPrice;
  	}else{
  		totalPrice += "0";
  	}
  	totalPrice += " Đồng"
    document.getElementById("product_bill").innerHTML = obj;
    document.getElementById("totalPrice_").innerHTML = totalPrice;
  }
};
xmlhttp.open("GET", "http://localhost/WebsiteLaravel/public/server", true);
xmlhttp.send();

</script>

<script type="text/javascript">
function telephoneCheck(str) {
	  var a = /^(1\s|1|)?((\(\d{3}\))|\d{3})(\-|\s)?(\d{3})(\-|\s)?(\d{4})$/.test(str);
	  return a;
}
function dathang_(){
	var http, myObj, dbParam, json_input_data = {};
	json_input_data.name = document.getElementById("name").value;
	json_input_data.gender = document.querySelector('input[id = "gender"]:checked').value;
	json_input_data.email = document.getElementById("email").value;
	json_input_data.address = document.getElementById("address").value;
	json_input_data.phone = document.getElementById("phone").value;
	json_input_data.note = document.getElementById("notes").value;
	json_input_data.payment = document.querySelector('input[name = "payment_method"]:checked').value;

	if(json_input_data.name === "" || json_input_data.email === "" || json_input_data.phone === "" || json_input_data.address === ""){

		console.log("nhap dung di ban oi!");
	
	}
	
	else {

		dbParam = JSON.stringify(json_input_data);
		
		myObj = JSON.stringify(product);
		http = new XMLHttpRequest();
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				
				location.href = "{{route('reset_session')}}";
			}
		}
		http.open("POST", "http://localhost/WebsiteLaravel/app/Http/Controllers/Request__.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send("dathang="+dbParam +"&cart=" + myObj);
		
		
	}
}
</script>

<script type="text/javascript" href="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js">

</script> 
@endsection

