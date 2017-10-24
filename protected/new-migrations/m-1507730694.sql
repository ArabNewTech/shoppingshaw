ALTER TABLE `shoppingshow`.`mt_brands` 
ADD COLUMN `created_at` VARCHAR(50) NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `brand_photo`,
ADD COLUMN `updated_at` VARCHAR(50) NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `created_at`;
