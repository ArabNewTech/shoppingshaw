<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/brands/do/add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/brands" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<div class="spacer"></div>

<div id="error-message-wrapper"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','adminAddBrands')?>
<?php echo CHtml::hiddenField('id',isset($_GET['id'])?$_GET['id']:"");?>
<?php if (!isset($_GET['id'])):?>
<?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/admin/brands/do/add")?>
<?php endif;?>

<?php 
if (isset($_GET['id'])){
	if (!$data=Yii::app()->functions->getBrand($_GET['id'])){
		echo "<div class=\"uk-alert uk-alert-danger\">".
		Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
		return ;
	}	
}
?>                                 

<div class="uk-form-row">

<?php if ( Yii::app()->functions->multipleField()==2):?>
<ul data-uk-tab="{connect:'#tab-content'}" class="uk-tab uk-active">
    <li class="uk-active" ><a href="#"><?php echo t("English")?></a></li>
    <?php if ( $fields=Yii::app()->functions->getLanguageField()):?>  
    <?php foreach ($fields as $f_val): ?>
    <li class="" ><a href="#"><?php echo $f_val;?></a></li>
    <?php endforeach;?>
    <?php endif;?>
</ul>

<ul class="uk-switcher" id="tab-content">

  <li class="uk-active">      
  <div class="uk-form-row">
   <label class="uk-form-label"><?php echo Yii::t("default","Brand Name")?></label>
  <?php echo CHtml::textField('brand_name',
  isset($data['brand_name'])?stripslashes($data['brand_name']):""
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"
  ))?>  
    </div>    
    
   <?php 
   $brand_name_trans=isset($data['brand_name_trans'])?json_decode($data['brand_name_trans'],true):'';
   ?>
   
   <?php if (is_array($fields) && count($fields)>=1):?>
   <?php foreach ($fields as $key_f => $f_val): ?>
   <li>
   
   <div class="uk-form-row">
	   <label class="uk-form-label"><?php echo Yii::t("default","Brand Name")?></label>
	  <?php echo CHtml::textField("category_name_trans[$key_f]",
	  array_key_exists($key_f,(array)$brand_name_trans)?$brand_name_trans[$key_f]:''
	  ,array(
	  'class'=>'uk-form-width-large',
	  //'data-validation'=>"required"
	  ))?>  
   </div>    
   
   </li>
   <?php endforeach;?>
   <?php endif;?>
</ul>

<?php else : // Normal field?>

<div class="uk-form-row">
<label class="uk-form-label"><?php echo Yii::t("default","Brand Name")?></label>
  <?php echo CHtml::textField('brand_name',
  isset($data['brand_name'])?stripslashes($data['brand_name']):""
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"
  ))?>  
</div>


<?php endif;?>

<div class="uk-form-row"> 
 <label class="uk-form-label"><?php echo Yii::t('default',"Featured Image")?></label>
  <div style="display:inline-table;margin-left:1px;" class="button uk-button" id="photo"><?php echo Yii::t('default',"Browse")?></div>	  
  <DIV  style="display:none;" class="photo_chart_status" >
	<div id="percent_bar" class="photo_percent_bar"></div>
	<div id="progress_bar" class="photo_progress_bar">
	  <div id="status_bar" class="photo_status_bar"></div>
	</div>
  </DIV>		  
</div>

<?php if (!empty($data['brand_photo'])):?>
<div class="uk-form-row"> 
<?php else :?>
<div class="input_block preview">
<?php endif;?>
<label><?php echo Yii::t('default',"Preview")?></label>
<div class="image_preview">
 <?php if (!empty($data['brand_photo'])):?>
 <input type="hidden" name="brand_photo" value="<?php echo $data['brand_photo'];?>">
 <img class="uk-thumbnail uk-thumbnail-small" src="<?php echo Yii::app()->request->baseUrl."/upload/".$data['brand_photo'];?>?>" alt="" title="">
 <?php endif;?>
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>