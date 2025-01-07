<?php
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

$action = isset($data['action']) ? $data['action'] : '';

$res = [
    'data' => [],
    'errors' => [],
];

function sanitize_action($action)
{
    return preg_replace('/[^a-zA-Z0-9_\/]/', '', $action);
}

$action = sanitize_action($action);

if (empty($action)) {
    $res['errors'][] = 'Не задан action';
    echo json_encode($res, JSON_UNESCAPED_UNICODE);

    exit;
}

$service_file = __DIR__ . '/' . $action . '.php';

if (!file_exists($service_file)) {
    $res['errors'][] = 'Сервис не найден';
    echo json_encode($res, JSON_UNESCAPED_UNICODE);

    exit;
}
/**
 * Буферизация файла
 */
function include_service($service_file, $data)
{
    ob_start();
    include $service_file;

    return ob_get_clean();
}

$serviceRes = json_decode(include_service($service_file, $data), true);
if (!$serviceRes['errors']) $res['data'] = $serviceRes['data'];
$res['errors'] = $serviceRes['errors'] ?: [];

echo json_encode($res, JSON_UNESCAPED_UNICODE);

