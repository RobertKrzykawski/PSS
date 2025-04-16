<?php
/* Smarty version 4.2.1, created on 2024-12-24 12:29:43
  from 'C:\xampp\htdocs\biblioteka\app\views\UserEditView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_676a9b270cf536_11016377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05c38466872ea45762f16c7e60521b4f5a63fdfb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\UserEditView.tpl',
      1 => 1735039781,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_676a9b270cf536_11016377 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_560950462676a9b270c38a1_93065839', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1169878164676a9b270c3ec2_69447437', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_363408843676a9b270cf243_13943898', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_560950462676a9b270c38a1_93065839 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_560950462676a9b270c38a1_93065839',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Edytuj</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_1169878164676a9b270c3ec2_69447437 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_1169878164676a9b270c3ec2_69447437',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<section>
    <h1>Edycja użytkownika</h1>
    <table>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Aktywny</th>
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
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>

    <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
userSave" method="post">
        <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->user_id;?>
" />

        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['form']->value->name ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />

        <label for="surname">Nazwisko:</label>
        <input type="text" id="surname" name="surname" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['form']->value->surname ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['form']->value->email ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />

        <label for="role_id">Rola:</label>
        <select id="role_id" name="role_id">
            <option value="" selected disabled>-- Wybierz rolę --</option>
            <option value="1" <?php if ($_smarty_tpl->tpl_vars['form']->value->role_id == 1) {?>selected<?php }?>>Administrator</option>
            <option value="2" <?php if ($_smarty_tpl->tpl_vars['form']->value->role_id == 2) {?>selected<?php }?>>Bibliotekarz</option>
            <option value="3" <?php if ($_smarty_tpl->tpl_vars['form']->value->role_id == 3) {?>selected<?php }?>>Użytkownik</option>
        </select>

        <label for="active">Aktywny:</label>
        <select id="active" name="active">
            <option value="" selected disabled>-- Wybierz status --</option>
            <option value="1" <?php if ($_smarty_tpl->tpl_vars['form']->value->active === 1) {?>selected<?php }?>>Tak</option>
            <option value="0" <?php if ($_smarty_tpl->tpl_vars['form']->value->active === 0) {?>selected<?php }?>>Nie</option>
        </select></br>
        
        <div class="col-12">
            <ul class="actions">
                <li><input type="submit" value="Zapisz" class="primary" /></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
displayUsers">Powrót</a></li>
            </ul>
        </div>
    </form>
</section>	
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_363408843676a9b270cf243_13943898 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_363408843676a9b270cf243_13943898',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
