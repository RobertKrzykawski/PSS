{extends file="main.tpl"}
{block name=p_description}<p>Edytuj</p>{/block}
{block name=top}
<section>
    <h1>Edycja użytkownika</h1>
    <table>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Aktywny</th>
            </tr>
            {foreach from=$users item=user}
                <tr>
                    <td>{$user.user_id}</td>
                    <td>{$user.name}</td>
                    <td>{$user.surname}</td>
                    <td>{$user.email}</td>
                    <td>{$user.role_name}</td>
                    <td>{if $user.active == 1}Tak{else}Nie{/if}</td>
                </tr>
            {/foreach}
        </table>

    <form action="{$conf->action_root}userSave" method="post">
        <input type="hidden" name="user_id" value="{$form->user_id}" />

        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" value="{$form->name|default:''}" />

        <label for="surname">Nazwisko:</label>
        <input type="text" id="surname" name="surname" value="{$form->surname|default:''}" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{$form->email|default:''}" />

        <label for="role_id">Rola:</label>
        <select id="role_id" name="role_id">
            <option value="1" {if $form->role_id == 1}selected{/if}>Administrator</option>
            <option value="2" {if $form->role_id == 2}selected{/if}>Bibliotekarz</option>
            <option value="3" {if $form->role_id == 3}selected{/if}>Użytkownik</option>
        </select>

        <label for="active">Aktywny:</label>
        <select id="active" name="active">
            <option value="1" {if $form->active == 1}selected{/if}>Tak</option>
            <option value="0" {if $form->active == 0}selected{/if}>Nie</option>
        </select></br>
        
        <div class="col-12">
            <ul class="actions">
                <li><input type="submit" value="Zapisz" class="primary" /></li>
                <li><a href="{$conf->action_root}displayUsers">Powrót</a></li>
            </ul>
        </div>
    </form>
</section>	
{/block}
{block name=footer}Robert Krzykawski{/block}