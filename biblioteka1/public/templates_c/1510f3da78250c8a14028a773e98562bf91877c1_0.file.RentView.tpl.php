<?php
/* Smarty version 4.2.1, created on 2024-12-08 13:57:00
  from 'C:\xampp\htdocs\biblioteka\app\views\RentView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6755979c8bc497_43056146',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1510f3da78250c8a14028a773e98562bf91877c1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\RentView.tpl',
      1 => 1733662533,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6755979c8bc497_43056146 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13487309036755979c8b4d75_48352859', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14560700216755979c8b53d1_18302833', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3798661236755979c8bc197_40332714', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_13487309036755979c8b4d75_48352859 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_13487309036755979c8b4d75_48352859',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Wypożycz książkę</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_14560700216755979c8b53d1_18302833 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_14560700216755979c8b53d1_18302833',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<section>
    <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
rent" method="post">
    <div class="row gtr-uniform gtr-50">
        <div class="col-12">
            <label for="book_id">Wybierz książkę:</label>
            <select id="book_id" name="book_id" required>
                <option value="">Wybierz książkę</option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'book');
$_smarty_tpl->tpl_vars['book']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['book']->value) {
$_smarty_tpl->tpl_vars['book']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['book']->value['book_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['book']->value['available_copies'] <= 0) {?>disabled<?php }?>>
                        "<?php echo $_smarty_tpl->tpl_vars['book']->value['title'];?>
" - <?php echo $_smarty_tpl->tpl_vars['book']->value['author'];?>
 (dostepnych: <?php echo $_smarty_tpl->tpl_vars['book']->value['available_copies'];?>
)
                    </option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
        </div>
        <div class="col-12">
                <ul class="actions">
                <?php if ($_smarty_tpl->tpl_vars['isLoggedIn']->value) {?>
                    <li><input type="submit" value="Wypożycz" class="primary"/></li>
                <?php } else { ?>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
loginShow" class="button primary">Musisz być zalogowany, aby wypożyczyć książkę. Zaloguj się</a></li>
                <?php }?>
                </ul>
            </div>
    </div>
    </form>
    
    <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
rent" method="post" id="rentForm">
        <div class="row gtr-uniform gtr-50">
            <div class="col-6 col-12-medium">
                <label for="currentDate">Data wypożyczenia:</label>
                <input type="date" id="currentDate" name="currentDate" value="<?php echo $_smarty_tpl->tpl_vars['currentDate']->value;?>
" readonly />
            </div>

            <div class="col-6 col-12-medium">
                <label for="nextMonthDate">Data oddania:</label>
                <input type="date" id="nextMonthDate" name="nextMonthDate" value="<?php echo $_smarty_tpl->tpl_vars['nextMonthDate']->value;?>
" readonly />
            </div>
        </div>
    </form>
</section>
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_3798661236755979c8bc197_40332714 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_3798661236755979c8bc197_40332714',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
