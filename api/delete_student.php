<?php
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json");
include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $input = file_get_contents('php://input');
    parse_str($input, $_DELETE);
    $id = $_DELETE['id'];
    $res = $config->deleteStudent($id);

    if ($res) {
        http_response_code(response_code: 200);
        $arr['status'] = 200;
        $arr['error'] = false;
        $arr['msg'] = "Student successfully deleted!";
    } else {
        http_response_code(response_code: 400);
        $arr['status'] = 400;
        $arr['error'] = true;
        $arr['msg'] = "failed to delete student";
    }
} else {
    http_response_code(response_code: 405);
    $arr['status'] = 405;
    $arr['error'] = true;
    $arr['msg'] = "DELETE HTTP Request Method Allowed Only";
}

echo json_encode($arr);
?>