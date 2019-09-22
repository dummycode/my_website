<?PHP
$data = ['status' => 200, 'message' => 'Hello World'];

header('Content-Type: application/json');
echo json_encode($data);

