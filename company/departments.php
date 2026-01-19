<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['dept_name'];

    $res = $config->insertDepartment($name);

    if ($res) {
        http_response_code(201);
        $arr['status'] = 201;
        $arr['error'] = false;
        $arr['msg'] = 'successfully inserted department';
    } else {
        http_response_code(201);
        $arr['status'] = 201;
        $arr['error'] = true;
        $arr['msg'] = "department insertion falied";
    }
} else {
    http_response_code(response_code: 400);
    $arr['status'] = 400;
    $arr['error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);

?>