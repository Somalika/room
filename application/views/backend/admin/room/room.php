<hr />
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/room/room_add/');" 
	class="btn btn-primary pull-right">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('add_new_room');?>
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
					<a href="<?php echo base_url();?>index.php?admin/room/<?php echo $row['building_id'];?>">
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
								<th style="width: 100px;"><?php echo get_phrase('Staying Name');?></th>
								<th style="width: 90px;"><?php echo get_phrase('staying_date');?></th>
                                <th><?php echo get_phrase('amount');?> (USD)</th>
                                <th><?php echo get_phrase('water_usage');?></th>
                                <th><?php echo get_phrase('elect_usage');?></th>
                                <th><?php echo get_phrase('water_price');?> (Riels)</th>
                                <th><?php echo get_phrase('elec_price');?> (Riels)</th>
								<th></th>
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
										r.water_old_usage,
										r.elect_old_usage,
										s.date_in,
										s.paid_date,
										s.next_paid_date,
										(select price_list from price_list where id = r.water_price_id) as water_price,
										(select price_list from price_list where id = r.electricity_price_id) as elec_price
										 
									from room r 							
									left join staying s on s.room_id = r.room_id and s.type_id!=5
									where r.building_id = ? 
									";
							$rooms = $this->db->query($sql,array($building_id))->result_array();
							foreach ($rooms as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['staying_name'];?></td> 
								<td><?php echo $row['date_in'];?></td>
                                
								<td align="center"><?php echo $row['amount'];?></td>
                                <td><?php echo $row['water_old_usage'];?></td>
                                <td><?php echo $row['elect_old_usage'];?></td>
                                <td><?php echo $row['water_price'];?></td>
                                <td><?php echo $row['elec_price'];?></td>
                                <td>
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/room/room_edit/<?php echo $row['room_id'];?>');">
                                        <i class="entypo-pencil"></i></a>
								</td>
							</tr>
						<?php endforeach;?>
							
						</tbody>
					</table>
				</div>

			</div>
			
		</div>	
	
	</div>
</div>