
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/brands/do/add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/brands" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="AdminbrandsList">
<input type="hidden" name="tbl" id="tbl" value="brands">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="brand_id">
<input type="hidden" name="slug" id="slug" value="brands/do/add">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
  <caption>Merchant List</caption>
   <thead>
        <tr>
            <th><input type="checkbox" id="chk_all" class="chk_all"></th>
            <th><?php echo Yii::t('default',"Name")?></th>
            <th><?php echo Yii::t('default',"Photo")?></th>                       
            <th><?php echo Yii::t('default',"Date")?></th>
        </tr>
    </thead>
    <tbody> 
    </tbody>
</table>
<div class="clear"></div>
</form>