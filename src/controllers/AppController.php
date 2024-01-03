<?php

class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';
                
        if(file_exists($templatePath)){
            extract($variables);
            
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
    
        // Add JavaScript for displaying an alert if there are error messages
        if (isset($variables['messages']) && is_array($variables['messages'])) {
            echo '<script>';
            echo 'alert("' . implode('\n', $variables['messages']) . '");';
            echo '</script>';
        }
    
        print $output;
    }

    function debug($message) {
        file_put_contents('php://stderr', print_r($message, TRUE), FILE_APPEND);
    }
}