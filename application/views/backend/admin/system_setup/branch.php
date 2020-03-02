<div class="box">
	<div id="tab_div" class="box-header">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('brand_list');?>
                </a>
            </li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('new_brand');?>
                </a>
            </li>
		</ul>
    	<!--CONTROL TABS END-->
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane  active" id="list">  
                        <div class="box-content"> 
                            <table class="table table-bordered datatable" id="table_export">
                                <thead>
                                    <tr>
                                        <th width="80"><div>ID</div></th>
                                        <th><div><?php echo get_phrase('brand_name');?></div></th>
                                        <th><div><?php echo get_phrase('prefix');?></div></th> 
                                        <th><div><?php echo get_phrase('Phome');?></div></th> 
                                        <th><div><?php echo get_phrase('location');?></div></th> 
                                        <th><div><?php echo get_phrase('optional');?></div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1;foreach($brands as $row):?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $row['brand_name'];?></td>
                                        <td><?php echo $row['prefix'];?></td>
                                        <td><?php echo $row['address2'];?></td>
                                        <td><?php echo $row['address'];?></td>
                                        <td align="center">
                                            <a href="#" onclick="editBranch('<?php echo base_url();?>',<?php echo $row['id'];?>)" class="btn btn-gray btn-small">
                                                <i class="icon-wrench"></i> <?php echo get_phrase('edit');?>
                                            </a>
                                            <a href="#" onclick="deleteBranch('<?php echo base_url();?>index.php?admin/branch/delete/<?php echo $row['id'];?>')" class="btn btn-red btn-small">
                                                <i class="icon-trash"></i> <?php echo get_phrase('delete');?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table> 
                        </div>  
			</div>
            <!--TABLE LISTING ENDS-->
            
			<!--CREATION FORM STARTS-->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<form id="frmBranch" name="frmBranch" class="form-horizontal validatable">
                    	<input type="hidden" id="branch_id" name="branch_id" value="" />
                    	<input type="hidden" id="hidden_prifix" name="hidden_prifix" value="" />
                         
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('branch_name_khmer');?></label>
                                <div class="col-sm-5">
                                   <input type="text" class="validate[required]" id="brand_name_kh" name="brand_name_kh" placeholder="Khmer name"/>
                                </div>
                            </div>	
                            
                             
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('branch__name');?></label>
                                <div class="col-sm-5">
                                   <input type="text" class="validate[required]" id="brand_name" name="brand_name" placeholder="English name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('prefix');?></label>
                                <div class="col-sm-5">
                                   <input type="text" class="validate[required]" id="prefix" name="prefix" style="width:50px;" placeholder="prefix"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Cell Phone');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="validate[required]" id="cell_phone" name="cell_phone" placeholder="Cell Phone"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Office Phone');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="validate[required]" id="office_phone" name="office_phone" placeholder="Office Phone"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('full_address_khmer');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="validate[required]" id="full_address_kh" name="full_address_kh" placeholder="Khmer adress"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('full_address');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="validate[required]" id="full_address" name="full_address" placeholder="English Address"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('is active');?></label>
                                <div class="col-sm-5">
                                    <input type="checkbox" value="1" id="status" name="status" checked />
                                </div>
                            </div>
                             
                        <div class="form-actions"><center>
                            <button type="button" id="btnUpdate" class="btn btn-gray" style="display:none"><?php echo get_phrase('Update');?></button>
                            <button type="button" id="btnCreate" class="btn btn-gray"><?php echo get_phrase('save');?></button></center>
                        </div>
                        
                        
        	<input type="hidden" id="authenticity_token" name="authenticity_token" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    </form>                
                </div>                
			</div>
			<!--CREATION FORM ENDS-->
		</div>
	</div>
</div>

<script language="javascript"  type="text/javascript">
 	$(document).ready(function() {
		// create
		 $("#btnCreate").click(function(){  
		 	$("#btnCreate").prop('disabled', true);  
			 $.ajax({
                url: "<?php echo base_url();?>index.php?admin/branch/create",
                type: 'post',
                dataType: 'json',
                data:$('#frmBranch').serialize(),
                success: function(data) {
                    if(data.data=='success'){
						window.location.reload(-1);
					}
                }
        	});
		  }); 
		  
		  $("#btnUpdate").click(function(){  
		 	$("#btnUpdate").prop('disabled', true);  
			 $.ajax({
                url: "<?php echo base_url();?>index.php?admin/branch/do_update",
                type: 'post',
                dataType: 'json',
                data:$('#frmBranch').serialize(),
                success: function(data) {
                    if(data.data=='success'){
						window.location.reload(-1);
					}
                }
        	});
		  });
	});
	
	/* edit branch 
	 *
	 */
	function editBranch(baseUrl,branch_id){
		
		if(!confirm("Are you sure you want to edit this branch?")){ 
			return false;
		}
		
		showTab(1,'add','list');
		showTab(1,'add','add'); 
		
		$.ajax({
				url: baseUrl+"index.php?admin/branch/edit",
				type: "POST",
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
					branch_id : branch_id 
				},
				dataType: "json", 
				cache: false,
				success: function(data){ 
					$('#btnUpdate').css('display','');
					$('#btnCreate').css('display','none');
					
					
					$('#branch_id').val(data.data[0].id);
					$('#brand_name_kh').val(data.data[0].brand_name_kh);
					$('#brand_name').val(data.data[0].brand_name);
					$('#prefix').val(data.data[0].prefix);
					$('#hidden_prifix').val(data.data[0].prefix);
					$('#full_address_kh').val(data.data[0].address);
					$('#full_address').val(data.data[0].address1);
					$('#cell_phone').val(data.data[0].address2);
					$('#office_phone').val(data.data[0].address3);
					if(data.data[0].status==1){
						$('#status').prop('checked',true);
					}else{
						$('#status').prop('checked',false);
					} 
					  
				},
				error:function(){
					alert("failure");
				}   
			});
		
		
	}
 
 	function deleteBranch(url){ 
		if(!confirm("Are you sure you want to delete this branch?")){ 
			return false;
		}
		$.ajax({
				url: url ,
				type: "POST",
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>' 
				},
				dataType: "json", 
				cache: false,
				success: function(data){
					if(data.success='success'){
						window.location.reload(-1);
					}
				},
				error:function(){
					alert("failure");
				}   
			});
	}
	
	function showTab(tab_id,div,div1){
		
		var selector = '.nav li'; 
		$(selector).removeClass('active');
		
		$('#'+div1).removeClass('active');
		
		/* checking the register student 
		 * if studendt come for testing just only testing 
		 * else if the studend come for study or register new student 
		 * the form generated the new tabs for payment
		 * 1: testing; 2: new student
		*/  
		  var nav = document.getElementById("tab_div");
			lis = nav.getElementsByTagName("li")[tab_id];
			lis.style.visibility = "visible";  
			var nav = $('#tab_div ul li');
			
			nav.eq(tab_id).addClass("active");
			$('#'+div).addClass('active'); 
	}
 
 
</script>