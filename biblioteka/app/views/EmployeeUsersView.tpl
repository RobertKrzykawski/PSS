{extends file="main.tpl"}
{block name=p_description}<p>Dodaj użytkownika</p>{/block}
{block name=top}
<div style="width:90%; margin: 2em auto;">
    <section>
        <h1>Dodaj Użytkownika</h1>
        <form id="addUserForm" action="{$conf->action_root}addUser" method="post">
            <div class="row gtr-uniform gtr-50">
                <div class="col-4 col-12-xsmall">
                    <label for="name">Imię:</label>
                    <input type="text" id="name" name="name" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="surname">Nazwisko:</label>
                    <input type="text" id="surname" name="surname" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" required><br>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label for="role">Rola:</label>
                    <select id="role_id" name="role_id" required>
                        <option value="3">Użytkownik</option>
                        <option value="2">Bibliotekarz</option>
                    </select><br>
                </div>

                <div class="col-12">
                    <input type="submit" class="primary" value="Dodaj użytkownika">
                </div>
            </div>
        </form>
    </section>
</div>
{/block}
{block name=footer}Robert Krzykawski{/block}