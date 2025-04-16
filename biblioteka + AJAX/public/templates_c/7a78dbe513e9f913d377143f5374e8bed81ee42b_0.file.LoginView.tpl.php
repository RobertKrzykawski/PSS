<?php
/* Smarty version 4.2.1, created on 2024-12-07 18:53:34
  from 'C:\xampp\htdocs\biblioteka\app\views\LoginView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_67548b9e2aa711_67366591',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a78dbe513e9f913d377143f5374e8bed81ee42b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\LoginView.tpl',
      1 => 1733590045,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67548b9e2aa711_67366591 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_178898243167548b9e2471d8_91350707', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44525441767548b9e247b63_72960368', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_66033048267548b9e2aa331_64075432', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_178898243167548b9e2471d8_91350707 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_178898243167548b9e2471d8_91350707',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Logowanie</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_44525441767548b9e247b63_72960368 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_44525441767548b9e247b63_72960368',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<h2>Zaloguj się</h2>
<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
login" method="post">
	<div class="row gtr-uniform">
		<div class="col-6 col-12-xsmall">
			<input id="login" type="text" name="login" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->login;?>
" placeholder="Email"/>
		</div>
		<div class="col-6 col-12-xsmall">
            <input id="password" type="password" name="password" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->password;?>
" placeholder="Hasło"/>
        </div>
		<div class="col-12">
            <ul class="actions">
                <li><input type="submit" value="Zaloguj" class="primary" /></li>
            </ul>
        </div>
	</div>
</form>
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_66033048267548b9e2aa331_64075432 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_66033048267548b9e2aa331_64075432',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
