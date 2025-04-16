<?php
/* Smarty version 4.2.1, created on 2024-12-08 14:39:07
  from 'C:\xampp\htdocs\biblioteka\app\views\CatalogView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6755a17bbaa7d6_28811946',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '988d44caae62cac585570b2f6ab9506b1563b6ac' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\CatalogView.tpl',
      1 => 1733665147,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6755a17bbaa7d6_28811946 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13436583886755a17bb9ce52_56058379', 'p_description');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8671040546755a17bb9d627_98840672', 'top');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16630232796755a17bbaa482_11391049', 'footer');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_13436583886755a17bb9ce52_56058379 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_13436583886755a17bb9ce52_56058379',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Katalog książek</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_8671040546755a17bb9d627_98840672 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_8671040546755a17bb9d627_98840672',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="catalog-container">
    <h1>Katalog książek</h1>

    <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
catalog">
        <input type="text" name="search" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Szukaj...">
        <select style="width:15rem;" name="search_type">
            <option value="title" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 'title') {?>selected<?php }?>>Tytuł</option>
            <option value="author" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 'author') {?>selected<?php }?>>Autor</option>
        </select>
        <button type="submit">Szukaj</button>
    </form>

    <?php if ((isset($_smarty_tpl->tpl_vars['books']->value)) && count($_smarty_tpl->tpl_vars['books']->value) > 0) {?>
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
                <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
catalog?page=<?php echo $_smarty_tpl->tpl_vars['current_page']->value-1;?>
">&laquo; Poprzednia</a>
            <?php }?>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, range(1,$_smarty_tpl->tpl_vars['total_pages']->value), 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
catalog?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" 
                   class="<?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>active<?php }?>">
                    <?php echo $_smarty_tpl->tpl_vars['page']->value;?>

                </a>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <?php if ($_smarty_tpl->tpl_vars['current_page']->value < $_smarty_tpl->tpl_vars['total_pages']->value) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
catalog?page=<?php echo $_smarty_tpl->tpl_vars['current_page']->value+1;?>
">Następna &raquo;</a>
            <?php }?>
        <?php }?>
    </div>
</div>
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_16630232796755a17bbaa482_11391049 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_16630232796755a17bbaa482_11391049',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
