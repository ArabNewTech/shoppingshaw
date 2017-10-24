

<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/dishes/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/dishes" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>

</div>

<?php 
if (isset($_GET['id'])){
	if (!$data=Yii::app()->functions->GetDish($_GET['id'])){
		echo "<div class=\"uk-alert uk-alert-danger\">".
		Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
		return ;
	}
}

$categories = Yii::app()->functions->getAllCategories();
$categories ['']  = 'Select Category';
$sub_categories = Yii::app()->functions->getAllSubCategories();
$sub_categories [''] = 'Select Sub Category';
$brands = Yii::app()->functions->getAllBrands();
$brands [''] = 'Select Brand';
$currencies = Yii::app()->functions->currencyList();
// print_r($data);die;
?>                                   

<div class="spacer"></div>
<!-- Start Tabs -->
<ul data-uk-tab="{connect:'#tab-content'}" class="uk-tab uk-active">
	<li class=""><a href="javascript:void(0)"><?php echo Yii::t("default","Product Details")?></a></li>
	<li class=""><a href="javascript:void(0)"><?php echo Yii::t("default","Business Details")?></a></li>
	<li class=""><a href="javascript:void(0)"><?php echo Yii::t("default","Customer Choice Options")?></a></li>	
</ul>
<!-- End tabs -->

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','addDish')?>
<?php echo CHtml::hiddenField('id',isset($_GET['id'])?$_GET['id']:"");?>
<?php if (!isset($_GET['id'])):?>
<?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/admin/dishes/Do/Add")?>
<?php endif;?>
<ul class="uk-switcher uk-margin " id="tab-content">
	<li class="uk-active">
		<fieldset>
			<div class="uk-form-row">
			 	<label class="uk-form-label"><?php echo Yii::t("default","Product Name")?></label>
			 	<?php 
			  		echo CHtml::textField('dish_name',
			  		isset($data['dish_name'])?$data['dish_name']:""
			  		,[
			  			'class'=>"uk-form-width-large",
			  			'data-validation'=>"required",
			  			'placeholder' => 'Product Name'
			  		])
			  	?>
			</div>
			<div class="uk-form-row"> 
 				<label class="uk-form-label"><?php echo Yii::t('default',"Upload Icon")?></label>
  				<div style="display:inline-table;margin-left:1px;" class="button uk-button" id="spicydish"><?php echo Yii::t('default',"Browse")?></div>	  
  				<div  style="display:none;" class="spicydish_chart_status" >
					<div id="percent_bar" class="spicydish_percent_bar"></div>
					<div id="progress_bar" class="spicydish_progress_bar">
	  					<div id="status_bar" class="spicydish_status_bar"></div>
					</div>
  				</div>		  
			</div>
			<?php $spicydish=isset($data['photo'])?$data['photo']:'';?>
			<?php if (!empty($spicydish)):?>
				<div class="uk-form-row">
			<?php else :?>
				<div class="input_block preview_spicydish">
			<?php endif;?>
				<label><?php echo Yii::t('default',"Preview")?></label>
				<div class="image_preview_spicydish">
					<?php if (!empty($spicydish)):?>
						<img class="uk-thumbnail" src="<?php echo Yii::app()->request->baseUrl."/upload/".$spicydish;?>?>" alt="" title="">
						<p><a href="javascript:rm_spicydish_preview();"><?php echo Yii::t("default","Remove image")?></a></p>
					<?php endif;?>
				</div>
			</div>
			<br>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo Yii::t("default","Status")?></label>
				<?php echo CHtml::dropDownList('status',
					isset($data['status'])?$data['status']:"",
					(array)statusList(),          
					array(
					'class'=>'uk-form-width-medium',
					'data-validation'=>"required"
					))
				?>
			</div>
			<br>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo Yii::t("default","Category")?></label>
				<?php echo CHtml::dropDownList('category',
					isset($data['category_id'])?$data['category_id']:"",
					$categories,          
					[
						'class'=>'uk-form-width-medium',
						'data-validation'=>"required"
					])
				?>
			</div>
			<br>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo Yii::t("default","Sub Category")?></label>
				<?php echo CHtml::dropDownList('sub-cat',
					isset($data['subcategory_id'])?$data['subcategory_id']:"",
					$sub_categories,          
					[
						'class'=>'uk-form-width-medium',
						'data-validation'=>"required"
					])
				?>
			</div>
			<br>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo Yii::t("default","Brand")?></label>
				<?php echo CHtml::dropDownList('brand',
					isset($data['brand_id'])?$data['brand_id']:"",
					$brands,          
					[
						'class'=>'uk-form-width-medium',
						'data-validation'=>"required"
					])
				?>
			</div>
			<br>
			<div class=class="uk-form-row">
				<label class="uk-form-label"><?php echo Yii::t("default","Unit")?></label>
				<?php 
					echo CHtml::textField('unit',
    					isset($data['unit'])?$data['unit']:""
    					,[
    						'class'=>"uk-form-width-large",
    						'placeholder' => 'Unit (e.g.kg,Pc,etc ...)',
    						'data-validation'=>"required"
    					])
				?>
			</div>
			<br>
			<div class=class="uk-form-row">
				<label class="uk-form-label"><?php echo Yii::t("default","Tags")?></label>
				<?php 
					echo CHtml::textField('tags',
    					isset($data['tags'])?$data['tags']:""
    					,[
    						'class'=>"uk-form-width-large",
    						'data-validation'=>"required",
    						'placeholder' => 'Tags (e.g.tag1,tag2,tag3,etc ...)'
    					])
				?>
			</div>
			<br>
			<div class="uk-form-row">
  				<label class="uk-form-label"><?php echo Yii::t("default","Description")?></label>
				<?php echo CHtml::textArea('description',
					isset($data['description'])?$data['description']:""
					,[
						'class'=>'uk-form-width-large',
						'data-validation'=>"required",
						'placeholder' => 'description'
					])
				?>
			</div>
		</fieldset>
	</li>
	<li>
		<div class=class="uk-form-row">
			<label class="uk-form-label"><?php echo Yii::t("default","Sale Price")?></label>
			<?php 
				echo CHtml::numberField('sale-price',
		    	isset($data['sale_price'])?$data['sale_price']:""
		    	,[
		    		'class'=>"uk-form-width-large",
		    		'placeholder' => 'Sale Price',
		    		'data-validation'=>"required"
		    	]);
		    ?>

		    <?php
				echo CHtml::dropDownList('sale-currency',
					isset($data['sale_currency'])?$data['sale_currency']:"",
					$currencies,          
					array(
					'class'=>'uk-form-width-mini',
					'data-validation'=>"required"
					))
			?>
		</div>
		<br>
		<div class=class="uk-form-row">
			<label class="uk-form-label"><?php echo Yii::t("default","Purchase Price")?></label>
			<?php 
				echo CHtml::numberField('purchase-price',
    			isset($data['purchase_price'])?$data['purchase_price']:""
    			,[
    				'class'=>"uk-form-width-large",
    				'placeholder' => 'Purchase Price',
    				'data-validation'=>"required",
    			])
			?>

			<?php
				echo CHtml::dropDownList('purchase-currency',
					isset($data['purchase_currency'])?$data['purchase_currency']:"",
					$currencies,          
					array(
					'class'=>'uk-form-width-mini',
					))
			?>
		</div>
		<br>
		<div class=class="uk-form-row">
			<label class="uk-form-label"><?php echo Yii::t("default","Shipping Cost")?></label>
			<?php 
				echo CHtml::numberField('shipping-cost',
    			isset($data['shipping_cost'])?$data['shipping_cost']:""
    			,[
    				'class'=>"uk-form-width-large",
    				'placeholder' => 'Shipping Price',
    				'data-validation'=>"required"
    			])
			?>
			
			<?php
				echo CHtml::dropDownList('cost-currency',
					isset($data['cost_currency'])?$data['cost_currency']:"",
					$currencies,          
					array(
					'class'=>'uk-form-width-mini',
					))
			?>
		</div>
		<br>
		<div class=class="uk-form-row">
			<label class="uk-form-label"><?php echo Yii::t("default","Product Tax")?></label>
			<?php 
				echo CHtml::numberField('product-tax',
					isset($data['product_tax'])?$data['product_tax']:""
					,[
						'class'=>"uk-form-width-large",
						'placeholder' => 'Product Tax',
						'data-validation'=>"required"
					])
			?>

			<?php
				echo CHtml::dropDownList('tax-mark',
					isset($data['tax_mark'])?$data['tax_mark']:"",
					[
						'%' => "%",
						'$' => "$",
					],          
					array(
					'class'=>'uk-form-width-mini',
					))
			?>
		</div>
		<br>
		<div class=class="uk-form-row">
			<label class="uk-form-label"><?php echo Yii::t("default","Product Discount")?></label>
			<?php 
			echo CHtml::numberField('product-discount',
			    isset($data['product_discount'])?$data['product_discount']:""
			    ,[
			    	'class'=>"uk-form-width-large",
			    	'placeholder' => 'Product Discoun',
			    	'data-validation'=>"required"
			    ])
			?>

			<?php
				echo CHtml::dropDownList('discount-mark',
					isset($data['discount_mark'])?$data['discount_mark']:"",
					[
						'%' => "%",
						'$' => "$",
					],        
					array(
					'class'=>'uk-form-width-mini',
					))
			?>
		</div>
		<br>
	</li>
	<li>
		<section class="newPage">
		    <div class="container">
		        <div class="row padd-t-b">
		            <div class="col-md-2">
		                <label class="col-sm-4 control-label" for="demo-hor-14">Color</label>
		            </div>
		            <div class="col-md-4">
		                <div class="example ">
		                    <div class="example-content ">
		                        <div class="example-content-widget">
		                            <div id="color-picker-rgb" class=" color-picker-rgb input-group colorpicker-component  after-add-more">
		                                <input type="text" value="#cccccc" class="form-control"/>
		                                <span class="input-group-addon"><i></i></span>

		                            </div>
		                            <script>
		                            
		                            </script>
		                        </div>
		                    </div>
		                </div>

		              <!--   <div class="copy-fields hide">
		                  <div class="control-group input-group" style="margin-top:10px">
		                            <div class="example-content-widget">
		                                <div id="color-picker-rgb2" class="input-group colorpicker-component ">
		                                    <input type="text" value="#cccccc" class="form-control"/>
		                                    <span class="input-group-addon"><i></i> </span>
		                                </div>
		                                <script>
		                                $(function () {
		                                  $('#color-picker-rgb2').colorpicker({
		                                      color: '#cccccc',
		                                      format: 'rgba'
		                                  });
		                                });
		                                </script>
		                            </div>              
		                        <div class="input-group-btn"> 
		                          <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
		                        </div>
		                  </div>
		                </div> -->
		          </div>
		          <div class="col-md-2">
		              <div class="input-group-btn"> 
		                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>  Add More Colors  </button>
		              </div>
		          </div>
		        </div>
		    </div>
		</section> 
		<div class="container">
      <div class="row">
          <h4>If You Need More Choice Options For Customers Of This Product ,please Click Here.</h4>
          
          <div class="col-md-12 after-add-more-block r-block clone" id="block"> <!-- col-md-12  -->
            <div class="row "> <!-- Frist row -->
                <div class="col-lg-12 col-md-12 entire-remove ">
                            <div class="col-lg-4 col-md-4">
                                <div class="control-group">
                                    <input type="text" name = "cutomer-input" class="form-control" placeholder="Customer Input Title">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="btn-group hierarchy-select multi-select" data-resize="auto" id="multi-select">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="selected-label pull-left">&nbsp;</span>
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu open" >
                                        <div class="hs-searchbox">
                                            <input type="text" name="custom-input-type-0" class="form-control" autocomplete="on">
                                        </div>
                                        <ul class="dropdown-menu inner" role="menu">
                                            <li data-value="" data-default-selected="">
                                                <a href="#">All colors</a>
                                            </li>
                                            <li data-value="1">
                                                <a href="#">Red</a>
                                            </li>
                                            <li data-value="2">
                                                <a href="#">Orange</a>
                                            </li>
                                            <li data-value="3">
                                                <a href="#">Yellow</a>
                                            </li>
                                            <li data-value="4">
                                                <a href="#">Green</a>
                                            </li>
                                            <li data-value="5">
                                                <a href="#">Blue</a>
                                            </li>
                                            <li data-value="6">
                                                <a href="#">Purple</a>
                                            </li>
                                            <li data-value="7">
                                                <a href="#">Pink</a>
                                            </li>
                                            <li data-value="8">
                                                <a href="#">Brown</a>
                                            </li>
                                            <li data-value="9">
                                                <a href="#">Black</a>
                                            </li>
                                            <li data-value="10">
                                                <a href="#">Grey</a>
                                            </li>
                                            <li data-value="11">
                                                <a href="#">White</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <input class="hidden hidden-field" num="0" name="example_two" readonly="readonly" aria-hidden="true" type="text"/>
                                </div>
                            </div>
                </div>
            </div> <!-- /frist row -->
          </div> <!--/ col-md-12  -->
          <!-- Marker Span -->
        <span id="add-block" ></span>    
        <!--\Marker Span -->
     </div>
        <!--  Button to add more blocks  -->
       <div class="row add_m_blocks">
           <div class="col-md-2">
              <div class="input-group-btn"> 
                <button onclick="increment('block', 'add-block')" class="btn btn-success add-more-block" type="button"><i class="glyphicon glyphicon-plus"></i>  Add Customer Input Options </button>
              </div>
          </div>
     </div>
        <!--/ Button to add more blocks  -->

</div>
	</li>
</ul>

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>