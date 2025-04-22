<?php
/* Smarty version 4.5.2, created on 2025-04-22 13:01:58
  from 'module_file_tpl:ModuleManager;newversionstab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_68077726ca09a6_38173546',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1cc29e9dd28c902a263ab666fbb21e1acaaac62' => 
    array (
      0 => 'module_file_tpl:ModuleManager;newversionstab.tpl',
      1 => 1745319093,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68077726ca09a6_38173546 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'get_module_status_icon' => 
  array (
    'compiled_filepath' => 'C:\\xampp\\htdocs\\cms\\tmp\\templates_c\\ModuleManager^b1cc29e9dd28c902a263ab666fbb21e1acaaac62_0.module_file_tpl.ModuleManagernewversionstab.tpl.php',
    'uid' => 'b1cc29e9dd28c902a263ab666fbb21e1acaaac62',
    'call_name' => 'smarty_template_function_get_module_status_icon_183827974368077726c8b192_50579463',
  ),
));
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),1=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.cms_escape.php','function'=>'smarty_modifier_cms_escape',),2=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.localedate_format.php','function'=>'smarty_modifier_localedate_format',),));
if (!empty($_smarty_tpl->tpl_vars['updatestxt']->value)) {?>
<div class="information"><p><?php echo $_smarty_tpl->tpl_vars['updatestxt']->value;?>
</p></div>
<?php } else { ?>
<div class="information"><p><?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('info_searchtab');?>
</p></div>
<?php }?>
<div style="clear:both;">&nbsp;</div>
<?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?>
<p class="pageerror"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>
<?php }?>



<?php if ((isset($_smarty_tpl->tpl_vars['itemcount']->value)) && $_smarty_tpl->tpl_vars['itemcount']->value > 0) {?>
<table class="pagetable scrollable">
	<thead>
		<tr>
			<th></th>
			<th><?php echo $_smarty_tpl->tpl_vars['nametext']->value;?>
</th>
			<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_newmoduleversion');?>
"><?php echo $_smarty_tpl->tpl_vars['vertext']->value;?>
</span></th>
			<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_yourmoduledate');?>
"><?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('releasedate');?>
</span></th>
						<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_modulesize2');?>
"><?php echo $_smarty_tpl->tpl_vars['sizetext']->value;?>
</span></th>
			<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_yourmoduleversion');?>
"><?php echo $_smarty_tpl->tpl_vars['haveversion']->value;?>
</span></th>
			<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_modulestatus');?>
"><?php echo $_smarty_tpl->tpl_vars['statustext']->value;?>
</span></th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'entry');
$_smarty_tpl->tpl_vars['entry']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->do_else = false;
?>
	<?php echo smarty_function_cycle(array('values'=>"row1,row2",'assign'=>'rowclass'),$_smarty_tpl);?>

	<tr class="<?php echo $_smarty_tpl->tpl_vars['rowclass']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['entry']->value->age == 'new') {?>style="font-weight: bold;"<?php }?>>
		<td><?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'get_module_status_icon', array('status'=>$_smarty_tpl->tpl_vars['entry']->value->age), true);?>
</td>
		<td>
			<span title="<?php echo smarty_modifier_cms_escape(preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['entry']->value->description));?>
"><?php echo (($tmp = $_smarty_tpl->tpl_vars['entry']->value->name ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</span>
			<?php if ($_smarty_tpl->tpl_vars['entry']->value->error) {?><br/><span style="color: red;"><?php echo $_smarty_tpl->tpl_vars['entry']->value->error;?>
</span><?php }?>
		</td>
		<td><?php echo (($tmp = $_smarty_tpl->tpl_vars['entry']->value->version ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</td>
		<td><?php echo smarty_modifier_localedate_format($_smarty_tpl->tpl_vars['entry']->value->date,'%x');?>
</td>
				<td><?php echo (($tmp = $_smarty_tpl->tpl_vars['entry']->value->size ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</td>
		<td><?php if ((isset($_smarty_tpl->tpl_vars['entry']->value->haveversion))) {
echo $_smarty_tpl->tpl_vars['entry']->value->haveversion;
}?></td>
		<td><?php echo (($tmp = $_smarty_tpl->tpl_vars['entry']->value->status ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</td>
		<td><a href="<?php echo $_smarty_tpl->tpl_vars['entry']->value->depends_url;?>
" title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_moduledepends');?>
"><?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('dependstxt');?>
</a></td>
		<td><a href="<?php echo $_smarty_tpl->tpl_vars['entry']->value->help_url;?>
" title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_modulehelp');?>
"><?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('helptxt');?>
</a></td>
		<td><a href="<?php echo $_smarty_tpl->tpl_vars['entry']->value->about_url;?>
" title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_moduleabout');?>
"><?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('abouttxt');?>
</a></td>
	</tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</tbody>
</table>
<?php } else { ?>
<p><?php echo $_smarty_tpl->tpl_vars['nvmessage']->value;?>
</p>
<?php }
}
/* smarty_template_function_get_module_status_icon_183827974368077726c8b192_50579463 */
if (!function_exists('smarty_template_function_get_module_status_icon_183827974368077726c8b192_50579463')) {
function smarty_template_function_get_module_status_icon_183827974368077726c8b192_50579463(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

<?php if ($_smarty_tpl->tpl_vars['status']->value == 'stale') {
echo $_smarty_tpl->tpl_vars['stale_img']->value;
} elseif ($_smarty_tpl->tpl_vars['status']->value == 'warn') {
echo $_smarty_tpl->tpl_vars['warn_img']->value;
} elseif ($_smarty_tpl->tpl_vars['status']->value == 'new') {
echo $_smarty_tpl->tpl_vars['new_img']->value;
}
}}
/*/ smarty_template_function_get_module_status_icon_183827974368077726c8b192_50579463 */
}
