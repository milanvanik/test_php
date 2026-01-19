<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['member_name'], $_POST['dept_id'])) {
        $name = $_POST['member_name'];
        $id = $_POST['dept_id'];

        $res = $config->insertMember($name, $id);

        if ($res) {
            http_response_code(201);
            $arr['status'] = 201;
            $arr['error'] = false;
            $arr['msg'] = 'member inserted successfully';
        } else {
            http_response_code(201);
            $arr['status'] = 201;
            $arr['error'] = true;
            $arr['msg'] = "Failed, Check if dept_id exists";
        }

    } else {
        http_response_code(500);
        $arr['status'] = 500;
        $arr['error'] = true;
        $arr['msg'] = "dept_name and dept_id are required";
    }

} else {
    http_response_code(400);
    $arr['status'] = 400;
    $arr['error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);

?>