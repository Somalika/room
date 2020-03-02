<hr />  
<span class="pull-left" style=" margin-left:22%; margin-top:6px;"/>Date Entry : </span>
<input type="text" class="form-control datepicker fill-up pull-left" placeholder="from" style="width:200px; margin-left:1%"/> 
<span class="pull-left" style=" margin-left:1%; margin-top:6px;"/>-</span>
<input type="text" class="form-control datepicker fill-up pull-left" placeholder="to" style="width:200px; margin-left:1%"/> 
    
    
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/room/room_add/');" 
	class="btn btn-primary pull-right">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('save');?>
</a> 
<br><br><br>
<div class="row">
	<div class="col-md-12">
	
		<div class="tabs-vertical-env">
		
			<ul class="nav tabs-vertical">
			<?php 
				$building = $this->db->get('building')->result_array();
				foreach ($building as $row):
			?>
				<li class="<?php if ($row['building_id'] == $building_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php?admin/usage_bundle/<?php echo $row['building_id'];?>">
						<i class="entypo-dot"></i>
						<?php echo get_phrase('building');?> <?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>
			
			<div class="tab-content">

				<div class="tab-pane active">
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase('room_name');?></th>
								<th><?php echo get_phrase('Staying Name');?></th> 
								<th><?php echo get_phrase('staying_date');?></th> 
								<th><?php echo get_phrase('old_water');?></th> 
								<th><?php echo get_phrase('new_water');?></th> 
								<th><?php echo get_phrase('old_elect');?></th> 
								<th><?php echo get_phrase('new_elect');?></th>
							</tr>
						</thead>
						<tbody>

						<?php
							$count    = 1;
							
							$sql = "
									select 
										r.name,r.room_id, 
										s.staying_name, 
										r.amount,
										s.date_in,
										s.paid_date,
										s.next_paid_date,
										new_usage
									from room r 
									inner join staying s on s.room_id = r.room_id 
									inner join `usage` u on u.room_id = s.room_id
									where r.building_id = ?
									and u.status = 0
									and u.type_id = 2
								";
							$rooms = $this->db->query($sql,array($building_id))->result_array();
							foreach ($rooms as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['staying_name'];?></td> 
								<td><?php echo $row['date_in'];?></td> 
                                
								<td align="center"><?php echo $row['new_usage'];?></td> 
								<td align="center"><input type="number"  style="width:70px;"/></td> 
								<td align="center">0</td> 
								<td align="center"><input type="number" style="width:70px;"/></td>
							</tr>
						<?php endforeach;?>
							
						</tbody>
					</table>
				</div>

			</div>
			
		</div>	
	
	</div>
</div>