<input type="hidden" name="path" id="path" value="<?=ROOT_ADMIN?>" />

<ul class="navigation widget">

 <li<?=($_SESSION['tipo_gestor'] == 'P' ? '' : 'style="display:none"')?> <?=($pagina == 'categorias' ? 'class="active"' : '')?>><a <?=($pagina == 'categorias' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/categorias" title=""><i class="icon-reorder"></i>Categorias</a></li>

 <li<?=($_SESSION['tipo_gestor'] == 'P' ? '' : 'style="display:none"')?> <?=($pagina == 'predios' ? 'class="active"' : '')?>><a <?=($pagina == 'predios' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/predios" title=""><i class="icon-building"></i>Pr&eacute;dios</a></li>

 <li<?=($_SESSION['tipo_gestor'] == 'P' || $_SESSION['tipo_gestor'] == 'D' ? '' : 'style="display:none"')?> <?=($pagina == 'usuarios' ? 'class="active"' : '')?>><a <?=($pagina == 'usuarios' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/usuarios" title=""><i class="icon-group"></i>Usu&aacute;rios</a></li>

 <li<?=($_SESSION['tipo_gestor'] == 'P' ? '' : 'style="display:none"')?> <?=($pagina == 'departamentos' ? 'class="active"' : '')?>><a <?=($pagina == 'departamentos' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/departamentos" title=""><i class="icon-sitemap"></i>Departamentos</a></li>

 <li<?=($_SESSION['tipo_gestor'] == 'P' ? '' : 'style="display:none"')?> <?=($pagina == 'salas' ? 'class="active"' : '')?>><a <?=($pagina == 'salas' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/salas" title=""><i class="icon-user"></i>Salas</a></li>

 <li<?=($_SESSION['tipo_gestor'] == 'P' ? '' : 'style="display:none"')?> <?=($pagina == 'bens' ? 'class="active"' : '')?>><a <?=($pagina == 'bens' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/bens" title=""><i class="icon-user"></i>Bens Patrimoniais</a></li>

 <li <?=($pagina == 'movimentacoes' ? 'class="active"' : '')?>><a <?=($pagina == 'movimentacoes' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/movimentacoes" title=""><i class="icon-truck"></i>Movimenta&ccedil;&atilde;o Bens</a></li>

 <li<?=($_SESSION['tipo_gestor'] == 'P' ? '' : 'style="display:none"')?> <?=($pagina == 'inventario' ? 'class="active"' : '')?>><a <?=($pagina == 'inventario' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/inventario" title=""><i class="icon-book"></i>Invent&aacute;rio</a></li>

 <li<?=($_SESSION['tipo_gestor'] == 'P' ? '' : 'style="display:none"')?> <?=($pagina == 'baixa' ? 'class="active"' : '')?>><a <?=($pagina == 'baixa' ? 'class="current"' : '')?> href="<?=ROOT_ADMIN?>/baixa" title=""><i class="icon-book"></i>Baixa de Bens</a></li>

</ul>


<!-- /main navigation -->