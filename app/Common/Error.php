<?php

namespace App\Common;

/**
 * Class Error
 * @package app\common
 */
class Error
{
    const ERR_OK                    = 0;
    const ERR_FATAL                 = 10;
    const ERR_GENERAL               = 11;
    const ERR_NOT_IMPLEMENTED_YET   = 12;
    const ERR_NOT_LOGIN             = 1000;
    const ERR_LOGIN_FAILED          = 1001;
    const ERR_ROW_NOT_FOUND         = 1002;
    const ERR_PERMISSION_NOT_ENOUGH = 1003;
    const ERR_BAD_ARGUMENTS         = 1004;

    const ERR_VALIDATION_FAILED = 2000;

    const ERR_IMG_TOO_LARGE         = 3000;
    const ERR_IMG_UPLOAD_FAILED     = 3001;
    const ERR_VIDEO_UPLOAD_FAILED   = 3002;
    const ERR_PASSWORD_IS_NOT_SAME  = 3003;
    const ERR_VERIFY_CODE_NOT_FOUND = 3004;
    const ERR_TOO_SHORT_PASSWORD    = 3005;
    const ERR_BAD_SIGN_MSG          = 3010;
    const ERR_FILE_UPLOAD_FAILED    = 3011;
    const ERR_NOT_ALLOWED_FILE_TYPE = 3012;
    const ERR_SAVE_FAILED           = 3013;
    const ERR_TOO_LOW_VERSION       = 3014;

    private static $MESSAGE
        = array(
            '0'    => '请求成功',
            '10'   => '未知错误，请检查服务器日志',
            '11'   => '一般性错误',
            '12'   => '暂未实现',
            '1000' => '由于服务器策略调整和安全考虑，系统要求重新验证您的用户名和密码',
            '1001' => '账户名或密码错误',
            '1002' => '资源不存在或已删除',
            '1003' => '您无权访问该资源',
            '1004' => '参数校验错误：缺失或不合法',

            '2000' => '输入校验错误',

            '3000' => '图片超过限制大小',
            '3001' => '图片上传失败',
            '3002' => '视频上传失败',
            '3003' => '两次输入密码不一致,请重新输入',
            '3004' => '验证码错误',
            '3005' => '密码输入不能少于6位.',
            '3010' => '参数签名错误',
            '3011' => '文件上传失败',
            '3012' => '不允许的文件类型',
            '3013' => '存储失败.',
            '3014' => '您的app版本过低，请去官网或应用商店下载最新版',
        );

    /**
     * @param       $code
     * @param array $args
     * @return string
     */
    public static function getMessage($code, $args = array())
    {
        $msg = 'Message is undefined : ' . $code;
        if (!is_integer($code)) return 'Illegal Code : ' . print_r($code, true);
        if (isset(self::$MESSAGE[$code])) {
            $msg = self::$MESSAGE[$code];
        }
        return $msg;
    }
}