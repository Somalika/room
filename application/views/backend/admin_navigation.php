<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        <!-- Appointment -->
        <li class="<?php if ($page_name == 'appointment') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?appointment/appointment">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('appointment'); ?></span>
            </a>
        </li>
        <!-- Reservation -->
        <li class="<?php if ($page_name == 'reservation') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?reservation/reservation">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('reservation'); ?></span>
            </a>
        </li>
        <!-- Miscellaneous -->
        <li>
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('miscellaneous'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'statationary') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?statationary/statationary">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('statationary'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Maintenance -->
        <li>
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('maintenance'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'maintenance') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?maintenance/maintenance">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('maintenance'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?contacting/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('contacting'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('billing'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'create_room_payment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?accounting/create_room_payment">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('create_room_payment'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'entry') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/entry">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('usage_entry'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'usage_bundle') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/usage_bundle">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('usage_bundle'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

                <!-- transaction -->
        <li class="<?php
        if ($page_name == 'create_room_payment' ||
                $page_name == 'entry'||
                $page_name == 'room_payment'||
                $page_name == 'usage_bundle'||
                	$page_name == 'billing' )
            			echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('accounting'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'room_payment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/room_payment">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('room_payment'); ?></span>
                    </a>
                </li>
                <!-- Payment Received -->
                <li class="<?php if ($page_name == 'payment_received') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?payment_received/payment_received">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('payment_received'); ?></span>
                    </a>
                </li>
                <!-- Deposit Slip -->
                <li class="<?php if ($page_name == 'deposit_slip') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?deposit_slip/deposit_slip">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('deposit_slip'); ?></span>
                    </a>
                </li>
                <!-- Checks -->
                <li class="<?php if ($page_name == 'check') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?check/check">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('check'); ?></span>
                    </a>
                </li>
                <!-- Credit Notice -->
                <li class="<?php if ($page_name == 'credit_notice') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?credit_notice/credit_notice">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('credit_notice'); ?></span>
                    </a>
                </li>
                <!-- Selling a Condominum -->
                <li class="<?php if ($page_name == 'selling_condominum') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?selling_condominum/selling_condominum">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('selling_condominum'); ?></span>
                    </a>
                </li>
                <!-- Payable Invoice -->
                <li class="<?php if ($page_name == 'payable_invoice') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?payable_invoice/payable_invoice">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('payable_invoice'); ?></span>
                    </a>
                </li>
                <!-- Return Check -->
                <li class="<?php if ($page_name == 'return_check') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?return_check/return_check">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('return_check'); ?></span>
                    </a>
                </li>
            </ul>
        </li> 
        
        <!-- building -->
        <li class="<?php
        if ($page_name == 'building' ||
                $page_name == 'room'||
                	$page_name == 'staying')
            			echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('building'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'building') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/building">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_building'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'room') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/room">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_rooms'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'staying') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/staying/4/1">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_staying'); ?></span>
                    </a>
                </li>
            </ul>
        </li> 
           
        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'price_list' )
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('setting'); ?></span>
            </a>
            <ul>
                <!--li class="< ?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="< ?php echo base_url(); ?>index.php?< ?php echo $account_type;?>/system_settings">
                        <span><i class="entypo-tools"></i> < ?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="< ?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="< ?php echo base_url(); ?>index.php?< ?php echo $account_type;?>/sms_settings">
                        <span><i class="entypo-mixi"></i> < ?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="< ?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="< ?php echo base_url(); ?>index.php?< ?php echo $account_type;?>/manage_language">
                        <span><i class="entypo-back-in-time"></i> < ?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li-->
                <li class="<?php if ($page_name == 'price_list') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?pricelist/pricelist">
                        <span><i class="fa fa-money"></i> <?php echo get_phrase('price_list'); ?></span>
                    </a>
                </li>
            </ul>
        </li> 
         
        
         <!-- auditrial -->
        <li class="<?php if($page_name == 'auditrial')echo 'active';?>"> 
            <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/auditrial"> 
                <i class="entypo-target"></i> 
                <span><?php echo get_phrase('auditrial');?></span>
            </a>
		</li>
         
    </ul>

</div>