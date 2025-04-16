{extends file="main.tpl"}

{block name=p_description}<p>Katalog książek</p>{/block}

{block name=top}
<div class="catalog-container">
    <h1>Katalog książek</h1>

    <form method="get" action="{$conf->action_root}catalog">
        <input type="text" name="search" value="{$search_query|escape}" placeholder="Szukaj...">
        <select style="width:15rem;" name="search_type">
            <option value="title" {if $search_type == 'title'}selected{/if}>Tytuł</option>
            <option value="author" {if $search_type == 'author'}selected{/if}>Autor</option>
        </select>
        <button type="submit">Szukaj</button>
    </form>

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
    {else}
        <p>Nie znaleziono książek.</p>
    {/if}

    <div class="pagination">
        {if $total_pages > 1}
            {if $current_page > 1}
                <a href="{$conf->action_root}catalog?page={$current_page-1}">&laquo; Poprzednia</a>
            {/if}

            {foreach from=range(1, $total_pages) item=page}
                <a href="{$conf->action_root}catalog?page={$page}" 
                   class="{if $page == $current_page}active{/if}">
                    {$page}
                </a>
            {/foreach}

            {if $current_page < $total_pages}
                <a href="{$conf->action_root}catalog?page={$current_page+1}">Następna &raquo;</a>
            {/if}
        {/if}
    </div>
</div>
{/block}


{block name=footer}Robert Krzykawski{/block}
