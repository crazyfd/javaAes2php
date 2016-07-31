<?php
namespace carazyfd\phpaes;
/**
 * Class Aes
 * @package carazyfd\phpaes
 * 16进制的，ECB模式
 */
class Aes
{
    protected $key;   //密匙16位
    protected $iv;   //IV初始向量16位

    protected $length;   //长度

    protected $mode;   //模式

    public function __construct($key, $mode = 'ECB', $iv = null)
    {
        if (strlen($key) != 16) {
            throw new \Exception('密匙长度必须是16位数');
        }
        $this->key = $key;
        $mode = strtolower($mode);

        if (!in_array($mode, ['cbc', 'cfb', 'ecb', 'nofb', 'ofb', 'stream'])) {
            throw new \Exception($mode . ' model not found.');
        }

        $this->mode = $mode;

        if ($iv === null) {
            $cm = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', $mode, '');
            $ivSize = mcrypt_enc_get_iv_size($cm);
            $this->iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);
        }

    }

    /**
     * 加密
     */
    public function encode($str)
    {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $str, $this->mode, $this->iv));
    }

    /**
     * 解密
     */
    public function decode($str)
    {
        $content = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, base64_decode($str), $this->mode, $this->iv);
        return $this->trimEnd($content);
    }

    /**
     * 字符串填充
     * @param $text
     * @param $length
     * @return string
     */
    public function strPad($text, $length)
    {
        $len = strlen($text) % $length;
        $res = $text;
        $span = $length - $len;
        for ($i = 0; $i < $span; $i++) {
            $res .= chr($span);
        }
        return $res;
    }

    /**
     * 将解密后多余的长度去掉(因为在加密的时候 补充长度满足block_size的长度)
     * @param $text
     * @return string
     */
    public function trimEnd($text)
    {
        $len = strlen($text);
        $c = $text[$len - 1];
        if (ord($c) < $len) {
            for ($i = $len - ord($c); $i < $len; $i++) {
                if ($text[$i] != $c) {
                    return $text;
                }
            }
            return substr($text, 0, $len - ord($c));
        }
        return $text;
    }
}


