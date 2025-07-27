<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CodeBlock extends Component
{
    public array $snippets = [];

    public function __construct(public string $name)
    {
        $this->snippets = $this->loadSnippets($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.code-block');
    }

    /**
     * Load code snippets based on the provided name.
     * @param string $name
     * @return array
     */
    protected function loadSnippets(string $name): array
    {
        $languages = ['php', 'js', 'bash'];
        $basePath = resource_path('code-snippets');

        return collect($languages)->map(function ($lang) use ($basePath, $name) {
            $path = "$basePath/$lang/$name." . $this->getExtension($lang);

            return [
                'title' => $this->getTitle($lang),
                'type' => $lang,
                'code' => file_exists($path) ? file_get_contents($path) : null,
            ];
        })->filter(fn ($item) => $item['code'])->values()->all();
    }

    /**
     * Get the file extension based on the language.
     * @param string $lang
     * @return string
     */
    protected function getExtension(string $lang): string
    {
        return match ($lang) {
            'php' => 'php',
            'js' => 'js',
            'bash' => 'sh',
            default => $lang,
        };
    }

    /**
     * Get the title for the code snippet based on the language.
     * @param string $lang
     * @return string
     */
    protected function getTitle(string $lang): string
    {
        return match ($lang) {
            'php' => 'PHP',
            'js' => 'JavaScript',
            'bash' => 'Bash',
            default => ucfirst($lang) . ' Code',
        };
    }
}
