<div id="basic-usage" class="pt-header flex flex-col gap-8 w-full">
    <h2 class="text-3xl font-semibold text-primary">
        Basic usage
    </h2>

    <div class="mx-auto w-full max-w-7xl grow lg:flex gap-8">
        <!-- Left sidebar & main wrapper -->
        <div class="flex-1 md:flex gap-8 lg:w-4/5">
            <div class="md:w-1/2 md:shrink-0 flex flex-col gap-8">
                <div class="flex items-center gap-x-3">
                    <span class="font-mono text-[0.625rem]/6 font-semibold rounded-md px-3 ring-1 ring-inset ring-emerald-300 dark:ring-emerald-400/30 bg-emerald-400/10 text-emerald-500 dark:text-emerald-400">
                        GET
                    </span>
                    <span class="h-0.5 w-0.5 rounded-full bg-zinc-300 dark:bg-zinc-600"></span>
                    <a target="_blank" href="{{ url('api/faker/' . $resource) }}" class="font-mono text-xs text-zinc-400 hover:text-zinc-900">{{ url('api/faker') }}/{{ $resource }}</a>
                </div>
                <p>
                    The Faker API provides a simple way to generate random data for testing purposes. You can use the
                    <code class="language-json hljs-inline-block">/api/faker/{{ $resource }}</code> endpoint to retrieve a collection of random
                    data. The response will include various attributes that you can use in your application.
                </p>
                <h3 class="text-2xl font-semibold text-primary">
                    Common attributes
                </h3>

                <x-faker.api-parameter-list :parameters="$parameters" />
            </div>

            <div class="md:flex-1 overflow-hidden">
                <x-faker.resource-sample
                    title="Sample request"
                    :resource="$resource"
                    :parameters="$parameters"
                />
                <x-faker.sample-response
                    title="Sample response"
                    :resource="$resource"
                    :parameters="$parameters"
                />
            </div>
        </div>

        <div class="shrink-0 lg:w-1/5">
            <div class="sticky top-8 shrink-0">
                <x-faker.resource-list />
            </div>
        </div>
    </div>
</div>
