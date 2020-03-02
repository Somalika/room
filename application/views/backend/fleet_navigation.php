<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:60px;"/>
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
        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- fleet menagement -->
        <li>
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('vehicle_fleet'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'vehicle') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/vehicle">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('vehicle_menagement'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('reminder'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('work_order'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('driver_management'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('fuel_log'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('completed_service'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('deliveries'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('tire_log'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('incomes'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('note'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('vehicle_group'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('parts_inventory'); ?></span>
            </a>
            <ul>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('orders_inventory'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('parts_inventory'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#">
                <i class="entypo-suitcase"></i>
                <span><?php echo get_phrase('configuration'); ?></span>
            </a>
            <ul>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('my_fuel_tanks'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('master_service'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('model'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('make'); ?></span>
                    </a>
                </li>
                <!-- Contacting -->
                <li class="<?php if ($page_name == 'contacting') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type;?>/contacting">
                        <i class="entypo-gauge"></i>
                        <span><?php echo get_phrase('fuel_card'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
         
    </ul>

</div>