# javaAes2php
目前和和其他公司项目接口对接，对方项目是java开发，丢过来的接口文档上面有个字段说明是aes加密了，其他的信息没了，经过几次沟通，叫对方给了一个明文和密文的东西给过来
密匙1111111122222222
明文php
AES加密后SqdeMqCpaO8qfXP+Z2ICoQ==

···php
$key = '1111111122222222';
$content = 'php';
$content2 = 'SqdeMqCpaO8qfXP+Z2ICoQ==';

$aes = new \carazyfd\phpaes\Aes($key);
$content =$aes->strPad($content, 16);
echo $aes->encode($content);
echo "<br>";
echo $aes->decode($content2);
···
得到的结果和对方的一致完成。
