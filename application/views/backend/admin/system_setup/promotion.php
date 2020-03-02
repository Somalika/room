<div class="box">
	<div id="tab_div" class="box-header">
        
        <!---CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#TestList" data-toggle="tab"><i class="icon-plus"></i> 
                   List
                </a></li> 
			<li>
            	<a href="#student_infor" data-toggle="tab"><i class="icon-plus"></i>Create Promotion</a></li> 
		</ul>
    	<!---CONTROL TABS END-->
         
    </div>

	<div class="box-content">
		<div class="tab-content">
            <!---TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="TestList">
            	<?php include_once('promotion_list.php');?>  
            </div>
            <div class="tab-pane box" id="student_infor">
              	<?php include_once('promotion_new.php');?> 
            </div>
            
      	</div>   
	</div>   

</div>
         
            
<script  type="text/javascript" language="javascript"> 
  $(document).ready(function() {
	  
	  
	// on click register test
	$('#btnSave').on('click', function(){   
			
			 
			if($('#txtPromotionName').val()==''){  
				alert('Please enter the promotion name !');
				return false;
			
			} 
			if($('#txtStartDate').val()=='' || $('#txtEndDate').val()==''){  
				alert('Please enter the date Start and End !');
				return false;
			
			} 
				// visible tabs
				$.ajax({
					url: "<?php echo base_url();?>index.php?admin/promotion/create",
					type: "POST",
					data: {
						'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
						  
						PromotionName    	: $('#txtPromotionName').val(),
						StartDate    		: formatDate($('#txtStartDate').val()), 
						EndDate    			: formatDate($('#txtEndDate').val()) , 
						NumberLimited    	: $('#txtNumberLimited').val() , 
						type    			: $('#slType').val() 
					},
					datatype: 'json',
					success: function(data){ 
							alert("Promotion have created.");  
							document.getElementById("fmPromotion").reset();
					},
					error:function(){
						alert("failure");
					}   
				});  
			
  			} 
		);
		
		
		
	  // format date
	function formatDate(dates){ 
		var arr = dates.split("/");
		return arr[2]+'-'+arr[0]+'-'+arr[1];
	}  
		
 	}); 
 </script> 