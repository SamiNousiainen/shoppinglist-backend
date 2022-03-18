drop database if exists shoppinglist;
create database shoppinglist;

use shoppinglist;
create Table item (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(255) NOT NULL,
    amount SMALLINT UNSIGNED NOT NULL
);

insert into item (description,amount) values ('test item', 1);