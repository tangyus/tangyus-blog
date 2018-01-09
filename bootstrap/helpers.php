<?php

/**
 * 截取字符串
 * @param $string
 * @param int $start
 * @param int $length
 * @return string
 */
function intercept_str($string, $start = 0, $length = 10) {
    return substr($string, $start, $length);
}