<?php
/* Smarty version 4.2.1, created on 2024-12-07 14:45:28
  from 'C:\xampp\htdocs\biblioteka\app\views\AboutUs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6754517864d831_23390933',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d774817971a3754993a48789bc27786c1aa1daa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\AboutUs.tpl',
      1 => 1733579052,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6754517864d831_23390933 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19472800466754517864cbc5_82132816', 'p_description');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15103874016754517864d1f8_76279696', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10696946536754517864d594_81654696', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_19472800466754517864cbc5_82132816 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_19472800466754517864cbc5_82132816',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Kim jesteśmy?</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_15103874016754517864d1f8_76279696 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_15103874016754517864d1f8_76279696',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div id="main" class="wrapper style1">
	<div class="container">
		<div class="row gtr-150">
			<div class="col-4 col-12-medium">
				<!-- Sidebar -->
					<section id="sidebar">
						<section>
							<p>Witamy w Bibliotece Miejskiej – miejscu, gdzie wiedza, pasja i inspiracja spotykają się każdego dnia.</p>
						</section>
						<hr />
						<section>
							<p class="image fit"><img src="images/library_interior.jpg" alt="Wnętrze biblioteki" /></p>
							<p>Dołącz do grona naszych czytelników i odkryj bogactwo książek, czasopism i multimediów dostępnych dla każdego.</p>
						</section>
					</section>
			</div>

			<div class="col-8 col-12-medium imp-medium">
				<!-- Content -->
					<section id="content">
						<p class="image fit"><img src="images/books_shelf.jpg" alt="Półka z książkami" /></p>
						<p>Nasza biblioteka oferuje szeroki wybór literatury, od klasyki po nowości wydawnicze, w tym książki naukowe, powieści, literaturę dziecięcą oraz multimedialne zasoby edukacyjne.</p>
						<p>Dzięki komfortowym czytelniom oraz przyjaznej atmosferze, nasze przestrzenie sprzyjają nauce, pracy oraz relaksowi. Organizujemy także liczne wydarzenia kulturalne, warsztaty, kluby czytelnicze i spotkania autorskie.</p>
					</section>
			</div>
		</div>
	</div>
</div>
<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_10696946536754517864d594_81654696 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_10696946536754517864d594_81654696',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Biblioteka Miejska<?php
}
}
/* {/block 'footer'} */
}
