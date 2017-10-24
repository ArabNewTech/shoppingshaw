ALTER TABLE `shoppingshow`.`mt_subcategory` 
CHANGE COLUMN `date_created` `date_created` VARCHAR(50) NOT NULL DEFAULT '0000-00-00 00:00:00' ,
CHANGE COLUMN `date_modified` `date_modified` VARCHAR(50) NOT NULL DEFAULT '0000-00-00 00:00:00' ,
ADD COLUMN `category_id` INT(14) NOT NULL AFTER `subcategory_description_trans`,



