ALTER TABLE `mt_dishes` ADD CONSTRAINT `dish.cat_id` FOREIGN KEY (`category_id`) REFERENCES `mt_category`(`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `mt_dishes` ADD CONSTRAINT `dish.subcat_id` FOREIGN KEY (`subcategory_id`) REFERENCES `mt_subcategory`(`subcat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `mt_dishes` ADD CONSTRAINT `dish.brand_id` FOREIGN KEY (`brand_id`) REFERENCES `mt_brands`(`brand_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `mt_dishes` ADD CONSTRAINT `dish.sale_currency` FOREIGN KEY (`sale-currency`) REFERENCES `mt_currency`(`currency_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `mt_dishes` ADD CONSTRAINT `dish.purchase_currency` FOREIGN KEY (`purchase-currency`) REFERENCES `mt_currency`(`currency_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `mt_dishes` ADD CONSTRAINT `dish.cost_currency` FOREIGN KEY (`cost-currency`) REFERENCES `mt_currency`(`currency_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;