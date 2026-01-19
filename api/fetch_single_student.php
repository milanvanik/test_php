<?php
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("../config/config.php");
$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $res = $config->fetchSingleStudent($id);

        if ($res) {
            $row = mysqli_fetch_assoc($res);

            if ($row) {
                http_response_code(200);
                $arr['status'] = 200;
                $arr['error'] = false;
                $arr['data'] = $row;
                $ar['msg'] = "student data fetched successfully";
            } else {
                http_response_code(404);
                $arr['status'] = 404;
                $arr['error'] = true;
                $arr['msg'] = "Student didn't found";
            }
        } else {
            http_response_code(500);
            $arr['status'] = 500;
            $arr['error'] = true;
            $arr['msg'] = "server error";
        }
    } else {
        http_response_code(400);
        $arr['status'] = 400;
        $arr['error'] = true;
        $arr['msg'] = "Kindly input an ID";
    }
} else {
    http_response_code(405);
    $arr['status'] = 405;
    $arr['error'] = true;
    $arr['msg'] = "POST HTTP Request Method Allowed Only";
}

echo json_encode($arr);
?>