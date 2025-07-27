<div id="basic-usage" class="pt-header flex flex-col gap-8 w-full">
    <h2 class="text-3xl font-semibold text-primary">
        Basic usage <a href="/#basic-usage" class="text-xl">#</a>
    </h2>
    <div class="flex flex-row gap-12">
        <div class="flex flex-col gap-8 w-1/2">
            <div class="flex items-center gap-x-3">
                <span class="font-mono text-[0.625rem]/6 font-semibold rounded-md px-3 ring-1 ring-inset ring-emerald-300 dark:ring-emerald-400/30 bg-emerald-400/10 text-emerald-500 dark:text-emerald-400">
                    GET
                </span>
                <span class="h-0.5 w-0.5 rounded-full bg-zinc-300 dark:bg-zinc-600"></span>
                <span class="font-mono text-xs text-zinc-400">{{ url('api/faker') }}/{resource}</span>
            </div>
            <p>
                The Faker API provides a simple way to generate random data for testing purposes. You can use the
                <code class="language-json hljs-inline-block">/api/faker/{resource}</code> endpoint to retrieve a collection of random
                data based on the specified resource type. The response will include various attributes that you can use in your
                application.
            </p>
            <h3 class="text-2xl font-semibold text-primary">
                Optional attributes
            </h3>
            <ul role="list"
                class="m-0 max-w-[calc(var(--container-lg)-(--spacing(8)))] list-none divide-y divide-zinc-900/5 p-0 dark:divide-white/5">
                @foreach($optionalParameters as $parameter)
                    <li class="m-0 px-0 py-8 first:pt-0 last:pb-0">
                        <dl class="m-0 flex flex-wrap items-center gap-x-3 gap-y-4">
                            <dt class="sr-only">Name</dt>
                            <dd><code class="language-json hljs-inline-block">{{ $parameter['name'] }}</code></dd>
                            <dt class="sr-only">Type</dt>
                            <dd class="font-mono text-xs text-zinc-400 dark:text-zinc-500">{{ $parameter['type'] }}</dd>
                            <dt class="sr-only">Description</dt>
                            <dd class="w-full flex-none [&amp;>:first-child]:mt-0 [&amp;>:last-child]:mb-0">
                                <p>{{ $parameter['description'] }}</p>
                            </dd>
                        </dl>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-1/2">
            <x-code-block title="Sample request" name="sample-request" />
            <x-code-block-simple title="Sample response">
{
    "status": "OK",
    "code": 200,
    "params": {
        "quantity": 10,
        "locale": "en_US",
        "seed": 123,
        "gender": null
    },
    "total": 10,
    "data": [
        {
            "id": 1,
            "street": "6029 Williamson Pine Apt. 587",
            "street_name": "Haley Well",
            "building_number": "988",
            "city": "Johnshaven",
            "postcode": "55061-7256",
            "country": "Micronesia",
            "county_code": "LY",
            "latitude": 22.992011,
            "longitude": -139.427909
        },
        // ...
    ]
}
            </x-code-block-simple>
        </div>
    </div>

</div>
