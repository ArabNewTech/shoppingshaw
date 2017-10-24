<?php
class Ajax extends AjaxAdmin 
{
	
	public function commissionSettings()
	{		
		/*if (isset($this->data['admin_disabled_membership'])){
			if (!isset($this->data['admin_commission_enabled'])){
				$this->msg=t("Sorry but you cannot disabled membership if commision is disabled");
				return ;
			}
		}*/
		
		/*if (!isset($this->data['admin_commission_enabled']) && !isset($this->data['admin_disabled_membership'])){
			$this->msg=t("Sorry but you cannot disabled both membership and commision");
			return ;
		}*/
		
		Yii::app()->functions->updateOptionAdmin("admin_commission_enabled",
    	isset($this->data['admin_commission_enabled'])?$this->data['admin_commission_enabled']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_disabled_membership",
    	isset($this->data['admin_disabled_membership'])?$this->data['admin_disabled_membership']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_commision_percent",
    	isset($this->data['admin_commision_percent'])?$this->data['admin_commision_percent']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_vat_no",
    	isset($this->data['admin_vat_no'])?$this->data['admin_vat_no']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_vat_percent",
    	isset($this->data['admin_vat_percent'])?$this->data['admin_vat_percent']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("total_commission_status",
    	isset($this->data['total_commission_status'])?json_encode($this->data['total_commission_status']):'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_commision_ontop",
    	isset($this->data['admin_commision_ontop'])?$this->data['admin_commision_ontop']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_commision_type",
    	isset($this->data['admin_commision_type'])?$this->data['admin_commision_type']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_include_merchant_cod",
    	isset($this->data['admin_include_merchant_cod'])?$this->data['admin_include_merchant_cod']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_exclude_cod_balance",
    	isset($this->data['admin_exclude_cod_balance'])?$this->data['admin_exclude_cod_balance']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_disabled_membership_signup",
    	isset($this->data['admin_disabled_membership_signup'])?$this->data['admin_disabled_membership_signup']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_bank_account_name",
    	isset($this->data['admin_bank_account_name'])?$this->data['admin_bank_account_name']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_bank_account_number",
    	isset($this->data['admin_bank_account_number'])?$this->data['admin_bank_account_number']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_bank_custom_tpl",
    	isset($this->data['admin_bank_custom_tpl'])?$this->data['admin_bank_custom_tpl']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_bank_deposited_timeframe",
    	isset($this->data['admin_bank_deposited_timeframe'])?$this->data['admin_bank_deposited_timeframe']:'');
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
	
	public function merchantCommission()
	{
		 		    
		  
	    	$and='';  
	    	$and_date='';	    	
	    	if (isset($this->data['start_date']) && isset($this->data['end_date']))	{
	    		if (!empty($this->data['start_date']) && !empty($this->data['end_date'])){
	    		$and=" AND a.date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
	    		        '".$this->data['end_date']." 23:59:00'
	    		 ";	    		
	    		$and_date=" AND date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
	    		        '".$this->data['end_date']." 23:59:00'
	    		 ";
	    		}
	    	}
	    	
	    	if ( $this->data['query']=="last15"){
		    	$start_date=date("Y-m-d", strtotime ('-15 days'));
				$end_date=date("Y-m-d");
				
				$and =" AND a.date_created BETWEEN  '".$start_date." 00:00:00' AND 
		    		        '".$end_date." 23:59:00'
		    		 ";	    		
				$and_date =" AND date_created BETWEEN  '".$start_date." 00:00:00' AND 
		    		        '".$end_date." 23:59:00'
		    		 ";	    		
	    	} elseif ( $this->data['query']=="last30"){
	    		
	    		$start_date=date("Y-m-d", strtotime ('-30 days'));
				$end_date=date("Y-m-d");
				
				$and =" AND a.date_created BETWEEN  '".$start_date." 00:00:00' AND 
		    		        '".$end_date." 23:59:00'
		    		 ";	    		
				$and_date =" AND date_created BETWEEN  '".$start_date." 00:00:00' AND 
		    		        '".$end_date." 23:59:00'
		    		 ";	    		
	    	} elseif ( $this->data['query']=="month"){
	    		
	    		$query_date = $this->data['query_date'];			
				$start_date=date('Y-m-01', strtotime($query_date));
				$end_date=date('Y-m-t', strtotime($query_date));
				
				$and =" AND a.date_created BETWEEN  '".$start_date." 00:00:00' AND 
		    		        '".$end_date." 23:59:00'
		    		 ";	    		
				$and_date =" AND date_created BETWEEN  '".$start_date." 00:00:00' AND 
		    		        '".$end_date." 23:59:00'
		    		 ";	    		
	    	}
	    	
	    	$order_status_id='';
	    	$or='';
	    	if (isset($this->data['stats_id'])){
		    	if (is_array($this->data['stats_id']) && count($this->data['stats_id'])>=1){
		    		foreach ($this->data['stats_id'] as $stats_id) {		    			
		    			$order_status_id.="'$stats_id',";
		    		}
		    		if ( !empty($order_status_id)){
		    			$order_status_id=substr($order_status_id,0,-1);
		    		}		    	
		    	}	    
	    	}
	    	
	    	if ( !empty($order_status_id)){	    		
	    		$where= " WHERE a.status IN ($order_status_id)";
	    		$and_date.=" AND status IN ($order_status_id)";
	    	} else {
	    		$where= " WHERE a.status NOT IN ('".initialStatus()."')";
	    		$and_date.="AND status NOT IN ('".initialStatus()."')";
	    	}
	    		    	
	    	 	    	
	    	
	    	if ( $this->data['merchant_id']>=1){
	    		$and.=" AND a.merchant_id='".$this->data['merchant_id']."' ";
	    	}
	    	
	    	if (isset($this->data['payment_type'])){
	    		if ( $this->data['payment_type']==2){ // cash
	    			$and_date.=" AND payment_type IN ('cod','pyr','ccr','ocr') ";
	    			$and.=" AND payment_type IN ('cod','pyr','ccr','ocr') ";
	    		} else if ($this->data['payment_type']==3) { // card
	    			$and_date.=" AND payment_type NOT IN ('cod','pyr','ccr','ocr') ";
	    			$and.=" AND payment_type NOT IN ('cod','pyr','ccr','ocr') ";
	    		}	    	
	    	}	
	    	
	    	$DbExt=new DbExt;    	
	    	
	    	$stmt="SELECT a.*,b.is_commission,
	    	(
	    	select restaurant_name 
	    	from
	    	{{merchant}}
	    	where merchant_id = a.merchant_id 
	    	) as merchant_name,
	    	
	    	(
	    	select sum(total_w_tax) 
	    	from
	    	{{order}}
	    	where merchant_id = a.merchant_id 	  
	    	$and_date  		 
	    	) as total_order,
	    	
	    	(
	    	select sum(total_commission)
	    	from
	    	{{order}}
	    	where merchant_id = a.merchant_id 	 
	    	$and_date   		 
	    	) as total_commission
	    	
	    	FROM
	    	{{order}} a	  	    
	    	left join {{merchant}} b
			On
			a.merchant_id=b.merchant_id
	    	  	  
	    	$where
	    	$and	    	
	    	AND b.is_commission='2'
	    	
	    	GROUP BY merchant_id
	    	ORDER BY order_id DESC
	    	LIMIT 0,2000
	    	";
	    	
	    	if (isset($_GET['debug'])){
	    		dump($this->data);	    	
	    	    dump($stmt);
	    	}
	    	$_SESSION['kr_export_stmt']=$stmt;	    	
	    			    
	    	if ( $res=$DbExt->rst($stmt)){	 
	    		if (isset($_GET['debug'])){   		
	    		   dump($res);
	    		}
	    		
	    		$total_commission=0;
	    		foreach ($res as $val) {	    		
	    			$link=websiteUrl()."/admin/merchantcommissiondetails";	    			
	    			/*$link.="/mtid/".$val['merchant_id'];	 
	    			$link.="/where/".$where;	 
	    			$link.="/and/".$and;*/
	    			
	    			$link.="?mtid=".$val['merchant_id'];	 
	    			$link.="&where=".$where;	 
	    			$link.="&and=".$and;
	    				    			
/*$action="<a class=\"view-details\" data-id=\"$val[merchant_id]\" href=\"javascript:;\" data-where=\"$where\" data-and=\"$and\">".
Yii::t("default","Details").
"</a>";*/	    			

                    $total_commission+=$val['total_commission'];
$action="<a href=\"$link\" >".Yii::t("default","Details")."</a>";
	    			$date=prettyDate($val['date_created'],true);
	    			$date=Yii::app()->functions->translateDate($date);
	    				    				    				    			
	    			$feed_data['aaData'][]=array(
	    			  $val['merchant_id'],
	    			  stripslashes($val['merchant_name']),
	    			  displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['total_order'])),
	    			  displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['total_commission'])),
	    			  $action	    			  
	    		    );
	    		}	    		
	    		
	    		$feed_data['total_commission']=displayPrice(adminCurrencySymbol(),normalPrettyPrice($total_commission));
	    		$this->otableOutput($feed_data);
	    	}	   
	    	$this->otableNodata();					
	}
	
	public function merchantCommissionDetails()
	{
		$DbExt=new DbExt;		
		$where=$this->data['where'];
		$and=" AND merchant_id='".$this->data['mtid']."'";
		$and.=$this->data['and'];
		
				
    	if (isset($this->data['start_date']) && isset($this->data['end_date']))	{
    		if (!empty($this->data['start_date']) && !empty($this->data['end_date'])){
    		$and.=" AND date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
    		        '".$this->data['end_date']." 23:59:00'
    		 ";
    		}
    	}
		
		$stmt="
		SELECT a.*,		
		(
    	select restaurant_name 
    	from
    	{{merchant}}
    	where merchant_id = a.merchant_id 
    	) as merchant_name    	
		FROM
		{{order}} a
		$where
		$and
		ORDER BY order_id DESC
		";
		
		if (isset($_GET['debug'])){
			dump($this->data);	    	
            dump($stmt);
	    }	    	
		$total_order=0;	
	    $total_commission=0;    	
	    
	    $_SESSION['kr_export_stmt']=$stmt;	    
	    	
		if ($res=$DbExt->rst($stmt)){
			foreach ($res as $val) {
				
				if(!isset($val['total_order'])){
					$val['total_order']=0;
				}		
				$total_order=$total_order+$val['total_order'];
	    		$total_commission=$total_commission+$val['total_commission'];
	    			
				/*$date=prettyDate($val['date_created'],true);
	    	    $date=Yii::app()->functions->translateDate($date);	    	    */
				$date=FormatDateTime($val['date_created']);
	    	    
	    	    $feed_data['total_commission']=displayPrice(adminCurrencySymbol(),
	    	    normalPrettyPrice($total_commission));
	    	    $feed_data['merchant_name']=ucwords($val['merchant_name']);
	    	    
	    	    if ( $val['commision_ontop']==1){
	    	    	$total_w_tax="<a  class=\"view-receipt\" data-id=\"$val[order_id]\" href=\"javascript:;\">".displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['sub_total']))."</a>";
	    	    } else {
	    	    	$total_w_tax="<a  class=\"view-receipt\" data-id=\"$val[order_id]\" href=\"javascript:;\">".displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['total_w_tax']))."</a>";
	    	    }	    	    
	    	    
	    	    $feed_data['aaData'][]=array(
					$val['order_id'],
					t($val['payment_type']),
					$total_w_tax,
					normalPrettyPrice($val['percent_commision']),
					displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['total_commission'])),
					$date
				);
			}	
			$this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}
	
	public function getPackageInformation()
	{				
		if (isset($this->data['package_id'])){
			if ( $this->data['package_id']==0 ){
				$this->code=3;
				return false;
			}
			if ( $res=Yii::app()->functions->getSMSPackagesById($this->data['package_id'])){
				$this->code=1;
				$this->msg=t("Successful");
				$this->details=$res['sms_limit'];
			} else $this->msg=t("Cannot find information");
		} else $this->msg=t("Missing parameters");
	}
	
	public function getCommissionTotal()
	{
		$total_com=displayPrice(adminCurrencySymbol(),
		normalPrettyPrice(Yii::app()->functions->getTotalCommission()));
		
		$total_today=displayPrice(adminCurrencySymbol(),
		normalPrettyPrice(Yii::app()->functions->getTotalCommissionToday()));
				
		$total_last=displayPrice(adminCurrencySymbol(),
		normalPrettyPrice(Yii::app()->functions->getTotalCommissionLast()));
		
		$commission=array(
		  'total_com'=>$total_com,
		  'total_today'=>$total_today,
		  'total_last'=>$total_last
		);
		$this->code=1;
		$this->msg="Ok";
		$this->details=$commission;
	}
	
	public function merchantSignUp2()
	{		
					
		/*csrf validation*/
		if(!isset($_POST[Yii::app()->request->csrfTokenName])){
			$this->msg=t("The CSRF token is missing");
			return ;
		}	    
		if ( $_POST[Yii::app()->request->csrfTokenName] != Yii::app()->getRequest()->getCsrfToken()){
			$this->msg=t("The CSRF token could not be verified");
			return ;
		}  	
		
        /** check if admin has enabled the google captcha*/    	    	
    	if ( getOptionA('captcha_merchant_signup')==2){
    		if ( GoogleCaptcha::checkCredentials()){
    			if ( !GoogleCaptcha::validateCaptcha()){
    				$this->msg=GoogleCaptcha::$message;
    				return false;
    			}	    		
    		}	    	
    	} 
	    	
		$status=Yii::app()->functions->getOptionAdmin('merchant_sigup_status');
		if(empty($status)){
			$status='pending';
		}	
		$token=md5($this->data['restaurant_name'].date('c'));
		
		$percent=Yii::app()->functions->getOptionAdmin('admin_commision_percent');
		
		$p = new CHtmlPurifier();
				
	    $params=array(
	      'restaurant_name'=>$p->purify($this->data['restaurant_name']),
	      'restaurant_phone'=>$p->purify($this->data['restaurant_phone']),
	      'contact_name'=>$p->purify($this->data['contact_name']),
	      'contact_phone'=>$p->purify($this->data['contact_phone']),
	      'contact_email'=>$p->purify($this->data['contact_email']),
	      'street'=>$p->purify($this->data['street']),
	      'city'=>$p->purify($this->data['city']),
	      'post_code'=>$this->data['post_code'],
	      'cuisine'=>json_encode($this->data['cuisine']),
	      'username'=>$this->data['username'],
	      'password'=>md5($this->data['password']),
	      'status'=>$status,
	      'date_created'=>FunctionsV3::dateNow(),
	      'ip_address'=>$_SERVER['REMOTE_ADDR'],
	      'activation_token'=>$token,
	      'activation_key'=>Yii::app()->functions->generateRandomKey(5),
	      'restaurant_slug'=>Yii::app()->functions->createSlug($this->data['restaurant_name']),	      
	      'payment_steps'=>3,	      
	      'country_code'=>$this->data['country_code'],
	      'state'=>$this->data['state'],
	      'is_commission'=>2,
	      'percent_commision'=>$percent,	      
	      'abn'=>isset($this->data['abn'])?$this->data['abn']:'',
	      'merchant_type'=>isset($this->data['merchant_type'])?$this->data['merchant_type']:'',
	      'service'=>isset($this->data['service'])?$this->data['service']:1
	    );			
	    
	    if (isset($this->data['invoice_terms'])){
	    	if (is_numeric($this->data['invoice_terms'])){
	    		$params['invoice_terms']=$this->data['invoice_terms'];
	    	}	    
	    }
	    	    	    
	    $commision_type=getOptionA('admin_commision_type');
		if(!empty($commision_type)){
			$params['commision_type']=$commision_type;
		}		
	    
	    if ( !Yii::app()->functions->validateUsername($this->data['username']) ){
	    	
	    	if ($respck=Yii::app()->functions->validateMerchantUserFromMerchantUser($params['username'],
	    	    $params['contact_email'])){
	    		$this->msg=$respck;
	    		return ;		    		
	    	}		    
	    		    		    	
		    if ($this->insertData("{{merchant}}",$params)){
		    	$mtid=Yii::app()->db->getLastInsertID();
		    	
		    	//AUTO ADD SIZE
			    FunctionsV3::autoAddSize($mtid);
			    	
		    	$this->code=1;
		    	$this->msg=Yii::t("default","Successful");
		    	$this->details=$token;
		    	
		    	/*SEND WELCOME EMAIL*/
		    	FunctionsV3::sendWelcomeEmailMerchant($params,true);
		    	
		    	/*SEND NOTIFICATION TO ADMIN*/
		    	FunctionsV3::NotiNewMerchantSignup($params,'commission');
	            			    				    				    	
		    } else $this->msg=Yii::t("default","Sorry but we cannot add your information. Please try again later");
	    } else $this->msg=Yii::t("default","Sorry but your username is alread been taken.");
	}
	
	public function getMerchantBalance()
	{
		$mtid=Yii::app()->functions->getMerchantID();	
		
		$balance=displayPrice(adminCurrencySymbol(),
		normalPrettyPrice(Yii::app()->functions->getMerchantBalance($mtid)));
			
		$this->details=$balance;
		$this->code=1;
		$this->msg="ok";
	}
	
	public function merchantStatement()
	{
		if (isset($_GET['debug'])){
		   dump($this->data);
		}
		$mtid=Yii::app()->functions->getMerchantID();
		
		$orderstats=Yii::app()->functions->getCommissionOrderStats();		
		
		if (isset($_GET['debug'])){
		   dump($orderstats);
		   dump($admin_commision_ontop);
		}
		
		$and=''; $trans_type='';
		if ( $this->data['query']=="month"){
			$query_date = $this->data['query_date'];			
			$start_date=date('Y-m-01', strtotime($query_date));
			$end_date=date('Y-m-t', strtotime($query_date));
			$and =" AND date_created BETWEEN  '".$start_date." 00:00:00' AND 
	    		        '".$end_date." 23:59:00'
	    		 ";	    		
		} elseif ( $this->data['query']=="period"){
			
			$start_date=$this->data['start_date'];
			$end_date=$this->data['end_date'];
			
			$and =" AND date_created BETWEEN  '".$start_date." 00:00:00' AND 
	    		        '".$end_date." 23:59:00'
	    		 ";	    		
		} elseif ( $this->data['query']=="last15"){
			
			$start_date=date("Y-m-d", strtotime ('-15 days'));
			$end_date=date("Y-m-d");
			
			$and =" AND date_created BETWEEN  '".$start_date." 00:00:00' AND 
	    		        '".$end_date." 23:59:00'
	    		 ";	    		
		} elseif ( $this->data['query']=="last30"){
			
			$start_date=date("Y-m-d", strtotime ('-30 days'));
			$end_date=date("Y-m-d");
			
			$and =" AND date_created BETWEEN  '".$start_date." 00:00:00' AND 
	    		        '".$end_date." 23:59:00'
	    		 ";	    		
		}	
		
		if (isset($this->data['payment_type'])){
			if ( $this->data['payment_type']==2){ //cash
				$trans_type="AND payment_type IN ('cod','pyr','ccr','ocr')";				
			} elseif ( $this->data['payment_type']==3){ //card			
				$trans_type="AND payment_type NOT IN ('cod','pyr','ccr','ocr')";	
			}		
		}
		/*$trans_type="AND payment_type NOT IN ('cod','pyr','ccr')";
		if (isset($this->data['cash_statement'])){
			$trans_type="AND payment_type IN ('cod','pyr','ccr')";
		}*/
		
	    $stmt="SELECT * FROM
	    {{order}}
	    WHERE
	    merchant_id=".Yii::app()->functions->q($mtid)."
	    AND status in ($orderstats)
	    $and	    
	    $trans_type
	    ORDER BY order_id DESC
	    ";
	    if (isset($_GET['debug'])){
	        dump($stmt);
	    }
	    
	    $_SESSION['kr_export_stmt']=$stmt;
	    
	    $total_amount=0;
	    $total_payable=0;
	    if ( $res=$this->rst($stmt)){
	    	foreach ($res as $val) {	    			    		
	    		//$date=prettyDate($val['date_created']);
	    		/*$date=date('M d,Y G:i:s',strtotime($val['date_created']));
			    $date=Yii::app()->functions->translateDate($date);*/					
	    		$date=FormatDateTime($val['date_created']);
			    
			    $total=$val['total_w_tax'];
			    if ( $val['commision_ontop']==1){
			    	$total=$val['sub_total'];
			    }
			    
			    $total_commission=$val['total_commission'];
			    $amount=$total-$total_commission;
			    
			    $amount=$val['merchant_earnings'];
			    
			    $link="<a href=\"javascript:;\" class=\"view-receipt\"  data-id=\"$val[order_id]\"  >".
			    displayPrice(adminCurrencySymbol(),normalPrettyPrice($total))."</a>";
			    			    
	    		$feed_data['aaData'][]=array(
	    		    $val['order_id'],
	    		    strtoupper($val['payment_type']),
	    		    $link,	    		    
	    		    normalPrettyPrice($val['percent_commision']),
	    		    displayPrice(adminCurrencySymbol(),normalPrettyPrice($total_commission)),
	    		    displayPrice(adminCurrencySymbol(),normalPrettyPrice($amount)),
	    		    $date
	    		);	    		
	    			    		
	    		$total_amount+=$amount;
	    		$total_payable+=$total_commission;
	    	}
	    	
	    	$feed_data['total_amount']=displayPrice(adminCurrencySymbol(),normalPrettyPrice($total_amount));
	    	$feed_data['total_payable']=displayPrice(adminCurrencySymbol(),normalPrettyPrice($total_payable));
	    	$this->otableOutput($feed_data);
	    } 
	    $this->otableNodata();
	}
	
	public function removeNotice()
	{
		$mtid=Yii::app()->functions->getMerchantID();		
		Yii::app()->functions->updateOption("merchant_read_notice","1",$mtid);
		$this->code=1;
	}
	
	public function ingredientsList()
	{
	    $slug=$this->data['slug'];
        $stmt="
		SELECT * FROM
		{{ingredients}}
		WHERE			
		merchant_id='".Yii::app()->functions->getMerchantID()."'
		ORDER BY ingredients_id  DESC
		";
		$connection=Yii::app()->db;
	    $rows=$connection->createCommand($stmt)->queryAll();     	    
	    if (is_array($rows) && count($rows)>=1){
	    	foreach ($rows as $val) {    	     	    		
	    		$chk="<input type=\"checkbox\" name=\"row[]\" value=\"$val[ingredients_id]\" class=\"chk_child\" >";   		
	    		$option="<div class=\"options\">
	    		<a href=\"$slug/id/$val[ingredients_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[ingredients_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";
	    		/*$date=date('M d,Y G:i:s',strtotime($val['date_created']));  
	    		$date=Yii::app()->functions->translateDate($date);*/
	    		$date=FormatDateTime($val['date_created']);
	    		
	    		$feed_data['aaData'][]=array(
	    		  $chk,$val['ingredients_name'].$option,
	    		  //$date."<div>".t($val['status'])."</div>"
	    		  "$date<br/><span class=\"tag ".$val['status']."\">".t($val['status'])."</span>"
	    		);
	    	}
	    	$this->otableOutput($feed_data);
	    }     	    
	    $this->otableNodata();	
	}
	
	public function AddIngredients()
	{
	  $params=array(
		  'ingredients_name'=>$this->data['ingredients_name'],
		  'status'=>addslashes($this->data['status']),
		  'date_created'=>FunctionsV3::dateNow(),
		  'ip_address'=>$_SERVER['REMOTE_ADDR'],
		  'merchant_id'=>Yii::app()->functions->getMerchantID()
		);								

		if (isset($this->data['ingredients_name_trans'])){
			if (okToDecode()){
				$params['ingredients_name_trans']=json_encode($this->data['ingredients_name_trans'],
				JSON_UNESCAPED_UNICODE);
			} else $params['ingredients_name_trans']=json_encode($this->data['ingredients_name_trans']);
		}
			
		$command = Yii::app()->db->createCommand();
		if (isset($this->data['id']) && is_numeric($this->data['id'])){				
			unset($params['date_created']);
			$params['date_modified']=FunctionsV3::dateNow();				
			$res = $command->update('{{ingredients}}' , $params , 
			'ingredients_id=:ingredients_id' , array(':ingredients_id'=>addslashes($this->data['id'])));
			if ($res){
				$this->code=1;
                $this->msg=Yii::t("default",'ingredients updated');  
			} else $this->msg=Yii::t("default","ERROR: cannot update");
		} else {				
			if ($res=$command->insert('{{ingredients}}',$params)){
				$this->details=Yii::app()->db->getLastInsertID();	
                $this->code=1;
                $this->msg=Yii::t("default",'ingredients added'); 
            } else $this->msg=Yii::t("default",'ERROR. cannot insert data.');
		}	    		  
	}
	
	public function withdrawalSettings()
	{
		/*Yii::app()->functions->updateOptionAdmin("wd_minimum_amount",
	    isset($this->data['wd_minimum_amount'])?$this->data['wd_minimum_amount']:'');*/
		
		Yii::app()->functions->updateOptionAdmin("wd_paypal_minimum",
	    isset($this->data['wd_paypal_minimum'])?$this->data['wd_paypal_minimum']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_bank_minimum",
	    isset($this->data['wd_bank_minimum'])?$this->data['wd_bank_minimum']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_days_process",
	    isset($this->data['wd_days_process'])?$this->data['wd_days_process']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_paypal",
	    isset($this->data['wd_paypal'])?$this->data['wd_paypal']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_paypal_mode",
	    isset($this->data['wd_paypal_mode'])?$this->data['wd_paypal_mode']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_paypal_mode_user",
	    isset($this->data['wd_paypal_mode_user'])?$this->data['wd_paypal_mode_user']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_paypal_mode_pass",
	    isset($this->data['wd_paypal_mode_pass'])?$this->data['wd_paypal_mode_pass']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_paypal_mode_signature",
	    isset($this->data['wd_paypal_mode_signature'])?$this->data['wd_paypal_mode_signature']:'');
	    
	    /*Yii::app()->functions->updateOptionAdmin("wd_paypal_client_id",
	    isset($this->data['wd_paypal_client_id'])?$this->data['wd_paypal_client_id']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_paypal_client_secret",
	    isset($this->data['wd_paypal_client_secret'])?$this->data['wd_paypal_client_secret']:'');*/
	    
	    Yii::app()->functions->updateOptionAdmin("wd_bank_deposit",
	    isset($this->data['wd_bank_deposit'])?$this->data['wd_bank_deposit']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_template_payout",
	    isset($this->data['wd_template_payout'])?$this->data['wd_template_payout']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_template_process",
	    isset($this->data['wd_template_process'])?$this->data['wd_template_process']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_enabled_paypal",
	    isset($this->data['wd_enabled_paypal'])?$this->data['wd_enabled_paypal']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_payout_disabled",
	    isset($this->data['wd_payout_disabled'])?$this->data['wd_payout_disabled']:'');
	    	    
	    Yii::app()->functions->updateOptionAdmin("wd_payout_notification",
	    isset($this->data['wd_payout_notification'])?$this->data['wd_payout_notification']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_template_payout_subject",
	    isset($this->data['wd_template_payout_subject'])?$this->data['wd_template_payout_subject']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_template_process_subject",
	    isset($this->data['wd_template_process_subject'])?$this->data['wd_template_process_subject']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("wd_bank_fields",
	    isset($this->data['wd_bank_fields'])?$this->data['wd_bank_fields']:'');
	    
	    $this->code=1;
	    $this->msg=t("Successful");
	}
	
	public function requestPayout()
	{
		
		$mtid=Yii::app()->functions->getMerchantID();
		
 		$wd_paypal_minimum=yii::app()->functions->getOptionAdmin('wd_paypal_minimum');
        $wd_bank_minimum=yii::app()->functions->getOptionAdmin('wd_bank_minimum');
        
        $wd_paypal_minimum=standardPrettyFormat($wd_paypal_minimum);
        $wd_bank_minimum=standardPrettyFormat($wd_bank_minimum);
        
        $current_balance=Yii::app()->functions->getMerchantBalance($mtid);
        $this->data['current_balance']=$current_balance;

		$validator=new Validator;
		
		$req=array(
		  'payment_type'=>t("Payment type is required"),
		  'payment_method'=>t("Payment Method is required"),
		);								
		
		if ( $this->data['payment_method']=="paypal"){
			$req2=array(
			 'account'=>t("Email account not valid"),	 
			 'account_confirm'=>t("Confirm email account not valid"),
			);
			$validator->email($req2,$this->data);

			$req['amount']=t("Amount is required");

			if ( $this->data['account']!=$this->data['account_confirm']){
				$validator->msg[]=t("Confirm email does not match");
			}
											    		   
		} elseif ( $this->data['payment_method']=="bank" ){
			
		}				
		
		if ( $this->data['payment_type']=="single"){
			if ( $this->data['minimum_amount']>$this->data['amount']){
			   $validator->msg[]=t("Sorry but minimum amount is")." ".displayPrice(baseCurrency(),$this->data['minimum_amount']);
			}				
			if ( $current_balance<$this->data['amount']){		    	
		       $validator->msg[]=t("Amount is greater than your balance");
		    }
		} elseif ( $this->data['payment_type']=="all-earnings"){						
			$this->data['amount']=$current_balance;
			if ( $this->data['minimum_amount']>$this->data['amount']){
			   $validator->msg[]=t("Sorry but minimum amount is")." ".displayPrice(baseCurrency(),$this->data['minimum_amount']);
			}				
			if ( $this->data['minimum_amount']>$current_balance){
			   $validator->msg[]=t("Sorry but minimum amount is")." ".displayPrice(baseCurrency(),$this->data['minimum_amount']);
			}		
		} else {
			
		}
												
		$validator->required($req,$this->data);
											
		if ( $validator->validate()){
			if ( $this->data['payment_type']=="single"){															
				/*if  ( $wd_paypal_minimum>$this->data['amount']){
					$this->msg=t("Sorry but minimum amount is")." ".displayPrice(baseCurrency(),$wd_paypal_minimum);
				} else {*/
					$resp=Yii::app()->functions->payoutRequest($this->data['payment_method'],$this->data);
					if ($resp){
						$this->details=$resp['id'];
						$this->code=1;
						$this->msg=t("Successful");
																	
					} else $this->msg=t("ERROR: Something went wrong");
				//}			
			} else {
				//echo 'all earning';
				$resp=Yii::app()->functions->payoutRequest($this->data['payment_method'],$this->data);
				if ($resp){
					$this->details=$resp['id'];
					$this->code=1;
					$this->msg=t("Successful");											
			   } else $this->msg=t("ERROR: Something went wrong");
			}
		} else $this->msg=$validator->getErrorAsHTML();
				
		if ( $this->code==1){
			
			/*update all orders paid status to locked*/		
		    FunctionsK::updateAllPaidOrders($mtid);
			
			if ( isset($this->data['default_account_paypal'])){
			   if ( $this->data['default_account_paypal']==2){
			   	    Yii::app()->functions->updateOption("merchant_payout_account",
    	            isset($this->data['account'])?$this->data['account']:'',$mtid);
			   }
            }			
            
            if ( isset($this->data['default_account_bank'])){
            	if ( $this->data['default_account_bank']==2){
            		$bank_info=array(
            		  'swift_code'=>isset($this->data['swift_code'])?$this->data['swift_code']:'',
            		  'bank_account_number'=>isset($this->data['bank_account_number'])?$this->data['bank_account_number']:'' ,
            		  'account_name'=>isset($this->data['account_name'])?$this->data['account_name']:'',
            		  'bank_account_number'=>isset($this->data['bank_account_number'])?$this->data['bank_account_number']:'',
            		  'swift_code'=>isset($this->data['swift_code'])?$this->data['swift_code']:'',
            		  'bank_name'=>isset($this->data['bank_name'])?$this->data['bank_name']:'',
            		  'bank_branch'=>isset($this->data['bank_branch'])?$this->data['bank_branch']:''
            		);
            		Yii::app()->functions->updateOption("merchant_payout_bank_account",
            		json_encode($bank_info),$mtid);
            	}            
            }		
            
            // send email
            $merchant_email='';
			$tpl='';
			
			$wd_days_process=Yii::app()->functions->getOptionAdmin("wd_days_process");		
			if (empty($wd_days_process)){
    		    $wd_days_process=5;
    	    }
			$cancel_date=$wd_days_process-2;
	        $cancel_date=date("F d Y", strtotime (" +$cancel_date days"));
	        $process_date=date("F d Y", strtotime (" +$wd_days_process days"));
	        
			if ( $merchant_info=Yii::app()->functions->getMerchant($mtid)){			
				$merchant_email=$merchant_info['contact_email'];
				$cancel_link=websiteUrl()."/store/cancelwithdrawal/id/".$resp['token'];
				$tpl=yii::app()->functions->getOptionAdmin('wd_template_payout');
			    $tpl=smarty("merchant-name",$merchant_email['restaurant_name'],$tpl);
			    $tpl=smarty("payout-amount",standardPrettyFormat($this->data['amount']),$tpl);
			    $tpl=smarty("payment-method",$this->data['payment_method'],$tpl);
			    $tpl=smarty("account",$this->data['account'],$tpl);
			    $tpl=smarty("cancel-date",$cancel_date,$tpl);
			    $tpl=smarty("cancel-link",$cancel_link,$tpl);
			    $tpl=smarty("process-date",$process_date,$tpl);
			}		
										
			if (!empty($tpl)){
				$wd_template_payout_subject=yii::app()->functions->getOptionAdmin('wd_template_payout_subject');
                if (empty($wd_template_payout_subject)){
	                $wd_template_payout_subject=t("Your Request for Withdrawal was Received");
                }                
				sendEmail($merchant_email,'',$wd_template_payout_subject,$tpl);
			}            
		} 		
	}	

	public function incomingWithdrawals()
	{		
		$show_action=true;
		$and="WHERE status IN ('pending')";		
		if (isset($this->data['w-list'])){
			switch ($this->data['w-list']) {
				case "cancel":
					$and="WHERE status IN ('cancel')";
					$show_action=false;
					break;
				case "reversal":
					$and="WHERE status IN ('reversal')";
					$show_action=false;
					break;
				case "paid":					
					$and="WHERE status IN ('paid')";
					$show_action=true;
					break;
				case "denied":					
					$and="WHERE status IN ('denied')";
					$show_action=false;
					break;
				case "failed":	
				    $and="WHERE status NOT IN ('paid','pending','denied','approved','reversal')";
				    $show_action=false;
				    break;
				case "approved":    
				    $and="WHERE status IN ('approved')";
					$show_action=false;
					break;
				case "all":    
				    $and="";
				    $show_action=false;
				    break;
				default:
					break;
			}
		}
		
		if (isset($this->data['start_date']) && isset($this->data['end_date'])){
			if (!empty($this->data['start_date']) && !empty($this->data['end_date'])){
				if (!empty($and)){				
					$and.=" AND date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
	    		        '".$this->data['end_date']." 23:59:00'
	    		    ";
				} else {
					$and.=" WHERE date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
	    		        '".$this->data['end_date']." 23:59:00'
	    		    ";
				}
			}
		}	
		
		if (isset($this->data['merchant_id'])){
			if (!empty($this->data['merchant_id'])){
				if (!empty($and)){
					$and.=" AND merchant_id='".$this->data['merchant_id']."'";
				} else {
					$and=" WHERE merchant_id='".$this->data['merchant_id']."'";
				}
			}
		}	
		
		$slug=$this->data['slug'];
        $stmt="
		SELECT a.*,
		(
		select restaurant_name 
		from
		{{merchant}}
		where
		merchant_id=a.merchant_id
		) as merchant_name
		 FROM
		{{withdrawal}} a		
		$and
		ORDER BY withdrawal_id DESC
		";
        
        if (isset($_GET['debug'])){
           dump($this->data);
           dump($stmt);
        }
        
        $_SESSION['kr_export_stmt']=$stmt;
        
		$connection=Yii::app()->db;
	    $rows=$connection->createCommand($stmt)->queryAll();     	    
	    if (is_array($rows) && count($rows)>=1){
	    	foreach ($rows as $val) {    	 
	    		$method=t("Paypal to")." ".$val['account'];
	    		if ( $val['payment_method']=="bank"){
	    			$method=t("Bank to")." ".$val['bank_account_number'];
	    		}	    	
	    		
	    		if ( $this->data['w-list']=="paid"){
	    		$action="<a href=\"javascript:;\" class=\"payout_action\" data-id=\"$val[withdrawal_id]\" data-status=\"reversal\">".t("Apply reversal")."</a><br/>";		    		
	    		} else {
	    		$action="<a href=\"javascript:;\" class=\"payout_action\" data-id=\"$val[withdrawal_id]\" data-status=\"approved\">".t("approved")."</a><br/>";
	    		$action.="<a href=\"javascript:;\" class=\"payout_action\" data-id=\"$val[withdrawal_id]\" data-status=\"denied\">".t("denied")."</a>";
	    		}
	    		
	    		/*$chk="<input type=\"checkbox\" name=\"row[]\" value=\"$val[cook_id]\" class=\"chk_child\" >";   		
	    		$option="<div class=\"options\">
	    		<a href=\"$slug/id/$val[cook_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[cook_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";*/
	    		/*$date=date('M d,Y G:i:s',strtotime($val['date_created']));  
	    		$date=Yii::app()->functions->translateDate($date);*/
	    		$date=FormatDateTime($val['date_created']);
	    		
	    		/*$date_created=displayDate($val['date_created']);
	    		$date_to_process=displayDate($val['date_to_process']);*/
	    		$date_created=FormatDateTime($val['date_created'],false);
	    		$date_to_process=FormatDateTime($val['date_to_process'],false);
	    		
	    		$bank_info='';
	    		if ( $val['payment_method']=="bank"){
	    			$bank_info="<br/><a href=\"javascript:;\" data-id=\"$val[withdrawal_id]\" class=\"view-bank-info\">".t("View bank info")."</a>";
	    		}	    	
	    		
	    		$feed_data['aaData'][]=array(
	    		  $val['withdrawal_id'],
	    		  $val['merchant_name'],
	    		  $method.$bank_info,
	    		  displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['amount'])),
	    		  displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['current_balance'])),
	    		  "<span class=\"uk-badge withdrawal-status\">".t($val['status'])."</span>",
	    		  $date_created,
	    		  $date_to_process,	    		  
	    		  $show_action==true?$action:''
	    		);
	    	}
	    	$this->otableOutput($feed_data);
	    }     	    
	    $this->otableNodata();	
	}
	
	public function payoutChangeStatus()
	{	    
	    $validator=new Validator;
	    $req=array(
	     'withdrawal_id'=>t("withdrawal id is required"),
	     'status'=>t("Status is required"),
	    );
	    $validator->required($req,$this->data);
	    if ( $validator->validate()){
	    	$params=array(
	    	  'status'=>$this->data['status'],
	    	  'viewed'=>2
	    	);	    	
	    	$DbExt=new DbExt;
	    	if ( $DbExt->updateData("{{withdrawal}}",$params,'withdrawal_id',$this->data['withdrawal_id'])){
	    		$this->code=1;
	    		$this->msg=t("Successful");
	    	} else $this->msg=t("Failed cannot update records");	    
	    } else $this->msg=$validator->getErrorAsHTML();
	}
	
	public function wdPayoutNotification()
	{	
		$DbExt=new DbExt;
		$stmt="SELECT count(*) as total
		 FROM
		{{withdrawal}}
		WHERE
		status ='pending'
		AND
		viewed='1'
		";
		if ( $res=$DbExt->rst($stmt)){			
			if ( $res[0]['total']>=1){
				$this->code=1;
				$msg=t("There are")." (".$res[0]['total'].") ".t("withdrawals waiting for your approval");
				$this->msg=$msg."<br/><a class=\"white-link\" href=\"".websiteUrl()."/admin/incomingwithdrawal\">".t("Click here to view")."</a>";
				$this->details=$res[0]['total'];
			} else $this->msg="no results";
		} else $this->msg="no results";
	}
	
	public function cancelWithdrawal()
	{
		if ( $res=Yii::app()->functions->getWithdrawalInformationByToken($this->data['id'])){			
			if ($res['status']=="cancel"){				
				$this->msg=t("This withdrawal request has been already cancel");
				return ;
			}		
		}
		
		$DbExt=new DbExt;
		if (isset($this->data['id'])){
			$params=array(
			  'status'=>'cancel',
			  'date_process'=>FunctionsV3::dateNow(),
			  'ip_address'=>$_SERVER['REMOTE_ADDR']
			);
			if ($DbExt->updateData("{{withdrawal}}",$params,'withdrawal_token',$this->data['id'])){
				$this->code=1;
				$this->msg=t("Your withdrawal has been cancel");
			} else $this->msg=t("Error cannot cancel withdrawal please contact site admin");
		} else $this->msg=t("Missing id");
	}
	
	public function rptMerchantSalesSummaryReport()
	{
		if(isset($_GET['debug'])){
			dump($this->data);
		}		
		
		unset($_SESSION['rpt_date_range']);
	
		$and='';  
    	if (isset($this->data['start_date']) && isset($this->data['end_date']))	{
    		if (!empty($this->data['start_date']) && !empty($this->data['end_date'])){
    		   $and=" AND date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
    		        '".$this->data['end_date']." 23:59:00'
    		   ";
    		   $_SESSION['rpt_date_range']=array(
    		     'start_date'=>$this->data['start_date'],
    		     'end_date'=>$this->data['end_date']
    		   );
    		}
    	}
    	
    	$order_status_id='';
	    $or='';
    	if (isset($this->data['stats_id'])){
	    	if (is_array($this->data['stats_id']) && count($this->data['stats_id'])>=1){
	    		foreach ($this->data['stats_id'] as $stats_id) {		    			
	    			$order_status_id.="'$stats_id',";
	    		}
	    		if ( !empty($order_status_id)){
	    			$order_status_id=substr($order_status_id,0,-1);
	    		}		    	
	    	}	    
    	}
    	
    	if ( !empty($order_status_id)){	    		
    		$and.= " AND status IN ($order_status_id)";
    	}	    	 
    	
    	$where='';
    	if (isset($this->data['merchant_id'])){
    		if (!empty($this->data['merchant_id'])){
    			$where=" WHERE merchant_id=".Yii::app()->functions->q($this->data['merchant_id'])." ";
    		}    	
    	}	
    	
    	if(!isset($this->data['slug'])){
    		$this->data['slug']='';
    	}
		$slug=$this->data['slug'];
        $stmt="
		SELECT a.restaurant_name,
		(
		select sum(total_w_tax)as total
		from 
		{{order}}
		where
		merchant_id=a.merchant_id
		$and
		) as total_sales,
		
		(
		select sum(total_commission)
		from
		{{order}}
		where
		merchant_id=a.merchant_id
		$and
		) as total_commission,
		
		(
		select sum(merchant_earnings)
		from
		{{order}}
		where
		merchant_id=a.merchant_id
		$and
		) as total_earnings
		
		
		FROM
		{{merchant}} a
		$where
		ORDER BY restaurant_name ASC
		";
        if(isset($_GET['debug'])){
        	dump($stmt);
        }
        
       /* (
		select sum(number_guest)
		from
		{{bookingtable}}
		where
		merchant_id=a.merchant_id
		and status='approved'		
		) as total_guest*/
		
        
        $_SESSION['kr_export_stmt']=$stmt;
        
		$connection=Yii::app()->db;
	    $rows=$connection->createCommand($stmt)->queryAll();     	    
	    if (is_array($rows) && count($rows)>=1){
	    	foreach ($rows as $val) {    	     	    			    		
	    		if(isset($_GET['debug'])){
	    		   dump($val);
	    		}
	    		$feed_data['aaData'][]=array(	    		  
	    		   stripslashes($val['restaurant_name']),
	    		   displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['total_sales']+0)),
	    		   displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['total_commission']+0)),
	    		   displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['total_earnings']+0)),
	    		   //$val['total_guest']
	    		);
	    	}
	    	$this->otableOutput($feed_data);
	    }     	    
	    $this->otableNodata();	
	}
	
	public function testEmail()
	{
		require_once 'test-email.php';
		die();
	}
	
	public function sendTestEmail()
	{		
		if (isset($this->data['email'])){
			$content="This is a test email";
			if ( Yii::app()->functions->sendEmail($this->data['email'],'',$content,$content)){
				$this->code=1;
				$this->msg=t("Successful");
			} else $this->msg=t("Sending of email has failed");		
		}  else $this->msg=t("Email is required");
	}
	
	public function FaxSettings()
	{	
		Yii::app()->functions->updateOptionAdmin("fax_company",
    	isset($this->data['fax_company'])?$this->data['fax_company']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("fax_username",
    	isset($this->data['fax_username'])?$this->data['fax_username']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("fax_password",
    	isset($this->data['fax_password'])?$this->data['fax_password']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("fax_enabled",
    	isset($this->data['fax_enabled'])?$this->data['fax_enabled']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("fax_user_admin_credit",
    	isset($this->data['fax_user_admin_credit'])?$this->data['fax_user_admin_credit']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("fax_email_notification",
    	isset($this->data['fax_email_notification'])?$this->data['fax_email_notification']:'');
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
		
	public function FaxpackagesList()
	{
	    $slug=$this->data['slug'];
		$stmt="SELECT * FROM
		{{fax_package}}			
		ORDER BY fax_package_id DESC
		";
		if ( $res=$this->rst($stmt)){
			foreach ($res as $val) {	
				/*$date=date('M d,Y G:i:s',strtotime($val['date_created']));  				
				$date=Yii::app()->functions->translateDate($date);*/
				$date=FormatDateTime($val['date_created']);
				$action="<div class=\"options\">
	    		<a href=\"$slug/id/$val[fax_package_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[fax_package_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";
				$val['title']=ucwords($val['title']);
				$feed_data['aaData'][]=array(
				  $val['fax_package_id'],
				  $val['title'].$action,
				  Yii::app()->functions->limitDescription($val['description']),
				  Yii::app()->functions->standardPrettyFormat($val['price']),
				  Yii::app()->functions->standardPrettyFormat($val['promo_price']),
				  $val['fax_limit'],
				  $date."<div>".Yii::t("default",$val['status'])."</div>"					  
				);
			}
			$this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}
	
	public function FaxPackageAdd()
	{		   
       $params=array(
         'title'=>$this->data['title'],
         'description'=>$this->data['description'],
         'price'=>$this->data['price'],
         'promo_price'=>$this->data['promo_price'],
         'fax_limit'=>$this->data['fax_limit'],
         'status'=>$this->data['status'],
         'date_created'=>FunctionsV3::dateNow(),
         'ip_address'=>$_SERVER['REMOTE_ADDR']
       );	       
       if (empty($this->data['id'])){	
	    	if ( $this->insertData("{{fax_package}}",$params)){
	    		$this->details=Yii::app()->db->getLastInsertID();
	    		$this->code=1;
	    		$this->msg=Yii::t("default","Successful");		    		
	    	}
	    } else {		    	
	    	unset($params['date_created']);
			$params['date_modified']=FunctionsV3::dateNow();			
			$res = $this->updateData('{{fax_package}}' , $params ,'fax_package_id',$this->data['id']);
			if ($res){
				$this->code=1;
                $this->msg=Yii::t("default",'Package updated.');  
			} else $this->msg=Yii::t("default","ERROR: cannot update");
	    }			
	}	
	
	public function FaxMerchantSettings()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
		
		Yii::app()->functions->updateOption("fax_merchant_recipient",
    	isset($this->data['fax_merchant_recipient'])?$this->data['fax_merchant_recipient']:''
    	,$merchant_id);
    	
	    Yii::app()->functions->updateOption("fax_merchant_number",
    	isset($this->data['fax_merchant_number'])?$this->data['fax_merchant_number']:''
    	,$merchant_id);
    	
    	Yii::app()->functions->updateOption("fax_merchant_enabled",
    	isset($this->data['fax_merchant_enabled'])?$this->data['fax_merchant_enabled']:''
    	,$merchant_id);
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Settings saved.");
	}
	
	public function initpaymentprovider()
	{
		$params="?method=".$this->data['payment_opt'];
		$params.="&purchase=".$this->data['purchase'];		
		$params.="&return_url=".$this->data['return_url'];
				
		$FunctionsK=new FunctionsK;		
		$merchantinfo=Yii::app()->functions->getMerchantInfo();
		
			
		switch ($this->data['purchase']) {
			case "fax_package":	
					
			    $resp=$FunctionsK->getFaxPackagesById( isset($this->data['fax_package_id'])?$this->data['fax_package_id']:'' );			    
			    if (!$resp){
			    	$this->msg=t("Package information not found");
			    	return ;
			    }		
			    
			    if ($resp['promo_price']>=1){
					$package_price.=$resp['promo_price'];
			    } else $package_price=$resp['price'];
			   
			    $credit=$resp['fax_limit'];
			    
			    if ($this->data['payment_opt']=="pyp" || $this->data['payment_opt']=="stp"){
					$params.="&package_id=".$this->data['fax_package_id'];				
					//if ( $resp=$FunctionsK->getFaxPackagesById($this->data['fax_package_id'])){					
					if ($resp){
						$params2='';
						if ($resp['promo_price']>=1){
							$params2.="&price=".$resp['promo_price'];
						} else $params2.="&price=".$resp['price'];
							
						$params2.="&description=".urlencode($resp['title']);		
						$params.="&raw=".base64_encode($params2);
												
						$this->code=1;
						$this->msg=t("Please wait while we redirect you");
						$this->details=websiteUrl()."/merchant/pay/$params";
					} else $this->msg=t("Package information not found");
					
			    } elseif ( $this->data['payment_opt']=="obd"){
			    	
			    	//$merchantinfo=Yii::app()->functions->getMerchantInfo();			    	
			    	if ( is_array($merchantinfo) && count($merchantinfo)>=1){
			    		$merchant_email=$merchantinfo[0]->contact_email;
			    		$ref="FAX_".Yii::app()->functions->generateRandomKey(8);
			 			    		
			    		$params_insert=array(
			    		 'merchant_id'=>Yii::app()->functions->getMerchantID(),
			    		 'fax_package_id'=>$this->data['fax_package_id'],
			    		 'payment_type'=>Yii::app()->functions->paymentCode("bankdeposit"),
			    		 'package_price'=>$package_price,
			    		 'fax_limit'=>$credit,
			    		 'payment_reference'=>$ref,
			    		 'date_created'=>FunctionsV3::dateNow(),
			    		 'ip_address'=>$_SERVER['REMOTE_ADDR']
			    		);		
			    		$bank_info=Yii::app()->functions->getBankDepositInstruction();			    		
			    		$tpl=$bank_info['content'];
			    		$tpl=smarty('amount',displayPrice(baseCurrency(),standardPrettyFormat($package_price)),$tpl);
			    		$tpl=smarty('verify-payment-link',
			    		websiteUrl()."/merchant/faxbankdepositverification/?ref=$ref",$tpl);
			    		
			    		if (sendEmail($merchant_email,$bank_info['sender'],$bank_info['subject'],$tpl)){
			    			if ( $this->insertData("{{fax_package_trans}}",$params_insert)){
			    				$this->details=websiteUrl()."/merchant/faxreceipt/id/".Yii::app()->db->getLastInsertID();
			    				$this->code=1;
$this->msg=t("We have sent bank information instruction to your email")." :$merchant_email";


                                //$FunctionsK=new FunctionsK();
                                $FunctionsK->faxSendNotification((array)$merchantinfo[0],
                                                   $this->data['fax_package_id'],
                                                   Yii::app()->functions->paymentCode("bankdeposit"),
                                                   $package_price);
                                
			    			} else $this->msg=t("Error cannot saved information");
			    		} else $this->msg=t("Failed cannot send bank payment instructions");
			    	} else $this->msg=t("Something went wrong merchant information is empty");
			    } else {
			    	if ($package_price==0){
			    		// Free package
			    		$params_insert=array(
			    		 'merchant_id'=>Yii::app()->functions->getMerchantID(),
			    		 'fax_package_id'=>$this->data['fax_package_id'],
			    		 'payment_type'=>'Free',
			    		 'package_price'=>$package_price,
			    		 'fax_limit'=>$credit,
			    		 'payment_reference'=>'',
			    		 'date_created'=>FunctionsV3::dateNow(),
			    		 'ip_address'=>$_SERVER['REMOTE_ADDR'],
			    		 'status'=>"paid"
			    		);					    		
			    		if ( $this->insertData("{{fax_package_trans}}",$params_insert)){
			    			$this->details=websiteUrl()."/merchant/faxreceipt/id/".Yii::app()->db->getLastInsertID();
			    			$this->code=1;
                            $this->msg=t("Successful");                            
                            $FunctionsK->faxSendNotification((array)$merchantinfo[0],
                                                   $this->data['fax_package_id'],
                                                   "Free",
                                                   $package_price);
			    		} else $this->msg=t("Error cannot saved information");
			    	} else {
			    		//$this->msg=t("No payment options has been selected");
			    		$this->code=1; $this->msg=t("Please wait");
			    		$this->details=Yii::app()->createUrl('merchant/fax-'.$this->data['payment_opt'].'-init',array(
			    		  'fax_id'=>$this->data['fax_package_id']
			    		));
			    	}			    
			    }
				break;
		
			default:
				$this->msg=t("No found instructions");
				break;
		}
	}
	
	public function paymentPaypalVerification()
	{		
		$raw=base64_decode(isset($this->data['raw'])?$this->data['raw']:'');
		parse_str($raw,$raw_decode);				
						
		$price='';
		$description='';
		if (is_array($raw_decode) && count($raw_decode)>=1){
			$price=isset($raw_decode['price'])?$raw_decode['price']:'';
			$description=isset($raw_decode['description'])?$raw_decode['description']:'';
		}
		
		$paypal_con=Yii::app()->functions->getPaypalConnectionAdmin();   			
        $paypal=new Paypal($paypal_con);
		
		if ($res_paypal=$paypal->getExpressDetail()){	            	
							
			$paypal->params['PAYERID']=$res_paypal['PAYERID'];
            $paypal->params['AMT']=$res_paypal['AMT'];
            $paypal->params['TOKEN']=$res_paypal['TOKEN'];
            $paypal->params['CURRENCYCODE']=$res_paypal['CURRENCYCODE'];	            	           
		            
            if ($res=$paypal->expressCheckout()){ 
            	            
        	    /*now insert transaction logs*/
				if ( $this->data['purchase']=="fax_package"){
					$payment_code=Yii::app()->functions->paymentCode("paypal");
					
					$FunctionsK=new FunctionsK;
					$info=$FunctionsK->getFaxPackagesById($this->data['package_id']);
										
	                $params=array(
    			      'merchant_id'=>Yii::app()->functions->getMerchantID(),
	    			  'fax_package_id'=>$this->data['package_id'],
	    			  'payment_type'=>$payment_code,
	    			  'package_price'=>$price,
	    			  'fax_limit'=>$info['fax_limit'],
	    			  'date_created'=>FunctionsV3::dateNow(),
	    			  'ip_address'=>$_SERVER['REMOTE_ADDR'],
	    			  'payment_gateway_response'=>json_encode($res),
	    			  'status'=>"paid"
	    			);	 
	    				    				    		
	    			if ( $this->insertData("{{fax_package_trans}}",$params)){
					   $this->details=websiteUrl()."/merchant/faxreceipt/id/".Yii::app()->db->getLastInsertID();
					   $this->code=1;
					   $this->msg=Yii::t("default","Successful");	

					   
					   $merchantinfo=Yii::app()->functions->getMerchantInfo();			    	
					   $FunctionsK=new FunctionsK();
                       $FunctionsK->faxSendNotification((array)$merchantinfo[0],
                                           $this->data['package_id'],
                                           $payment_code,
                                           $price);
                        
					   							
				    } else $this->msg=Yii::t("default","ERROR: Cannot insert record.");	
				    
				} else $this->msg=t("Uknown transaction");
					            	
            } else $this->msg=$paypal->getError();	
		} else $this->msg=$paypal->getError();	           	
	}
	
	public function faxTransactionList()
	{
	    $slug=$this->data['slug'];
		$stmt="SELECT a.*,
		(
		select restaurant_name
		from
		{{merchant}} 
		where
		merchant_id=a.merchant_id
		limit 0,1
		) merchant_name,
		
		(
		select title
		from
		{{fax_package}}
		where
		fax_package_id=a.fax_package_id
		limit 0,1
		) fax_package_name
		
		 FROM
		{{fax_package_trans}} a
		ORDER BY id DESC
		";
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    			   	    
				$action="<div class=\"options\">
	    		<a href=\"$slug/Do/Add/?id=$val[id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";		   	
				
				$class='';
			   /*$date=Yii::app()->functions->prettyDate($val['date_created']);
			   $date=Yii::app()->functions->translateDate($date);   */
			   $date=FormatDateTime($val['date_created']);
			   
		   	   $feed_data['aaData'][]=array(
		   	      $val['id'],
		   	      ucwords($val['merchant_name']).$action,
		   	      ucwords($val['fax_package_name']),
		   	      standardPrettyFormat($val['package_price']),
		   	      $val['fax_limit'],
		   	      strtoupper($val['payment_type']),
		   	      $date."<br/><div class=\"uk-badge $class\">".strtoupper(Yii::t("default",$val['status']))."</div>"
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}	
	
	public function updateFaxTransaction()
	{						
		$f=new FunctionsK;
		if (empty($this->data['id'])){
			if ( $res=$f->getFaxPackagesById($this->data['fax_package_id'])){
				if ( $res['promo_price']>=1){
					$package_price=$res['promo_price'];
				} else $package_price=$res['price'];
			}
			$params=array(
			  'merchant_id'=>$this->data['merchant_id'],
			  'fax_package_id'=>$this->data['fax_package_id'],
			  'package_price'=>$package_price,
			  'fax_limit'=>$this->data['fax_limit'],
			  'status'=>$this->data['status'],
			  'date_created'=>FunctionsV3::dateNow(),
			  'ip_address'=>$_SERVER['REMOTE_ADDR'],
			  'payment_type'=>"manual"
			);				
			if ( $this->insertData("{{fax_package_trans}}",$params)){
				$this->details=Yii::app()->db->getLastInsertID();					
				$this->code=1;
				$this->msg=t("Successful");
			} else $this->msg=t("ERROR. cannot insert data.");
		} else {		
			$params=array( 
			  'fax_limit'=>$this->data['fax_limit'],
			  'status'=>$this->data['status'],
			  'ip_address'=>$_SERVER['REMOTE_ADDR']
			);
			if ( $this->updateData("{{fax_package_trans}}",$params,'id',$this->data['id']) ){
				$this->code=1;
				$this->msg=Yii::t("default","Successful");
			} else $this->msg=Yii::t("default","ERROR: cannot update");		
		}
	}		
	
	public function FaxbankDepositVerification()
	{
		$FunctionsK=new FunctionsK();
		
		if (isset($this->data['photo'])){
				$req=array('ref'=>t("reference number is required"));
			} else {
		        $req=array(
		          'branch_code'=>t("branch code is required"),
		          'date_of_deposit'=>t("date of deposit is required"),
		          'time_of_deposit'=>t("time of deposit is required"),
		          'amount'=>t("amount is required"),
		        );
			}
			$Validator=new Validator;			
			$Validator->required($req,$this->data);
						
			if ($Validator->validate()){
				$DbExt=new DbExt;
				 if ($res=$FunctionsK->getFaxTransactionByRef($this->data['ref'])){			 	
				 	
					$params=array(				
					  'merchant_id'=>Yii::app()->functions->getMerchantID(),
					  'branch_code'=>$this->data['branch_code'],
					  'date_of_deposit'=>$this->data['date_of_deposit'],
					  'time_of_deposit'=>$this->data['time_of_deposit'],
					  'amount'=>$this->data['amount'],
					  'scanphoto'=>isset($this->data['photo'])?$this->data['photo']:'',
					  'date_created'=>FunctionsV3::dateNow(),
					  'ip_address'=>$_SERVER['REMOTE_ADDR'],
					  'transaction_type'=>"fax_purchase"
					);									
					if ($DbExt->insertData("{{bank_deposit}}",$params)){
						$this->code=1;
						$this->msg=Yii::t("default","Thank you. Your information has been receive please wait 1 or 2 days to verify your payment.");
						
						/*send email to admin owner*/
						$from='no-reply@'.$_SERVER['HTTP_HOST'];
	    	            $subject=Yii::t("default","New Bank Deposit");
	    	            $to=Yii::app()->functions->getOptionAdmin('website_contact_email');
	    	            $tpl=EmailTPL::bankDepositedReceive();
	    	            if (!empty($to)){
	    	                Yii::app()->functions->sendEmail($to,$from,$subject,$tpl);
	    	            }
						
					} else $this->msg=Yii::t("default","Something went wrong during processing your request. Please try again later.");
				 } else $this->msg=Yii::t("default","Reference number not found");
			} else $this->msg=$Validator->getErrorAsHTML();
	}
	
	public function faxTransactionLogs()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
		$slug=$this->data['slug'];
		$stmt="
		SELECT * FROM
		{{fax_broadcast}}
		WHERE
		merchant_id=".Yii::app()->functions->q($merchant_id)."
		ORDER BY id DESC
		";
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    			   	    				
			   /*$date=Yii::app()->functions->prettyDate($val['date_created']);
			   $date=Yii::app()->functions->translateDate($date);   */
			   $date=FormatDateTime($val['date_created']);
		   	   $feed_data['aaData'][]=array(
		   	      $val['id'],
		   	      $val['jobid'],
		   	      $val['faxurl'],
		   	      $val['status'],
		   	      $val['api_raw_response'],
		   	      $date
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}
	
	public function updateMerchantUserProfile()
	{		
		$params=array(
		  'first_name'=>$this->data['first_name'],
		  'last_name'=>$this->data['last_name'],
		  'contact_email'=>$this->data['contact_email'],
		  'username'=>$this->data['username'],
		  'date_modified'=>FunctionsV3::dateNow()
		);
		if (!empty($this->data['password'])){
			$params['password']=md5($this->data['password']);
		}
		
		if ($this->updateData("{{merchant_user}}",$params,'merchant_user_id',$this->data['merchant_user_id'])){
			$this->code=1;
			$this->msg=t("Profile successfully updated");
		} else $this->msg=t("ERROR: cannot update");
	}
	
	public function faxPurchaseTransaction()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
		$slug=$this->data['slug'];
		$stmt="
		SELECT a.*,
		(
		select title
		from
		{{fax_package}}
		where
		fax_package_id=a.fax_package_id
		) as package_name
		 FROM
		{{fax_package_trans}} a
		WHERE
		merchant_id=".Yii::app()->functions->q($merchant_id)."
		ORDER BY id DESC
		";
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    			   	    				
			   /*$date=Yii::app()->functions->prettyDate($val['date_created']);
			   $date=Yii::app()->functions->translateDate($date);   */
			   $date=FormatDateTime($val['date_created']);
		   	   $feed_data['aaData'][]=array(
		   	      $val['id'],
		   	      strtoupper($val['payment_type']),
		   	      ucfirst($val['package_name']),
		   	      displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['package_price'])),
		   	      $val['fax_limit'],
		   	      $val['status'],
		   	      $date
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}
	
	public function smsPurchaseTransaction()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
		$slug=$this->data['slug'];
		$stmt="
		SELECT a.*,
		(
		select title
		from
		{{sms_package}}
		where
		sms_package_id=a.sms_package_id
		) as package_name
		 FROM
		{{sms_package_trans}} a
		WHERE
		merchant_id=".Yii::app()->functions->q($merchant_id)."
		ORDER BY id DESC
		";
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    			   	    				
			   /*$date=Yii::app()->functions->prettyDate($val['date_created']);
			   $date=Yii::app()->functions->translateDate($date);   */
			   $date=FormatDateTime($val['date_created']);
		   	   $feed_data['aaData'][]=array(
		   	      $val['id'],
		   	      //strtoupper($val['payment_type']),
		   	      FunctionsV3::prettyPaymentType('sms_package_trans',$val['payment_type'],$val['id']),
		   	      ucfirst($val['package_name']),
		   	      displayPrice(adminCurrencySymbol(),normalPrettyPrice($val['package_price'])),
		   	      $val['sms_limit'],
		   	      $val['status'],
		   	      $date
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}


	public function viewBankInfo()
	{
		require_once 'bank-info.php';
		die();
	}
	
	public function shipppingRates()
	{
		//dump($this->data);		
		$mtid=Yii::app()->functions->getMerchantID();	
		Yii::app()->functions->updateOption("shipping_enabled",
    	isset($this->data['shipping_enabled'])?$this->data['shipping_enabled']:'',$mtid);
    	
    	Yii::app()->functions->updateOption("free_delivery_above_price",
    	isset($this->data['free_delivery_above_price'])?$this->data['free_delivery_above_price']:'',$mtid);
    	
    	if (is_array($this->data['distance_from']) && count($this->data['distance_from'])>=1){    		
    		$x=0;
    		$stmt="
    		DELETE FROM
    		{{shipping_rate}}    		
    		WHERE
    		merchant_id=".Yii::app()->functions->q($mtid)."
    		";
    		$this->qry($stmt);
    		foreach ($this->data['distance_from'] as $val) {    			
    			$params=array(
    			  'merchant_id'=>$mtid,
    			  'distance_from'=>$val,
    			  'distance_to'=>$this->data['distance_to'][$x],
    			  'shipping_units'=>$this->data['shipping_units'][$x],
    			  'distance_price'=>$this->data['distance_price'][$x],    			  
    			);    			
    			$this->insertData("{{shipping_rate}}",$params);
    			$x++;
    		}
    	}	
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
	
	public function bookingSummaryReport()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
		
		$and='';  
    	if (isset($this->data['start_date']) && isset($this->data['end_date']))	{
    		if (!empty($this->data['start_date']) && !empty($this->data['end_date'])){
    		  $and=" AND date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
    		        '".$this->data['end_date']." 23:59:00'
    		  ";
    		    		  
              $_SESSION['rpt_date_range']=array(
    		     'start_date'=>$this->data['start_date'],
    		     'end_date'=>$this->data['end_date']
    		   );
    		  
    		}
    	}
		
		$slug=isset($this->data['slug'])?$this->data['slug']:'';
		$stmt="
		SELECT sum(a.number_guest) as total_approved,
		(
		select sum(number_guest)
		from {{bookingtable}}
		where
		merchant_id=".Yii::app()->functions->q($merchant_id)."
		and
		status='denied'
		) as total_denied,
		
		(
		select sum(number_guest)
		from {{bookingtable}}
		where
		merchant_id=".Yii::app()->functions->q($merchant_id)."
		and
		status='pending'
		) as total_pending
		
		FROM
		{{bookingtable}} a
		WHERE
		merchant_id=".Yii::app()->functions->q($merchant_id)."
		AND status='approved'
		$and
		";		
		$_SESSION['kr_export_stmt']=$stmt;
		if (isset($_GET['debug'])){
			dump($stmt);
		}	
		if ($res=$this->rst($stmt)){		   			
		   foreach ($res as $val) {				   	    			   	    							   
		   	   $feed_data['aaData'][]=array(
		   	      $val['total_approved']+0,
		   	      $val['total_denied']+0,
		   	      $val['total_pending']+0
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}
	
	public function merchanBbookingSummaryReport()
	{		
		unset($_SESSION['rpt_date_range']);
		$and='';  
    	if (isset($this->data['start_date']) && isset($this->data['end_date']))	{
    		if (!empty($this->data['start_date']) && !empty($this->data['end_date'])){
    		   $and=" AND date_created BETWEEN  '".$this->data['start_date']." 00:00:00' AND 
    		        '".$this->data['end_date']." 23:59:00'
    		   ";    		   
               $_SESSION['rpt_date_range']=array(
    		     'start_date'=>$this->data['start_date'],
    		     'end_date'=>$this->data['end_date']
    		   );
    		}
    	}
    	
    	$where='';
    	if (isset($this->data['merchant_id'])){
    		if (!empty($this->data['merchant_id'])){
    			$where=" WHERE merchant_id=".Yii::app()->functions->q($this->data['merchant_id'])." ";
    		}    	
    	}	
    	
    	$stmt="
    	SELECT a.merchant_id,a.restaurant_name as merchant_name,
    	
    	(
    	select sum(number_guest)
    	from
    	{{bookingtable}}
    	where
    	merchant_id=a.merchant_id  
    	and status='approved'  	
    	$and
    	) as total_approved,
    	
    	
    	(
    	select sum(number_guest)
    	from
    	{{bookingtable}}
    	where
    	merchant_id=a.merchant_id  
    	and status='denied'  	
    	$and
    	) as total_denied,
    	
    	
    	(
    	select sum(number_guest)
    	from
    	{{bookingtable}}
    	where
    	merchant_id=a.merchant_id    	
    	and status='pending'
    	$and
    	) as total_pending
    	
    	
    	FROM
    	{{merchant}} a
    	$where
    	GROUP BY merchant_id
    	";
		
		$_SESSION['kr_export_stmt']=$stmt;
		if (isset($_GET['debug'])){
			dump($stmt);
		}	
		if ($res=$this->rst($stmt)){		   					   
		   foreach ($res as $val) {				   	    			   	    							   
		   	   $feed_data['aaData'][]=array(
		   	      ucwords(stripslashes($val['merchant_name'])),
		   	      $val['total_approved']+0,
		   	      $val['total_denied']+0,
		   	      $val['total_pending']+0
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}
	
	public function adminFaxTransactionLogs()
	{		
		$slug=$this->data['slug'];
		$stmt="
		SELECT a.*,
		(
		select restaurant_name
		from
		{{merchant}}
		where
		merchant_id=a.merchant_id
		) as merchant_name
		 FROM
		{{fax_broadcast}} a		
		ORDER BY id DESC
		";
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    			   	    				
			   /*$date=Yii::app()->functions->prettyDate($val['date_created']);
			   $date=Yii::app()->functions->translateDate($date);   */
			   $date=FormatDateTime($val['date_created']);
		   	   $feed_data['aaData'][]=array(
		   	      $val['id'],
		   	      ucwords($val['merchant_name']),
		   	      $val['jobid'],
		   	      $val['faxurl'],
		   	      $val['status'],
		   	      $val['api_raw_response'],
		   	      $date
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}	
	
	public function merchantList()
	{
		
		$slug=$this->data['slug'];
		
		$aColumns = array(
		  'merchant_id','restaurant_name','street','city','country_code','contact_phone',
		  'package_id','activation_token','is_commission','status'
		);
		
		$sWhere=''; $sOrder=''; $sLimit='';
		
		$sTable = "{{merchant}}";
		
		$functionk=new FunctionsK();
		$t=$functionk->ajaxDataTables($aColumns);
		if (is_array($t) && count($t)>=1){
			$sWhere=$t['sWhere'];
			$sOrder=$t['sOrder'];
			$sLimit=$t['sLimit'];
		}	
		$stmt = "
			SELECT SQL_CALC_FOUND_ROWS 
			a.*,
			(
			select title
			from
			{{packages}}
			where
			package_id = a.package_id
			limit 0,1
			) as package_name
			
			FROM $sTable a
			$sWhere
			$sOrder
			$sLimit
		";
		if (isset($_GET['debug'])){
		   dump($stmt);
		}
		if ( $res=$this->rst($stmt)){		
			
			$iTotalRecords=0;
			$stmt2="SELECT FOUND_ROWS()";
			if ( $res2=$this->rst($stmt2)){
				//dump($res2);
				$iTotalRecords=$res2[0]['FOUND_ROWS()'];
			}	
						
			$feed_data['sEcho']=intval($_GET['sEcho']);
			$feed_data['iTotalRecords']=$iTotalRecords;
			$feed_data['iTotalDisplayRecords']=$iTotalRecords;
			
			foreach ($res as $val) {	
				    $class='';
					/*$date=date('M d,Y G:i:s',strtotime($val['date_created']));
					$date=Yii::app()->functions->translateDate($date);*/
					$date=FormatDateTime($val['date_created']);
					
					$action="<div class=\"options\">
    	    		<a href=\"$slug/id/$val[merchant_id]\" >".Yii::t("default","Edit")."</a>
    	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[merchant_id]\" >".Yii::t("default","Delete")."</a>
    	    		</div>";
					
					$val['package_name']=isset($val['package_name'])?$val['package_name']:'';
					
					if ($val['status']=="expired"){
					   $class='uk-badge-danger';
					} elseif ( $val['status']=="pending"){
						$class='';
					} elseif ($val['status']=="active"){
						$class='uk-badge-success';
					}				
					$membershipdate=FormatDateTime($val['membership_expired'],false);
					$membershipdate=Yii::app()->functions->translateDate($membershipdate);					
					
					$url_login=baseUrl()."/merchant/autologin/id/".$val['merchant_id']."/token/".$val['password'];
					$link_login='<br/><br/>
					<a target="_blank" href="'.$url_login.'"><div class="uk-badge">'.t("AutoLogin").'</div></a>
					';
					
					$aa_access=Yii::app()->functions->AAccess();
					if (!in_array('autologin',(array)$aa_access)){
						$link_login='';						
					}					
					
					if (getOptionA('home_search_mode')!="postcode"){
						$feed_data['aaData'][]=array(
						  $val['merchant_id'],stripslashes($val['restaurant_name']).$action,
						  $val['street'],
						  $val['city'],
						  $val['country_code'],
						  $val['restaurant_phone']." / ".$val['contact_phone'],
						  $val['package_name']."<br/>".$membershipdate,
						  $val['activation_key'],
						  //membershipType($val['is_commission']),
						  FunctionsV3::DisplayMembershipType($val['merchant_type'], $val['invoice_terms']),
						  //$date."<br/><div class=\"uk-badge $class\">".strtoupper(Yii::t("default",$val['status']))."</div>".$link_login
						  "$date<br/><span class=\"tag ".$val['status']."\">".t($val['status'])."</span>$link_login"
						  
						);
					} else {
						$feed_data['aaData'][]=array(
						  $val['merchant_id'],stripslashes($val['restaurant_name']).$action,
						  $val['street'],						  
						  $val['post_code'],
						  $val['restaurant_phone']." / ".$val['contact_phone'],
						  $val['package_name']."<br/>".$membershipdate,
						  $val['activation_key'],
						  //membershipType($val['is_commission']),
						  FunctionsV3::DisplayMembershipType($val['merchant_type'] , $val['invoice_terms']),
						  //$date."<br/><div class=\"uk-badge $class\">".strtoupper(Yii::t("default",$val['status']))."</div>".$link_login
						  "$date<br/><span class=\"tag ".$val['status']."\">".t($val['status'])."</span>$link_login"
					);
					}
		
				}										
						
			$this->otableOutput($feed_data);	
		}
	    $this->otableNodata();
	}
	
	public function showSMS()
	{
		require_once "show-sms.php";
		die();
	}
	
	public function sendUpdateOrderSMS()
	{				
		$_GET['backend']=true;
		$order=Yii::app()->functions->getOrder2($this->data['order_id']);		
				
		if (isset($this->data['sms_order_change_msg'])){
			if (is_array($order) && count($order)>=1){
				$sms_msg=$this->data['sms_order_change_msg'];				
				$to=$order['contact_phone'];		
				
				$mtid=Yii::app()->functions->getMerchantID();				
				$available_credit=Yii::app()->functions->getMerchantSMSCredit($mtid);	 				
				if ( $available_credit>=1){						
					if ($resp= Yii::app()->functions->sendSMS($to,$sms_msg)){							
						if ( $resp['msg']=='process'){
							$this->code=1;
						    $this->msg=t("SMS sent");
						    $params=array(
						      'merchant_id'=>$mtid,
						      'broadcast_id'=>'999999999',
						      'client_id'=>$order['client_id'],
						      'client_name'=>$order['full_name'],
						      'contact_phone'=>$to,
						      'sms_message'=>$sms_msg,
						      'status'=>'process',
						      'gateway_response'=>$resp['raw'],
						      'date_created'=>FunctionsV3::dateNow(),
						      'date_executed'=>FunctionsV3::dateNow(),
						      'ip_address'=>$_SERVER['REMOTE_ADDR'],
						      'gateway'=>$resp['sms_provider']
						    );						    
						    $this->insertData("{{sms_broadcast_details}}",$params);
						} else $this->msg=$resp['msg'];
					} else $this->msg=$resp['msg'];
				} else $this->msg=t("No SMS Credit");
			} else $this->msg=t("Sory but we cannot find the order information");
		} else $this->msg=t("Message is required");
	}	
	
	public function saveAdminAuthorizeSettings()
	{

		Yii::app()->functions->updateOptionAdmin("admin_enabled_autho",
    	isset($this->data['admin_enabled_autho'])?$this->data['admin_enabled_autho']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_mode_autho",
    	isset($this->data['admin_mode_autho'])?$this->data['admin_mode_autho']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_autho_api_id",
    	isset($this->data['admin_autho_api_id'])?$this->data['admin_autho_api_id']:'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_autho_key",
    	isset($this->data['admin_autho_key'])?$this->data['admin_autho_key']:'');
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
	
	public function saveMerchantAuthorizeSettings()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
		
		Yii::app()->functions->updateOption("merchant_enabled_autho",
    	isset($this->data['merchant_enabled_autho'])?$this->data['merchant_enabled_autho']:'',$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_mode_autho",
    	isset($this->data['merchant_mode_autho'])?$this->data['merchant_mode_autho']:'',$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_autho_api_id",
    	isset($this->data['merchant_autho_api_id'])?$this->data['merchant_autho_api_id']:'',$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_autho_key",
    	isset($this->data['merchant_autho_key'])?$this->data['merchant_autho_key']:'',$merchant_id);
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
	
	public function merchantBankDeposit()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
		
		Yii::app()->functions->updateOption("merchant_bankdeposit_enabled",
    	isset($this->data['merchant_bankdeposit_enabled'])?$this->data['merchant_bankdeposit_enabled']:'',$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_deposit_sender",
    	isset($this->data['merchant_deposit_sender'])?$this->data['merchant_deposit_sender']:'',$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_deposit_subject",
    	isset($this->data['merchant_deposit_subject'])?$this->data['merchant_deposit_subject']:'',$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_deposit_instructions",
    	isset($this->data['merchant_deposit_instructions'])?$this->data['merchant_deposit_instructions']:'',$merchant_id);
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
	
	public function ItemBankDepositVerification()
	{		
		if ( $res=Yii::app()->functions->getOrderInfo($this->data['ref'])){			
			$params=array(				
			  'merchant_id'=>$res['merchant_id'],
			  'branch_code'=>$this->data['branch_code'],
			  'date_of_deposit'=>$this->data['date_of_deposit'],
			  'time_of_deposit'=>$this->data['time_of_deposit'],
			  'amount'=>$this->data['amount'],
			  'scanphoto'=>isset($this->data['photo'])?$this->data['photo']:'',
			  'date_created'=>FunctionsV3::dateNow(),
			  'ip_address'=>$_SERVER['REMOTE_ADDR'],
			  'transaction_type'=>"item_purchase",
			  'client_id'=>$res['client_id'],
			  'order_id'=>$this->data['ref'],
			);				
			
			if ($this->insertData("{{bank_deposit}}",$params)){
				$this->code=1;
				$this->msg=Yii::t("default","Thank you. Your information has been receive please wait 1 or 2 days to verify your payment.");
				
				/*send email to admin owner*/
				if ( $merchant_info=Yii::app()->functions->getMerchant($res['merchant_id'])){					
					$to=$merchant_info['contact_email'];
				} else $to='';
				
				$from='no-reply@'.$_SERVER['HTTP_HOST'];
	            $subject=Yii::t("default","New Bank Deposit");	            
	            $tpl=EmailTPL::bankDepositedReceiveMerchant();
	            
	            if (!empty($to)){
	                Yii::app()->functions->sendEmail($to,$from,$subject,$tpl);
	            }
					
			} else $this->msg=t("Something went wrong during processing your request. Please try again later.");
		} else $this->msg=t("ERROR: Something went wrong");
	}
	
	public function BankDepositListMerchant()
	{
		$mtid=Yii::app()->functions->getMerchantID();
		$slug=$this->data['slug'];
		$stmt="SELECT a.*,
		(
		select restaurant_name from
		{{merchant}}
		where merchant_id=a.merchant_id
		) as merchant_name,
		
		(
		select concat(first_name,' ',last_name)
		from
		{{client}}
		where
		client_id=a.client_id
		) as client_name
		
		 FROM		 
		{{bank_deposit}} a
		
		WHERE
		merchant_id=".Yii::app()->functions->q($mtid)."
		AND
		transaction_type='item_purchase'
		ORDER BY id DESC
		";
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    			   	    
				$action="<div class=\"options\">
	    		<a href=\"$slug/Do/Add/?id=$val[cuisine_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[cuisine_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";		   	   
				
			   /*$date=Yii::app()->functions->prettyDate($val['date_created']);
			   $date=Yii::app()->functions->translateDate($date);*/
			   $date=FormatDateTime($val['date_created']);
			   
			   if (!empty($val['scanphoto'])){
			      $img=Yii::app()->request->baseUrl."/upload/$val[scanphoto]";
			      $scanphoto="<a href=\"$img\" target=\"_blank\">";
	    		  $scanphoto.="<img class=\"uk-thumbnail uk-thumbnail-mini\" src=\"$img\" >";	
	    		  $scanphoto.="</a>";
			   } else $scanphoto='';
			   
		   	   $feed_data['aaData'][]=array(
		   	      $val['id'],
		   	      ucwords($val['client_name']),		   	      
		   	      $val['branch_code'],
		   	      FormatDateTime($val['date_of_deposit'],false),
		   	      $val['time_of_deposit'],
		   	      Yii::app()->functions->standardPrettyFormat($val['amount']),
		   	      $scanphoto,
		   	      $date
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();
	}

	public function testSms()
	{
		require_once 'test-sms.php';
		die();
	}
	
	public function SendTestSMS()
	{		
		if (isset($this->data['mobile'])){
			$text="This is a sms test message";
			if ( $res=Yii::app()->functions->sendSMS($this->data['mobile'],$text) ){								
				if ( $res['msg']=="process"){
					$this->code=1;
					$this->msg=t("Successful");
					
					$params=array(
				      'merchant_id'=>'999999999',
				      'broadcast_id'=>'999999999',
				      'client_id'=>0,
				      'client_name'=>'',
				      'contact_phone'=>$this->data['mobile'],
				      'sms_message'=>$text,
				      'status'=>'process',
				      'gateway_response'=>$res['raw'],
				      'date_created'=>FunctionsV3::dateNow(),
				      'date_executed'=>FunctionsV3::dateNow(),
				      'ip_address'=>$_SERVER['REMOTE_ADDR'],
				      'gateway'=>$res['sms_provider']
				    );		
				    				    
				    $db= new DbExt;
				    $db->insertData("{{sms_broadcast_details}}",$params);
				    unset($db);
			
				} else $this->msg=$res['msg'];
			} else $this->msg=t("Failed");
		} else $this->msg=t("Mobile number is required");				
	}
	
	public function verifyMobileCode()
	{		
		if( $res=Yii::app()->functions->getClientInfo($this->data['client_id'])){
			if ( $this->data['code']==$res['mobile_verification_code']){
				$this->code=1;
				$this->msg=t("Successful");
				
				$params=array( 
				  'status'=>"active",
				  'mobile_verification_date'=>FunctionsV3::dateNow()
				);
				$this->updateData("{{client}}",$params,'client_id',$res['client_id']);
				
				Yii::app()->functions->clientAutoLogin($res['email_address'],$res['password'],$res['password']);
				
			} else $this->msg=t("Verification code is invalid");		
		} else $this->msg=t("Sorry but we cannot find your records");
	}
	
	public function resendMobileCode()
	{
		$date_now=date('Y-m-d g:i:s a');				
		if ( isset($_SESSION['resend_code'])){			
			$date_diff=Yii::app()->functions->dateDifference($_SESSION['resend_code'],$date_now);			
			if (is_array($date_diff) && count($date_diff)>=1){
				if ( $date_diff['minutes']<5){
					$remaining=5-$date_diff['minutes'];
					$this->msg=t("Please wait for a minute to receive your code");					
					$this->msg.=" (".$remaining ." "."minutes".")";
					return ;
				}			
			}		
		}	
				
		if ( isset($this->data['id'])){
			if( $res=Yii::app()->functions->getClientInfo($this->data['id'])){				
				$code=$res['mobile_verification_code'];
				$_SESSION['resend_code']=$date_now;				
				FunctionsV3::sendCustomerSMSVerification($res['contact_phone'],$code);
				$this->code=1;
				$this->msg=t("Your verification code has been sent to")." ".$res['contact_phone'];
			} else $this->msg=t("Sorry but we cannot find your records");
		} else $this->msg=t("Missing id");
	}
		
	public function getAllMerchantCoordinates()
	{		
		$admin_country_set=Yii::app()->functions->getOptionAdmin('admin_country_set');
		
		$this->qry("SET SQL_BIG_SELECTS=1");
		
		$stmt="
		SELECT merchant_id,
		restaurant_slug,restaurant_name,latitude,lontitude,
		concat(street,' ',city,' ',state,' ',post_code) as address
		FROM
		{{view_merchant}}
		WHERE
		status in ('active')
		AND latitude <>''
		AND lontitude <>''		
		ORDER BY latitude ASC
		";
		if ( $res=$this->rst($stmt)){
			$list='';
			$x=0;
			foreach ($res as $val) {					
				$photo=Yii::app()->functions->getOption("merchant_photo",$val['merchant_id']);
				if (empty($photo)){
					$photo='thumbnail-medium.png';
				}
				
				$logo='<a href="'.websiteUrl()."/store/menu/merchant/".$val['restaurant_slug'].'">';
                $logo.='<img title="" alt="" src="'.uploadURL()."/$photo".'" class="uk-thumbnail uk-thumbnail-mini">';
				$logo.='</a>';
				
							
				$list[]=array(
				  $val['restaurant_name'],
				  $val['latitude'],
				  $val['lontitude'],
				  $x,
				  $val['address'],
				  $val['restaurant_slug'],
				  $logo,
				);
				$x++;
			}			
			
			$lng='';
			$lng='';
			$country=Yii::app()->functions->getAdminCountrySet();			
			if( $lat_res=Yii::app()->functions->geodecodeAddress($country)){				
				$lat=$lat_res['lat'];
				$lng=$lat_res['long'];
			}		
			
			$this->code=1;
			$this->msg=array(
			  'lat'=>$lat,
			  'lng'=>$lng,
			);
			$this->details=$list;
		} else $this->msg=t("0 restaurant found");
	}
	
	public function findGeo()
	{
		$home_search_unit_type=Yii::app()->functions->getOptionAdmin('home_search_unit_type');
		$home_search_radius=Yii::app()->functions->getOptionAdmin('home_search_radius');
		
		if(!is_numeric($home_search_radius)){
			$home_search_radius=15;
		}	
				
		$distance_exp=3959;
		if ($home_search_unit_type=="km"){
			$distance_exp=6371;
		}		
		
		$lat=isset($this->data['lat'])?$this->data['lat']:0;
		$long=isset($this->data['lng'])?$this->data['lng']:0;
						
		if ($lat_res=Yii::app()->functions->geodecodeAddress($this->data['geo_address'])){			
			$lat=$lat_res['lat'];
			$long=$lat_res['long'];
		}		
						
		if (isset($this->data['geo_address'])){
			$stmt="
			SELECT 
			SQL_CALC_FOUND_ROWS a.*, ( $distance_exp * acos( cos( radians($lat) ) * cos( radians( latitude ) ) 
			* cos( radians( lontitude ) - radians($long) ) 
			+ sin( radians($lat) ) * sin( radians( latitude ) ) ) ) 
			AS distance								
			
			FROM {{view_merchant}} a 
			HAVING distance < $home_search_radius	
			AND status='active' AND is_ready='2' 		
			";		
			//dump($stmt);
			if ( $res=$this->rst($stmt)){
				$list='';
			    $x=0;
				foreach ($res as $val) {
					$address=$val['street']." ".$val['city']." ".$val['state']." ".$val['post_code'];
					
					
					$photo=Yii::app()->functions->getOption("merchant_photo",$val['merchant_id']);
				    if (empty($photo)){
					   $photo='thumbnail-medium.png';
				    }
				
				    $logo='<a href="'.websiteUrl()."/store/menu/merchant/".$val['restaurant_slug'].'">';
                    $logo.='<img title="" alt="" src="'.uploadURL()."/$photo".'" class="uk-thumbnail uk-thumbnail-mini">';
				    $logo.='</a>';
					
					$list[]=array(
					  $val['restaurant_name'],
					  $val['latitude'],
					  $val['lontitude'],
					  $x,
					  $address,
					  $val['restaurant_slug'],
					  $logo,
					);
				    $x++;
				}				
				$this->code=1;
			    $this->msg=array(
			      'lat'=>$lat,
			      'lng'=>$long
			    );
			    $this->details=$list;
			} else $this->msg=t("No results");
		} else $this->msg=t("Missing parameters");
	}
	
	public function dishList()
	{
		$slug=$this->data['slug'];
        $stmt="
		SELECT * FROM
		{{dishes}}
		-- WHERE
		-- status in ('published','publish')
		ORDER BY dish_id  DESC
		";
		$connection=Yii::app()->db;
	    $rows=$connection->createCommand($stmt)->queryAll();     	    
	    if (is_array($rows) && count($rows)>=1){
	    	foreach ($rows as $val) {    	     	    		
	    		$chk="<input type=\"checkbox\" name=\"row[]\" value=\"$val[dish_id]\" class=\"chk_child\" >";   		
	    		/*$option="<div class=\"options\">
	    		<a href=\"$slug/id/$val[dish_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[dish_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";*/
	    		
	    		$slug=Yii::app()->createUrl('/admin/dishes',array(
	    		  'Do'=>"Add",
	    		  'id'=>$val['dish_id']
	    		));
	    		
	    		$option="<div class=\"options\">
	    		<a href=\"$slug\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[dish_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";
	    		
	    		$date=FormatDateTime($val['date_created']);
	    		
	    		$feed_data['aaData'][]=array(
	    		  $val['dish_id'],
	    		  $val['dish_name'].$option,
	    		  '<img class="uk-thumbnail uk-thumbnail-mini" src="'.uploadURL()."/".$val['photo'].'">',
	    		  //$date."<div>".$val['status']."</div>"
	    		  "$date<br/><span class=\"tag ".$val['status']."\">".t($val['status'])."</span>",
	    		);
	    	}
	    	$this->otableOutput($feed_data);
	    }     	    
	    $this->otableNodata();	
	}
	
	public function addDish()
	{		
	   $Validator=new Validator;
		$req=array(
		  'dish_name'=>Yii::t("default","Dish name is required"),
		  'spicydish'=>t("Icon is required")
		);		
		$Validator->required($req,$this->data);
		if ($Validator->validate()){
			$params=array(
			  'dish_name'=>$this->data['dish_name'],
			  'photo'=>$this->data['spicydish'],
			  'status'=>$this->data['status'],
			  'date_created'=>FunctionsV3::dateNow(),
			  'ip_address'=>$_SERVER['REMOTE_ADDR'],
			  'category_id' => $this->data['category'],
			  'subcategory_id' => $this->data['sub-cat'],
			  'brand_id' => $this->data['brand'],
			  'unit' => $this->data['unit'],
			  'tags' => $this->data['tags'],
			  'description' => $this->data['description'],
			  'sale_price' => $this->data['sale-price'],
			  'sale_currency' => $this->data['sale-currency'],
			  'purchase_price' => $this->data['purchase-price'],
			  'purchase_currency' => $this->data['purchase-currency'],
			  'shipping_cost' => $this->data['shipping-cost'],
			  'cost_currency' => $this->data['cost-currency'],
			  'product_tax' => $this->data['product-tax'],
			  'tax_mark' => $this->data['tax-mark'],
			  'product_discount' => $this->data['product-discount'],
			  'discount_mark' => $this->data['discount-mark'],
			);			
		   if (empty($this->data['id'])){	
		    	if ( $this->insertData("{{dishes}}",$params)){
		    		    $this->details=Yii::app()->db->getLastInsertID();
			    		$this->code=1;
			    		$this->msg=Yii::t("default","Successful");				    		
			    	}
			    } else {		    	
			    	unset($params['date_created']);
					$params['date_modified']=FunctionsV3::dateNow();
					
					$filename_to_delete='';
					if($old_data=Yii::app()->functions->GetDish($this->data['id'])){
						if($old_data['photo']!=$this->data['spicydish']){
						   $filename_to_delete=$old_data['photo'];			
						}			
					}
					
					$res = $this->updateData('{{dishes}}' , $params ,'dish_id',$this->data['id']);
					if ($res){
						$this->code=1;
		                $this->msg=Yii::t("default",'Dish updated');  
		                
		                /*DELETE IMAGE*/
		                if(!empty($filename_to_delete)){
		                  FunctionsV3::deleteUploadedFile($filename_to_delete);
		                }
					    
				} else $this->msg=Yii::t("default","ERROR: cannot update");
		    }	
		} else $this->msg=$Validator->getErrorAsHTML();	
	}
	
	public function addVoucherNew()
	{					
		$functionsk=new FunctionsK();		
		
		$merchant_id=Yii::app()->functions->getMerchantID();
		$params=array(
		  'voucher_name'=>$this->data['voucher_name'],
		  'voucher_type'=>$this->data['voucher_type'],
		  'amount'=>$this->data['amount'],
		  'expiration'=>$this->data['expiration'],
		  'status'=>$this->data['status'],
		  'date_created'=>FunctionsV3::dateNow(),
		  'ip_address'=>$_SERVER['REMOTE_ADDR'],
		  'merchant_id'=>$merchant_id
		);
		
		/*dump($this->data);
		dump($params);
		die();*/
		
		if (isset($this->data['voucher_owner'])){
			unset($params['merchant_id']);
			$params['voucher_owner']=$this->data['voucher_owner'];
		}
		
		if (isset($this->data['joining_merchant'])){
			$params['joining_merchant']=json_encode($this->data['joining_merchant']);
		} else $params['joining_merchant']='';
		
		if (isset($this->data['used_once'])){
			$params['used_once']=$this->data['used_once'];
		} else 	$params['used_once']='0';
						
		if (!empty($this->data['id'])){
			
			if ( $functionsk->checkIFVoucherCodeExisting($this->data['voucher_name'],$this->data['id'])){
				$this->msg=t("Sorry but voucher name already exist!");
				return;
			}		
			
			$params['date_modified']=FunctionsV3::dateNow();
			unset($params['date_created']);
			if ( $this->updateData("{{voucher_new}}",$params,'voucher_id',$this->data['id'])){
				$this->code=1;
	    		$this->msg=t("Successful");
			} else $this->msg=t("Failed cannot update records");	    	
		} else {
			if ( $functionsk->checkIFVoucherCodeExists($this->data['voucher_name'])){
				$this->msg=t("Sorry but voucher name already exist!");
				return;
			}		
	        if ( $this->insertData('{{voucher_new}}',$params)){
	        	$this->details=Yii::app()->db->getLastInsertID();
	    		$this->code=1;
	    		$this->msg=Yii::t("default","Successful");		 
	        } else $this->msg=t("ERROR: Something went wrong");		
		}
	}
	
	public function VoucherListNew()
		{
			$slug=$this->data['slug'];
						
			$and='';
			if (isset($this->data['voucher_owner'])){
				$stmt="
				SELECT a.*,
				(
				select count(*) 
				from
				{{order}}
				where
				voucher_code=a.voucher_name			
				) as total_used
				FROM
				{{voucher_new}} a
				WHERE
				voucher_owner=".Yii::app()->db->quoteValue($this->data['voucher_owner'])."
				ORDER BY voucher_id DESC
				";	   		    		    	
			} else {
				$merchant_id=Yii::app()->functions->getMerchantID();		    
			    $stmt="
				SELECT a.*,
				(
				select count(*) 
				from
				{{order}}
				where
				voucher_code=a.voucher_name			
				) as total_used
				FROM
				{{voucher_new}} a
				WHERE
				merchant_id=".Yii::app()->db->quoteValue($merchant_id)."
				ORDER BY voucher_id DESC
				";	   		    		    	
			}	
						
			$connection=Yii::app()->db;
    	    $rows=$connection->createCommand($stmt)->queryAll();     	        	        	        	    
    	    //dump($rows);
    	    if (is_array($rows) && count($rows)>=1){
    	    	foreach ($rows as $val) {    	    	    		
    	    		$chk="<input type=\"checkbox\" name=\"row[]\" value=\"$val[voucher_id]\" class=\"chk_child\" >";   		
    	    		$action="<div class=\"options\">
    	    		<a href=\"$slug/id/$val[voucher_id]\" >".Yii::t("default","Edit")."</a>
    	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[voucher_id]\" >".Yii::t("default","Delete")."</a>
    	    		</div>";
    	    		
    	    		
    	    		if ( $val['total_used']>0){
    	    			$used='<a class="voucher-details" href="javascript:;" data-id="'.$val['voucher_name'].'">'.
    	    			$val['total_used'].'</a>';
    	    		} else $used='';  	    	 
    	    		
    	    		if ($val['voucher_type']=="percentage"){
    	    			$amt=normalPrettyPrice($val['amount']). " %";
    	    		} else $amt=normalPrettyPrice($val['amount']);    		
    	    		    	    		
    	    		$date=FormatDateTime($val['date_created']);
    	    		
    	    		$feed_data['aaData'][]=array(
    	    		  $val['voucher_id'],
    	    		  $val['voucher_name'].$action,    	    		  
    	    		  t($val['voucher_type']),
    	    		  $amt,    	    		
    	    		  FormatDateTime($val['expiration'],false),
    	    		  $used,
    	    		  "$date<br/><span class=\"tag ".$val['status']."\">".t($val['status'])."</span>"
    	    		  //$date."<div>".Yii::t("default",$val['status'])."</div>"
    	    		);
    	    	}
    	    	$this->otableOutput($feed_data);
    	    }     	    
    	    $this->otableNodata();	
     }	
     
     public function viewVoucherDetails()
     {
     	require_once "voucher-details.php";
     }
     
     public function addressBook()
     {     	
 	    //$slug=createUrl("store/profile/?tab=2");
		$stmt="SELECT id,location_name,country_code,as_default,
		concat(street,' ',city,' ',state,' ',zipcode) as address		
		FROM
		{{address_book}}		
		WHERE
		client_id ='".Yii::app()->functions->getClientId()."'	
		ORDER BY id DESC
		";						
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    	
		   	    $slug=Yii::app()->createUrl("store/profile/",array(
		   	     'tab'=>2,
		   	     'do'=>"add",
		   	     'id'=>$val['id']
		   	    ));		   	    
				$action="<div class=\"options\">
	    		<a href=\"$slug\" ><i class=\"ion-ios-compose-outline\"></i></a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[id]\" ><i class=\"ion-ios-trash\"></i></a>
	    		</div>";		   	   
		   	   $feed_data['aaData'][]=array(
		   	      $val['address'].$action,
		   	      $val['location_name'],
		   	      $val['as_default']==2?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>'
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();			
     }
     
     public function addAddressBook()
     {     	
     	$params=array(
     	  'client_id'=>Yii::app()->functions->getClientId(),
     	  'street'=>$this->data['street'],
     	  'city'=>$this->data['city'],
     	  'state'=>$this->data['state'],
     	  'zipcode'=>$this->data['zipcode'],
     	  'location_name'=>isset($this->data['location_name'])?$this->data['location_name']:'',
     	  'as_default'=>isset($this->data['as_default'])?$this->data['as_default']:1,
     	  'date_created'=>FunctionsV3::dateNow(),
     	  'ip_address'=>$_SERVER['REMOTE_ADDR'],
     	  'country_code'=>$this->data['country_code']
     	);     	
     	
     	if (!isset($this->data['as_default'])){
     		$this->data['as_default']='';
     	}
     	     	
     	if ( $this->data['as_default']==2){
     		$sql_up="UPDATE {{address_book}}
     		SET as_default='1' 	     		
     		WHERE
     		client_id='".Yii::app()->functions->getClientId()."'
     		";
     		$this->qry($sql_up);
     	}     
     	
     	if ( isset($this->data['id'])){
     		unset($params['date_created']);
     		$params['date_modified']=FunctionsV3::dateNow();
     		if ( $this->updateData("{{address_book}}",$params,'id',$this->data['id'])){
     			$this->code=1;
     			$this->msg=Yii::t("default","Successful");		 
     		} else $this->msg=t("ERROR: Something went wrong");	
     	} else {
     	    if ( $this->insertData('{{address_book}}',$params)){
	        	$id=Yii::app()->db->getLastInsertID();
	        	$this->details=Yii::app()->createUrl('store/profile',array(
	        	  'tab'=>2,
	        	  'do'=>'add',
	        	  'id'=>$id
	        	));
	    		$this->code=1;
	    		$this->msg=Yii::t("default","Successful");		 
	        } else $this->msg=t("ERROR: Something went wrong");		
     	}
     }
     
	public function adminCustomerReviews()
	{		
		$slug=$this->data['slug'];
		$stmt="SELECT a.*,
		(
		select concat(first_name,' ',last_name)
		from {{client}}
		where
		client_id=a.client_id
		) client_name,
		
		(
		select restaurant_name
		from
		{{merchant}}
		where
		merchant_id=a.merchant_id
		) as merchant_name
		
		 FROM
		{{review}} a			
		ORDER BY id DESC
		";						
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	  
		   	$class='';  			   	    
				$action="<div class=\"options\">
	    		<a href=\"$slug/Do/Add/?id=$val[id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";		   	  
				
				if ( $this->data['currentController']=="admin"){						
				} else {					
					if ( Yii::app()->functions->getOptionAdmin('merchant_can_edit_reviews')=="yes"){
						$action='';
					}
				}
				
			   /*$date=Yii::app()->functions->prettyDate($val['date_created']);	
			   $date=Yii::app()->functions->translateDate($date); */
			   $date=FormatDateTime($val['date_created']);
			   
		   	   $feed_data['aaData'][]=array(
		   	     $val['id'],
		   	      stripslashes($val['merchant_name']).$action,
		   	      stripslashes($val['client_name']),
		   	      $val['review'],
		   	      /*$val['order_id'],*/
		   	      $val['rating'],
		   	      //$date."<br/><div class=\"uk-badge $class\">".strtoupper(Yii::t("default",$val['status']))."</div>"
		   	      "$date<br/><span class=\"tag ".$val['status']."\">".t($val['status'])."</span>",
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();	
	}     
	
	public function AdminUpdateCustomerReviews()
	{
		$db_ext=new DbExt;			
		if (isset($this->data['id'])){
			$params=array(
			  'review'=>$this->data['review'],
			  'status'=>$this->data['status'],
			  'rating'=>$this->data['rating'],
			  'ip_address'=>$_SERVER['REMOTE_ADDR']
			);
			if ($db_ext->updateData("{{review}}",$params,'id',$this->data['id'])){
				$this->code=1;
				$this->msg=Yii::t("default","Successful");
			} else $this->msg=Yii::t("default","ERROR: cannot update");
		} else $this->msg="";		
	}	
	
	public function clearCart()
	{
		unset($_SESSION['kr_item']);
		$this->code=1;
		$this->msg="OK";
	}
	
	public function UpdateItemAvailable()
	{		
		if (isset($this->data['item_id'])){
			$params=array('not_available'=>$this->data['checked']==1?2:1);
			$db_ext=new DbExt;
			if ( $db_ext->updateData("{{item}}",$params,'item_id',$this->data['item_id'])){
				$this->code=1;
				$this->msg=t("Successful");
			} else $this->msg=t("ERROR: cannot update records.");
		} else $this->msg=t("Missing parameters");
	}
	
	public function cardPaymentSettings()
	{
		Yii::app()->functions->updateOptionAdmin("admin_enabled_card",
    	isset($this->data['admin_enabled_card'])?$this->data['admin_enabled_card']:'');
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
	
	public function switchMerchantAccount()
	{		
		if (!isset($this->data['iagree'])){
			$this->msg=t("You must agree to switch your account to commission");
			return ;
		}			
		$params=array(
		  'is_commission'=>2,
		  'percent_commision'=>getOptionA('admin_commision_percent'),
		  'commision_type'=>getOptionA('admin_commision_type'),
		  'merchant_type'=>$this->data['merchant_type']
		);	
				
		$merchant_id=Yii::app()->functions->getMerchantID();		
		$db_ext=new DbExt;
		if ( $db_ext->updateData("{{merchant}}",$params,'merchant_id',$merchant_id)){
			$this->code=1; 
			$this->msg=t("You have successfully switch your account to commission");
			$this->msg.="<br/>";
			$this->msg.=t("Please not you might have to relogin again to see the balance");
			$this->details=websiteUrl()."/merchant/dashboard";
		} else $this->msg=t("ERROR: cannot update");
	}

	public function sendUpdateOrderEmail()
	{
		if (empty($this->data['email_order_change_msg'])){
			$this->msg=t("Email content is required");
			return false;
		}	
		if (empty($this->data['subject'])){
			$this->msg=t("Subject is required");
			return false;
		}	
		if ($res=Yii::app()->functions->getOrder($this->data['order_id'])){
			$client_email=$res['email_address'];			
			$content=$this->data['email_order_change_msg'];
			$subject=$this->data['subject'];
			if (Yii::app()->functions->sendEmail($client_email,'',$subject,$content)){
				$this->code=1;
				$this->msg=t("Email sent");
			} else $this->msg=t('ERROR: Cannot sent email.');
		} else $this->msg=t("Sory but we cannot find the order information");
	}
	
	public function viewOrderHistory()
	{		
		?>
		<div class="view-receipt-pop">
	      <h3><?php echo Yii::t("default",'History')?></h3>
	    
	      <?php if ( $resh=FunctionsK::orderHistory($this->data['id'])):?>                    
               <table class="uk-table uk-table-hover">
                 <thead>
                   <tr>
                    <th class="uk-text-muted"><?php echo t("Date/Time")?></th>
                    <th class="uk-text-muted"><?php echo t("Status")?></th>
                    <th class="uk-text-muted"><?php echo t("Remarks")?></th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php foreach ($resh as $valh):?>
                   <tr style="font-size:12px;">
                     <td><?php                       
                      echo FormatDateTime($valh['date_created'],true);
                      ?></td>
                     <td><?php echo t($valh['status'])?></td>
                     <td><?php echo $valh['remarks']?></td>
                   </tr>
                   <?php endforeach;?>
                 </tbody>
               </table> 
          <?php else :?>                
            <p class="uk-text-danger order-order-history show-history-<?php echo $val['order_id']?>">
              <?php echo t("No history found")?>
            </p>
          <?php endif;?>	 
	    	 
	    </div>
		<?php
		Yii::app()->end();
	}
	
	public function sendOrderSMSCode()
	{		
		$validator=new Validator;
		$req=array(
		  'session'=>t("Session is missing"),
		  'mobile'=>t("Mobile number is required"),
		  'mtid'=>t("Merchant id is missing")
		);
		
		if (empty($this->data['mtid'])){
			$this->msg=t("Merchant id is missing");
			return ;
		}	
		
		$waiting_time_define=getOption($this->data['mtid'],'order_sms_code_waiting');	
		if (!is_numeric($waiting_time_define)){
			$waiting_time_define=5;
		}			
		if (isset($_SESSION['request_order_sms'])){			
			$time_1=date('Y-m-d g:i:s a');			
			$time_2=$_SESSION['request_order_sms'];			
			if (!empty($time_2)){			
				$time_diff=Yii::app()->functions->dateDifference($time_2,$time_1);				
				if (is_array($time_diff) && count($time_diff)>=1){
					if ($time_diff['days']==0 && $time_diff['hours']==0){
						if ($time_diff['minutes']<$waiting_time_define){
							$waiting_time=$waiting_time_define-$time_diff['minutes'];
							$this->msg=t("Spam protection. you cannot request another order sms code in less than")." ".$waiting_time_define." ".t("Minutes");
							$this->msg.="<br/><br/>";
							$this->msg.=t("Please wait in")." ".$waiting_time." ".t("Minutes")."";
							$this->details=$time_diff;
							return ;
						}				
					} else {					
						$this->msg=t("Spam protection. you cannot request another order sms code in less than")." ".$waiting_time_define." ".t("Minutes");
						$waiting_time=$time_diff['hours']." ".t("hour")." ".t("and")." ".$time_diff['minutes']." ".t("Minutes");
						$this->msg.="<br/><br/>";
						$this->msg.=t("Please wait in")." ".$waiting_time;
						$this->details=$time_diff;
						return ;
					}		
				}			
			}
		}		
		
		$validator->required($req,$this->data);
		if ($validator->validate()){
						
			$client_id=Yii::app()->functions->getClientId();			
			if ( $client_info=Yii::app()->functions->getClientInfo($client_id)){
				$this->data['mobile']=$client_info['contact_phone'];
			}
											
			$sms_balance=Yii::app()->functions->getMerchantSMSCredit($this->data['mtid']);			
			if ( $sms_balance>=1){
				$code=FunctionsK::generateSMSOrderCode($this->data['mobile']);
				$sms_msg=t("Your order sms code is")." ".$code;
				if ( $resp=Yii::app()->functions->sendSMS($this->data['mobile'],$sms_msg)){				    
				    if ($resp['msg']=="process"){
				    	$this->code=1;
				    	$this->msg=t("Your order sms code has been sent to")." ".$this->data['mobile'];
				    	
				    	$this->data['mobile']=str_replace("+","",$this->data['mobile']);
				    	$params=array(
				    	  'mobile'=>trim($this->data['mobile']),
				    	  'code'=>$code,
				    	  'session'=>$this->data['session'],
				    	  'date_created'=>FunctionsV3::dateNow(),
				    	  'ip_address'=>$_SERVER['REMOTE_ADDR']
				    	);
				    	$this->insertData("{{order_sms}}",$params);
				    	$_SESSION['request_order_sms']=date('Y-m-d g:i:s a');
				    					    								    		    
                        $params=array(
			        	  'merchant_id'=>$this->data['mtid'],
			        	  'broadcast_id'=>"999999999",			        	  
			        	  'contact_phone'=>$this->data['mobile'],
			        	  'sms_message'=>$sms_msg,
			        	  'status'=>$resp['msg'],
			        	  'gateway_response'=>$resp['raw'],
			        	  'date_created'=>FunctionsV3::dateNow(),
			        	  'date_executed'=>FunctionsV3::dateNow(),
			        	  'ip_address'=>$_SERVER['REMOTE_ADDR'],
			        	  'gateway'=>$resp['sms_provider']
			        	);	  		        	  
			        	$this->insertData("{{sms_broadcast_details}}",$params);	   
				    	
				    } else $this->msg=t("Sorry but we cannot sms code this time")." ".$resp['msg'];
				} else $this->msg=t("Sorry but we cannot sms code this time");
			} else $this->msg=t("Sorry but this merchant does not have enought sms credit to send sms");		
		} else $this->msg=$validator->getErrorAsHTML();	
	}
	
	public function ZipCodeList()
	{		
	    $slug=$this->data['slug'];
		$stmt="SELECT * FROM
		{{zipcode}}
		ORDER BY zipcode_id DESC
		";
		if ($res=$this->rst($stmt)){
		   foreach ($res as $val) {				   	    			   	    
				$action="<div class=\"options\">
	    		<a href=\"$slug/Do/Add/?id=$val[zipcode_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[zipcode_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";		   	   
							   
			   $date=FormatDateTime($val['date_created']);
		   	   $feed_data['aaData'][]=array(
		   	      $val['zipcode_id'].$action,
		   	      $val['zipcode'],
		   	      Yii::app()->functions->countryCodeToFull($val['country_code']),
		   	      $val['stree_name'],
		   	      $val['city'],
		   	      $val['area'],
		   	      Yii::app()->functions->translateDate($date)."<br/><div class=\"uk-badge\">".$val['status']."</div>"
		   	   );			       
		   }
		   $this->otableOutput($feed_data);
		}
		$this->otableNodata();		
	}
	
	public function addZipCode()
	{
		$Validator=new Validator;
		$req=array(
		  'zipcode'=>Yii::t("default","post code is required"),
		  'country_code'=>t("country is required"),
		  'city'=>t("city is required"),
		  'area'=>t("area is required"),
		);				
		$Validator->required($req,$this->data);
		if ($Validator->validate()){
			$params=array(
			  'zipcode'=>$this->data['zipcode'],
			  'country_code'=>$this->data['country_code'],
			  'city'=>$this->data['city'],
			  'area'=>$this->data['area'],
			  'status'=>$this->data['status'],			  
			  'date_created'=>FunctionsV3::dateNow(),
			  'ip_address'=>$_SERVER['REMOTE_ADDR'],
			  'stree_name'=>isset($this->data['stree_name'])?$this->data['stree_name']:''
			);
		   if (empty($this->data['id'])){	
		    	if ( $this->insertData("{{zipcode}}",$params)){
		    		    $this->details=Yii::app()->db->getLastInsertID();
			    		$this->code=1;
			    		$this->msg=Yii::t("default","Successful");				    		
			    	}
			    } else {		    	
			    	unset($params['date_created']);
					$params['date_modified']=FunctionsV3::dateNow();		
					$res = $this->updateData('{{zipcode}}' , $params ,'zipcode_id',$this->data['id']);
					if ($res){
						$this->code=1;
		                $this->msg=Yii::t("default",'zipcode updated');  
				} else $this->msg=Yii::t("default","ERROR: cannot update");
		    }	
		} else $this->msg=$Validator->getErrorAsHTML();		
	}
	
	public function getArea()
	{		
		if (isset($this->data['city'])){
		   $stmt="
		   SELECT DISTINCT area
		   FROM
		   {{zipcode}}
		   WHERE
		   city =".q($this->data['city'])."
		   ORDER BY area ASC
		   ";
		   if ( $res=$this->rst($stmt)){
		   	   $this->code=1;
		   	   $this->msg="OK";
		   	   $this->details=$res;
		   } else $this->msg=t("No results");
		} else $this->msg=t("missing city parameters");
	}
	
	public function verifyEmailCode()
	{
		$client_id=isset($this->data['client_id'])?$this->data['client_id']:'';
		if( $res=Yii::app()->functions->getClientInfo( $client_id )){	
			
		    if ($res['email_verification_code']==trim($this->data['code'])){
		    	$this->code=1;
		    	$this->msg=t("Successful");
		    	
		    	$params=array( 
				  'status'=>"active",
				  'last_login'=>FunctionsV3::dateNow()
				);
				$this->updateData("{{client}}",$params,'client_id',$res['client_id']);
				
				$verification=Yii::app()->functions->getOptionAdmin("website_enabled_mobile_verification");	
				$email_verification=getOptionA('theme_enabled_email_verification');								
				if ($verification=="yes" || $email_verification==2){
					/*sent welcome email*/	    			
	    			FunctionsV3::sendCustomerWelcomeEmail($res);
				}
				
				Yii::app()->functions->clientAutoLogin($res['email_address'],$res['password'],$res['password']);
				
		    } else $this->msg=t("Verification code is invalid");
		} else $this->msg=t("Sorry but we cannot find your information.");
    }
    
    public function adminBrainTreeSettings()
    {
    
    	Yii::app()->functions->updateOptionAdmin("admin_btr_enabled",
	    isset($this->data['admin_btr_enabled'])?$this->data['admin_btr_enabled']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("admin_btr_mode",
	    isset($this->data['admin_btr_mode'])?$this->data['admin_btr_mode']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("sanbox_brain_mtid",
	    isset($this->data['sanbox_brain_mtid'])?$this->data['sanbox_brain_mtid']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("sanbox_brain_publickey",
	    isset($this->data['sanbox_brain_publickey'])?$this->data['sanbox_brain_publickey']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("sanbox_brain_privateckey",
	    isset($this->data['sanbox_brain_privateckey'])?$this->data['sanbox_brain_privateckey']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("live_brain_mtid",
	    isset($this->data['live_brain_mtid'])?$this->data['live_brain_mtid']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("live_brain_publickey",
	    isset($this->data['live_brain_publickey'])?$this->data['live_brain_publickey']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("live_brain_privateckey",
	    isset($this->data['live_brain_privateckey'])?$this->data['live_brain_privateckey']:'');
	    	
		$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
    		
    }
    
    public function merchantBrainTreeSettings()
    {
    	
		$merchant_id=Yii::app()->functions->getMerchantID();
			    	
		Yii::app()->functions->updateOption("merchant_btr_mode",
		isset($this->data['merchant_btr_mode'])?$this->data['merchant_btr_mode']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("merchant_btr_enabled",
		isset($this->data['merchant_btr_enabled'])?$this->data['merchant_btr_enabled']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("mt_sanbox_brain_mtid",
		isset($this->data['mt_sanbox_brain_mtid'])?$this->data['mt_sanbox_brain_mtid']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("mt_sanbox_brain_publickey",
		isset($this->data['mt_sanbox_brain_publickey'])?$this->data['mt_sanbox_brain_publickey']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("mt_sanbox_brain_privateckey",
		isset($this->data['mt_sanbox_brain_privateckey'])?$this->data['mt_sanbox_brain_privateckey']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("mt_live_brain_mtid",
		isset($this->data['mt_live_brain_mtid'])?$this->data['mt_live_brain_mtid']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("mt_live_brain_publickey",
		isset($this->data['mt_live_brain_publickey'])?$this->data['mt_live_brain_publickey']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("mt_live_brain_privateckey",
		isset($this->data['mt_live_brain_privateckey'])?$this->data['mt_live_brain_privateckey']:'',$merchant_id);
				
		$this->code=1;
		$this->msg=Yii::t("default","Settings saved.");
    }
			
    public function adminRazorSettings()
    {
    	Yii::app()->functions->updateOptionAdmin("admin_razor_key_id_sanbox",
	    isset($this->data['admin_razor_key_id_sanbox'])?$this->data['admin_razor_key_id_sanbox']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("admin_razor_secret_key_sanbox",
	    isset($this->data['admin_razor_secret_key_sanbox'])?$this->data['admin_razor_secret_key_sanbox']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("admin_razor_key_id_live",
	    isset($this->data['admin_razor_key_id_live'])?$this->data['admin_razor_key_id_live']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("admin_razor_secret_key_live",
	    isset($this->data['admin_razor_secret_key_live'])?$this->data['admin_razor_secret_key_live']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("admin_rzr_enabled",
	    isset($this->data['admin_rzr_enabled'])?$this->data['admin_rzr_enabled']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("admin_rzr_mode",
	    isset($this->data['admin_rzr_mode'])?$this->data['admin_rzr_mode']:'');
	    
	    $this->code=1;
		$this->msg=Yii::t("default","Settings saved.");
    }    
    
    public function merchantRazorSettings()
    {
    	    
	    $merchant_id=Yii::app()->functions->getMerchantID();
	    
	    Yii::app()->functions->updateOption("merchant_rzr_mode",
		isset($this->data['merchant_rzr_mode'])?$this->data['merchant_rzr_mode']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("merchant_rzr_enabled",
		isset($this->data['merchant_rzr_enabled'])?$this->data['merchant_rzr_enabled']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("merchant_razor_key_id_sanbox",
		isset($this->data['merchant_razor_key_id_sanbox'])?$this->data['merchant_razor_key_id_sanbox']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("merchant_razor_secret_key_sanbox",
		isset($this->data['merchant_razor_secret_key_sanbox'])?$this->data['merchant_razor_secret_key_sanbox']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("merchant_razor_key_id_live",
		isset($this->data['merchant_razor_key_id_live'])?$this->data['merchant_razor_key_id_live']:'',$merchant_id);
		
		Yii::app()->functions->updateOption("merchant_razor_secret_key_live",
		isset($this->data['merchant_razor_secret_key_live'])?$this->data['merchant_razor_secret_key_live']:'',$merchant_id);
	    
	    $this->code=1;
		$this->msg=Yii::t("default","Settings saved.");
    }        
    
    public function Admincategorylist()
	{	
		$slug=$this->data['slug'];
		$stmt="
		SELECT * FROM
		{{category}}
		WHERE
		merchant_id='999999'
		ORDER BY cat_id DESC
		";
		$connection=Yii::app()->db;
	    $rows=$connection->createCommand($stmt)->queryAll();     	    
	    if (is_array($rows) && count($rows)>=1){
	    	foreach ($rows as $val) {    	 
	    		$chk="<input type=\"checkbox\" name=\"row[]\" value=\"$val[cat_id]\" class=\"chk_child\" >";   		
	    		$option="<div class=\"options\">
	    		<a href=\"$slug/id/$val[cat_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[cat_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";
	    			    		
	    		$date=FormatDateTime($val['date_created']);
	    		
	    		if (!empty($val['photo'])){
	    			$img=Yii::app()->request->baseUrl."/upload/$val[photo]";
	    		    $photo="<img class=\"uk-thumbnail uk-thumbnail-mini\" src=\"$img\" >";	
	    		} else $photo='';
	    		
	    		$feed_data['aaData'][]=array(
	    		  $chk,stripslashes($val['category_name']).$option,
	    		  stripslashes($val['category_description']),
	    		  $photo,
	    		  Widgets::displaySpicyIconNew($val['dish']),
	    		  $date."<div>".Yii::t("default",$val['status'])."</div>"
	    		);
	    	}
	    	$this->otableOutput($feed_data);
	    }     	    
	    $this->otableNodata();
	}    
	
	public function Adminsubcategorylist()
	{
		$slug=$this->data['slug'];
		$stmt="
		SELECT * , sub.photo as sub_photo FROM
		{{subcategory}} AS sub
		LEFT JOIN {{category}} AS cat
		ON sub.category_id=cat.cat_id
		ORDER BY subcat_id DESC
		";
		$connection=Yii::app()->db;
	    $rows=$connection->createCommand($stmt)->queryAll(); 
	    if (is_array($rows) && count($rows)>=1){
	    	foreach ($rows as $val) {   
	    		// print_r($val) ;die;
	    		$chk="<input type=\"checkbox\" name=\"row[]\" value=\"$val[subcat_id]\" class=\"chk_child\" >";   		
	    		$option="<div class=\"options\">
	    		<a href=\"$slug/id/$val[subcat_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[subcat_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";
	    			    		
	    		$date=FormatDateTime($val['date_created']);
	    		
	    		if (!empty($val['photo'])){
	    			$img=Yii::app()->request->baseUrl."/upload/$val[sub_photo]";
	    		    $photo="<img class=\"uk-thumbnail uk-thumbnail-mini\" src=\"$img\" >";	
	    		} else $photo='';
	    		
	    		$feed_data['aaData'][]=array(
	    		  $chk,stripslashes($val['subcategory_name']).$option,
	    		  stripslashes($val['subcategory_description']),
	    		  $photo,
	    		  $val['category_name'],
	    		  $date
	    		);
	    	}
	    	$this->otableOutput($feed_data);
	    }     	    
	    $this->otableNodata();
	}

	public function AdminbrandsList()
	{
		$slug=$this->data['slug'];
		$stmt="
		SELECT * FROM
		{{brands}}
		ORDER BY brand_id DESC
		";
		$connection=Yii::app()->db;
	    $rows=$connection->createCommand($stmt)->queryAll();     	    
	    if (is_array($rows) && count($rows)>=1){
	    	foreach ($rows as $val) {    	 
	    		$chk="<input type=\"checkbox\" name=\"row[]\" value=\"$val[brand_id]\" class=\"chk_child\" >";   		
	    		$option="<div class=\"options\">
	    		<a href=\"$slug/id/$val[brand_id]\" >".Yii::t("default","Edit")."</a>
	    		<a href=\"javascript:;\" class=\"row_del\" rev=\"$val[brand_id]\" >".Yii::t("default","Delete")."</a>
	    		</div>";
	    			    		
	    		$date=FormatDateTime($val['created_at']);	    		
	    		if (!empty($val['brand_photo'])){
	    			$img=Yii::app()->request->baseUrl."/upload/$val[brand_photo]";
	    		    $photo="<img class=\"uk-thumbnail uk-thumbnail-mini\" src=\"$img\" >";	
	    		} else $photo='';
	    		
	    		$feed_data['aaData'][]=array(
	    		  $chk,
	    		  stripslashes($val['brand_name']).$option,
	    		  $photo,
	    		  $date
	    		);
	    	}
	    	$this->otableOutput($feed_data);
	    }     	    
	    $this->otableNodata();
	}

	public function adminAddCategory()
	{
		  $params=array(
			  'category_name'=>addslashes($this->data['category_name']),
			  'category_description'=>addslashes($this->data['category_description']),
			  'photo'=>isset($this->data['photo'])?addslashes($this->data['photo']):'',
			  'status'=>addslashes($this->data['status']),
			  'date_created'=>FunctionsV3::dateNow(),
			  'ip_address'=>$_SERVER['REMOTE_ADDR'],
			  'merchant_id'=>'999999',			  
			  'spicydish_notes'=>isset($this->data['spicydish_notes'])?$this->data['spicydish_notes']:'',
			  'dish'=>isset($this->data['dish'])?json_encode($this->data['dish']):''			  
			);				
			
			if (isset($this->data['category_name_trans'])){				
				if (okToDecode()){
					$params['category_name_trans']=json_encode($this->data['category_name_trans'],
					JSON_UNESCAPED_UNICODE);
				} else $params['category_name_trans']=json_encode($this->data['category_name_trans']);				
			}
			if (isset($this->data['category_description_trans'])){
				if (okToDecode()){
					$params['category_description_trans']=json_encode($this->data['category_description_trans'],
					JSON_UNESCAPED_UNICODE);
				} else $params['category_description_trans']=json_encode($this->data['category_description_trans']);
			}
																					
			$command = Yii::app()->db->createCommand();
			if (isset($this->data['id']) && is_numeric($this->data['id'])){				
				unset($params['date_created']);
				$params['date_modified']=FunctionsV3::dateNow();
								
				ClassCategory::updateCategoryMerchant($this->data['id'],$params);				
						
				$res = $command->update('{{category}}' , $params , 
				'cat_id=:cat_id' , array(':cat_id'=> addslashes($this->data['id']) ));
				if ($res){
					$this->code=1;
	                $this->msg=Yii::t("default",'Category updated.');  
				} else $this->msg=Yii::t("default","ERROR: cannot update");
			} else {				
				if ($res=$command->insert('{{category}}',$params)){
					$this->details=Yii::app()->db->getLastInsertID();	   
					
					/*special category*/
					ClassCategory::autoAddCategoryToMerchant($this->details);
					             
	                $this->code=1;
	                $this->msg=Yii::t("default",'Category added.');  	                
	            } else $this->msg=Yii::t("default",'ERROR. cannot insert data.');
			}		
	}
	
	public function adminAddSubCategory()
	{
		$params=array(
			  'category_id'=>addslashes($this->data['cat_id']),
			  'subcategory_name'=>addslashes($this->data['subcategory_name']),
			  'subcategory_description'=>addslashes($this->data['subcategory_description']),
			  'photo'=>isset($this->data['photo'])?addslashes($this->data['photo']):'',
			  'parent_id'=>addslashes($this->data['parent_id']),
			  'date_created'=>FunctionsV3::dateNow(),
			  'ip_address'=>$_SERVER['REMOTE_ADDR'],
			);
		if (isset($this->data['subcategory_name_trans'])){				
				if (okToDecode()){
					$params['subcategory_name_trans']=json_encode($this->data['subcategory_name_trans'],
					JSON_UNESCAPED_UNICODE);
				} else $params['subcategory_name_trans']=json_encode($this->data['subcategory_name_trans']);				
			}
		if (isset($this->data['category_description_trans'])){
				if (okToDecode()){
					$params['subcategory_description_trans']=json_encode($this->data['subcategory_description_trans'],
					JSON_UNESCAPED_UNICODE);
				} else $params['subcategory_description_trans']=json_encode($this->data['subcategory_description_trans']);
			}
		$command = Yii::app()->db->createCommand();
		if (isset($this->data['id']) && is_numeric($this->data['id'])){				
			unset($params['date_created']);
			$params['date_modified']=FunctionsV3::dateNow();
					
						
			$res = $command->update('{{subcategory}}' , $params , 
			'subcat_id=:subcat_id' , array(':subcat_id'=> addslashes($this->data['id']) ));
			if ($res){
				$this->code=1;
	            $this->msg=Yii::t("default",'Category updated.');  
			} else $this->msg=Yii::t("default","ERROR: cannot update");
		} else {			
			if ($res=$command->insert('{{subcategory}}',$params)){
				$this->details=Yii::app()->db->getLastInsertID();	   
				
				/*special category*/
				// ClassCategory::autoAddCategoryToMerchant($this->details);
				             
	            $this->code=1;
	            $this->msg=Yii::t("default",'Sub Category added.');  	                
	        } else $this->msg=Yii::t("default",'ERROR. cannot insert data.');
		}
	}
	/**
	*
	*
	*
	*/
	public function adminAddBrands()
	{
		$params=array(
			'brand_name'=>addslashes($this->data['brand_name']),
			'brand_photo'=>isset($this->data['photo'])?addslashes($this->data['photo']):'',
			'created_at'=>FunctionsV3::dateNow(),
		);

		if (isset($this->data['brand_name_trans'])){				
			if (okToDecode()){
				$params['brand_name_trans']=json_encode($this->data['brand_name_trans'],
				JSON_UNESCAPED_UNICODE);
			} else $params['brand_name_trans']=json_encode($this->data['brand_name_trans']);				
		}
		$command = Yii::app()->db->createCommand();
		if (isset($this->data['id']) && is_numeric($this->data['id'])){				
			unset($params['created_at']);
			$params['updated_at']=FunctionsV3::dateNow();
					
						
			$res = $command->update('{{brands}}' , $params , 
			'brand_id=:brand_id' , array(':brand_id'=> addslashes($this->data['id']) ));
			if ($res){
				$this->code=1;
	            $this->msg=Yii::t("default",'Brand updated.');  
			} else $this->msg=Yii::t("default","ERROR: cannot update");
		} else {	

			if ($res=$command->insert('{{brands}}',$params)){
				// print_r($command->insert('{{brands}}',$params));die;
				$this->details=Yii::app()->db->getLastInsertID();	   
				
				/*special category*/				             
	            $this->code=1;
	            $this->msg=Yii::t("default",'Brand added.');  	                
	        } else $this->msg=Yii::t("default",'ERROR. cannot insert data.');
		}
	}

	public function categorySettings()
	{
		Yii::app()->functions->updateOptionAdmin("merchant_category_disabled",
	    isset($this->data['merchant_category_disabled'])?$this->data['merchant_category_disabled']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("merchant_category_auto_add",
	    isset($this->data['merchant_category_auto_add'])?$this->data['merchant_category_auto_add']:'');
	    
	    $this->code=1;
		$this->msg=Yii::t("default","Settings saved.");
	}
	
	public function showCCDetails()
	{
		$data=FunctionsV3::getMerchantCCdetails($this->data['id']);
		require_once('cc_details.php');		
		die();
	}
	
	public function getCartCount()
	{
		$count=count($_SESSION['kr_item']);
		if($count>0){
			$this->code=1;
			$this->msg="OK";
			$this->details=$count;
		} else $this->msg="No item";
	}
	
	public function getAdminNewOrder()
	{
		$list='';
		if ( $res=FunctionsV3::getNewOrders('admin')){
			$this->code=1;
	    	$this->msg=count($res);	 
	    	$order_list='';
    		foreach ($res as $val) {	    			
    			$order_list.="<div class=\"new-order-link\">";
    			$order_list.="<a class=\"view-receipt\" data-id=\"$val[order_id]\" 
    			href=\"javascript:;\">".t("Click here to view")." ". t("Reference #") .":". $val['order_id'] . "</a>";	    			
    			$order_list.="<div>";
    		}	    		
    		$this->details=$order_list;
		} else $this->msg= t("No results");
	}
	
	public function updateOrderAdmin()
	{
	    //dump($this->data);
	    $DbExt=new DbExt;	   
	    $date_now=date('Y-m-d');
	    if (isset($this->data['order_id'])){
	    	$order_id=$this->data['order_id'];
	    	
	    	$params=array(
	    	    'status'=>$this->data['status'],
	    	    'date_modified'=>FunctionsV3::dateNow(),
	    	    'admin_viewed'=>1
	    	);	    	
	    	if ($DbExt->updateData('{{order}}',$params,'order_id',$order_id)){
	    		
	    		$this->code=1;
	    		$this->msg=Yii::t("default","Status saved.");
	    		
	    		/*Now we insert the order history*/	    		
				$params_history=array(
				  'order_id'=>$order_id,
				  'status'=>$this->data['status'],
				  'remarks'=>isset($this->data['remarks'])?$this->data['remarks']:'',
				  'date_created'=>FunctionsV3::dateNow(),
				  'ip_address'=>$_SERVER['REMOTE_ADDR']
				);	    				
				$DbExt->insertData("{{order_history}}",$params_history);
				
				/*if (FunctionsV3::hasModuleAddon("mobileapp")){					
			    	Yii::app()->setImport(array(			
					  'application.modules.mobileapp.components.*',
				    ));
			    	AddonMobileApp::savedOrderPushNotification($this->data);
				}*/
				
				/*SEND NOTIFICATIONS TO CUSTOMER*/	    				
				FunctionsV3::notifyCustomerOrderStatusChange(
				  $order_id,
				  $this->data['status'],
				  isset($this->data['remarks'])?$this->data['remarks']:''
				);
		    	
				/*DRIVER APP ADD TASK*/
				if (FunctionsV3::hasModuleAddon("driver")){			    	
			    	Yii::app()->setImport(array(			
					  'application.modules.driver.components.*',
				    ));
				    Driver::addToTask($order_id);
				}
	    		
	    	} else $this->msg=Yii::t("default","ERROR: cannot update order.");	    	
	    } else $this->msg=Yii::t("default","Missing parameters");	    
	}
	
	public function minTableRates()
	{
		
		$mtid=Yii::app()->functions->getMerchantID();	
		Yii::app()->functions->updateOption("min_tables_enabled",
    	isset($this->data['min_tables_enabled'])?$this->data['min_tables_enabled']:'',$mtid);
    	    	
    	if (is_array($this->data['distance_from']) && count($this->data['distance_from'])>=1){    		
    		$x=0;
    		$stmt="
    		DELETE FROM
    		{{minimum_table}}    		
    		WHERE
    		merchant_id=".Yii::app()->functions->q($mtid)."
    		";
    		$this->qry($stmt);
    		foreach ($this->data['distance_from'] as $val) {    			
    			$params=array(
    			  'merchant_id'=>$mtid,
    			  'distance_from'=>$val,
    			  'distance_to'=>$this->data['distance_to'][$x],
    			  'shipping_units'=>$this->data['shipping_units'][$x],    			  
    			  'min_order'=>$this->data['min_order'][$x], 
    			);    			
    			$this->insertData("{{minimum_table}}",$params);
    			$x++;
    		}
    	}	
    	
    	$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");
	}
	
	public function adminMonerisSettings()
	{
				
		Yii::app()->functions->updateOptionAdmin("admin_moneris_storeid",
    	isset($this->data['admin_moneris_storeid'])?trim($this->data['admin_moneris_storeid']):'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_moneris_token",
    	isset($this->data['admin_moneris_token'])?trim($this->data['admin_moneris_token']):'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_moneris_enabled",
    	isset($this->data['admin_moneris_enabled'])?trim($this->data['admin_moneris_enabled']):'');
    	
    	Yii::app()->functions->updateOptionAdmin("admin_moneris_mode",
    	isset($this->data['admin_moneris_mode'])?trim($this->data['admin_moneris_mode']):'');
    	
		$this->code=1;
    	$this->msg=Yii::t("default","Setting saved");	    
	}
	
	public function merchantMonerisSettings()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
			
        Yii::app()->functions->updateOption("merchant_moneris_enabled",
    	isset($this->data['merchant_moneris_enabled'])?$this->data['merchant_moneris_enabled']:''
    	,$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_moneris_mode",
    	isset($this->data['merchant_moneris_mode'])?$this->data['merchant_moneris_mode']:''
    	,$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_moneris_storeid",
    	isset($this->data['merchant_moneris_storeid'])?$this->data['merchant_moneris_storeid']:''
    	,$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_moneris_token",
    	isset($this->data['merchant_moneris_token'])?$this->data['merchant_moneris_token']:''
    	,$merchant_id);
    	
    	$this->code=1;
	    $this->msg=Yii::t("default","Setting saved");
	}
	
	public function InitPlaceOrder()
	{
		//dump($this->data);
		
		$mtid=$_SESSION['kr_merchant_id'];
			    
	    if ( $this->data['delivery_type']=="delivery"){
	    	if (FunctionsV3::isSearchByLocation()){	    		
	    		$params_check=array(
	    		   'state_id'=>$this->data['state_id'],
	    		   'city_id'=>$this->data['city_id'],
	    		   'area_id'=>$this->data['area_id'],
	    		   'location_city'=>isset($this->data['city'])?$this->data['city']:'',
	    		   'city_name'=>isset($this->data['city'])?$this->data['city']:'',
	    		   'location_area'=>isset($this->data['area_name'])?$this->data['area_name']:'',
	    		   'location_type'=>getOptionA('admin_zipcode_searchtype')
	    		);	   
	    		//dump($params_check);
	    		if ( $fee=FunctionsV3::validateCanDeliverByLocation($mtid,$params_check)){
	    			$_SESSION['shipping_fee']=$fee['fee'];		
	    			Cookie::setCookie('kr_location_search',json_encode($params_check));  	    			
	    		} else {
	    			$this->msg=t("Sorry this merchant does not deliver to your location");
	    			return ;
	    		} 
	    		  	
	    	} else {
		    	if (!FunctionsV3::reCheckDelivery($mtid,$this->data)){
		    		$mt_delivery_miles=getOption($mtid,'merchant_delivery_miles'); 
		    		$distance_type=FunctionsV3::getMerchantDistanceType($mtid); 
		    		$unit=$distance_type=="M"?t("miles"):t("kilometers");
		    		$this->msg=t("Sorry but this merchant delivers only with in ").$mt_delivery_miles." $unit";
		    		return ;
		    	}
	    	}
	    }
	    	    
	    $params='';
	    if (is_array($this->data) && count($this->data)>=1){
	    	foreach ($this->data as $key=>$val) {	    		
	    		$params[$key]=$val;
	    	}
	    	unset($params['action']);
	    }
	    
	    $params['merchant_id']=$mtid;
	    $params['payment_opt']=$this->data['payment_opt'];
	    
	    switch ($this->data['payment_opt']) {
	    	case "pyp":
	    		//if ( FunctionsV3::isMerchantCommission($mtid)){
	    		if (FunctionsV3::isMerchantPaymentToUseAdmin($mtid)){
	    			$card_fee = getOptionA('admin_paypal_fee');
	    		} else $card_fee = getOption($mtid,'merchant_paypal_fee');
	    		if ($card_fee>0){
	    			$params['card_fee']=$card_fee;
	    		}	    
	    		break;
	    
	    	default:
	    		break;
	    }	    
	    $_SESSION['confirm_order_data']=$params;	    
	    $this->code=1; $this->msg=t("Please wait while we redirect you");
	    	    
	    $is_guest=false;
	    if (isset($this->data['is_guest_checkout'])){
	    	if ($this->data['is_guest_checkout']==2){
	    		$is_guest=true;
	    	}	    
	    } 	
	    if ($is_guest){
	    	$this->details=Yii::app()->createUrl('store/confirmorder',array(
	    	  'isguest'=>1
	    	)) ;
	    } else $this->details=Yii::app()->createUrl('store/confirmorder') ;		    
	}
	
	public function emailLogs()
	{
		$aColumns = array(
		  'id','email_address','sender','subject','content','email_provider','status','date_created'
		);
		$t=AjaxDataTables::AjaxData($aColumns);		
		if (isset($_GET['debug'])){
		    dump($t);
		}
		
		if (is_array($t) && count($t)>=1){
			$sWhere=$t['sWhere'];
			$sOrder=$t['sOrder'];
			$sLimit=$t['sLimit'];
		}	
		
		$and='';		
				
		$stmt="SELECT SQL_CALC_FOUND_ROWS a.*		
		FROM
		{{email_logs}} a
		WHERE 1
		$and		
		$sWhere
		$sOrder
		$sLimit
		";
		if (isset($_GET['debug'])){
		   dump($stmt);
		}
				
		$DbExt=new DbExt; 
		if ( $res=$DbExt->rst($stmt)){
			
			$iTotalRecords=0;						
			$stmtc="SELECT FOUND_ROWS() as total_records";
			if ( $resc=$DbExt->rst($stmtc)){									
				$iTotalRecords=$resc[0]['total_records'];
			}
			
			$feed_data['sEcho']=intval($_GET['sEcho']);
			$feed_data['iTotalRecords']=$iTotalRecords;
			$feed_data['iTotalDisplayRecords']=$iTotalRecords;										
			
			foreach ($res as $val) {
				$date_created=Yii::app()->functions->prettyDate($val['date_created'],true);
			    $date_created=Yii::app()->functions->translateDate($date_created);		
			    $action='';	
			    
			    $status="<span class=\"tag ".$val['status']."\">".t($val['status'])."</span>";
			    $link=Yii::app()->createUrl('admin/viewemail',array(
			      'id'=>$val['id']
			    ));
			    $action="<a target=\"_blank\" href=\"$link\">".t("View Content")."</a>";
			    			    
			    $feed_data['aaData'][]=array(			      
			      $val['id'],
			      $val['email_address'],
			      $val['sender'],
			      $val['subject'],
			      $action,
			      t($val['email_provider']),
			      $status,
			      $date_created,
			    );			    
			}
			if (isset($_GET['debug'])){
			   dump($feed_data);
			}
			$this->otableOutput($feed_data);	
		}
		$this->otableNodata();
	}
	
	public function CountryList()
	{
		$aColumns = array(
		  'country_id','shortcode','country_name','phonecode','country_id'
		);
		$t=AjaxDataTables::AjaxData($aColumns);		
		if (isset($_GET['debug'])){
		    dump($t);
		}
		
		if (is_array($t) && count($t)>=1){
			$sWhere=$t['sWhere'];
			$sOrder=$t['sOrder'];
			$sLimit=$t['sLimit'];
		}	
		
		$and='';		
				
		$stmt="SELECT SQL_CALC_FOUND_ROWS a.*		
		FROM
		{{location_countries}} a
		WHERE 1
		$and		
		$sWhere
		$sOrder
		$sLimit
		";
		if (isset($_GET['debug'])){
		   dump($stmt);
		}
				
		$DbExt=new DbExt; 
		if ( $res=$DbExt->rst($stmt)){
			
			$iTotalRecords=0;						
			$stmtc="SELECT FOUND_ROWS() as total_records";
			if ( $resc=$DbExt->rst($stmtc)){									
				$iTotalRecords=$resc[0]['total_records'];
			}
			
			$feed_data['sEcho']=intval($_GET['sEcho']);
			$feed_data['iTotalRecords']=$iTotalRecords;
			$feed_data['iTotalDisplayRecords']=$iTotalRecords;										
			
			foreach ($res as $val) {
				$link=Yii::app()->createUrl('admin/definelocation',array(
				  'countryid'=>$val['country_id']
				));
				$acion="<a href=\"$link\">".t("Define location")."</a>";			    
			    $feed_data['aaData'][]=array(			      
			      $val['country_id'],
			      $val['shortcode'],
			      $val['country_name'],
			      $val['phonecode'],
			      $acion
			    );			    
			}
			if (isset($_GET['debug'])){
			   dump($feed_data);
			}
			$this->otableOutput($feed_data);	
		}
		$this->otableNodata();
	}
	
	public function InvoiceList()
	{
				
		$aColumns = array(
		  'invoice_number','merchant_name','invoice_terms',
		  'invoice_total','date_from','status','pdf_filename'
		);
		
		$sWhere=''; $sOrder=''; $sLimit='';
		
		$sTable = "{{invoice}}";
		
		$functionk=new FunctionsK();
		$t=$functionk->ajaxDataTables($aColumns);
		if (is_array($t) && count($t)>=1){
			$sWhere=$t['sWhere'];
			$sOrder=$t['sOrder'];
			$sLimit=$t['sLimit'];
		}	
		$stmt = "
			SELECT SQL_CALC_FOUND_ROWS 
			a.*
			FROM $sTable a
			$sWhere
			$sOrder
			$sLimit
		";
		if (isset($_GET['debug'])){dump($stmt);}
		if ( $res=$this->rst($stmt)){		
			
			$iTotalRecords=0;
			$stmt2="SELECT FOUND_ROWS()";
			if ( $res2=$this->rst($stmt2)){
				//dump($res2);
				$iTotalRecords=$res2[0]['FOUND_ROWS()'];
			}	
						
			$feed_data['sEcho']=intval($_GET['sEcho']);
			$feed_data['iTotalRecords']=$iTotalRecords;
			$feed_data['iTotalDisplayRecords']=$iTotalRecords;
			
			$action='';
						
			foreach ($res as $val) {	
			   if (isset($_GET['debug'])){dump($val);}
			   
			   if(!empty($val['pdf_filename']) && $val['pdf_filename']!=".pdf" ){			
			   	  $link=uploadURL()."/invoice/".$val['pdf_filename'];
			      $action="<a href=\"$link\" target=\"_blank\" class=\"uk-button uk-button-primary\">".t("View")."</a>";
			   }		
			   
			   $action.='<br/><br/>';
			   $action.='<a href="javascript:;" class="uk-button invoice_view_history" data-id="'.$val['invoice_number'].'" >'.t("History").'</a>';
			   
			   $edit_actions='<div class="options">';
			   $edit_actions.='<a href="javascript:;" data-id="'.$val['invoice_number'].'" class="edit_invoice">'.t("Edit").'</a>';
			   $edit_actions.="&nbsp;";
			   $edit_actions.='<a href="javascript:;" class="row_del" rev="'.$val['invoice_number'].'">'.t("Delete").'</a>';
			   $edit_actions.='</div>';
			   
			   $date_created=FunctionsV3::prettyDate($val['date_created']);
			   $date_created.=" ".FunctionsV3::prettyTime($val['date_created']);
			   $feed_data['aaData'][]=array(			
			     $val['invoice_number'],
			     stripslashes($val['merchant_id']).$edit_actions,
			     stripslashes($val['merchant_name']),			     
			     FunctionsV3::prettyInvoiceTerms($val['invoice_terms']),			     
			     FunctionsV3::prettyDate($val['date_from'])." - ".FunctionsV3::prettyDate($val['date_to']),
			     FunctionsV3::prettyPrice($val['invoice_total']),
			     $date_created."<span class=\"tag $val[status]\">".$val['status']."</span>",
			     "<span class=\"tag $val[payment_status]\">".$val['payment_status']."</span>",
			     $action
			   );
					
			}										
						
			$this->otableOutput($feed_data);	
		}
	    $this->otableNodata();
	}	

	
	public function AllOrders()
	{
				
		$aColumns = array(
		  'order_id','a.merchant_id','a.client_id',
		  'json_details','trans_type','payment_type',
		  'sub_total','taxable_total','total_w_tax','a.status','request_from','a.date_created'
		);
		
		$sWhere=''; $sOrder=''; $sLimit='';
				
		
		$functionk=new FunctionsK();
		$t=$functionk->ajaxDataTables($aColumns);
		if (is_array($t) && count($t)>=1){
			$sWhere=$t['sWhere'];
			$sOrder=$t['sOrder'];
			$sLimit=$t['sLimit'];
		}	
		
		if(!empty($sWhere)){
			$sWhere.=" AND a.status NOT IN ('initial_order')";
		} else $sWhere.=" WHERE a.status NOT IN ('initial_order')";
				
		$stmt = "
			SELECT SQL_CALC_FOUND_ROWS 
			a.*,
			b.restaurant_name,
			concat(c.first_name,' ',c.last_name) as client_name
			
			FROM {{order}} a
			LEFT join {{merchant}} b
            ON
            a.merchant_id=b.merchant_id
            
            LEFT join {{client}} c
            ON
            a.client_id = c.client_id
			
			$sWhere
			$sOrder
			$sLimit
		";
		if (isset($_GET['debug'])){dump($stmt);}
		if ( $res=$this->rst($stmt)){		
			
			$iTotalRecords=0;
			$stmt2="SELECT FOUND_ROWS()";
			if ( $res2=$this->rst($stmt2)){
				//dump($res2);
				$iTotalRecords=$res2[0]['FOUND_ROWS()'];
			}	
						
			$feed_data['sEcho']=intval($_GET['sEcho']);
			$feed_data['iTotalRecords']=$iTotalRecords;
			$feed_data['iTotalDisplayRecords']=$iTotalRecords;
			
			$action='';
						
			foreach ($res as $val) {	
			   if (isset($_GET['debug'])){dump($val);}

			    $action='';
				$action.="<a data-id=\"".$val['order_id']."\" class=\"edit-order\" href=\"javascript:\">".Yii::t("default","Edit")."</a>";
				$action.="<br/><a data-id=\"".$val['order_id']."\" class=\"view-receipt\" href=\"javascript:\">".Yii::t("default","View")."</a>";
				
				$action.="<a data-id=\"".$val['order_id']."\" class=\"view-order-history\" href=\"javascript:\">".Yii::t("default","History")."</a>";		   
			   
			   $item=FunctionsV3::translateFoodItemByOrderId($val['order_id']);
			   
			   $new='';
                if ($val['admin_viewed']<=0){
    				$new=" <div class=\"uk-badge\">".Yii::t("default","NEW")."</div>";
    			}	    			    			
	    			
			   $date_created=FunctionsV3::prettyDate($val['date_created']);
			   $date_created.=" ".FunctionsV3::prettyTime($val['date_created']);
			   $feed_data['aaData'][]=array(			
			     $val['order_id'],
			     stripslashes($val['restaurant_name']).$new,
			     $val['client_name'],
			     $item,
			     t($val['trans_type']),
			     t($val['payment_type']),
			     FunctionsV3::prettyPrice($val['sub_total']),
			     FunctionsV3::prettyPrice($val['taxable_total']),
			     FunctionsV3::prettyPrice($val['total_w_tax']),
			     "<span class=\"tag ".$val['status']."\">".t($val['status'])."</span>"."<div>$action</div>",
			     t($val['request_from']),
			     $date_created
			   );
					
			}										
						
			$this->otableOutput($feed_data);	
		}
	    $this->otableNodata();
	}	
	
	public function MerchantInvoiceList()
	{
				
		$aColumns = array(
		  'invoice_number','merchant_name','invoice_terms',
		  'invoice_total','date_from','status','pdf_filename'
		);
		
		$sWhere=''; $sOrder=''; $sLimit='';
		
		$sTable = "{{invoice}}";
		
		$functionk=new FunctionsK();
		$t=$functionk->ajaxDataTables($aColumns);
		if (is_array($t) && count($t)>=1){
			$sWhere=$t['sWhere'];
			$sWhere=str_replace("WHERE",'AND',$sWhere);
			$sOrder=$t['sOrder'];
			$sLimit=$t['sLimit'];
		}	
		$stmt = "
			SELECT SQL_CALC_FOUND_ROWS 
			a.*
			FROM $sTable a			
			WHERE merchant_id  =".FunctionsV3::q($this->data['merchant_id'])."
			$sWhere
			$sOrder
			$sLimit
		";
		if (isset($_GET['debug'])){dump($stmt);}
		if ( $res=$this->rst($stmt)){		
			
			$iTotalRecords=0;
			$stmt2="SELECT FOUND_ROWS()";
			if ( $res2=$this->rst($stmt2)){
				//dump($res2);
				$iTotalRecords=$res2[0]['FOUND_ROWS()'];
			}	
						
			$feed_data['sEcho']=intval($_GET['sEcho']);
			$feed_data['iTotalRecords']=$iTotalRecords;
			$feed_data['iTotalDisplayRecords']=$iTotalRecords;
			
			$action='';
						
			foreach ($res as $val) {	
			   if (isset($_GET['debug'])){dump($val);}
			   
			   if(!empty($val['pdf_filename']) && $val['pdf_filename']!=".pdf" ){			
			   	  //$link=uploadURL()."/invoice/".$val['pdf_filename'];
			   	  $link=Yii::app()->createUrl('merchant/viewinvoice',array(
			   	    'token'=>$val['invoice_token']
			   	  ));
			      $action="<a href=\"$link\" target=\"_blank\">".t("View")."</a>";
			   }		
			   
			   $new='';
			   if ($val['viewed']==2 || $val['viewed']=""){
			   	  $new='<span class="tag new">'.t("NEW").'</span>';
			   }			
			   
			   $date_created=FunctionsV3::prettyDate($val['date_created']);
			   $date_created.=" ".FunctionsV3::prettyTime($val['date_created']);
			   $feed_data['aaData'][]=array(			
			     $val['invoice_number'],			     
			     stripslashes($val['merchant_name'])."<br/>".$new,			     
			     FunctionsV3::prettyInvoiceTerms($val['invoice_terms']),			     
			     FunctionsV3::prettyDate($val['date_from'])." - ".FunctionsV3::prettyDate($val['date_to']),
			     FunctionsV3::prettyPrice($val['invoice_total']),
			     $date_created."<br/><span class=\"tag $val[payment_status]\">".$val['payment_status']."</span>",
			     $action
			   );
					
			}										
						
			$this->otableOutput($feed_data);	
		}
	    $this->otableNodata();
	}	
	
	public function saveCODSettings()
	{		
		$merchant_id=Yii::app()->functions->getMerchantID();
    	
    	Yii::app()->functions->updateOption("merchant_disabled_cod",
    	isset($this->data['merchant_disabled_cod'])?$this->data['merchant_disabled_cod']:'',$merchant_id);

    	$this->code=1;
	    $this->msg=Yii::t("default","Settings saved.");    
	}
	
	public function saveOfflineSettings()
	{		
		$merchant_id=Yii::app()->functions->getMerchantID();
		    
    	Yii::app()->functions->updateOption("merchant_disabled_ccr",
    	isset($this->data['merchant_disabled_ccr'])?$this->data['merchant_disabled_ccr']:'',$merchant_id);

    	$this->code=1;
	    $this->msg=Yii::t("default","Settings saved.");    
	}

	public function AdminVoguepaySettings()
	{
		Yii::app()->functions->updateOptionAdmin("admin_vog_enabled",
	    isset($this->data['admin_vog_enabled'])?$this->data['admin_vog_enabled']:'');
	    
	    Yii::app()->functions->updateOptionAdmin("admin_vog_merchant_id",
	    isset($this->data['admin_vog_merchant_id'])?$this->data['admin_vog_merchant_id']:'');
	    
	    $this->code=1;
		$this->msg=Yii::t("default","Settings saved.");
	}
	
	public function MerchantVoguepaySettings()
	{
		$merchant_id=Yii::app()->functions->getMerchantID();
    	
    	Yii::app()->functions->updateOption("merchant_vog_enabled",
    	isset($this->data['merchant_vog_enabled'])?$this->data['merchant_vog_enabled']:'',$merchant_id);
    	
    	Yii::app()->functions->updateOption("merchant_vog_merchant_id",
    	isset($this->data['merchant_vog_merchant_id'])?$this->data['merchant_vog_merchant_id']:'',$merchant_id);

    	$this->code=1;
	    $this->msg=Yii::t("default","Settings saved.");    
	}
	
} /*END CLASS*/