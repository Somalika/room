
 
<select id="building_id" name="building_id" class="form-control pull-left" style="width:220px;" onchange="get_building(this.value)">
    <option value="">Select building</option>
    <?php 
        $sql = "
            select * from building
        ";
        $result = $this->db->query($sql)->result_array(); 
        foreach($result as $row){
			if($row["building_id"] == $this->uri->segment(3)){
				$selected = " selected";
			}else{
				$selected = " ";
			}
    ?>
    <option value="<?php echo $row["building_id"] ?>" <?php echo $selected;?>><?php echo $row["name"] ?></option>
    <?php }?>
                                                
</select>  

<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/staying/staying_add/<?php echo $this->uri->segment(3)?>');" 
	class="btn btn-primary pull-right">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('add_new_staying');?>
</a> 
<br><br><br>

<div class="row">
	<div class="col-md-12">
	
		<div class="tabs-vertical-env">
		
			<ul class="nav tabs-vertical">
			<?php 
				$this->db->where('building_id',$this->uri->segment(3));
				$room = $this->db->get('room')->result_array();
				foreach ($room as $row):
			?>
				<li class="<?php if ($row['room_id'] == $this->uri->segment(4)) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php?admin/staying/<?php echo $this->uri->segment(3)?>/<?php echo $row['room_id'];?>">
						<i class="entypo-dot"></i>
						<?php echo get_phrase('room');?> <?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>

			<div class="tab-content"> 
		
			<div class="col-md-6">
				<h4 class="modal-title">Profiles</h4>
					<table class="table table-bordered responsive"> 
						<tbody>

						<?php
							$count    = 1;
							$sql = "select * from room r 
							inner join staying s on s.room_id = r.room_id AND s.type_id !=5 
							left join `type` t on t.type_id = s.type_id where s.room_id = ?";
							$stayings = $this->db->query($sql , array($this->uri->segment(4) ))->result_array();
							foreach ($stayings as $row):
						?>
							<tr> 
								<td width="100px">Staying Name	</td>
								<td><?php echo $row['staying_name'];?></td> 
							</tr>  
							<tr> 
								<td width="100px">Date In</td>
								<td><?php echo $row['date_in'];?></td> 
							</tr>   
							<tr> 
								<td width="100px">Phone</td> 
								<td><?php echo $row['phone'];?></td>  
							</tr>     
							<tr> 
								<td width="100px">Type</td>  
								<td>
                                    <?php if($row["type_id"]==6){ // tobe leave ?>
                                    <strong style="color:red"><?php echo $row['type_name'].": ".$row['date_in'];?>
                                    <?php } else if($row["type_id"]==3){  //staying ?>
                                        <strong style="color:blue"><?php echo $row['type_name'];?>
                                    <?php }
                                    else if($row["type_id"]==4){ //tobe stay ?>
                                        <strong style="color:orange">
                                    <?php
                                        echo $row['type_name'].": ".$row['date_in']; } ?>

                                    </strong>
                                </td>
							</tr>     
							<tr> 
								<td width="100px">Persons</td>  
								<td><?php echo $row['type_name'];?></td>  
							</tr>     
							<tr> 
								<td width="100px">Next Paid</td>  
								<td><?php echo $row['next_paid_date'];?></td>  
							</tr>  
							<tr> 
								<td colspan="2" style="text-align:right">
								<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/staying/staying_edit/<?php echo $row['staying_id'];?>/<?php echo $this->uri->segment(3);?>');">
									<i class="entypo-pencil"></i>
										<?php echo get_phrase('edit');?>
									</a>
								</td>  
							</tr>
						<?php endforeach;?>
							
						</tbody>
					</table> 
			</div>
			<div class="col-md-6">
				<h4 class="modal-title">Usage</h4>
					<table class="table table-bordered responsive"> 
						<tbody>

						<?php
							$count    = 1;
							$sql = "select * from  invoice inv 
                            inner join invoice_detail ind on ind.invoice_id = inv.invoice_id
                            inner join room r on inv.room_id = r.room_id
							inner join staying s on s.room_id = r.room_id and s.type_id != 5
							left join `type` t on t.type_id = s.type_id where s.room_id = ? and inv.is_paid = 'unpaid'";
							$stayings = $this->db->query($sql , array($this->uri->segment(4) ))->row();
						?>
							<tr> 
								<td width="150px">Room Price</td>
								<td><?php echo $stayings->amount;?> USD</td>
							</tr> 
							<tr> 
								<td width="150px">
								Water Price<br />
                                    <?php echo $stayings->water_new?>Kh - <?php echo $stayings->water_old?>Kh = <?php echo $row['water_usage']?>Kh
								</td>
								<td> <?php echo $stayings->water_usage?>Kh x <?php echo $stayings->water_price?> Riels = <?php echo $stayings->total_water_price;?> Riels</td>
							</tr> 
							<tr> 
								<td width="150px">Elect Price
								<br />
                                    <?php echo $stayings->elect_new?>Km3 - <?php echo $stayings->elect_old?>Km3 = <?php echo $stayings->elect_usage?>Km3
								</td>
								<td><?php echo $stayings->elect_usage?>Kh x <?php echo $stayings->elect_price?> Riels =<?php echo $stayings->total_elect_price;?> Riels</td>
							</tr> 
							<tr> 
								<td width="150px">Paid Date</td>
								<td><?php echo $stayings->next_paid_date;?></td> 
							</tr> 
							<tr> 
								<td width="150px">Next Paid</td>
								<td><?php echo $stayings->next_paid_date;?></td> 
							</tr>
							
						</tbody>
					</table> 
			</div>
			<div class="clear"></div>
			<div class="col-md-12">
				<h4 class="modal-title">Staying History</h4>
				 
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase('staying_name');?></th>
								<th><?php echo get_phrase('date_in');?></th> 
								<th><?php echo get_phrase('date_out');?></th> 
								<th><?php echo get_phrase('next_paid');?></th> 
								<th><?php echo get_phrase('phone');?></th> 
								<th><?php echo get_phrase('type');?></th> 
								<th><?php echo get_phrase('amount');?></th> 
								<!--th>< ?php echo get_phrase('options');?></th-->
							</tr>
						</thead>
						<tbody>

						<?php
							$count    = 1;
							$sql = "select * from room r 
                                inner join staying s on s.room_id = r.room_id
                                left join `type` t on t.type_id = s.type_id where s.room_id = ? order by s.staying_id desc
							";
							$stayings = $this->db->query($sql , array($this->uri->segment(4) ))->result_array();
							foreach ($stayings as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['staying_name'];?></td>
								<td><?php echo $row['date_in'];?></td>
								<td><?php echo $row['date_out'];?></td>
								<td><?php echo $row['next_paid_date'];?></td> 
								<td><?php echo $row['phone'];?></td> 
								<td><?php echo $row['type_name'];?></td> 
								<td><?php echo $row['amount'];?> USD</td>
							</tr>
						<?php endforeach;?>
							
						</tbody>
					</table> 
					
				</div>

			</div>
			
		</div>	
	
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">


	function get_building(building_id) {
        location.href = '<?php echo base_url();?>index.php?admin/staying/' + $('#building_id').val() 
		
    }  


	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script> 