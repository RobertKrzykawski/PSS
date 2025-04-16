{extends file="main.tpl"}

{block name=p_description}<p>Katalog książek</p>{/block}

{block name=top}
<div class="catalog-container">
    <h1>Katalog książek</h1>

    <form id="searchForm" method="get" action="{$conf->action_root}catalog">
        <input type="text" id="searchInput" name="searchInput" value="{$search_query|escape}" placeholder="Szukaj...">
        <select style="width:15rem;" name="search_type" id="searchType">
            <option value="title" {if $search_type == 'title'}selected{/if}>Tytuł</option>
            <option value="author" {if $search_type == 'author'}selected{/if}>Autor</option>
        </select>
        <button type="submit">Szukaj</button>
    </form>

    <div id="results">
        {if isset($books) && $books|@count > 0}
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
                    {foreach from=$books item=book}
                        <tr>
                            <td>{$book.title}</td>
                            <td>{$book.author}</td>
                            <td>{$book.genre_name|default:'Unknown'}</td>
                            <td>{$book.available_copies}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
            {$pagination}
        {else}
            <p>Nie znaleziono książek.</p>
        {/if}
    </div>
</div>

{literal}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
            url: '{/literal}{$conf->action_root}ajaxSearchBooks{literal}',
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
</script>
{/literal}
{/block}
{block name=footer}Robert Krzykawski{/block}