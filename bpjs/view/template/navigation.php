<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <span class="navbar-brand">
                <img alt="Brand" src="resources/public/gambar/logo-bpjs.png"/>
                Portal BPJS Kesehatan
            </span>
            <?php if(isset($_POST['administrator'])):?>
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
            <?php endif?>
        </div>
        <ul class="nav navbar-nav navbar-right">
        </ul>
    </div>
</nav>