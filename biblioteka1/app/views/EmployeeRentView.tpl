{extends file="main.tpl"}
{block name=p_description}<p>Podgląd wypożyczeń książek</p>{/block}
{block name=top}
<section>
    <h1>Zarządzanie wypożyczeniami</h1>
    <form action="{$conf->action_root}employeeRents" method="post">
        <label for="rent_date">Filtruj po dacie wypożyczenia:</label>
        <input type="date" id="rent_date" name="rent_date" value="{$date_filter|default:''}">

        <label for="rent_id">Filtruj po ID wypożyczenia:</label>
        <input type="number" id="rent_id" name="rent_id" min="0" value="{$rent_id_filter|default:''}">

        <label for="users_surname">Filtruj po nazwisku użytkownika:</label>
        <input type="text" id="users_surname" name="users_surname" value="{$surname_filter|default:''}">

        <label for="book_title">Filtruj po tytule książki:</label>
        <input type="text" id="book_title" name="book_title" value="{$book_title_filter|default:''}">

        <input type="submit" value="Filtruj">
    </form>

    {if isset($rents) && $rents|@count > 0}
    <table>
        <tr>
            <th>Nr wypożyczenia</th>
            <th>Data wypożyczenia</th>
            <th>Termin zwrotu</th>
            <th>Status</th>
            <th>Tytuł książki</th>
            <th>Autor</th>
            <th>Użytkownik</th>
            <th>Akcja</th>
        </tr>
        {foreach from=$rents item=rent}
        {assign var="today" value=$smarty.now|date_format:"%Y-%m-%d"}
        <tr {if $rent.return_date < $today && $rent.status != 'Zwrócone'}style="background-color: red; color: white;"{/if}>
            <td>{$rent.rent_id}</td>
            <td>{$rent.rent_date}</td>
            <td>{$rent.return_date}</td>
            <td>{$rent.status}</td>
            <td>{$rent.book_title}</td>
            <td>{$rent.book_author}</td>
            <td>{$rent.user_name} {$rent.user_surname}</td>
            <td>
                <form action="{$conf->action_root}updateRentStatus" method="post">
                    <input type="hidden" name="rent_id" value="{$rent.rent_id}">
                    <select name="status">
                        <option value="Wypożyczone" {if $rent.status == 'Wypożyczone'}selected{/if}>Wypożyczone</option>
                        <option value="Zwrócone" {if $rent.status == 'Zwrócone'}selected{/if}>Zwrócone</option>
                        <option value="Przeterminowane" {if $rent.status == 'Przeterminowane'}selected{/if}>Przeterminowane</option>
                    </select>
                    <input type="submit" value="Zaktualizuj">
                </form>
            </td>
        </tr>
        {/foreach}
    </table>
    {else}
    <p>Brak wypożyczeń do wyświetlenia.</p>
    {/if}
</section>
</div>
{/block}
{block name=footer}Robert Krzykawski{/block}
