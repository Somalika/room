<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('enty_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_entry');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
        
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('room_name');?></div></th> 
                    		<th><div><?php echo get_phrase('old_usage');?></div></th>
                    		<th><div><?php echo get_phrase('new_usage');?></div></th>
                            <th><div><?php echo get_phrase('usage');?></div></th>
                            <th><div><?php echo get_phrase('type');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($entry as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['room_name'];?></td> 
							<td align="center"><?php echo $row['old_usage'];?></td>
							<td align="center"><?php echo $row['new_usage'];?></td>
                            <td align="center"><?php echo $row['usage_amount'];?></td>
                            <td align="center"><?php echo $row['type_name'];?></td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accounting/modal_edit_entry/<?php echo $row['usage_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/entry/delete/<?php echo $row['usage_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/entry/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                  <div class="padded">
                        <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Building');?></label>
                        
						<div class="col-sm-5">
							<select id="building_id"  name="building_id" class="form-control" onchange="return get_building(this.value)">
                                <option value="">Select building</option>
                                <?php 
                                    $sql = "
                                        select * from building where status =1
                                    ";
                                    $result = $this->db->query($sql)->result_array(); 
                                    foreach($result as $row){
                                ?>
                                <option value="<?php echo $row["building_id"] ?>"><?php echo $row["name"] ?></option>
                                <?php }?>
                                                                                
                            </select> 
						</div> 
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label>
                        
						<div class="col-sm-5">
							<select name="room_id" class="form-control" style="width:100%;" id="room_selection_holder">
                                <option value="">Select room First</option> 
                            </select>
						</div> 
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<select name="type_id" class="form-control selectboxit" onChange="onTypeChange(this.value);">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="7"> water </option>
                              <option value="8"> electricity </option>
								 
                          </select>
						</div> 
					</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('old_usage');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="old_usage" name="old_usage" readonly/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('new_usage');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="new_usage"/>
                        </div>
                    </div>  

                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-5">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('add_usage');?></button>
                      </div>
                    </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">


	function get_building(building_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_building/' + building_id ,
            success: function(response)
            {
                jQuery('#room_selection_holder').html(response);
            }
        });
    } 
	
	//
	function onTypeChange(value){
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_last_usage' ,
			type: 'POST',
			dataType:"json",
			data:{
					building_id: $('#building_id').val(),
					room_id:$('#room_selection_holder').val(),
					type_id:value
					
				},
            success: function(response)
            {	console.log(response.new_usage);
                $('#old_usage').val(response.new_usage);
            }
        });
	}

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script> 