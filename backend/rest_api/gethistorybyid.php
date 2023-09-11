<?php
require_once('./require.php');
require_once('../classes/User.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['user_id'])) {
        $orders = new User();
        $result = $orders->gethistoryByUid($_GET['user_id']);
        if ($result == false)
            $response['message'] = SERVER_ERROR;
        else {
            $response['data'] = $result;
            $response['message'] = 'success';
            $response['error'] = false;
        }
    } else {
        $response['message'] = 'uid not provided';
    }
} else
    $response['message'] = INVALID;
echo json_encode($response);
