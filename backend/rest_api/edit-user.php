<?php
require_once('./require.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = new User();
    $post = json_decode(file_get_contents('php://input'), true);
    if (isset($post['user_id'])) {
        $result = $users->edituser($post);
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
