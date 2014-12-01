{include file="header.tpl"}

{if $statut == ''}
<p class="center">Veuillez vous connecter pour accéder à cette page.</p>
{else}

<h2 class="center">Liste des Liens</h2>

{foreach $listeMatieres as $matiere}
	{if isset($possedeMatiere[$matiere['MAT_id']])}
	<h3 class="center">{$matiere['MAT_nom']}</h3>
	{foreach $listeLiens as $lienmat}
		{if $lienmat['MAT_id'] == $matiere['MAT_id']}
			<p class="center" id="{$lienmat['LI_id']}">
			<a href="{$lienmat['LI_adresse']}">{$lienmat['LI_nom']}</a>
			{if $statut == 'prof'}
				<img src="design/editer.png" alt="Editer ce lien" class="editer"/>
				<img src="design/supprimer.png" alt="Supprimer ce lien" class="supprimer" />
			{/if}
			</p>
		{/if}
	{/foreach}
	{foreach $listeGroupes as $groupe}
		{if $groupe['MAT_id'] == $matiere['MAT_id']}
			{if isset($possedeGroupe[$groupe['GR_id']])}
			<h4 class="center"><i>{$groupe['GR_nom']}</i></h4>
			{foreach $listeLiens as $liengroupe}
				{if $liengroupe['GR_id'] == $groupe['GR_id']}
					<p class="center" id="{$liengroupe['LI_id']}">
					<a href="{$liengroupe['LI_adresse']}">{$liengroupe['LI_nom']}</a>
					{if $statut == 'prof'}
						<img src="design/editer.png" alt="Editer ce lien" class="editer"/>
						<img src="design/supprimer.png" alt="Supprimer ce lien" class="supprimer" />
					{/if}
					</p>
				{/if}
			{/foreach}
			{/if}
		{/if}
	{/foreach}
	{/if}
{/foreach}

{/if}

{if $statut == 'prof'}

<h2 class="center">Ajouter un nouveau lien</h2>
<form method="post" id="lienFormulaire">
		<p class="center">
			<input type="hidden" id="idLien" name="idLien" />
			Nom du lien :<br />
			<input type="text" name="nomLien" id="nomLien" /></p>
		<p class="center">
			Adresse du lien :<br />
			<input type="text" name="adresseLien" id="adresseLien"></p>
		<p class="center">
			Image du lien :<br />
			<span class="explication">Laissez vide pour ne pas afficher d'image</span><br />
			<input type="text" name="imageLien" id="imageLien"></p>
		
		<p class="center">
			<span class="explication">Choisissez une matière ou un groupe dans lequel intégrer le lien.</span>
		</p>
			
		<p class="center">
			Matière du lien :<br />
			<select id="matiereLien" name="matiereLien">
				<option value="-1">Aucune matière</option>
				{foreach $listeMatieres as $matiere}
					<option value="{$matiere['MAT_id']}">{$matiere['MAT_nom']}</option>
				{/foreach}
			</select>
			</p>
			
		<p class="center">
			Groupe du lien :<br />
			<select id="groupeLien" name="groupeLien">
				<option value="-1">Aucun groupe</option>
				{foreach $listeGroupes as $groupe}
					<option value="{$groupe['GR_id']}">{$groupe['GR_nom']}</option>
				{/foreach}
			</select>
			</p>
		<p class="center">
			<input type="submit" value="Ajouter le lien" id="ajouterLien" /></p>
	</p>
</form>

{/if}

{include file="footer.tpl"}