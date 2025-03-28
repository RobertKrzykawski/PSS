<?php
/* Smarty version 4.2.1, created on 2024-12-15 17:14:02
  from 'C:\xampp\htdocs\biblioteka\app\views\EmployeeUsersView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_675f004ae9a5c6_42982809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1baa7083196c919882c827fa24446704d5817146' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\EmployeeUsersView.tpl',
      1 => 1734279124,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675f004ae9a5c6_42982809 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1080300560675f004ae98006_41516172', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1192530622675f004ae985e5_84724688', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_389952675f004ae9a2c8_23774827', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_1080300560675f004ae98006_41516172 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_1080300560675f004ae98006_41516172',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Dodaj użytkownika</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_1192530622675f004ae985e5_84724688 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_1192530622675f004ae985e5_84724688',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div style="width:90%; margin: 2em auto;">
    <section>
        <h1>Dodaj Użytkownika</h1>
        <form id="addUserForm" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
addUser" method="post">
            <div class="row gtr-uniform gtr-50">
                <div class="col-4 col-12-xsmall">
                    <label for="name">Imię:</label>
                    <input type="text" id="name" name="name" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="surname">Nazwisko:</label>
                    <input type="text" id="surname" name="surname" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="role">Rola:</label>
                    <select id="role_id" name="role_id" required>
                        <option value="3">Użytkownik</option>
                        <option value="2">Bibliotekarz</option>
                    </select><br>
                </div>

                <div class="col-12">
                    <input type="submit" class="primary" value="Dodaj użytkownika">
                </div>
            </div>
        </form>
    </section>
</div>
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_389952675f004ae9a2c8_23774827 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_389952675f004ae9a2c8_23774827',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
