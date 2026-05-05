<?php
    function getJsonInput(){
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        if(!is_array($data)){
            $data = $_POST;
        }

        return $data;
    }

    function sendJson($data){
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    function requireLoginForAjax(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['status']) || $_SESSION['status'] !== true){
            sendJson([
                'success' => false,
                'message' => 'Unauthorized request. Please login first.'
            ]);
        }
    }
?>
