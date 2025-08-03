<ul role="list"
    class="m-0 max-w-[calc(var(--container-lg)-(--spacing(8)))] list-none divide-y divide-zinc-900/5 p-0 dark:divide-white/5">
    @foreach($parameters as $parameter)
        <x-faker.api-parameter
            :name="$parameter['name']"
            :type="$parameter['type']"
            :description="$parameter['description']"
        />
    @endforeach
</ul>
