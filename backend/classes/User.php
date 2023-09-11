<?php
class User
{
    public $con;
    public function __construct()
    {
        require_once dirname(__FILE__) . "/includes/DbConnect.php";
        $db = new DbConnect();
        $this->con = $db->connect();
    }
    function getAllUsers()
    {
        $sql = 'SELECT * from `users`';
        return mysqli_query($this->con, $sql);
    }
   
    function edituser($post){
        echo
        $sql = "UPDATE `users` SET `type` = '$post[type]', `name` = '$post[name]', `id_proof` = '$post[id_proof]', `email` = '$post[email]', `password` = '$post[password]', `contact_no` = '$post[contact_no]', `address` = '$post[address]', `gender` = '$post[gender]'  WHERE `users`.`user_id` = '$post[user_id]'";
        return mysqli_query($this->con, $sql);  


    }
    function getdetailByUid($user_id)
    {
        $sql = "SELECT * from `users` WHERE user_id=$user_id";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $temp = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $temp[] = $row;
            }
            return $temp;
        } else
            return false;
    }
    function gethistoryByUid($user_id)
    {
        $sql = "SELECT * from `attendance` WHERE user_id=$user_id";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $temp = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $temp[] = $row;
            }
            return $temp;
        } else
            return false;
    }
    public function getAllhistoryWithPagination($user_id,$startLimit,$recordPerPage){
       
       
        $sql="SELECT * FROM `attendance` WHERE `user_id`=$user_id ORDER by `created_at` DESC LIMIT $startLimit,$recordPerPage;";
        $result=mysqli_query($this->con,$sql);
        return $result;
    }
    function authUserWithContact($contact_no,$post)
    {
        if ($this->isUserExists($contact_no))
            return 0;
        else {
            $sql = "INSERT INTO `users` (`type`,`name`,`id_proof`,`email`,`password`,`contact_no`,`address`,`gender`,`sispl_id`) VALUES('$post[type]', '$post[name]','$post[id_proof]','$post[email]','$post[password]','$post[contact_no]','$post[address]','$post[gender]','$post[sispl_id]')";
            // $sql="INSERT INTO `users` (`type`,`name`,`id_proof`,`email`,`password`,`contact_no`,`address`,`gender`) VALUES ($type,$name,$id_proof,$email,$password,$contact_no,$address,$gender)";
            $status = mysqli_query($this->con, $sql);
            if ($status > 0)
                return 1;
            else
                return -1;
        }
    }
    function isUserExists($contact_no)
    {
        
        $sql = "SELECT * FROM `users` WHERE contact_no=$contact_no";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0)
          return true;
        else
            return false;
    }
    
}
