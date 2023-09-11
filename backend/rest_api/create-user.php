<?php
    $response=array();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        require_once '../classes/User.php';
    $users=new User();
       
        if(!isset($_GET['contact_no'])){
            $response['error']=true;
            $response['message']="Contact no not provided";
        }else{
            
            $status=$users->authUserWithContact($_GET['contact_no'],$_POST);
            // echo $status;
            if($status==1){
                $response['error']=false;
                $response['message']="User Created successfully";
            }if($status==-1){
                $response['error']=true;
                $response['message']="User already exists";
            }
            if($status==0){
                $response['error']=true;
                $response['message']="User not Created,something went wrong ";
            }
        }
       
    }else{
        $response['error']=true;
        $response['message']="Invalid method";
    }
    echo json_encode($response);
?>