function verify ()
{
    var qte = document.getElementById("achatbundle_lignecommande_quantite").value;
    if ( qte < 0 )
        alert("quantite negative");

}