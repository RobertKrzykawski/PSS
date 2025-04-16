{extends file="main.tpl"}
{block name=p_description}<p>Wypożycz książkę</p>{/block}
{block name=top}
<section>
    <form action="{$conf->action_root}rent" method="post">
    <div class="row gtr-uniform gtr-50">
        <div class="col-12">
            <label for="book_id">Wybierz książkę:</label>
            <select id="book_id" name="book_id" required>
                <option value="">Wybierz książkę</option>
                {foreach $books as $book}
                    <option value="{$book.book_id}" {if $book.available_copies <= 0}disabled{/if}>
                        "{$book.title}" - {$book.author} (dostepnych: {$book.available_copies})
                    </option>
                {/foreach}
            </select>
        </div>
        <div class="col-12">
                <ul class="actions">
                {if $isLoggedIn}
                    <li><input type="submit" value="Wypożycz" class="primary"/></li>
                {else}
                    <li><a href="{$conf->action_root}loginShow" class="button primary">Musisz być zalogowany, aby wypożyczyć książkę. Zaloguj się</a></li>
                {/if}
                </ul>
            </div>
    </div>
    </form>
    
    <form action="{$conf->action_root}rent" method="post" id="rentForm">
        <div class="row gtr-uniform gtr-50">
            <div class="col-6 col-12-medium">
                <label for="currentDate">Data wypożyczenia:</label>
                <input type="date" id="currentDate" name="currentDate" value="{$currentDate}" readonly />
            </div>

            <div class="col-6 col-12-medium">
                <label for="nextMonthDate">Data oddania:</label>
                <input type="date" id="nextMonthDate" name="nextMonthDate" value="{$nextMonthDate}" readonly />
            </div>
        </div>
    </form>
</section>
{/block}
{block name=footer}Robert Krzykawski{/block}