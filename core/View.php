<?php

declare(strict_types=1);

namespace Core;

defined('ROOT_PATH') or exit('Access Denied!');

class View
{
    private $_siteTitle = '', $_content = [], $_currentContent, $_buffer, $_layout;
    private $_defaultViewPath;

    public function __construct($path = '')
    {
        $this->_defaultViewPath = $path;
        $this->_siteTitle = Config::get('SITE_TITLE');
    }

    public function setLayout($layout)
    {
        $this->_layout = $layout;
    }

    public function setSiteTitle($title)
    {
        $this->_siteTitle = $title;
    }

    public function getSiteTitle()
    {
        return $this->_siteTitle;
    }

    public function render($path = '', $params = [])
    {
        if (empty($path)) {
            $path = $this->_defaultViewPath;
        }

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        $layoutPath = ROOT_PATH . '../' . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $this->_layout . '.php';
        $fullPath = ROOT_PATH . '../' . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $path . '.php';
        if (!file_exists($fullPath)) {
            throw new \Exception("The view \"{$path}\" does not exist.");
        }
        if (!file_exists($layoutPath)) {
            throw new \Exception("The layout \"{$this->_layout}\" does not exist.");
        }
        require($fullPath);
        require($layoutPath);
    }

    public function start($key)
    {
        if (empty($key)) {
            throw new \Exception("Your start method requires a valid key.");
        }
        $this->_buffer = $key;
        ob_start();
    }

    public function end()
    {
        if (empty($this->_buffer)) {
            throw new \Exception("You must first run the start method.");
        }
        $this->_content[$this->_buffer] = ob_get_clean();
        $this->_buffer = null;
    }

    public function content($key)
    {
        if (array_key_exists($key, $this->_content)) {
            echo $this->_content[$key];
        } else {
            echo '';
        }
    }

    public function partial($path)
    {
        $fullPath = ROOT_PATH . '../' . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $path . '.php';
        if (file_exists($fullPath)) {
            require($fullPath);
        }
    }
}