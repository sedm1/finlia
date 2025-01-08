<?php
include __DIR__ . '/../db/connect.php';

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

$action = isset($data['action']) ? $data['action'] : '';

$res = [
    'data' => [],
    'errors' => [],
];

function sanitize_action($action): string
{
    return preg_replace('/[^a-zA-Z0-9_\/]/', '', $action);
}

$action = sanitize_action($action);

if (empty($action)) {
    $res['errors'][] = 'Не задан action';
    echo json_encode($res, JSON_UNESCAPED_UNICODE);

    exit;
}
$servicePosition = strpos($action, "/");

$action = substr_replace($action, '/Methods/', $servicePosition, 1);

$serviceFile = __DIR__ . '/' . $action . '.php';

if (!file_exists($serviceFile)) {
    $res['errors'][] = 'Сервис не найден';
    echo json_encode($res, JSON_UNESCAPED_UNICODE);

    exit;
}

function include_service($serviceFile, $data) : array
{
    global $action;
    global $pdo;

    include_once '../Methods/AbstractMethod.php';
    include_once $serviceFile;

    $servicePath = str_replace('/', '\\', $action);

    $service = 'Services\\' . $servicePath;

    $service = new $service($data, $pdo);

    return $service->exec();
}

$serviceRes = include_service($serviceFile, $data);
if (!isset($serviceRes['errors'])) $res['data'] = $serviceRes['data'];

$res['errors'] = $serviceRes['errors'] ?? [];

echo json_encode($res, JSON_UNESCAPED_UNICODE);

