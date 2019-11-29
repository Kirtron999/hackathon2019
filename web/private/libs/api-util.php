<?php

function api_response(array $data): void {
    $json = json_encode($data);
    ob_end_clean();
    header("Content-Type: application/json");
    echo $json;
    exit;
}

function api_error_response(string $message): void {
    api_response([
        "success" => false,
        "message" => $message
    ]);
}

function http_get_param(string $key): ?string {
    if (isset($_GET[$key]) && is_string($_GET[$key])) {
        return $_GET[$key];
    }

    return null;
}

function http_post_param(string $key): ?string {
    if (isset($_POST[$key]) && is_string($_POST[$key])) {
        return $_POST[$key];
    }

    return null;
}


?>