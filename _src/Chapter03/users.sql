CREATE TABLE `Blog`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`), UNIQUE `email_unique` (`email`)) ENGINE = InnoDB;

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES (NULL, 'Haafiz', 'kaasib@gmail.com', '$2y$10$aComplexStringOfAtleaeeeoYTF1Nrkf8VohijM26vuoPJxTwbSK'), (NULL, 'Ali', 'abc@email.com', '$2y$10$aComplexStringOfAtleaeeeoYTF1Nrkf8VohijM26vuoPJxTwbSK');
