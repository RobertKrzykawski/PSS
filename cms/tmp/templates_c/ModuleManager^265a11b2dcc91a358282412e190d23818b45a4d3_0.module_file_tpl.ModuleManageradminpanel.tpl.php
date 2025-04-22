<?php
/* Smarty version 4.5.2, created on 2025-04-22 13:01:59
  from 'module_file_tpl:ModuleManager;adminpanel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_680777278e6190_83265696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '265a11b2dcc91a358282412e190d23818b45a4d3' => 
    array (
      0 => 'module_file_tpl:ModuleManager;adminpanel.tpl',
      1 => 1745319093,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_680777278e6190_83265696 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'get_module_status_icon' => 
  array (
    'compiled_filepath' => 'C:\\xampp\\htdocs\\cms\\tmp\\templates_c\\ModuleManager^265a11b2dcc91a358282412e190d23818b45a4d3_0.module_file_tpl.ModuleManageradminpanel.tpl.php',
    'uid' => '265a11b2dcc91a358282412e190d23818b45a4d3',
    'call_name' => 'smarty_template_function_get_module_status_icon_176450521680777278d9200_94047764',
  ),
));
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),1=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.cms_escape.php','function'=>'smarty_modifier_cms_escape',),2=>array('file'=>'C:\\xampp\\htdocs\\cms\\lib\\plugins\\modifier.localedate_format.php','function'=>'smarty_modifier_localedate_format',),));
if ((isset($_smarty_tpl->tpl_vars['header']->value))) {?>
<h3><?php echo $_smarty_tpl->tpl_vars['header']->value;?>
</h3>
<?php }?>

<p class="pagerows">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['letter_urls']->value, 'url', false, 'key');
$_smarty_tpl->tpl_vars['url']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['url']->value) {
$_smarty_tpl->tpl_vars['url']->do_else = false;
?>
  <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['curletter']->value) {?>
	<strong><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</strong>&nbsp;
  <?php } else { ?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_letter',$_smarty_tpl->tpl_vars['key']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</a>&nbsp;
  <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</p>

<?php if ((isset($_smarty_tpl->tpl_vars['message']->value)) && $_smarty_tpl->tpl_vars['message']->value != '') {?>
<div class="warning"><p><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p></div>
<?php }?>



<?php if ((isset($_smarty_tpl->tpl_vars['itemcount']->value)) && $_smarty_tpl->tpl_vars['itemcount']->value > 0) {?>
<table class="pagetable scrollable">
	<thead>
		<tr>
			<th></th>
			<th><?php echo $_smarty_tpl->tpl_vars['nametext']->value;?>
</th>
			<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_modulelastversion');?>
"><?php echo $_smarty_tpl->tpl_vars['vertext']->value;?>
</span></th>
			<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_modulelastreleasedate');?>
"><?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('releasedate');?>
</span></th>
						<th><span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_modulestatus');?>
"><?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('statustext');?>
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
			<td><span title="<?php echo smarty_modifier_cms_escape(preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['entry']->value->description));?>
"><?php echo $_smarty_tpl->tpl_vars['entry']->value->name;?>
</span></td>
			<td><?php echo $_smarty_tpl->tpl_vars['entry']->value->version;?>
</td>
			<td><?php echo smarty_modifier_localedate_format($_smarty_tpl->tpl_vars['entry']->value->date,'%x');?>
</td>
						<td><?php if ($_smarty_tpl->tpl_vars['entry']->value->candownload) {?>
				<span title="<?php echo $_smarty_tpl->tpl_vars['ModuleManager']->value->Lang('title_moduleinstallupgrade');?>
"><?php echo $_smarty_tpl->tpl_vars['entry']->value->status;?>
</span>
			<?php } else { ?>
				<?php echo $_smarty_tpl->tpl_vars['entry']->value->status;?>

			<?php }?>
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
<?php }
}
/* smarty_template_function_get_module_status_icon_176450521680777278d9200_94047764 */
if (!function_exists('smarty_template_function_get_module_status_icon_176450521680777278d9200_94047764')) {
function smarty_template_function_get_module_status_icon_176450521680777278d9200_94047764(Smarty_Internal_Template $_smarty_tpl,$params) {
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
/*/ smarty_template_function_get_module_status_icon_176450521680777278d9200_94047764 */
}
