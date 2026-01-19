<?php
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $res = $config->fetchStudents();
    $student_list = [];

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $student_list[] = $row;
        }

        http_response_code(200);
        $arr['status'] = 200;
        $arr['error'] = false;
        $arr['data'] = $student_list;
        $arr['msg'] = "all students data fetched successfully";
    } else {
        http_response_code(500);
        $arr['status'] = 500;
        $arr['error'] = true;
        $arr['msg'] = "Failed to fetch any data";
    }
} else {
    http_response_code(405);
    $arr['status'] = 405;
    $arr['error'] = true;
    $arr['msg'] = "GET HTTP Request Method Allowed Only";
}

echo json_encode($arr);
?>