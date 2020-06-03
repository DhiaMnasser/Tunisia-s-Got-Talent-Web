function verif() {
	var qte=document.getElementById("tgt_stockbundle_produit_qte").value;
	var prix=document.getElementById("tgt_stockbundle_produit_prix").value;
	if(qte<0)
	{
		alert("Qte negative");
	}
	if(prix<0)
	{
		alert("prix negative");
	}

}