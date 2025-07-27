$query = http_build_query([
    'quantity' => 10,
    'locale' => 'en_US',
    'seed' => 123
]);

$url = 'https://lorumapi.ddev.site/api/faker/addresses?' . $query;

$response = file_get_contents($url);
$data = json_decode($response, true);

print_r($data);
