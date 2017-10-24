CREATE TABLE `shoppingshow`.`mt_merchant_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `merchant_type` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `merchant_type_UNIQUE` (`merchant_type` ASC));
