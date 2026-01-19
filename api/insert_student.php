<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    $res = $config->insertStudents($name, $age, $course);

    if ($res) {
        http_response_code(201);
        $arr['status'] = 201;
        $arr['error'] = false;
        $arr['msg'] = 'Student successfully inserted!';
    } else {
        http_response_code(201);
        $arr['status'] = 201;
        $arr['error'] = true;
        $arr['msg'] = "falied to insert student";
    }
} else {
    http_response_code(response_code: 400);
    $arr['status'] = 400;
    $arr['error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);

?>