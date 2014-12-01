{* Inclusion du template du header *}
{include file="header.tpl"}

<div id="menu">
	<div id="liens" class="bouton">
	<p>Liens</p>
	</div>
	
	<div id="photos" class="bouton">
	<p>Photos</p>
	</div>
	
	<div id="rendus" class="bouton">
	<p>Rendus</p>
	</div>
	
	<div id="quizz" class="bouton">
	<p>Quizz</p>
	</div>
</div>

{if $statut == 'prof'}
<div id="menuEnseignants">
	<div id="notes" class="bouton">
	<p>Notes</p>
	</div>
	
	<div id="gestion" class="bouton">
	<p>Gestion des élèves</p>
	</div>
</div>

{if $admin == '1'}
<div id="menuAdmin">
	<div id="administration" class="bouton">
	<p>Administration générale</p>
	</div>
</div>
{/if}
{/if}

</div>

{* Inclusion du template du footer *}
{include file="footer.tpl"}
