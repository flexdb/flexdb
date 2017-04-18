    <div class="logo-container">
        <a href="#/dashboards/alpha" class="logo">
            <img src="../assets/common/img/{{env('LOGO')}}" alt="logo" />
        </a>
    </div>
    <div class="left-menu-inner scroll-pane">
        <ul class="left-menu-list left-menu-list-root list-unstyled">

            <li class="left-menu-list-separator"><!-- --></li>
            <li ng-repeat="item in menu.menuItems">
                <a class="left-menu-link capitalize  align-icon-center" href="@{{item.link}}" style="display:flex; align-items: center;">
                    <i class="material-icons">play_arrow</i>
                    @{{item.label}}
                </a>
            </li>
<!--            <li>
                <a class="left-menu-link" href="#/dashboards/beta">
                    <i class="left-menu-link-icon icmn-home2"> </i>
                    <span class="menu-top-hidden">Dashboard</span> Beta
                </a>
            </li>
            <li class="left-menu-list-separator"> </li>
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-files-empty2"> </i>
                    Pages
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="#/pages/login">
                            Login
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#/pages/register">
                            Register
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#/pages/lockscreen">
                            Lockscreen
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#/pages/pricing-tables">
                            Pricing Tables
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#/pages/invoice">
                            Invoice
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#/pages/page-404">
                            Page 404
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#/pages/page-500">
                            Page 500
                        </a>
                    </li>
                </ul>
            </li>
            <li class="left-menu-list-separator"> </li>
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-files-empty2"> </i>
                    Forms
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="#/forms/basic-form-elements">
                            Basic Form Elements
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#/forms/buttons">
                            Buttons
                        </a>
                    </li>

                </ul>
            </li>-->

        </ul>
    </div>
    <div class="footer">&copy; {{env('COPY')}}</div>