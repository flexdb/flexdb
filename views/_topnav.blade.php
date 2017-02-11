<nav class="top-menu" ng-class="{'hidden-top-menu': hideTopMenu}">
    <div class="menu-icon-container hidden-md-up">
        <div class="animate-menu-button left-menu-toggle">
            <div><!-- --></div>
        </div>
    </div>
    <div class="menu">
        <div class="menu-user-block">
            <div class="dropdown dropdown-avatar">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="avatar" href="javascript:void(0);">
                        <img src="../assets/common/img/temp/avatars/1.jpg" alt="Alternative text to the image">
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header">Home</div>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> System Dashboard</a>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> User Boards</a>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> Issue Navigator (35 New)</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-exit"></i> Logout</a>
                </ul>
            </div>
        </div>
        <div class="menu-info-block">
            <div class="left">
                <div class="header-buttons">
                    <div class="dropdown" uib-dropdown>
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" uib-dropdown-toggle aria-expanded="false">
                            <i class="dropdown-inline-button-icon icmn-sort-alpha-asc"></i>
                            <span class="hidden-lg-down">Sort By</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu" uib-dropdown-menu>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-office"></i>Office Name</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-calendar"></i>Date</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header">Geographic</div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-location"></i>Atoll</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-location"></i>Island</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-location"></i>North/South</a>
                            <div class="dropdown-divider"></div>
                        </ul>
                    </div>
                    <div class="dropdown" uib-dropdown>
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button"  uib-dropdown-toggle aria-expanded="false">
                            <i class="dropdown-inline-button-icon icmn-stack"></i>
                            <span class="hidden-lg-down">Group By</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu"  uib-dropdown-menu>
                            <!--<div class="dropdown-header">Active</div>-->
                            <a class="dropdown-item" href="javascript:void(0)">Office Name</a>
                            <a class="dropdown-item" href="javascript:void(0)">Month</a>
                            <a class="dropdown-item" href="javascript:void(0)">Atoll</a>
                        </ul>
                    </div>
                </div>
            </div>
<!--            <div class="left hidden-md-down">
                <div class="example-top-menu-chart">
                    <span class="title">Income:</span>
                    <span class="chart" id="topMenuChart">1,3,2,0,3,1,2,3,5,2</span>
                    <span class="count">425.00 USD</span>
                </div>
            </div>-->
            <div class="right hidden-md-down margin-left-20">
                <div class="search-block">
                    <div class="form-input-icon form-input-icon-right">
                        <i class="icmn-search"></i>
                        <input type="text" class="form-control form-control-sm form-control-rounded" placeholder="Search...">
                        <button type="submit" class="search-block-submit "></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>