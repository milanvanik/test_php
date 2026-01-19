<?php

header("Access-Control-Allow-Methods: PUT, PATCH");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH') {

    $input = file_get_contents('php://input');
    parse_str($input, $_UPDATE);

    $name = $_UPDATE['name'];
    $age = $_UPDATE['age'];
    $course = $_UPDATE['course'];
    $id = $_UPDATE['id'];

    $res = $config->updateStudent($name, $age, $course, $id);

    if ($res) {
        http_response_code(200);
        $arr['status'] = 200;
        $arr['error'] = false;
        $arr['msg'] = "Student successfully updated!";
    } else {
        http_response_code(500);
        $arr['status'] = 500;
        $arr['error'] = true;
        $arr['msg'] = "failed to update student";
    }

} else {
    http_response_code(405);
    $arr['status'] = 405;
    $arr['error'] = true;
    $arr['msg'] = "PUT or PATCH Request Method Allowed Only";
}

echo json_encode($arr);
?>