Embria2
=======
[![Build Status](https://travis-ci.org/jumper423/embria2.svg?branch=master)](https://travis-ci.org/jumper423/embria2)

Имеется таблица пользователей:
```
CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(32) NOT NULL,
`gender` tinyint(2) NOT NULL,
`email` varchar(1024) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;
```
В таблице более 100 млн записей, и она находится под нагрузкой в production (идут запросы на добавление / изменение / удаление).

В поле email может быть от одного до нескольких перечисленных через запятую адресов. Может быть пусто.

Напишите скрипт, который выведет список представленных в таблице почтовых доменов с количеством пользователей по каждому домену.


## Install

Run sql files
* query/install.sql
* query/generator.sql

## Tests
```
vendor/bin/phpunit 
```

OR 

edit file "tests/test.php" and run "php tests/test.php" 