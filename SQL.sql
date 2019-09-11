-- auto-generated definition
create table mark_book_class
(
  id        int auto_increment
    primary key,
  parent_id int default 0 not null,
  name      varchar(30)   not null,
  modify_at int default 0 null,
  create_at int default 0 null,
  user_id   int           not null comment '用户id'
)
  comment '书签分类' charset = utf8;

-- auto-generated definition
create table mark_book_mark
(
  id         int auto_increment
    primary key,
  mark_name  varchar(50)   not null comment '书签名称',
  url        mediumtext    null comment 'url 地址',
  class_id   int           not null comment '分类id',
  create_at  int default 0 not null,
  modify_at  int default 0 not null comment '修改时间',
  user_id    int           not null,
  read_count int default 0 not null comment '点击次数'
)
  comment '书签表' charset = utf8;

-- auto-generated definition
create table mark_user
(
  id            int auto_increment
    primary key,
  username      varchar(50)   not null,
  email         varchar(100)  not null,
  password      varchar(50)   not null,
  create_at     int default 0 not null,
  last_login_at int default 0 not null
);

