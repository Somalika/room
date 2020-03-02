<?php 
$edit_data		=	$this->db->get_where('usage' , array('usage_id' => $param2) )->row();

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_entry');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/entry/do_update/'.$edit_data->usage_id , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                    <div class="padded">
                        <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Building');?></label>
                        
						<div class="col-sm-5">
							<select name="building_id" class="form-control" onchange="return get_building(this.value)">
                                <option value="">Select building</option>
                                <?php 
                                    $sql = "
                                        select * from building where status =1
                                    ";
                                    $result = $this->db->query($sql)->result_array(); 
                                    foreach($result as $row){
                                        $sel_build = $edit_data->building_id == $row["building_id"]?' selected':'';
                                ?>
                                <option value="<?php echo $row["building_id"] ?>" <?php echo $sel_build;?>><?php echo $row["name"] ?></option>
                                <?php }?>
                                                                                
                            </select> 
						</div> 
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label>
                        
						<div class="col-sm-5">
							<select name="room_id" class="form-control" style="width:100%;" id="room_selection_holder"  onchange="return get_old_usage(this.value)">
                                <option value="">Select room First</option>
                                <?php
                                $sqlr = "
                                        select * from room where status =1 and building_id = ?
                                    ";
                                $r_room = $this->db->query($sqlr,array($edit_data->building_id ))->result_array();
                                foreach($r_room as $row){
                                    $sel_room = $edit_data->room_id == $row["room_id"]?' selected':'';
                                    ?>
                                    <option value="<?php echo $row["room_id"] ?>" <?php echo $sel_room;?>><?php echo $row["name"] ?></option>
                                <?php }?>
                            </select>
						</div> 
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<select name="type_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                                <?php
                                $sql = "
                                        select * from type where type_id in(7,8)
                                    ";
                                $r_type = $this->db->query($sql)->result_array();

                                foreach($r_type as $row){
                                    $selected = $edit_data->type_id == $row["type_id"]?' selected':'';
                                    ?>
                                    <option value="<?php echo $row["type_id"] ?>" <?php echo $selected;?>><?php echo $row["type_name"] ?></option>
                                <?php }?>
								 
                          </select>
						</div> 
					</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('old_usage');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="old_usage" value="<?php echo $edit_data->old_usage;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('new_usage');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="new_usage" value="<?php echo $edit_data->new_usage;?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-5">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_usage');?></button>
                      </div>
                    </div>
                    </form> 
            </div>
        </div>
    </div>
</div>


