<?php
/* Smarty version 4.2.1, created on 2025-04-16 19:20:02
  from 'C:\xampp\htdocs\biblioteka\app\views\CatalogView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_67ffe6c2a6a3b8_70757282',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '988d44caae62cac585570b2f6ab9506b1563b6ac' => 
    array (
      0 => 'C:\\xampp\\htdocs\\biblioteka\\app\\views\\CatalogView.tpl',
      1 => 1744824001,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67ffe6c2a6a3b8_70757282 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_166016711167ffe6c2a5d9f1_84863026', 'p_description');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_188518195367ffe6c2a5e018_82926851', 'top');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_88366771467ffe6c2a6a0c2_12259377', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'p_description'} */
class Block_166016711167ffe6c2a5d9f1_84863026 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'p_description' => 
  array (
    0 => 'Block_166016711167ffe6c2a5d9f1_84863026',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Katalog książek</p><?php
}
}
/* {/block 'p_description'} */
/* {block 'top'} */
class Block_188518195367ffe6c2a5e018_82926851 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_188518195367ffe6c2a5e018_82926851',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="catalog-container">
    <h1>Katalog książek</h1>

    <form id="searchForm" method="get" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
catalog">
        <input type="text" id="searchInput" name="searchInput" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Szukaj...">
        <select style="width:15rem;" name="search_type" id="searchType">
            <option value="title" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 'title') {?>selected<?php }?>>Tytuł</option>
            <option value="author" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 'author') {?>selected<?php }?>>Autor</option>
        </select>
        <button type="submit">Szukaj</button>
    </form>

    <div id="results">
        <?php if ((isset($_smarty_tpl->tpl_vars['books']->value)) && count($_smarty_tpl->tpl_vars['books']->value) > 0) {?>
            <table>
                <thead>
                    <tr>
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Gatunek</th>
                        <th>Dostępne kopie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'book');
$_smarty_tpl->tpl_vars['book']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['book']->value) {
$_smarty_tpl->tpl_vars['book']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['book']->value['title'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['book']->value['author'];?>
</td>
                            <td><?php echo (($tmp = $_smarty_tpl->tpl_vars['book']->value['genre_name'] ?? null)===null||$tmp==='' ? 'Unknown' ?? null : $tmp);?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['book']->value['available_copies'];?>
</td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
            <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

        <?php } else { ?>
            <p>Nie znaleziono książek.</p>
        <?php }?>
    </div>
</div>


<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
$(document).ready(function() {
    // Handle form submission
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        const searchQuery = $('#searchInput').val();
        const searchType = $('#searchType').val();
        loadResults(1, searchQuery, searchType);
    });

    // Handle pagination clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        const searchQuery = $(this).data('search');
        const searchType = $(this).data('type');
        loadResults(page, searchQuery, searchType);
    });

    function loadResults(page, searchQuery, searchType) {
        $.ajax({
            url: '<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
ajaxSearchBooks',
            type: 'GET',
            data: {
                page: page,
                searchInput: searchQuery,
                search_type: searchType
            },
            dataType: 'json',
            success: function(data) {
                // Update books table
                let booksHtml = '';
                if (data.books.length > 0) {
                    booksHtml = '<table><thead><tr><th>Tytuł</th><th>Autor</th><th>Gatunek</th><th>Dostępne kopie</th></tr></thead><tbody>';
                    $.each(data.books, function(index, book) {
                        booksHtml += '<tr>' +
                            '<td>' + book.title + '</td>' +
                            '<td>' + book.author + '</td>' +
                            '<td>' + (book.genre_name || 'Unknown') + '</td>' +
                            '<td>' + book.available_copies + '</td>' +
                            '</tr>';
                    });
                    booksHtml += '</tbody></table>';
                } else {
                    booksHtml = '<p>Nie znaleziono książek.</p>';
                }

                // Update pagination
                $('#results').html(booksHtml + data.pagination);

                // Update URL without reloading
                const params = new URLSearchParams();
                if (searchQuery) params.set('searchInput', searchQuery);
                params.set('search_type', searchType);
                params.set('page', page);
                history.pushState(null, '', '?' + params.toString());
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $('#results').html('<p>Wystąpił błąd podczas wyszukiwania.</p>');
            }
        });
    }
});
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'top'} */
/* {block 'footer'} */
class Block_88366771467ffe6c2a6a0c2_12259377 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_88366771467ffe6c2a6a0c2_12259377',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Robert Krzykawski<?php
}
}
/* {/block 'footer'} */
}
