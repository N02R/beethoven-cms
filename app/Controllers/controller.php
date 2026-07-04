<?php

class controller
{
    /**
     * Render View
     */
    protected function view(string $path, array $data = [])
    {
        extract($data);

        $file = __DIR__ . '/../Views/' . $path . '.php';

        if (!file_exists($file)) {
            throw new Exception("View not found: " . $file);
        }

        require $file;
    }
}