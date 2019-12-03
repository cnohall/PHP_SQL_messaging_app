# PHP_SQL_messaging_app
This is a messaging app that's written in PHP and that utilizes a mysql to create accounts, login, and write messages

The databasename should be "mysql".

It should contain 2 tables: "accounts" and "messages"

SQL for first table: 
```SQL
CREATE TABLE accounts (
    id int NOT NULL AUTO_INCREMENT,
    firstname varchar(255) NOT NULL,
    lastname varchar(255),
    username varchar(255),
    email varchar(255),
    password varchar(255),
    phone int(20),
    PRIMARY KEY (id)
);
```
The messages table should contain: message, writer, timewritten.

