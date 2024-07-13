<?php

namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CodeGeneratorService
{
    protected $files;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function generate($type, $name)
    {
        $stub = $this->getStub($type);
        $stub = str_replace('{{name}}', $name, $stub);
        $stub = str_replace('{{table_name}}', Str::plural(strtolower($name)), $stub);

        $path = $this->getPath($type, $name);
        $this->files->put($path, $stub);
    }

    protected function getStub($type)
    {
        return $this->files->get(resource_path("stubs/{$type}.stub"));
    }

    protected function getPath($type, $name)
    {
        switch ($type) {
            case 'controller':
                return app_path("Http/Controllers/{$name}Controller.php");
            case 'model':
                return app_path("Models/{$name}.php");
            case 'migration':
                return database_path("migrations/" . date('Y_m_d_His') . "_create_" . Str::plural(strtolower($name)) . "_table.php");
            default:
                throw new \Exception("Invalid type: {$type}");
        }
    }
}
