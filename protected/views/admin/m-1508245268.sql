ALTER TABLE `mt_dishes` CHANGE `sale_price` `sale_price` DECIMAL(10,0) NULL DEFAULT '0', CHANGE `sale_currency` `sale_currency` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'AUD', CHANGE `purchase_price` `purchase_price` DECIMAL(10,0) NULL DEFAULT '0', CHANGE `purchase_currency` `purchase_currency` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'AUD', CHANGE `shipping_cost` `shipping_cost` DECIMAL(10,0) NULL DEFAULT '0', CHANGE `cost_currency` `cost_currency` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'AUD', CHANGE `product_tax` `product_tax` DECIMAL(10,0) NULL DEFAULT '0', CHANGE `tax_mark` `tax_mark` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '$', CHANGE `product_discount` `product_discount` DECIMAL(10,0) NULL DEFAULT '0', CHANGE `discount_mark` `discount_mark` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'AUd';
