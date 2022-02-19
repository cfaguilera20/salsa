<?php
namespace Core\Templating;

class HtmlTemplating
{
    public $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function render(string $template, array $data = []) : void
    {
        $template = $this->directory . '/' . $template . '.php';
        if (!file_exists($template)) {
            throw new \Exception('Template not found');
        }

        extract($data);
        
        include $template;
    }
}
