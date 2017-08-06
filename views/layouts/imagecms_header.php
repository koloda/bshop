<header class="imgcms">
    <section class="container">
            <div class="col-sm-3">
                <a href="/admin/dashboard" class="logo pull-left">
                    <img src="/templates/administrator/img/logo_new.png">
                </a>
            </div>

            <div class="col-sm-6">
            </div>

            <div class="col-sm-3">
                <a href="/" target="_blank" class="bshop-menu-a-icon pull-right">
                    <i class="glyphicon glyphicon-new-window"></i>
                </a>
                <a data-toggle="dropdown" class="dropdown-toggle bshop-menu-a-icon pull-right">
                    <i class="glyphicon glyphicon-user"></i>
                </a>
                <ul class="frame-dropdown dropdown-menu drop_menu_black pull-right">

                    <li>
                        <a href="/admin/components/cp/user_manager/edit_user/1" id="user_name">
                            <?=Yii::t('bshop', 'My account')?>
                        </a>
                    </li>
                    <li>
                        <a href="/auth/logout">
                            <?=Yii::t('bshop', 'Logout')?>
                        </a>
                    </li>
                </ul>
            </div>
    </section>
</header>