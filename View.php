<?php
/*
 * Created 16.12.2019 21:10
 */

namespace ITTech\View;

use ITTech\Lib\Cache;

/**
 * Class View
 * @package ITTech\View
 * @author Alexandr Pokatskiy
 * @copyright ITTechnology
 */
class View
{
    /**
     * Путь к директории шаблонов
     * @var string
     */
    private $viewDir;

    /**
     * Кэш
     * @var string
     */
    private $cache;

    /**
     * Файл шаблона
     * @var string
     */
    private $file;

    /**
     * Массив данных
     * @var array
     */
    private $data;

    /**
     * View constructor.
     * @param string $view
     * @param string|null $cache
     */
    public function __construct(string $view, string $cache = null)
    {
        $this->viewDir = $view;
        $this->cache = $cache;
    }

    /**
     * Вывод содержимого
     * @param string $file
     * @param array $data
     * @return bool|false|string
     */
    public function render(string $file, array $data = [])
    {
        $cache = null;

        $this->file = $file;
        $this->data = $data;

        if(!is_null($this->cache))
        {
            $cache  = new Cache($_SERVER["DOCUMENT_ROOT"]."/tmp/cache");
            $result = $cache->get($_SERVER["REQUEST_URI"]);

            if(!$result)
            {
                $page = $this->getPage();

                $cache->set($_SERVER["REQUEST_URI"], $page, $this->cache);
                return $page;
            }

            return $result;
        }

        return $this->getPage();
    }

    /**
     * Получить содержимое
     * @return false|string
     */
    private function getPage()
    {
        ob_start();
        extract($this->data);
        require_once $this->viewDir."/".$this->file;
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}
