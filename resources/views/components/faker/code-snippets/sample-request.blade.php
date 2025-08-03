@extends('components.faker.code-snippets.wrapper')


@section('php-code-snippet')
$query = http_build_query([
@foreach($parameters as $parameter)
    '{{ $parameter['name'] }}' => {{ $parameter['type'] === 'integer' || $parameter['type'] === 'float' ? $parameter['example'] : '\'' . $parameter['example'] . '\'' }},
@endforeach
]);

$url = 'https://lorumapi.ddev.site/api/faker/{{ $resource }}?' . $query;

$response = file_get_contents($url);
$data = json_decode($response, true);

print_r($data);
@endsection


@section('js-code-snippet')
const params = new URLSearchParams({
@foreach($parameters as $parameter)
    {{ $parameter['name'] }} => {{ $parameter['type'] === 'integer' || $parameter['type'] === 'float' ? $parameter['example'] : '\'' . $parameter['example'] . '\'' }},
@endforeach
});

fetch(`https://lorumapi.ddev.site/api/faker/{{ $resource }}?${params}`)
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
@endsection


@section('bash-code-snippet')
curl https://lorumapi.ddev.site/api/faker/{{ $resource }} \
-G \
@foreach($parameters as $parameter)
    -d {{ $parameter['name'] }}={{ $parameter['example'] }} {{ $loop->last ? '' : '\\' }}
@endforeach
@endsection
