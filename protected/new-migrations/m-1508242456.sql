ALTER TABLE `shoppingshow`.`mt_dishes` 
CHANGE COLUMN `date_modified` `date_modified` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ,
ADD COLUMN `category_id` INT(14) NULL AFTER `ip_address`,
ADD COLUMN `subcategory_id` INT(14) NULL AFTER `category_id`,
ADD COLUMN `brand_id` INT(14) NULL AFTER `subcategory_id`,
ADD COLUMN `unit` VARCHAR(45) NULL AFTER `brand_id`,
ADD COLUMN `tags` TEXT NULL AFTER `unit`,
ADD COLUMN `description` TEXT NULL AFTER `tags`,
ADD COLUMN `sale-price` DECIMAL NULL AFTER `description`,
ADD COLUMN `sale-currency` VARCHAR(3) NULL AFTER `sale-price`,
ADD COLUMN `purchase-price` DECIMAL NULL AFTER `sale-currency`,
ADD COLUMN `purchase-currency` VARCHAR(3) NULL AFTER `purchase-price`,
ADD COLUMN `shipping-cost` DECIMAL NULL AFTER `purchase-currency`,
ADD COLUMN `cost-currency` VARCHAR(3) NULL AFTER `shipping-cost`,
ADD COLUMN `product-tax` DECIMAL NULL AFTER `cost-currency`,
ADD COLUMN `tax-mark` VARCHAR(5) NULL AFTER `product-tax`,
ADD COLUMN `product-discount` DECIMAL NULL AFTER `tax-mark`,
ADD COLUMN `discount-mark` VARCHAR(45) NULL AFTER `product-discount`;