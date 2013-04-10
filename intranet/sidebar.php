<header>
    <div class="header_logo">
        <a href="index.php">
        <div id="logo">
            <img src="images/logo.png">
            <p>Photo & Motion<br/> Production Company</p>
        </div>
        </a>
    </div>
    <div class="header_admin">
        <div class="header_admin_title">Administration panel</div>
        <div class="header_login"><!--<img src="<?php //echo BASE;?>intranet/images/account_ico.png">My account--> <a onClick="location.href='<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?logout=1';?>'"><img src="images/logout_ico.png">Logout</a></div>
    </div>    
    <nav class="header_menu" id="sidebarnav">
        <ul>
            <li><a href="works.php">Works</a></li>
            <li><a href="background.php">HOME IMAGES</a></li>
            <li class="last"><a href="contact.php">ABOUT US</a></li>
            <!--<li><a href="crop.php">Proyectos</a></li>
            <li class="last"><a href="Gallery">Galerias</a></li>-->
        </ul>
    </nav>
    <div class="header_shadow"></div>
</header>