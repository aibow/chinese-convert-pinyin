<?php
/**
 * 演示文件
 *
 */

require('pinyin.php');

foreach(array('中国', '重庆', '打的', 'abc12', '天 地') as $str){
    var_dump(AbPinyin::convert($str));
    echo '<br/>';
}