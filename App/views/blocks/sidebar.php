<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
<!--    <div class="profile-sidebar">
       <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Username</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>-->
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <?
        if ($sideBar_page["lvl1"] == "dashboard") {
            $parent_active = "active";
            $in = ($sideBar_page["lvl2"]) ? "in" : null;
        } else {
            $parent_active = null;
            $in = null;
        }
        ?>
        <li class="parent <? echo $parent_active; ?>"><a href="/main"><em class="fa fa-dashboard">&nbsp;</em>
                Dashboard</a></li>
        <?
        if ($sideBar_page["lvl1"] == "task") {
            $parent_active = "active";
            $in = ($sideBar_page["lvl2"]) ? "in" : null;
        } else {
            $parent_active = null;
            $in = null;
        }
        ?>
        <li class="parent <? echo $parent_active; ?>">
            <a data-toggle="collapse" href="#sub-item-1" >
                <em class="fa fa-calendar">&nbsp</em> Задачи <span href="#sub-item-1" class="icon pull-right"><svg
                            class="bi bi-chevron-compact-down" width="1em" height="1em" viewBox="0 0 16 16"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M1.553 6.776a.5.5 0 01.67-.223L8 9.44l5.776-2.888a.5.5 0 11.448.894l-6 3a.5.5 0 01-.448 0l-6-3a.5.5 0 01-.223-.67z"
                                  clip-rule="evenodd"/>
                            </svg></span>
                <? if ($Badges["new_tasks"]) { ?>
                    <span class="badge bg-warning"><? echo $Badges["new_tasks"] ?></span>
                <? } ?>
            </a>
            <ul class="children collapse <? echo $in; ?>" id="sub-item-1">
                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "my") ? "active" : null; ?>
                    <a class="<? echo $children_active; ?>" href="/task">
                        <span class="fa fa-arrow-right">&nbsp;</span> Мои
                    </a></li>
                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "for_me") ? "active" : null; ?>
                    <a class="<? echo $children_active; ?>" href="/task/for_me">
                        <span class="fa fa-arrow-right">&nbsp;</span> Для меня

                        <? if ($Badges["new_tasks"]) { ?>
                            <span class="badge bg-warning"><? echo $Badges["new_tasks"] ?></span>
                        <? } ?>

                    </a></li>
            </ul>
        </li>
        <?
        if ($sideBar_page["lvl1"] == "invite") {
            $parent_active = "active";
            $in = ($sideBar_page["lvl2"]) ? "in" : null;
        } else {
            $parent_active = null;
            $in = null;
        }
        ?>
        <li class="parent <? echo $parent_active; ?>">
            <a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-clone">&nbsp;</em> Приглашения
                <span href="#sub-item-2" class="icon pull-right">
                    <svg class="bi bi-chevron-compact-down" width="1em" height="1em" viewBox="0 0 16 16"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M1.553 6.776a.5.5 0 01.67-.223L8 9.44l5.776-2.888a.5.5 0 11.448.894l-6 3a.5.5 0 01-.448 0l-6-3a.5.5 0 01-.223-.67z"
                          clip-rule="evenodd"/>
                    </svg>
                </span>

                <? if ($Badges["new_invites"]) { ?>
                    <span class="badge bg-warning"><? echo $Badges["new_invites"] ?></span>
                <? } ?>
            </a>
            <ul class="children collapse <? echo $in; ?>" id="sub-item-2">
                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "my") ? "active" : null; ?>
                    <a class="<? echo $children_active; ?>" href="/invite">
                        <span class="fa fa-arrow-right">&nbsp;</span> Мои
                    </a></li>
                <li>
                    <? $children_active = ($in && $sideBar_page["lvl2"] == "for_me") ? "active" : null; ?>
                    <a class="<? echo $children_active; ?>" href="/invite/for_me">
                        <span class="fa fa-arrow-right">&nbsp;</span> Для меня
                        <? if ($Badges["new_invites"]) { ?>
                            <span class="badge bg-warning"><? echo $Badges["new_invites"] ?></span>
                        <? } ?>
                    </a>
                </li>
            </ul>
        </li>

        <!--        <li><a href="widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
                <li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
                <li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
                <li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
                <li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>-->
    </ul>
</div>
