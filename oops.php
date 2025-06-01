<?php
  
//    class laptop{
//           public $price=9000;
//    	      public function keypad(){
//    	      	//$obj1= new laptop();
//    	      	echo "laptop ready ".$this->price;
//    	      }
//    }

//    $obj = new laptop();

//    $obj->keypad();

//    echo "<br>";

// // single inheritance

//    class laptop1{
//           public $price=9000;
//    	      public function keypad1(){
//    	      	//$obj1= new laptop();
//    	      	echo "laptop ready ".$this->price;
//    	      }
//    }

//    class printer1 extends laptop1{

//    	   public function A4(){
//    	   	 echo "print ready";
//    	   }
//    }

//    $objin = new printer1();

//    $objin->keypad1();

//    echo "<br>";


//  // multilevel inheritance


//    class laptop2{
//           public $price=9000;
//    	      public function keypad1(){
//    	      	//$obj1= new laptop();
//    	      	echo "laptop ready ".$this->price;
//    	      }
//    }

//    class printer extends laptop2{

//    	   public function A4(){
//    	   	 echo "print ready";
//    	   }
//    }

//    class joypad extends printer{

//    	    public function up(){
//    	    	return "jump";
//    	    }
//    }

//    $objin = new joypad();

//    $objin->keypad1();
//    echo "<br>";
//    $result=$objin->up();
//    echo $result;


// //hierarchal inheritance

//       class laptop3{
//           public $price=9000;
//    	      public function keypad3(){
//    	      	//$obj1= new laptop();
//    	      	echo "laptop ready ".$this->price;
//    	      }
//    }

//    class printer4 extends laptop3{

//    	   public function A4(){
//    	   	 echo "print ready";
//    	   }
//    }

//    class joypad1 extends laptop3{

//    	    public function up(){
//    	    	return "jump";
//    	    }
//    }

//    $objin = new joypad1();

//    $objin->keypad3();
//    echo "<br>";
//    $result=$objin->up();
//    echo $result;


// // multiple inheritance 
//    //not supported in php

//   //example: class joypad1 extends laptop3 printer4


//    //trait -> multiple inheritance --- -- -- -- -- 





// // GET request
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // Retrieve data from DB
//     $data = ['id' => 1, 'name' => 'John'];
//    // header('Content-Type: application/json');
//     echo json_encode($data);
// }

$name="Saravanan";
$kkk=0;
$result=array();
for($iii=0;$iii<strlen($name);$iii++){
   
     for($jjj=$iii+1;$jjj<strlen($name)-1;$jjj){

          if($name[$iii]==$name[$jjj]){
               echo "saro";
               $result[$kkk]=$name[$iii];
               $kkk++;
               break;
               

           }

       }

}

print_r($result);


?>  