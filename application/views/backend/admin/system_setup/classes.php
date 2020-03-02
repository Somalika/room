<div class="box">
	<div id="tab_div" class="box-header">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('class_list');?>
                </a>
            </li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_class');?>
               	</a>
            </li>
		</ul>
    	<!--CONTROL TABS END-->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('class_names');?></div></th>
                    		<th><div><?php echo get_phrase('Prize');?></div></th> 
                    		<th><div><?php echo get_phrase('Branch Id');?></div></th> 
                    		<th><div><?php echo get_phrase('Schedule');?></div></th> 
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($classes as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td align="center">USD <?php echo number_format($row['price'],0);?> </td>
							<td align="center"><?php echo $row['brand_name'];?> </td>
							<td align="center"><?php echo $row['time'];?> </td>
							<td align="center">
                            	<a href="#" onclick="editClass('<?php echo base_url();?>index.php?admin/classes/edit',<?php echo $row['class_id'];?>)" class="btn btn-gray btn-small">
                                	<i class="icon-wrench"></i> <?php echo get_phrase('edit');?>
                                </a>
                            	<a href="#" onclick="deleteClass('<?php echo base_url();?>index.php?admin/classes/delete/<?php echo $row['class_id'];?>')" class="btn btn-red btn-small">
                                	<i class="icon-trash"></i> <?php echo get_phrase('delete');?>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!--TABLE LISTING ENDS-->
            
            
			<!--CREATION FORM STARTS-->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">  
                        <form  id="frmClass" class="form-horizontal validatable"> 
                        
                        	<input type="hidden" id="class_id" name="class_id" />
                         
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class_names');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="validate[required]" id="name" name="name"/>
                                </div>
                            </div> 
                            <div class="form-group"> 
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Prize');?></label>
                                <div class="col-sm-5">
                                <input type="text" class="validate[required]" id="price" name="price"/>
                                
                                    <!--select id="room_source" name="room_source" class="uniform" style="width:105px;"  size="10" >
                                    <?php 
									$room = $this->db->get('room')->result_array();
									foreach($room as $row):
									?>
                                    	<option value="<?php echo $row['id'];?>"><?php echo $row['room_number'];?></option>
                                    <?php
									endforeach;
									?>
                                    </select>
									
									<input type="button" value=">" onclick="addremoveitem(1);"/> 
									<input type="button" value="<" onclick="addremoveitem(2);"/> 
									
									<select id="room_target" name="room_target[]" class="uniform" style="width:105px;" size="10" multiple> 
                                    	
                                    </select-->
                                </div>
                            </div>
                            <!-- admin only --> 
                            <div class="form-group"> 
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Schedule');?></label>
                                <div class="col-sm-5">
                                <select id="schedule" name="schedule" class="validate[required]">
									<?php 
                                        $this->db->select('id, time');
                                        $times = $this->db->get_where('times', array('active' => 1))->result_array();  
                                        foreach($times as $row):
                                        ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['time'];?></option>
                                        <?php
                                        endforeach;
                                    ?>
                                </select> 
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Branch');?></label>
                                <div class="col-sm-5"> 
                                
                                <select id="brand_name" name="brand_name" class="validate[required]">
									<?php  
									
										$user_id = $this->session->userdata('user_id');
									
										if(	$user_id ==1 || // sys
											$user_id == 2 || // admin
											$user_id ==4){ // admin
											 $user_id = "";
										}
										
										
									
                                        $sql = 'select 
													b.id,
													b.brand_name 
												from brand b 
												inner join user u on u.BRAND_ID = b.id
												where /*(u.USER_ID = ? or  "" = ?)
												and*/ b.status = 1
												
												group by b.id'; 
										
                                        $brand_name = $this->db->query($sql/*, array($user_id,$user_id,1)*/)->result_array();  
                                        foreach($brand_name as $b):
                                        ?>
                                            <option value="<?php echo $b['id'];?>"><?php echo $b['brand_name'];?></option>
                                        <?php
                                        endforeach;
                                    ?>
                                </select> 
                                </div>
                         </div> 
                        <div class="form-actions"><center>
                            <button type="button" id="btnUpdate" class="btn btn-gray" style="display:none"><?php echo get_phrase('Update');?></button>
                            <button type="button" id="btnCreateClass" class="btn btn-gray"><?php echo get_phrase('add_class');?></button></center>
                        </div>    
                        
                        <input type="hidden" id="authenticity_token" name="authenticity_token" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        
                        </form>      
                </div>                
			</div>

			<!--CREATION FORM ENDS-->
            
		</div>
	</div>
</div>

<script type="text/javascript">

	$( document ).ready(function() {  
	 
			$('#btnCreateClass').click(function(){
				$.ajax({
					url: "<?php echo base_url();?>index.php?admin/classes/create",
					type: "POST",
					data: {
						'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
						brand_name: $('#brand_name').val(),
						schedule: $('#schedule').val(),
						price: $('#price').val(),
						name: $('#name').val(), 
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
			});
			
			
		$("#btnUpdate").click(function(){  
		 	$("#btnUpdate").prop('disabled', true);  
			 $.ajax({
                url: "<?php echo base_url();?>index.php?admin/classes/do_update",
                type: 'post',
                dataType: 'json',
                data:$('#frmClass').serialize(),
                success: function(data) { 
                    if(data.data=='success'){
						window.location.reload(-1);
					}
                }
        	}); 
		});
	
	
	});
		/* type:
		 * 1: assign room to class
		 * 2: remove room from class
		*/
		function addremoveitem(type){   
		
			var val = $("#room_source").val();
			var val_t = $("#room_target").val();
			 
			// checking the value both source and target is empty value
			if(val!=null || (val_t!=null)){
				switch(type){
					case 1:
						var val = $("#room_source option:selected").val(); 
						var text = $("#room_source option:selected").text();
						// remove item
						$("#room_source option:selected").remove();  
						// add item
						$("#room_target").append('<option value="'+val+'">'+text+'</option>');
						$("#room_target option").prop("selected",true);
						break;
					case 2:
						var val = $("#room_target option:selected").val(); 
						var text = $("#room_target option:selected").text();
						// remove item
						$("#room_target option:selected").remove();  
						// add item
						$("#room_source").append('<option value="'+val+' selected">'+text+'</option>');
						$("#room_target option").prop("selected",true);
						break;
				}
			}
		} 
		
	/* edit class
	*/
	function editClass(BaseUrl,class_id){
		if(!confirm("Are you sure you want to edit this class?")){ 
			return false;
		}
		
		showTab(1,'add','list');
		showTab(1,'add','add'); 
		
		$.ajax({
			url: BaseUrl ,
			type: "POST",
			data: {
				'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
				class_id : class_id
			},
			dataType: "json", 
			cache: false,
			success: function(data){
				
				$('#btnUpdate').css('display','');
				$('#btnCreateClass').css('display','none'); 
				
				$('#class_id').val(data.data[0].class_id);
				$('#name').val(data.data[0].name);
				$('#price').val(data.data[0].price); 
				$('#schedule').val(data.data[0].schedule_id); 
				$('#brand_name').val(data.data[0].branch_id); 
			},
			error:function(){
				alert("failure");
			}   
		});
	}
	
	function deleteClass(url){
		if(!confirm("Are you sure you want to delete this class?")){ 
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
