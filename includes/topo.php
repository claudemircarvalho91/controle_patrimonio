<!-- Fixed top -->
<div id="top">
    <div class="fixed">
        <a href="<?=ROOT?>" target="_blank" title="Abrir o Site" class="logo"><img src="<?=ROOT_ADMIN?>/img/logo.png" alt="" /></a>
        <ul class="top-menu">
            <li><a class="fullview"></a></li>
            <li><a class="showmenu"></a></li>
            <!--<li><a href="#" title="" class="messages"><i class="new-message"></i></a></li>-->
            <li class="dropdown">
                <a class="user-menu" data-toggle="dropdown"><span>Usu&aacute;rio: <?=$_SESSION['nome_usuario_gestor']?><b class="caret"></b></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=ROOT_ADMIN?>/usuarios/edit/<?=$_SESSION['id_gestor']?>" title=""><i class="icon-user"></i>Meus Dados</a></li>
                    <!--<li><a href="#" title=""><i class="icon-inbox"></i>Messages<span class="badge badge-info">9</span></a></li>-->
                    <!--<li><a href="#" title=""><i class="icon-cog"></i>Settings</a></li>-->
                    <li><a href="<?=ROOT_ADMIN?>/sair" title=""><i class="icon-remove"></i>Sair do Sistema</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /fixed top -->