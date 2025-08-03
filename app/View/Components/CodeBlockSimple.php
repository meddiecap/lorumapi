<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CodeBlockSimple extends Component
{
    /**
     * @var string The name of the code snippet.
     */
    public string $name;

    /**
     * @var string|null The code snippet content.
     */
    public ?string $snippet;

    /**
     * @var string The programming language of the code snippet.
     */
    public string $lang;

    /**
     * @var string The title of the code snippet.
     */
    public string $title;

    public function __construct(string $title, string $name, string $lang)
    {
        $this->name = $name;
        $this->lang = $lang;
        $this->title = $title;

        $this->snippet = $this->loadSnippet();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.code-block-simple');
    }

    /**
     * Load code snippets based on the provided name.
     * @return string|null
     */
    protected function loadSnippet(): ?string
    {
        $basePath = resource_path('code-snippets');

        $path = "$basePath/$this->lang/$this->name." . $this->getExtension();

        return file_exists($path) ? file_get_contents($path) : null;
    }

    /**
     * Get the file extension based on the language.
     * @return string
     */
    protected function getExtension(): string
    {
        return match ($this->lang) {
            'bash' => 'sh',
            default => $this->lang,
        };
    }
}
