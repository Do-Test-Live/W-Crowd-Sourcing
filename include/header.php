<div class="nav-header">
    <a href="Dashboard" class="brand-logo">
        <img src="images/logo.png" class="image-fluid head-logo">
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-toggle="dropdown">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6001 4.3008V1.4C12.6001 0.627199 13.2273 0 14.0001 0C14.7715 0 15.4001 0.627199 15.4001 1.4V4.3008C17.4805 4.6004 19.4251 5.56639 20.9287 7.06999C22.7669 8.90819 23.8001 11.4016 23.8001 14V19.2696L24.9327 21.5348C25.4745 22.6198 25.4171 23.9078 24.7787 24.9396C24.1417 25.9714 23.0147 26.6 21.8023 26.6H15.4001C15.4001 27.3728 14.7715 28 14.0001 28C13.2273 28 12.6001 27.3728 12.6001 26.6H6.19791C4.98411 26.6 3.85714 25.9714 3.22014 24.9396C2.58174 23.9078 2.52433 22.6198 3.06753 21.5348L4.20011 19.2696V14C4.20011 11.4016 5.23194 8.90819 7.07013 7.06999C8.57513 5.56639 10.5183 4.6004 12.6001 4.3008ZM14.0001 6.99998C12.1423 6.99998 10.3629 7.73779 9.04973 9.05099C7.73653 10.3628 7.00011 12.1436 7.00011 14V19.6C7.00011 19.817 6.94833 20.0312 6.85173 20.2258C6.85173 20.2258 6.22871 21.4718 5.57072 22.7864C5.46292 23.0034 5.47412 23.2624 5.60152 23.4682C5.72892 23.674 5.95431 23.8 6.19791 23.8H21.8023C22.0445 23.8 22.2699 23.674 22.3973 23.4682C22.5247 23.2624 22.5359 23.0034 22.4281 22.7864C21.7701 21.4718 21.1471 20.2258 21.1471 20.2258C21.0505 20.0312 21.0001 19.817 21.0001 19.6V14C21.0001 12.1436 20.2623 10.3628 18.9491 9.05099C17.6359 7.73779 15.8565 6.99998 14.0001 6.99998Z" fill="#3E4954"></path>
                            </svg>
                            <?php
                            $alert = $db_handle->runQuery("SELECT COUNT(n.question_id) as no from notification as n, answer as a where n.user_id = a.user_id and n.question_id != a.question_id and n.user_id = '$userid';");
                            $no = $alert[0]['no'];
                            ?>
                            <span class="badge light text-white bg-primary rounded-circle"><?php echo $no;?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380 ps">
                                <ul class="timeline">
                                    <?php
                                    $fetch_notification = $db_handle->runQuery("select * from question,notification where notification.user_id = '$userid' and question.question_id = notification.question_id");
                                    $no_fetch_notification = $db_handle->numRows("select * from question,notification where notification.user_id = '$userid' and question.question_id = notification.question_id");
                                    for($i = 0; $i < $no_fetch_notification; $i++){
                                        ?>
                                        <li>
                                            <a href="#">
                                                <div class="timeline-panel">
                                                    <div class="media-body">
                                                        <h6 class="mb-1">A new question "<?php echo $fetch_notification[$i]['question'];?>" is submitted. Hurry to answer the question.</h6>
                                                        <?php
                                                        $date = date_create($fetch_notification[$i]["inserted_at"]);
                                                        $date_formatted = date_format($date, "d F y, g:i A");
                                                        ?>
                                                        <small class="d-block"><?php echo $date_formatted; ?></small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                            <a class="all-notification" href="javascript:void(0)">See all notifications <i class="ti-arrow-right"></i></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                            <div class="header-info">
                                <?php
                                $user = $db_handle->runQuery("select * from user where user_id = '$userid'");
                                $data = $db_handle->numRows("select * from user where user_id = '$userid'");
                                ?>
                                <span class="text-black">Hello,<strong><?php echo $user[0]['user_name'];?></strong></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="logout.php" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>