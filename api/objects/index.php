<?PHP
$objects = [{'id' = 1, 'name' => 'Henry Harris'}, {'id' => 2, 'name' => 'Tom Cruise'}]
$data = ['status' => 200, 'data' => $objects];

header('Content-Type: application/json');
echo json_encode($data);

