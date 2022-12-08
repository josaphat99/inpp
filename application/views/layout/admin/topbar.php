<!-- <div class="page-loader">
    <div class="page-loader__spinner">
        <svg viewBox="25 25 50 50">
            <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
</div> -->

<header class="header">
    <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
        <div class="navigation-trigger__inner">
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
        </div>
    </div>

    <div class="header__logo hidden-sm-down">
        <h1>
            <img class="img-fluid" width="50px" height="50px" src="<?=base_url('assets/demo/img/inpp.jpg')?>" alt="">
        </h1>
    </div>

    <ul class="top-nav">
        <!--Theme switch-->     
        <?php
        if($this->session->id)
        {
        ?>       
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"><img class="user__img" src=<?=base_url("assets/demo/img/profile-pics/2.jpg")?> alt=""></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                <div class="listview listview--hover">
                    <div class="listview__header">
                    <img class="user__img" src=<?=base_url("assets/demo/img/profile-pics/2.jpg")?> alt=""><?=$this->session->name?>                 
                    </div>

                    <a href=<?=site_url("profile")?> class="listview__item">
                        <div class="listview__content">
                            <div class="listview__heading">
                            <i class="zmdi zmdi-account" style="font-size: 20px;"></i>&nbsp;&nbsp; Profile
                            </div>                            
                        </div> 
                    </a>
                    <a href=<?=site_url("compte/logout")?> class="listview__item">
                        <div class="listview__content">
                            <div class="listview__heading">
                            <i class="zmdi zmdi-arrow-left" style="font-size: 20px;"></i>&nbsp;&nbsp;Logout                                
                            </div>                            
                        </div>
                    </a>                
                </div>
            </div>
        </li>  
        <?php
        }
        ?>
    </ul>
</header>
<body data-ma-theme="green">
    <main class="main">