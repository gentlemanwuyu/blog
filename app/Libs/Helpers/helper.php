<?php
/**
 * Created by PhpStorm.
 * User: Woozee
 * Date: 2019/11/4
 * Time: 17:52
 */

if (!function_exists('get_content_type')) {
    /**
     * 获取资源的类型
     *
     * @param $url
     */
    function get_content_type($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);

        return curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    }
}