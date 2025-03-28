{extends file="main.tpl"}
{block name=p_description}<p>Edytuj</p>{/block}
{block name=top}
<section>
    {if isset($users) && $users|@count > 0}
        <table>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Aktywny</th>
                <th>Akcje</th>
            </tr>
            {foreach from=$users item=user}
                <tr>
                    <td>{$user.user_id}</td>
                    <td>{$user.name}</td>
                    <td>{$user.surname}</td>
                    <td>{$user.email}</td>
                    <td>{$user.role_name}</td>
                    <td>{if $user.active == 1}Tak{else}Nie{/if}</td>
                    <td>
                        <a href="{$conf->action_root}userEdit/{$user.user_id}">Edytuj</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {else}
    <p>Brak użytkowników do wyświetlenia.</p>
    {/if}
</section>	
{/block}
{block name=footer}Robert Krzykawski{/block}