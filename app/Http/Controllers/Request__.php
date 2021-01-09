<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class Request__ {
	public function postDatHang(){
		
		$obj = json_decode($_POST["dathang"], false);
		$cart = json_decode($_POST["cart"], false);
        $check_customer_id;
        $customer = new Customer();
        $check_customer = $customer->where("phone_number",$obj->phone);
        if (mysqli_num_rows($check_customer) > 0) {
      
          while($row = mysqli_fetch_assoc($check_customer)) {
            $check_customer_id = $row['id'];
            break;
          }
        } else {
                $customer->name = $obj->name;
                $customer->gender = $obj->gender; 
                $customer->email = $obj->email;
                $customer->address = $obj->address;
                $customer->phone_number = $obj->phone;
                $customer->note = $obj->note;
                $customer->save(); 
                
                $check_customer_id = $customer->id;
                  
        }

        $bill = new Bill;
        $bill->id_customer = $check_customer_id;
        $bill->date_order= date('y-m-d');
         $bill->total = $cart->totalPrice;
         $bill->payment = $obj->payment;
         $bill->note = $obj->note;
        $bill->save();

         $bill_detail = new BillDetail;
         
         foreach ($cart->items as $key => $value) {

                $bill_detail->id_bill = $bill->id;
               $bill_detail->id_product = $key;
               $bill_detail->quantity = $value->qty;
               $bill_detail->unit_price = $value->item->unit_price;
               $bill_detail->save();
         }
        
    
    }
}
//Model - database
class Model{
    protected $db_host;
    protected $db_user;
    protected $db_password;
    protected $db_database;
    protected $mysqli;
    public function getMysqli(){
        return $this->mysqli;
    }
    public function __construct(){
        $this->db_host = "localhost";
        $this->db_user = "root";
        $this->db_password = "";
        $this->db_database ="db_banhang1";
        
        $this->mysqli = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_database)
        or die("can't connect database '".$this->db_database."'");
    }
}
class Customer extends Model{
    public $id;
    public $name;
    public $gender;
    public $email;
    public $address;
    public $phone_number;
    public $note;

    public function save(){
        $sql = "INSERT INTO customer (name, gender, email, address, phone_number, note)
        VALUES ('".$this->name."', '".$this->gender."', '".$this->email."','".$this->address."','".$this->phone_number."','".$this->note."')";

        if (mysqli_query($this->mysqli, $sql)) {
          echo "New record created successfully";
          $this->id = mysqli_insert_id($this->mysqli);
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($this->mysqli);
        }
    }

    public function where($column, $value){
        $sql = "SELECT * FROM customer WHERE ".$column."='".$value."'";
        $result = mysqli_query($this->mysqli, $sql);
        return $result;
    }
}

class Bill extends Model{
    public $id;
    public $id_customer;
    public $date_order;
    public $total;
    public $payment;
    public $note;

    public function save(){
        $sql = "INSERT INTO bills (id_customer, date_order, total, payment, note)
            VALUES ('".$this->id_customer."','".$this->date_order."','".$this->total."','".$this->payment."','".$this->note."')";

        if (mysqli_query($this->mysqli, $sql)) {
          echo "New record created successfully";
           $this->id = mysqli_insert_id($this->mysqli);
          
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($this->mysqli);
        }
    }

    public function where($column, $value){
        $sql = "SELECT * FROM bills WHERE ".$column."='".$value."'";
        $result = mysqli_query($this->mysqli, $sql);
        return $result;
    }

}

class BillDetail extends Model{
    public $id;
    public $id_bill;
    public $id_product;
    public $quantity;
    public $unit_price;

    public function save(){
        $sql = "INSERT INTO bill_detail (id_bill, id_product, quantity, unit_price)
            VALUES ('".$this->id_bill."','".$this->id_product."','".$this->quantity."','".$this->unit_price."')";

        if (mysqli_query($this->mysqli, $sql)) {
          echo "New record created successfully";
          $this->id = mysqli_insert_id($this->mysqli);
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($this->mysqli);
        }
    }

    public function where($column, $value){
        $sql = "SELECT * FROM bill_detail WHERE ".$column."='".$value."'";
        $result = mysqli_query($this->mysqli, $sql);
        return $result;
    }

}
Request__::postDatHang();
// $customer = new Customer();
// $bill = new Bill();
// $bill_detail = new BillDetail();
// --search customer
// $column = "phone_number";
// $value = '1234';
// $test = $customer->where($column, $value);
// if (mysqli_num_rows($test) > 0) {
//   // output data of each row
//   while($row = mysqli_fetch_assoc($test)) {
//     echo "id: " . $row['id']. " - Name: " . $row['name']. "<br>";
//   }
// } else {
//   echo "0 results";
// }
//---insert customer
// $customer->name = "duc";
// $customer->gender ="Nam";
// $customer->email = "missyou97s2@gmail.com";
// $customer->address = "18";
// $customer->phone_number = "0965974599";
// $customer->note = "ok hang ngon";
// $customer->save();

//-----search bills
// $colum = "id_customer";
// $value = 36;
// $test = $bill->where($colum,$value);

// echo "so hang: ".mysqli_num_rows($test);
// if (mysqli_num_rows($test) > 0) {
//   // output data of each row
//   while($row = mysqli_fetch_assoc($test)) {
//     echo "id: " . $row['id']. " - Name: " . $row['id_customer']. "<br>";
//   }
// } else {
//   echo "0 results";
// }
//---insert bill
// $bill->id_customer = "37";
// $bill->date_order = date('y-m-d');
// $bill->total = "123456";
// $bill->payment = "COD";
// $bill->note = "hang ngon";

// $bill->save();

//-----search bill_detail
// $colum = "id_bill";
// $value = 37;
// $test = $bill_detail->where($colum,$value);

// echo "so hang: ".mysqli_num_rows($test)."<br>";
// if (mysqli_num_rows($test) > 0) {
//   // output data of each row
//   while($row = mysqli_fetch_assoc($test)) {
//     echo "id: " . $row['id']. " - Name: " . $row['id_product']. "<br>";
//   }
// } else {
//   echo "0 results";
// }
//---insert bill_detail
// $bill_detail->id_bill = "37";
// $bill_detail->id_product = "64";
// $bill_detail->quantity = "2";
// $bill_detail->unit_price = "300000";


// $bill_detail->save();