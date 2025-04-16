{extends file="main.tpl"}
{block name=p_description}<p>Logowanie</p>{/block}
{block name=top}
<h2>Zaloguj się</h2>
<form action="{$conf->action_root}login" method="post">
	<div class="row gtr-uniform">
		<div class="col-6 col-12-xsmall">
			<input id="login" type="text" name="login" value="{$form->login}" placeholder="Email"/>
		</div>
		<div class="col-6 col-12-xsmall">
            <input id="password" type="password" name="password" value="{$form->password}" placeholder="Hasło"/>
        </div>
		<div class="col-12">
            <ul class="actions">
                <li><input type="submit" value="Zaloguj" class="primary" /></li>
            </ul>
        </div>
	</div>
</form>
{/block}
{block name=footer}Robert Krzykawski{/block}