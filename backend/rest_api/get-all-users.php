<?php
require_once './require.php';
require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $users = new User();
    $result = $users->getAllUsers();
    if ($result == false)
        $response['message'] = SERVER_ERROR;
    else {
        $temp = array();
        while ($row = mysqli_fetch_assoc($result))
            $temp[] = $row;
        $response['data'] = $temp;
        $response['message'] = 'success';
        $response['error'] = false;
    }
} else
    $response['message'] = INVALID;
echo json_encode($response);
