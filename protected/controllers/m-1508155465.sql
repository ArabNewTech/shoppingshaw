ALTER TABLE `shoppingshow`.`mt_subcategory` 
ADD INDEX `fk_mt_subcategory_2_idx` (`parent_id` ASC);
ALTER TABLE `shoppingshow`.`mt_subcategory` 
ADD CONSTRAINT `fk_mt_subcategory_1`
  FOREIGN KEY (`category_id`)
  REFERENCES `shoppingshow`.`mt_category` (`cat_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_mt_subcategory_2`
  FOREIGN KEY (`parent_id`)
  REFERENCES `shoppingshow`.`mt_subcategory` (`subcat_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
