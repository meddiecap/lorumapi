<li class="m-0 px-0 py-8 first:pt-0 last:pb-0">
    <dl class="m-0 flex flex-wrap items-center gap-x-3 gap-y-4">
        <dt class="sr-only">Name</dt>
        <dd><code class="language-json hljs-inline-block">{{ $name }}</code></dd>
        <dt class="sr-only">Type</dt>
        <dd class="font-mono text-xs text-zinc-400 dark:text-zinc-500">{{ $type }}</dd>
        @if($description)
            <dt class="sr-only">Description</dt>
            <dd class="w-full flex-none [&amp;>:first-child]:mt-0 [&amp;>:last-child]:mb-0">
                <p>{{ $description }}</p>
            </dd>
        @endif
    </dl>
</li>
