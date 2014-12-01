{include file="header.tpl"}

<h1 class="center">Classe de {$nomClasse}</h1>

<p align="center">Pour ajouter un élève, entrez son nom et prénom dans une case vide puis validez. Une nouvelle case sera automatiquement créée.<br />
Pour supprimer un élève, cliquez sur la croix à droite puis validez.</p>

<div id="colonnePrenom"><p>Prénom</p></div>
<div id="colonneNom"><p>Nom</p></div>

<div class="clear"></div>

<form method="post">

<div class="eleves">

{foreach $eleves as $eleve}
<div class="eleve">
<input type="text" class="gestionPrenom champ" name="prenoms[]" value="{$eleve['EL_prenom']}">
<input type="text" class="gestionNom champ" name="noms[]" value="{$eleve['EL_nom']}">
<input type="hidden" name="ids[]" value="{$eleve['EL_id']}">
<input type="hidden" class="modifie" name="modifie[]" value="0">
<img class="supprimerEleve" src="design/supprimer.png" />
</div>
{/foreach}

{* Champs supplémentaire pour ajout nouvel élève*}
<div class="eleve">
<input type="text" class="gestionPrenom champ new" name="prenoms[]" value="">
<input type="text" class="gestionNom champ new" name="noms[]" value="">
<input type="hidden" name="ids[]" value="">
<input type="hidden" class="modifie" name="modifie[]" value="0">
</div>

</div>

<p class="center">
<input id="valider" type="submit" value="Valider les modifications" />
</p>

</form>
{include file="footer.tpl"}
