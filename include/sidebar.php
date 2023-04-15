
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="ai-icon" href="Dashboard" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <?php if($user_type == 1){
                ?>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-heart"></i>
                        <span class="nav-text">Question</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="New-Question">Submit a Question</a></li>
                        <li><a href="My-Questions">My Questions</a></li>
                        <li><a href="Questions">Question I answered</a></li>
                    </ul>
                </li>
                <?php
            }else{
                ?>
                <li><a class="ai-icon" href="All-Questions" aria-expanded="false">
                        <i class="flaticon-381-heart"></i>
                        <span class="nav-text">Questions</span>
                    </a>
                </li>
                <li><a class="ai-icon" href="Users" aria-expanded="false">
                        <i class="flaticon-381-menu"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
                <?php
            }
            ?>

        </ul>

        <div class="copyright">
            <p><strong>Crowd Sourcing</strong> © 2023 All Rights Reserved</p>
            <p>Made with <span class="heart"></span>CROWD SOURCING</p>
        </div>
    </div>
</div>