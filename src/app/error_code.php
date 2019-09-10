<?php

// 添加数据失败
const INSERT_ERROR = '10001';
const NOT_EMPTY_CLASS = '1002';
const NOT_EMPTY_MARK = '1003';
const DELETE_ERROR = '1004';
const UPDATE_ERROR = '1005';
const CLASS_NOT_EXISTS = '1006';
const URL_EXISTS = '1007';
const SEND_MAIL_ERROR = '10008';
const EMAIL_EXISTS = '10009';
const USERNAME_EXISTS = '10010';
const REGISTER_ERROR = '10011';
const EMAIL_CODE_ERROR = '10012';
const VERIFY_ERROR = '10013';
const MODIFY_PASSWORD_ERROR = '10014';


// 错误信息
const ERROR_MSG = array(
    INSERT_ERROR => '添加数据失败',
    NOT_EMPTY_CLASS => '子分类不是空的，无法删除',
    NOT_EMPTY_MARK => '分类下还存在书签，无法删除',
    DELETE_ERROR => '删除失败',
    UPDATE_ERROR => '修改失败',
    CLASS_NOT_EXISTS => '分类不存在',
    URL_EXISTS => 'URL已经存在',
    SEND_MAIL_ERROR => '邮件发送失败',
    EMAIL_EXISTS => '邮箱已经存在',
    USERNAME_EXISTS => '用户名已存在',
    REGISTER_ERROR => '注册失败',
    EMAIL_CODE_ERROR => '邮箱验证码错误',
    VERIFY_ERROR => '验证失败',
    MODIFY_PASSWORD_ERROR => '修改密码失败'
);