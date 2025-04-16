<?php
/* Smarty version 4.2.1, created on 2025-04-08 19:32:36
  from 'C:\xampp\htdocs\biblioteka\app\views\CatalogContent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_67f55db4a00d40_32367457',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a12b5d3dd0c93a5c6853c06388d11c92754039f1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\CatalogContent.tpl',
      1 => 1744133502,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67f55db4a00d40_32367457 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['books']->value)) && count($_smarty_tpl->tpl_vars['books']->value) > 0) {?>
    <table>
        <thead>
            <tr>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>Gatunek</th>
                <th>Dostępne kopie</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'book');
$_smarty_tpl->tpl_vars['book']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['book']->value) {
$_smarty_tpl->tpl_vars['book']->do_else = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['book']->value['title'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['book']->value['author'];?>
</td>
                    <td><?php echo (($tmp = $_smarty_tpl->tpl_vars['book']->value['genre_name'] ?? null)===null||$tmp==='' ? 'Unknown' ?? null : $tmp);?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['book']->value['available_copies'];?>
</td>
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Nie znaleziono książek.</p>
<?php }?>

<div class="pagination">
    <?php if ($_smarty_tpl->tpl_vars['total_pages']->value > 1) {?>
        <?php if ($_smarty_tpl->tpl_vars['current_page']->value > 1) {?>
            <a class="page-link" data-page="<?php echo $_smarty_tpl->tpl_vars['current_page']->value-1;?>
">&laquo; Poprzednia</a>
        <?php }?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, range(1,$_smarty_tpl->tpl_vars['total_pages']->value), 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
            <a class="page-link <?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>active<?php }?>" 
               data-page="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">
                <?php echo $_smarty_tpl->tpl_vars['page']->value;?>

            </a>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        <?php if ($_smarty_tpl->tpl_vars['current_page']->value < $_smarty_tpl->tpl_vars['total_pages']->value) {?>
            <a class="page-link" data-page="<?php echo $_smarty_tpl->tpl_vars['current_page']->value+1;?>
">Następna &raquo;</a>
        <?php }?>
    <?php }?>
</div><?php }
}
