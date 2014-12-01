{include file="header.tpl"}

<h2 class="center">{$titreDevoir}</h2>

<p class="center">{$sujetDevoir|nl2br}</h2>

<form method="post" action="rendus_consulter.php?id={$idDevoir}">
	<p class="center">
		<textarea name="renduDevoir" id="renduDevoir">{$texte}</textarea>
		<br /><br />
		<input type="submit" value="Envoyer" />
	</p>
</form>

{include file="footer.tpl"}
