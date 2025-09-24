<div class="px-4 py-3 opacity-70 hover:opacity-100 transition-opacity">
    <h3 class="text-xs/7 font-semibold text-gray-400">Other resources</h3>
    <ul role="list" class="-mx-2 mt-2 space-y-1">
        @foreach($fakerResources as $fakerResource)
            <li>
                <a href="{{ $fakerResource['url'] }}#basic-usage"
                   class="rounded-md p-2 text-sm/6 font-semibold {{ url()->current() === $fakerResource['url'] ? 'text-indigo-600' : 'text-gray-700' }} hover:bg-gray-100 hover:text-indigo-600">
                    {{ $fakerResource['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
