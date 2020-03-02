<div class="box">
	<div class="box-header">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('room_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_room');?>
                    	</a></li>
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
                    		<th><div><?php echo get_phrase('room_number');?></div></th>
                    		<th><div><?php echo get_phrase('floor');?></div></th> 
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($room as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['room_number'];?></td>
							<td><?php echo $this->crud_model->get_floor_description_by_id('floor',$row['floor_id'], 'description');?></td>
							<td align="center">
                            	<a data-toggle="modal" href="#modal-form" onclick="modal('edit_room',<?php echo $row['id'];?>)" class="btn btn-gray btn-small">
                                		<i class="icon-wrench"></i> <?php echo get_phrase('edit');?>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/room/delete/<?php echo $row['id'];?>')" class="btn btn-red btn-small">
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
                	<?php echo form_open(base_url().'index.php?admin/room/create' , array('class' => 'form-horizontal validatable','target'=>'_top'));?> 
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('room_number');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="validate[required]" name="room_number"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('floor');?></label>
                                <div class="col-sm-5">
                                    <select name="floor_id" class="uniform" style="width:100%;">
                                        <option value=""></option>
                                    	<?php 
										$floor = $this->db->get('floor')->result_array();
										foreach($floor as $row):
										?>
                                    		<option value="<?php echo $row['id'];?>"><?php echo $row['description'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('is_hidden');?></label>
                                <div class="col-sm-5">
                                    <input type="checkbox" value="1" name="status"/>
                                </div>
                            </div> 
                            
                        <div class="form-actions"><center>
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_room');?></button></center>
                        </div>
                    </form>                
                </div>                
			</div>
			<!--CREATION FORM ENDS-->
		</div>
	</div>
</div>