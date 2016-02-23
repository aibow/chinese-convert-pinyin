# chinese convert pinyin

## 使用方法

```
require('pinyin.php');

foreach(array('中国', '重庆', '打的', 'abc12', '天 地') as $str){
    var_dump(AbPinyin::convert($str));
    echo '<br/>';
}
```

输出内容

```
array(1) { [0]=> string(8) "zhongguo" } 
array(2) { [0]=> string(9) "zhongqing" [1]=> string(9) "chongqing" } 
array(2) { [0]=> string(4) "dadi" [1]=> string(4) "dade" } 
array(1) { [0]=> string(5) "abc12" } 
array(2) { [0]=> string(7) "tian di" [1]=> string(7) "tian de" } 
```

## 说明

- 字典来自https://github.com/ohfang/HanziToPinyin
- 字典支持2万+汉字,支持多音字