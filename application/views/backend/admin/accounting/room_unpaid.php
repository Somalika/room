<table class="table table-bordered datatable" id="table_export"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th><div><?php echo get_phrase('room_no');?></div></th>
                    <th style="width: 300px;"><div><?php echo get_phrase('whom_staying');?></div></th>
                    <th><div><?php echo get_phrase('room_price');?></div></th>
                    <th><div><?php echo get_phrase('water');?></div></th>
                    <th><div><?php echo get_phrase('electrict');?></div></th>
                    <th><div><?php echo get_phrase('paid');?></div></th>
                    <th><div><?php echo get_phrase('date');?></div></th>
                    <th><div><?php echo get_phrase('options');?></div></th>
                </tr>
            </thead>
            
            <tbody>
            
             <?php $count = 1;foreach($invoices as $row):?>  
            
                <tr>
                    <td align="center"><?php echo $count++;?></td>
                    <td align="center"><?php echo $row['name'];?></td>
                    <td><?php echo $row['staying_name'];?></td>
                    <td align="right"><?php echo number_format($row['room_amount'],0);?> USD</td>
                    <td align="right">
                        <?php
                            echo $row['water_new']." - ".$row['water_old']." = ".$row['water_usage']."<br />";
                            echo number_format($row['water_amount'],0);
                        ?>
                        Riels</td>
                    <td align="right">
                        <?php
                            echo $row['elect_new']." - ".$row['elect_old']." = ".$row['elect_usage']."<br />";
                            echo number_format($row['elect_amount'],0);
                        ?> Riels</td>
                    <td><button class="btn btn-<?php echo ($row['is_paid']=='paid'?'success':'danger');?> btn-xs"><?php echo $row['is_paid'];?></button></td>
                    <td><?php echo date("d M, Y", strtotime($row['invoice_date']));?></td>
                    <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
    
                            
                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accounting/modal_take_payment/<?php echo $row['room_id'];?>');">
                                    <i class="entypo-bookmarks"></i>
                                        Take Payment                                        </a>
                            </li>
                            <li class="divider"></li>
                                                                
                            <!-- VIEWING LINK -->
                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accounting/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
                                    <i class="entypo-credit-card"></i>
                                        View Invoice                                            </a>
                                            </li>
                            <li class="divider"></li>
                            
                            <!-- EDITING LINK -->
                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accounting/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
                                    <i class="entypo-pencil"></i>
                                        Edit                                        </a>
                            </li>
                            <li class="divider"></li>
    
                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['room_id'];?>');">
                                    <i class="entypo-trash"></i>
                                        Delete                                            </a>
                                            </li>
                        </ul>
                    </div>
                    </td>
                </tr> 
                
        		<?php endforeach;?>
          </tbody>
        </table>