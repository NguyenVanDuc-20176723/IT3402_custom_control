<?php

namespace App\Http\Controllers;
use Alert;
use Illuminate\Http\Request;
use Session;
class Server
{
    public function getDatHang(){
    	$cart = Session::get('cart');
    	$myJSON = json_encode($cart);
    	echo $myJSON;
    }

    public function resetSession(){
    	Session::forget('cart');
         Alert::success('Success','đặt hàng thành công');
        return redirect('index');
    }

}
