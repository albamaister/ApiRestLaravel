CREATE DATABASE IF NOT EXIST api_rest_laravel;
use api_rest_laravel;

CREATE TABLE users(
id                  int(255) auto_increment not null,
name                varchar(50) NOT NULL,
subname             varchar(100),
role                varchar(20)
email               varchar(255) NOT NULL,
password            varchar(255) NOT NULL,
description         text,
image               varchar(255),
created_at          datetime DEFAULT NULL,
update_at           datetime DEFAULT NULL,
remember_token      varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)  
)ENGINE=InnoDb;

CREATE TABLE categories (
id                  int(255) auto_increment not null,
name                varchar(100),
created_at          datetime DEFAULT NULL,
update_at           datetime DEFAULT NULL,
CONSTRAINT pk_categories PRIMARY KEY(id)  
)ENGINE=InnoDb;

CREATE TABLE posts (
id                  int(255) auto_increment not null,
user_id             int(255) not null,
category_id         int(255) not null,
title               varchar(100) not null,
content             text not null,
image               varchar(255),
created_at          datetime DEFAULT NULL,
update_at           datetime DEFAULT NULL,
CONSTRAINT pk_posts PRIMARY KEY(id),
CONSTRAINT fk_post_user FOREIGN KEY(user_id) references users(id),
CONSTRAINT fk_post_category FOREIGN KEY(category_id) references categories(id)  
)ENGINE=InnoDb;



