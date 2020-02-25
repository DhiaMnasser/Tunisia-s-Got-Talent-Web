function verif()
        	 {
        	 	var nom = document.getElementById("eventbundle_evenement_nomevent").value ;
        	 	var duree = document.getElementById("eventbundle_evenement_duree").value ;
        	 	var max = document.getElementById("eventbundle_evenement_maxParticipants").value ;
        	 	var etat = document.getElementById("eventbundle_evenement_etat").value ;

				 var yeardebut = Date.parse(document.getElementById("eventbundle_evenement_dateD_year").value) ;
				 var yearfin = Date.parse(document.getElementById("eventbundle_evenement_dateF_year").value) ;

				 var moisdebut = Date.parse(document.getElementById("eventbundle_evenement_dateD_month").value) ;
				 var moisfin = Date.parse(document.getElementById("eventbundle_evenement_dateF_month").value) ;

				 var jourdebut = Date.parse(document.getElementById("eventbundle_evenement_dateD_day").value) ;
				 var jourfin = Date.parse(document.getElementById("eventbundle_evenement_dateF_day").value) ;

				 if ((yeardebut>yearfin ) || (yearfin == yeardebut && moisdebut>moisfin) || (yearfin == yeardebut && moisdebut==moisfin && jourdebut>=jourfin))
				 {
				 	alert ("La date de début est supérieure ou égale à la date de fin, veuillez vérifier !") ;
				 }

        	 	if (nom == "")

			{alert ("champ <<nom>>   vide !") ;}

		if (duree < 0)

			{alert ("Durée négative , impossible !") ;}
      if (max < 0)

			{alert ("nombre de participants négatif, impossible !") ;}
if (etat < 0 || etat > 1)

			{alert ("l'état doit être égale à 0 ou 1") ;}


        	 }

        	 function verif2 ()
        	 {
        	 	var nom = document.getElementById("eventbundle_evenement_nomevent").value ;
        	 	var duree = document.getElementById("eventbundle_evenement_duree").value ;
        	 	var max = document.getElementById("eventbundle_evenement_maxParticipants").value ;
        	 	
        	 	var etat = document.getElementById("eventbundle_evenement_etat").value ;
				 var yeardebut = Date.parse(document.getElementById("eventbundle_evenement_dateD_year").value) ;
				 var yearfin = Date.parse(document.getElementById("eventbundle_evenement_dateF_year").value) ;

				 var moisdebut = Date.parse(document.getElementById("eventbundle_evenement_dateD_month").value) ;
				 var moisfin = Date.parse(document.getElementById("eventbundle_evenement_dateF_month").value) ;

				 var jourdebut = Date.parse(document.getElementById("eventbundle_evenement_dateD_day").value) ;
				 var jourfin = Date.parse(document.getElementById("eventbundle_evenement_dateF_day").value) ;

				 if ((yeardebut>yearfin ) || (yearfin == yeardebut && moisdebut>moisfin) || (yearfin == yeardebut && moisdebut==moisfin && jourdebut>=jourfin))
				 {
					 alert ("La date de début est supérieure ou égale à la date de fin, veuillez vérifier !") ;
				 }
        	 	if (nom == "")

			{alert ("champ <<nom>> vide !") ;}

		if (duree < 0)

			{alert ("Durée négative , impossible !") ;}
      if (max < 0)

			{alert ("nombre de participants négatif, impossible !") ;}
if (etat < 0 || etat > 1)

			{alert ("l'état doit être égale à 0 ou 1") ;}

else {alert("Evénement modifié avec succès");}
        	 


        	 }
        	 function verif3 ()
        	 {
        	 alert("Evénement supprimé avec succès");


        	 }
        	 function verifRegion()
			 {
				 var nbvilles = document.getElementById("eventbundle_region_nbVilles").value ;
				 if (nbvilles < 0)

				 {alert ("Nombre de villes négatif , impossible !") ;}
			 }
function verif2Region()
{
	var nbvilles = document.getElementById("eventbundle_region_nbVilles").value ;
	if (nbvilles < 0)

	{alert ("Nombre de villes négatif , impossible !") ;}
}
function verif3Region()
{
	alert("Region supprimée avec succès");
}