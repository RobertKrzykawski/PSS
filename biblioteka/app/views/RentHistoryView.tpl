{extends file="main.tpl"}

{block name=p_description}<p>Historia wypożyczenia</p>{/block}

{block name=top}
<section>
    <h1>Historia wypożyczenia</h1>
    {if $rents|@count > 0}
        <table>
            <tr>
                <th>Nr wypożyczenia</th>
                <th>Data wypożyczenia</th>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>Data oddania</th>
            </tr>
            {foreach $rents as $rent}
                <tr>
                    <td>{$rent.rent_id}</td>
                    <td>{$rent.rent_date}</td>
                    <td>{$rent.book_title}</td>
                    <td>{$rent.book_author}</td>
                    <td>{$rent.return_date}</td>
                </tr>
            {/foreach}
        </table>

        <div class="pagination">
            {if $current_page > 1}
                <a href="{$conf->action_root}rentHistory?page={$current_page-1}">&laquo; Poprzednia</a>
            {/if}
            {section name=page loop=$total_pages}
                <a href="{$conf->action_root}rentHistory?page={$smarty.section.page.index+1}" 
                   class="{if $smarty.section.page.index+1 == $current_page}active{/if}">
                    {$smarty.section.page.index+1}
                </a>
            {/section}
            {if $current_page < $total_pages}
                <a href="{$conf->action_root}rentHistory?page={$current_page+1}">Następna &raquo;</a>
            {/if}
        </div>
    {else}
        <p>Brak wypożyczenia do wyświetlenia.</p>
    {/if}
</section>
{/block}
{block name=footer}Robert Krzykawski{/block}