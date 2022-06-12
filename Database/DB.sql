DROP DATABASE IF EXISTS shop_db;
CREATE DATABASE shop_db CHARACTER SET utf8 COLLATE utf8_general_ci;
USE shop_db;


CREATE TABLE product
(
    pk_product_id         INT PRIMARY KEY AUTO_INCREMENT,
    product_name          VARCHAR (25) NOT NULL,
    product_price         FLOAT,
    product_image         VARCHAR (100)
);