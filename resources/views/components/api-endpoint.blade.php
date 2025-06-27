@props(['method', 'endpoint', 'description', 'parameters' => [], 'response' => null])

<div {{ $attributes->merge(['class' => 'overflow-hidden bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6']) }}>
    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 flex items-center">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium
            @if($method === 'GET') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
            @elseif($method === 'POST') bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100
            @elseif($method === 'PUT') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
            @elseif($method === 'DELETE') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
            @endif
            mr-3">
            {{ $method }}
        </span>
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $endpoint }}</h3>
    </div>

    <div class="p-4 bg-white dark:bg-gray-800">
        <div class="text-sm text-gray-600 dark:text-gray-400 mb-4">{!! \Illuminate\Support\Str::markdown($description) !!}</div>

        @if(count($parameters) > 0)
            <div class="mb-4">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Parameters</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Required</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($parameters as $param)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $param['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ is_array($param['type']) ? implode('|', $param['type']) : $param['type'] }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{!! \Illuminate\Support\Str::markdown($param['description']) !!}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        @if($param['required'] ?? false)
                                            <span class="text-green-500 dark:text-green-400">Yes</span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">No</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if($response)
            <div>
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Example Response</h4>
                <div class="bg-gray-800 dark:bg-gray-900 rounded-md overflow-x-auto">
                    <pre class="language-json p-4 text-sm text-white overflow-auto"><code>{{ $response }}</code></pre>
                </div>
            </div>
        @endif

        {{ $slot }}
    </div>
</div>
