<?php
/* Smarty version 4.2.1, created on 2025-01-12 09:22:40
  from 'C:\xampp\htdocs\biblioteka\app\views\RentHistoryView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_67837bd004cd13_04555569',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17be05f712bffd7efabeb6e0e156cb042d7e3008' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\RentHistoryView.tpl',
      1 => 1736670159,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837bd004cd13_04555569 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_114830196367837bcff0d1f7_66798787', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_103673309367837bcff0dd25_19028371', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_159829753867837bd004c898_39128178', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_114830196367837bcff0d1f7_66798787 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_114830196367837bcff0d1f7_66798787',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Historia wypożyczenia</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_103673309367837bcff0dd25_19028371 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_103673309367837bcff0dd25_19028371',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<section>
    <h1>Historia wypożyczenia</h1>
    <?php if ((isset($_smarty_tpl->tpl_vars['no_rents']->value)) && $_smarty_tpl->tpl_vars['no_rents']->value) {?>
        <p>Nie masz żadnych wypożyczeń w historii.</p>
    <?php } else { ?>
        <?php if (count($_smarty_tpl->tpl_vars['rents']->value) > 0) {?>
            <table>
                <tr>
                    <th>Nr wypożyczenia</th>
                    <th>Data wypożyczenia</th>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Data oddania</th>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rents']->value, 'rent');
$_smarty_tpl->tpl_vars['rent']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rent']->value) {
$_smarty_tpl->tpl_vars['rent']->do_else = false;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['rent_id'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['rent_date'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['book_title'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['book_author'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['return_date'];?>
</td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </table>

            <div class="pagination">
                <?php if ($_smarty_tpl->tpl_vars['current_page']->value > 1) {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
rentHistory?page=<?php echo $_smarty_tpl->tpl_vars['current_page']->value-1;?>
">&laquo; Poprzednia</a>
                <?php }?>
                <?php
$__section_page_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['total_pages']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_page_0_total = $__section_page_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_page'] = new Smarty_Variable(array());
if ($__section_page_0_total !== 0) {
for ($__section_page_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] = 0; $__section_page_0_iteration <= $__section_page_0_total; $__section_page_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']++){
?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
rentHistory?page=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] : null)+1;?>
" 
                       class="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] : null)+1 == $_smarty_tpl->tpl_vars['current_page']->value) {?>active<?php }?>">
                        <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_page']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_page']->value['index'] : null)+1;?>

                    </a>
                <?php
}
}
?>
                <?php if ($_smarty_tpl->tpl_vars['current_page']->value < $_smarty_tpl->tpl_vars['total_pages']->value) {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
rentHistory?page=<?php echo $_smarty_tpl->tpl_vars['current_page']->value+1;?>
">Następna &raquo;</a>
                <?php }?>
            </div>
        <?php } else { ?>
            <p>Brak wypożyczenia do wyświetlenia.</p>
        <?php }?>
    <?php }?>
</section>

<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_159829753867837bd004c898_39128178 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_159829753867837bd004c898_39128178',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
