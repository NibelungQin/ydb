<?php
defined('IN_IA') or exit('Access Denied');

if (!function_exists('load')) {
    function load()
    {
        static $loader;
        if (empty($loader)) {
            $loader = new Loader();
        }
        return $loader;
    }
}

if (!function_exists('table')) {
    function table($name)
    {
        load()->classs('table');
        load()->table($name);
        $service = false;

        $class_name = "{$name}Table";
        if (class_exists($class_name)) {
            $service = new $class_name();
        }
        return $service;
    }
}

if (!class_exists('Loader')) {
    class Loader
    {

        private $cache = array();
        private $singletonObject = array();
        private $libraryMap = array(
            'agent' => 'agent/agent.class',
            'captcha' => 'captcha/captcha.class',
            'pdo' => 'pdo/PDO.class',
            'qrcode' => 'qrcode/phpqrcode',
            'ftp' => 'ftp/ftp',
            'pinyin' => 'pinyin/pinyin',
            'pkcs7' => 'pkcs7/pkcs7Encoder',
            'json' => 'json/JSON',
            'phpmailer' => 'phpmailer/PHPMailerAutoload',
            'oss' => 'alioss/autoload',
            'qiniu' => 'qiniu/autoload',
            'cos' => 'cosv4.2/include',
            'cosv3' => 'cos/include',
        );
        private $loadTypeMap = array(
            'func' => '/framework/function/%s.func.php',
            'model' => '/framework/model/%s.mod.php',
            'classs' => '/framework/class/%s.class.php',
            'library' => '/framework/library/%s.php',
            'table' => '/framework/table/%s.table.php',
            'web' => '/web/common/%s.func.php',
            'app' => '/app/common/%s.func.php',
        );

        public function __call($type, $params)
        {
            global $_W;
            $name = $cachekey = array_shift($params);
            if (!empty($this->cache[$type]) && isset($this->cache[$type][$cachekey])) {
                return true;
            }
            if (empty($this->loadTypeMap[$type])) {
                return true;
            }
            if ($type == 'library' && !empty($this->libraryMap[$name])) {
                $name = $this->libraryMap[$name];
            }
            $file = sprintf($this->loadTypeMap[$type], $name);
            if (file_exists(IA_ROOT . $file)) {
                include_once IA_ROOT . $file;
                $this->cache[$type][$cachekey] = true;
                return true;
            } else {
                trigger_error('Invalid ' . ucfirst($type) . $file, E_USER_WARNING);
                return false;
            }
        }


        function singleton($name)
        {
            if (isset($this->singletonObject[$name])) {
                return $this->singletonObject[$name];
            }
            $this->singletonObject[$name] = $this->object($name);
            return $this->singletonObject[$name];
        }


        function object($name)
        {
            $this->classs(strtolower($name));
            if (class_exists($name)) {
                return new $name();
            } else {
                return false;
            }
        }
    }
}
