<?php
/* Smarty version 4.2.1, created on 2024-12-24 12:25:49
  from 'C:\xampp\htdocs\biblioteka\app\views\EmployeeUsersTable.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_676a9a3de8ab22_04233656',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25f1510892a7fddd8103080db9dd4ce2ddbeb688' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\EmployeeUsersTable.tpl',
      1 => 1735039549,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_676a9a3de8ab22_04233656 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1820872318676a9a3de7e5d0_27537821', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1816189197676a9a3de7ed46_22746970', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1732088972676a9a3de8a812_17006663', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_1820872318676a9a3de7e5d0_27537821 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_1820872318676a9a3de7e5d0_27537821',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Edytuj</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_1816189197676a9a3de7ed46_22746970 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_1816189197676a9a3de7ed46_22746970',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<section>
    <h1>Lista Użytkowników</h1>
    <?php if ((isset($_smarty_tpl->tpl_vars['users']->value)) && count($_smarty_tpl->tpl_vars['users']->value) > 0) {?>
        <table>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Aktywny</th>
                <th>Akcje</th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['surname'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['role_name'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['user']->value['active'] == 1) {?>Tak<?php } else { ?>Nie<?php }?></td>
                    <td>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
userEdit/<?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
">Edytuj</a>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
    <?php } else { ?>
    <p>Brak użytkowników do wyświetlenia.</p>
    <?php }?>
</section>	
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_1732088972676a9a3de8a812_17006663 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_1732088972676a9a3de8a812_17006663',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
