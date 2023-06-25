<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include 'connect.php';

$objDb= new Dbconnect;
$conn= $objDb->connect();

$method=$_SERVER['REQUEST_METHOD'];
switch($method){

    case "GET":

        $path=explode('/',$_SERVER['REQUEST_URI']);
    if(isset($path[3]) && is_numeric($path[3]))
    {

$json_array=array();
$userid=$path[3];
$sql="SELECT * FROM demo WHERE user_id='$userid'";
$stmt=$conn->prepare($sql);
$stmt->execute();
$login_student=$stmt->fetchAll(PDO :: FETCH_ASSOC);
echo json_encode($login_student);



    }else{
        $sql="SELECT * FROM demo";
$stmt=$conn->prepare($sql);
$stmt->execute();
$login_student=$stmt->fetchAll(PDO :: FETCH_ASSOC);
echo json_encode($login_student);


    }
    break;
    case "PUT":

         $usupdt=json_decode(file_get_contents("php://input"));
        // print_r($usupdt);die;
         
        $user_id=$usupdt->user_id;
        $user_name=$usupdt->user_name;
        $user_email=$usupdt->user_email;
        $user_address=$usupdt->user_address;
        $user_mob=$usupdt->user_mob;
       

       $updatedata="UPDATE demo SET user_name='$user_name',
       user_email='$user_email',user_address=' $user_address' ,user_mob='$user_mob' WHERE user_id='$user_id'";
        $stmt2=$conn->prepare($updatedata);
        $stmt2->execute();

        if($updatedata){
            echo json_encode(["success"=>"updated allready"]);
            return;
        }else{
           echo json_encode(["success"=>"not updated"]);
           return;
        
        //print_r($usupdt); die;
    }

        break;

        case "DELETE":
            $path=explode('/',$_SERVER['REQUEST_URI']); 
            
    
           // echo 'message'.$path[3];die;  
    
            $result="DELETE FROM demo WHERE user_id='$path[3]' ";
            $stmt1=$conn->prepare($result);
            $stmt1->execute();

            if($result){
                echo json_encode(["success"=>"deleted"]);
                return;
            }else{
                echo json_encode(["success"=>"not deleted"]);
                return;
            }
    
            break;

            case "POST":

                
                $userinsert=json_decode(file_get_contents("php://input"));
                //echo "success inserted";
               // print_r($userinsert);die;

                $user_name=$userinsert->user_name;
                $user_email=$userinsert->user_email;
               
                $user_address=$userinsert->user_address;
                $user_mob=$userinsert->user_mob;
                $insert="INSERT INTO demo(user_name,user_email,user_address,user_mob) 
                 VALUES('$user_name','$user_email','$user_address','$user_mob')";
                 $stmt4=$conn->prepare($insert);
                 $stmt4->execute();
     
                 if($insert){
                     echo json_encode(["success"=>"inserted"]);
                     return;
                 }else{
                     echo json_encode(["success"=>"not inserted"]);
                     return;
                 }

        

                
                 break;
                
            


            

        

   

}

?>