<?php
/**
 * Created by PhpStorm.
 * User: ESoluk
 * Date: 25.04.2018
 * Time: 15:59
 */

namespace webshop;


class Cache
{
    use TSingletone;

    public function set($key, $data, $sec = 3600)
    {
        if ($sec) {
            $content['data'] = $data;
            $content['end_time'] = time() + $sec;
            if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize
            ($content))) {
                return true;
            }
        }
        return false;
    }

    public function get($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content;
            }
            unlink($file);
        }
        return false;
    }

    public function delete($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }
}