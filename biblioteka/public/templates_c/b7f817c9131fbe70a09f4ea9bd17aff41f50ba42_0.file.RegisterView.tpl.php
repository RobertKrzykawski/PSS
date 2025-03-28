<?php
/* Smarty version 4.2.1, created on 2024-12-08 12:37:27
  from 'C:\xampp\htdocs\biblioteka\app\views\RegisterView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_675584f78832e2_89417677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7f817c9131fbe70a09f4ea9bd17aff41f50ba42' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\RegisterView.tpl',
      1 => 1733657843,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_675584f78832e2_89417677 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1601203314675584f7880c95_42042855', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_618186689675584f78812a5_78558847', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_356272946675584f7882fc8_62601299', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_1601203314675584f7880c95_42042855 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_1601203314675584f7880c95_42042855',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Rejestracja</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_618186689675584f78812a5_78558847 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_618186689675584f78812a5_78558847',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<section>
    <h2>Podaj dane do rejestracji</h2>
    <form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
register" method="post">
        <div class="row gtr-uniform gtr-50">
            <div class="col-4 col-12-xsmall">
                <label for="name">Imię:</label>
                <input id="name" type="text" name="name" placeholder="Imię">
            </div></br>
            <div class="col-4 col-12-xsmall">
                <label for="surname">Nazwisko:</label>
                <input id="surname" type="text" name="surname" placeholder="Nazwisko" />
            </div>
            <div class="col-4 col-12-xsmall">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" placeholder="Email" />
            </div>
            <div class="col-4 col-12-xsmall">
                <label for="password">Hasło:</label>
                <input id="password" type="password" name="password" placeholder="Hasło" />
            </div>
            <div class="col-4 col-12-xsmall">
                <label for="confirm_password">Potwierdź hasło:</label>
                <input id="confirm_password" type="password" name="confirm_password" placeholder="Potwierdź hasło"/>
            </div>
            <div class="col-12">
                <ul class="actions">
                    <li><input type="submit" value="Zarejestruj" class="primary" /></li>
                </ul>
            </div>
        </div>
    </form>
</section>
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_356272946675584f7882fc8_62601299 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_356272946675584f7882fc8_62601299',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
