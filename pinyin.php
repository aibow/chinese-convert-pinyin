<?php
/**
 * 汉字转拼音库
 *
 * 支持多音字,返回多字组合
 */
class AbPinyin {

    // 转换
    public static function convert($str){
        if(!$str) return '';
        $table = self::loadTable();
        if(!$table) return '';
        $words = self::split($str);
        $arr = array();
        foreach($words as $word){
            // 中文
            if(preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $word)){
                if(array_key_exists($word, $table)){
                    $pinyin = $table[$word];
                }else{
                    $pinyin = array(' ');
                }
                $arr[] = array_unique($pinyin);
            }else{
                $arr[] = array($word);
            }
        }
        return self::merge($arr);
    }

    // 加载拼音库
    private static function loadTable(){
        static $data = null;
        if(!$data){
            $data = @unserialize(file_get_contents(__DIR__.'/pinyin.dat'));
        }
        return $data; 
    }

    // 将字符串拆分成多个字符
    private static function split($str){
        $len = mb_strlen($str, 'UTF-8');
        if ($len <= 1){
            return array($str);
        }
        preg_match_all('/.{1}|[^\x00]{1}$/us', $str, $ar);
        return $ar[0];
    }

    // 合并所有可能
    private static function merge($arr){
        if(!$arr) return array();
        foreach($arr as $k=>$v){
            if(!$v){
                unset($arr[$k]);
            }
        }
        if(!$arr) return array();
        $arr = array_values($arr);
        $a = $arr[0];
        for($i=1;$i<count($arr);$i++){
            $b = array();
            foreach($arr[$i] as $m){
                foreach($a as $n){
                    $b[] = $n.$m;
                }
            }
            $a = $b;
        }
        return $a;
    }

}