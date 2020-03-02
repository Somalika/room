
<style>
	.lv{
		color:blue;
	}
	.card{
		margin-left:5%; 
		width:350px; 
		border-radius: 3px 3px; 
		margin-bottom:10px; 
		padding:5px; 
		border:1px solid #666; 
		color:black;
	}
	.labels{
		padding:5px 20px; width:50%; float:left; border:0px solid #EEE;
	}
</style> 
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary" data-collapsed="0" style="padding:5px;"> 
                <div class="labels"><label>Renter name</label>: <span class="lv"><?php echo $stay_info->staying_name;?></span></div>  
                <div class="labels"><label>Job </label>: <span class="lv"><?php echo $stay_info->job;?></span></div>  
                <div class="labels"><label>Phone number</label>: <span class="lv"><?php echo $stay_info->phone;?></span></div> 
                <div class="labels"><label>ID Card</label>: <span class="lv"><?php echo $stay_info->id_card;?></span></div>  
                <div class="labels"><label>Date In</label>: <span class="lv"><?php echo $stay_info->date_in;?></span></div> 
                <div class="labels"><label>Person Number</label>: <span class="lv"><?php echo $stay_info->number_person;?></div>  
                <div style="clear:both"></div>
            </div> 
           
        	<div class="panel panel-primary" data-collapsed="0" style="padding:5px;"> 
                
                <div class="labels"><label style="width:100px;">Old Water</label>: <span class="lv"><?php echo $water_usage->old_usage;?></span></div>  
                <div class="labels"><label style="width:100px;">Date Entry</label>: <span class="lv"><?php echo $water_usage->date_entry;?></span></div> 
                <div class="labels"><label style="width:100px;">New Water</label>: <span class="lv"><?php echo $water_usage->new_usage;?></span></div>  
                <div class="labels"><label style="width:100px;">Paid date</label>: <span class="lv"><?php echo $water_usage->paid_date;?></span></div> 
                <div class="labels"><label style="width:100px;">Usage</label>: <span class="lv"><?php echo $water_usage->usage_amount;?></span></div>     
                <div class="labels">
                <a class="btn btn-info" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accounting/new_entry/<?php echo $filter_data;?>/1/<?php echo $stay_info->room_id;?>/<?php echo $water_usage->new_usage;?>/<?php echo $stay_info->id;?>');"><?php echo get_phrase('new_entry');?></a></div>    
                
                <hr style="clear:both"/>
               <div class="labels"><label style="width:100px;">Old Water</label>: <span class="lv"><?php echo $elect_usage->old_usage;?></span></div>  
                <div class="labels"><label style="width:100px;">Date Entry</label>: <span class="lv"><?php echo $elect_usage->date_entry;?></span></div> 
                <div class="labels"><label style="width:100px;">New Water</label>: <span class="lv"><?php echo $elect_usage->new_usage;?></span></div>  
                <div class="labels"><label style="width:100px;">Paid date</label>: <span class="lv"><?php echo $elect_usage->paid_date;?></span></div> 
                <div class="labels"><label style="width:100px;">Usage</label>: <span class="lv"><?php echo $elect_usage->usage_amount;?></span></div>       
                <div class="labels">
                 <a class="btn btn-info" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accounting/new_entry/<?php echo $filter_data;?>/2/<?php echo $stay_info->room_id;?>/<?php echo $elect_usage->new_usage;?>/<?php echo $stay_info->id;?>');"><?php echo get_phrase('new_entry');?></a></div> 
                <div style="clear:both"></div>
            
          </div>  
    </div>
	<div class="col-md-6">
    
    	<div class="panel panel-primary" data-collapsed="0" style="padding:15px;">
			 	<?php
					$total_w = $water_usage->usage_amount*2000;
					$total_e = $elect_usage->usage_amount*1500;
                ?>
                <div><label style="width:290px;">Room payment (60 USD)</label>: <span class="lv">Paid</span></div>  
                <div><label style="width:290px;">Water payment (<?php echo $total_w;?> Riels)</label>: 
                	<span class="lv">
						<?php if($total_w>0){?>
                            <a href="#" onClick="onPaid(1);">un-Paid</a>
                        <?php } else{ echo 'paid'; }?>
                    </span></div>  
                <div><label style="width:290px;">Elect payment (<?php echo $total_e;?>  Riels)</label>:  
                	<span class="lv">
						<?php if($total_e>0){?>
                            <a href="#" onClick="onPaid(2);">un-Paid</a>
                        <?php } else{ echo 'paid'; }?>
                    </span></div>    
                <div><label style="width:300px;">All-in-one (60 USD, <?php echo $total_e;?> Riels, <?php echo $total_w;?> Riels)</label>: 
                	<span class="lv">
						<?php if($total_w>0 || $total_w > 0 || $total_e){?>
                            <a href="#" onClick="onPaid(3);">un-Paid</a>
						<?php } else{ echo 'paid'; }?></span></div> 
            	<div style="clear:both"></div>
          </div> 
          
          
          <div class="panel panel-primary" data-collapsed="0" style="padding:5px;"> 
            	<div class="panel-title"> 
					Payment history
            	</div>
                <br /> 
                <div> 
                    <table class="table table-bordered datatable"> 
                    	<thead>
                        	<tr>  
                            	<th>old</th>
                            	<th>new</th>
                            	<th>usage</th>
                            	<th>from</th>
                            	<th>to</th>
                            	<th>Room</th>
                            	<th>type</th>
                            	<th>paid date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1;foreach($payment_trans_data as $row){?>
                            <tr> 
                            	<td><?php echo $row["old_usage"];?></td>
                            	<td><?php echo $row["new_usage"];?></td>
                            	<td><?php echo $row["usage_amount"];?></td>
                            	<td><?php echo $row["date_from"];?></td>
                            	<td><?php echo $row["date_to"];?></td>
                            	<td><?php echo $row["amount"];?></td>
                            	<td><?php echo $row["type_name"];?></td>
                            	<td><?php echo $row["paid_date"];?></td>
                            </tr>
                		<?php } ?> 
                        </tbody>
                    </table>
				</div> 
                  
            
          </div>
	</div> 
    
</div>

<script>
	function onPaid(id){
		
		s
		console.log(id);
	}
</script>
       
     