<table class="table table-bordered datatable" id="table_export"> 
                <thead>
                    <tr> 
                        <th>#</th> 
                        <th><div><?php echo get_phrase('room_no');?></div></th>
                        <th><div><?php echo get_phrase('whom_staying');?></div></th>
                        <th><div><?php echo get_phrase('room');?></div></th>
                        <th><div><?php echo get_phrase('water');?></div></th>
                        <th><div><?php echo get_phrase('electrict');?></div></th>
                        <th><div><?php echo get_phrase('paid');?></div></th>
                        <th><div><?php echo get_phrase('date');?></div></th>
                        <th><div><?php echo get_phrase('options');?></div></th> 
                     </tr>
                </thead>
                
                <tbody>
                
                <?php $count = 1;foreach($invoices_history as $r): 
				?>  
            
                	<tr>
                    	<td align="center"><?php echo $count++;?></td>  
                        <td align="center"><?php echo $r['name'];?></td>
                       <td><?php echo $r['staying_name'];?></td>
                        <td align="right"><?php echo number_format($r['room_amount'],0);?> USD</td>
                        <td align="right"><?php echo number_format($r['water_amount'],0);?> Riels</td>
                        <td align="right"><?php echo number_format($r['elect_amount'],0);?> Riels</td> 
                        <td><button class="btn btn-<?php echo ($r['is_paid']=='paid'?'success':'danger');?> btn-xs"><?php echo $r['is_paid'];?></button></td>
                        <td><?php echo date("d M, Y", strtotime($r['invoice_date']));?></td>
                        <td align="center">
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accounting/modal_view_invoice/<?php echo $r['invoice_id'];?>');" class="btn btn-default">
                                    View Invoice					            	</a>
                        </td>
                    </tr> 
                    <?php endforeach;?>
                    
                  </tbody>
                </table> 