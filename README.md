php-aes
=================================
* @author crazyfd <crazyfd@qq.com>
* @version 1.0


# javaAes2php
目前和和其他公司项目接口对接，对方项目是java开发，丢过来的接口文档上面有个字段说明是aes加密了，其他的信息没了，
经过几次沟通，叫对方给了一个明文和密文的东西给过来，然后才知道对方是用什么模式生成的。



php > 5.5 

How to install?
To use this extension, you may insert the following code:
--------------------------------

Get it via [composer](http://getcomposer.org/) by adding the package to your `composer.json`:

```json
{
  "require": {
    "crazyfd/phpaes": "dev-master"
  }
}
```
执行命令
```php
php composer.phar update
```
使用
-----

```php
<?php 
$key = '1111111122222222';
$content = 'php';
$content2 = 'SqdeMqCpaO8qfXP+Z2ICoQ==';

$aes = new \carazyfd\phpaes\Aes($key);
$content =$aes->strPad($content, 16);
echo $aes->encode($content);
echo "<br>";
echo $aes->decode($content2);
```

