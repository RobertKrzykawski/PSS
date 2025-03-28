<?php
/* Smarty version 4.2.1, created on 2024-12-16 13:02:26
  from 'C:\xampp\htdocs\biblioteka\app\views\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_676016d2b1f000_86959346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4b02f92f17648c3813bff60f247f4c01537fff0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\templates\\main.tpl',
      1 => 1734350546,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_676016d2b1f000_86959346 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE HTML>
<!--
    Library System by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['page_title']->value ?? null)===null||$tmp==='' ? "Biblioteka Miejska" ?? null : $tmp);?>
</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['page_description']->value ?? null)===null||$tmp==='' ? "Twoje miejsce dla książek i wiedzy" ?? null : $tmp);?>
">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_url;?>
/assets/css/main.css" />
    <noscript><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_url;?>
/assets/css/noscript.css" /></noscript>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_url;?>
/js/functions.js"><?php echo '</script'; ?>
>
</head>

<body class="is-preload">
    <div id="wrapper" class="fade-in">
        <header id="header">
            <h2>Biblioteka Miejska<h2>
        </header>
        <nav id="nav">
            <ul class="links">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
aboutUs">O Bibliotece</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
catalog">Katalog</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
rent">Wypożycz książkę</a></li>
                <?php if ((isset($_SESSION['user']))) {?>
                    <li><a>Zalogowano jako: 
                        <?php echo $_SESSION['user']->name;?>
 <?php echo $_SESSION['user']->surname;?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
rentHistory">Historia wypożyczeń</a></li>
                    <?php if ((isset($_SESSION['user']->roles)) && in_array('Bibliotekarz',$_SESSION['user']->roles)) {?>
                        <li class="dropdown">
                            <a href="#" class="dropbtn">Panel Pracownika</a>
                            <div class="dropdown-content">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
employeeRents">Zarządzanie wypożyczeniami</a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
addUser">Dodaj użytkownika</a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
displayUsers">Edytuj użytkownika</a>
                            </div>
                        </li>
                    <?php }?>
                    <li style="margin-left:auto;"><a style="font-size:25px;" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
logout" >Wyloguj</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
loginShow"">Zaloguj</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
registerShow">Rejestracja</a></li>
                <?php }?>
            </ul>
        </nav>
        
        <div id="main">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1344279808676016d2b1a7e6_67398421', 'top');
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1687560057676016d2b1ad56_14604293', 'messages');
?>

        </div>

        <footer id="footer">
            <section>
                <form method="post" action="#">
                    <div class="fields">
                        <div class="field">
                            <label for="name">Imię</label>
                            <input type="text" name="name" id="name" />
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" />
                        </div>
                        <div class="field">
                            <label for="message">Wiadomość</label>
                            <textarea name="message" id="message" rows="3" style="resize: none"></textarea>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Wyślij wiadomość" /></li>
                    </ul>
                </form>
            </section>
            <section class="split contact">
                <section class="alt">
                    <h3>Adres</h3>
                    <p>ul. Książkowa 10, Warszawa</p>
                </section>
                <section>
                    <h3>Telefon</h3>
                    <p>555 123 456</p>
                </section>
                <section>
                    <h3>Adres email</h3>
                    <p>kontakt@bibliotekamiejska.pl</p>
                </section>
                <section>
                    <h3>Copyright</h3>
                    <ul class="icons alt">
                        <li>&copy; <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_200905892676016d2b1eab0_82912597', 'footer');
?>
. Wszelkie prawa zastrzeżone.</li>
                        <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                    </ul>
                </section>
            </section>
        </footer>

        <?php echo '<script'; ?>
 src="assets/js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/js/jquery.scrollex.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/js/jquery.scrolly.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/js/browser.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/js/breakpoints.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/js/util.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/js/main.js"><?php echo '</script'; ?>
>

        </div>
    </body>
</html><?php }
/* {block 'top'} */
class Block_1344279808676016d2b1a7e6_67398421 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_1344279808676016d2b1a7e6_67398421',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'top'} */
/* {block 'messages'} */
class Block_1687560057676016d2b1ad56_14604293 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'messages' => 
  array (
    0 => 'Block_1687560057676016d2b1ad56_14604293',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if ($_smarty_tpl->tpl_vars['msgs']->value->isMessage()) {?>
                <div class="messages bottom-margin">
                    <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getMessages(), 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
                            <li class="msg <?php if ($_smarty_tpl->tpl_vars['msg']->value->isError()) {?>error<?php }
if ($_smarty_tpl->tpl_vars['msg']->value->isWarning()) {?>warning<?php }?> <?php if ($_smarty_tpl->tpl_vars['msg']->value->isInfo()) {?>info<?php }?>"><?php echo $_smarty_tpl->tpl_vars['msg']->value->text;?>
</li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                </div>
            <?php }?>
        <?php
}
}
/* {/block 'messages'} */
/* {block 'footer'} */
class Block_200905892676016d2b1eab0_82912597 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_200905892676016d2b1eab0_82912597',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Biblioteka Miejska<?php
}
}
/* {/block 'footer'} */
}
