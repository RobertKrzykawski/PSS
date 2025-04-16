<?php
/* Smarty version 4.2.1, created on 2024-12-15 16:14:38
  from 'C:\xampp\htdocs\biblioteka\app\views\EmployeeRentView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_675ef25eb4bf04_29167371',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1182885f3d784d4bb8de1afd17fb161a6979cb0b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\EmployeeRentView.tpl',
      1 => 1734273548,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675ef25eb4bf04_29167371 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1237093769675ef25ead8187_43850012', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_468482710675ef25ead8825_91269895', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_762799482675ef25eb4b8d9_28272901', 'footer');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_1237093769675ef25ead8187_43850012 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_1237093769675ef25ead8187_43850012',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Podgląd wypożyczeń książek</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_468482710675ef25ead8825_91269895 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_468482710675ef25ead8825_91269895',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\biblioteka\\lib\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<section>
    <h1>Zarządzanie wypożyczeniami</h1>
    <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
employeeRents" method="post">
        <label for="rent_date">Filtruj po dacie wypożyczenia:</label>
        <input type="date" id="rent_date" name="rent_date" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['date_filter']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

        <label for="rent_id">Filtruj po ID wypożyczenia:</label>
        <input type="number" id="rent_id" name="rent_id" min="0" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['rent_id_filter']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

        <label for="users_surname">Filtruj po nazwisku użytkownika:</label>
        <input type="text" id="users_surname" name="users_surname" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['surname_filter']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

        <label for="book_title">Filtruj po tytule książki:</label>
        <input type="text" id="book_title" name="book_title" value="<?php echo (($tmp = $_smarty_tpl->tpl_vars['book_title_filter']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

        <input type="submit" value="Filtruj">
    </form>

    <?php if ((isset($_smarty_tpl->tpl_vars['rents']->value)) && count($_smarty_tpl->tpl_vars['rents']->value) > 0) {?>
    <table>
        <tr>
            <th>Nr wypożyczenia</th>
            <th>Data wypożyczenia</th>
            <th>Termin zwrotu</th>
            <th>Status</th>
            <th>Tytuł książki</th>
            <th>Autor</th>
            <th>Użytkownik</th>
            <th>Akcja</th>
        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rents']->value, 'rent');
$_smarty_tpl->tpl_vars['rent']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rent']->value) {
$_smarty_tpl->tpl_vars['rent']->do_else = false;
?>
        <?php $_smarty_tpl->_assignInScope('today', smarty_modifier_date_format(time(),"%Y-%m-%d"));?>
        <tr <?php if ($_smarty_tpl->tpl_vars['rent']->value['return_date'] < $_smarty_tpl->tpl_vars['today']->value && $_smarty_tpl->tpl_vars['rent']->value['status'] != 'Zwrócone') {?>style="background-color: red; color: white;"<?php }?>>
            <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['rent_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['rent_date'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['return_date'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['status'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['book_title'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['book_author'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['rent']->value['user_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['rent']->value['user_surname'];?>
</td>
            <td>
                <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
updateRentStatus" method="post">
                    <input type="hidden" name="rent_id" value="<?php echo $_smarty_tpl->tpl_vars['rent']->value['rent_id'];?>
">
                    <select name="status">
                        <option value="Wypożyczone" <?php if ($_smarty_tpl->tpl_vars['rent']->value['status'] == 'Wypożyczone') {?>selected<?php }?>>Wypożyczone</option>
                        <option value="Zwrócone" <?php if ($_smarty_tpl->tpl_vars['rent']->value['status'] == 'Zwrócone') {?>selected<?php }?>>Zwrócone</option>
                        <option value="Przeterminowane" <?php if ($_smarty_tpl->tpl_vars['rent']->value['status'] == 'Przeterminowane') {?>selected<?php }?>>Przeterminowane</option>
                    </select>
                    <input type="submit" value="Zaktualizuj">
                </form>
            </td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
    <?php } else { ?>
    <p>Brak wypożyczeń do wyświetlenia.</p>
    <?php }?>
</section>
</div>
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_762799482675ef25eb4b8d9_28272901 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_762799482675ef25eb4b8d9_28272901',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
