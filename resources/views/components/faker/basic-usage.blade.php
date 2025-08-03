<div id="basic-usage" class="pt-header flex flex-col gap-8 w-full">
    <h2 class="text-3xl font-semibold text-primary">
        Basic usage
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
                Common attributes
            </h3>

            <x-faker.api-parameter-list :parameters="$commonParameters" />
        </div>
        <div class="w-1/2">
            <x-code-block title="Sample request" name="sample-request" />
            <x-code-block-simple title="Sample response" name="sample-response" lang="json" />
        </div>
    </div>
</div>
