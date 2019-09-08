<?php

// 添加数据失败
const INSERT_ERROR = '10001';
const NOT_EMPTY_CLASS = '1002';
const NOT_EMPTY_MARK = '1003';
const DELETE_ERROR = '1004';
const UPDATE_ERROR = '1005';
const CLASS_NOT_EXISTS = '1006';
const URL_EXISTS = '1007';

// 错误信息
const ERROR_MSG = array(
    INSERT_ERROR => '添加数据失败',
    NOT_EMPTY_CLASS => '子分类不是空的，无法删除',
    NOT_EMPTY_MARK => '分类下还存在书签，无法删除',
    DELETE_ERROR => '删除失败',
    UPDATE_ERROR => '修改失败',
    CLASS_NOT_EXISTS => '分类不存在',
    URL_EXISTS => 'URL已经存在'
);