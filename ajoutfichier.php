<DOCTYPE HTML>
	<html>
		<head>
			Ajout du fichier
		</head>
		<body>
			<?php
				require('./connexion.php');
				$req = $db->prepare('Select Type_activités from variables');
			echo"aaaaaaaa";
			?>
			<form action="ajoutfichier.php" method="post" name="ajouterfichier">
				Nom du parcours<input type="text" name="nom"><br/>
				Parcours<input type="file" name="fichier"><br/>
				Description du parcours<input type="text" name="description"><br/>
				Météo <input type="radio" id="beauTemps" name="meteo" value="beauTemps">
				<label for="beauTemps">Beau Temps</label>
				<input type="radio" id="Nuageux" name="meteo" value="Nuageux">
				<label for="Nuageux">Nuageux</label>
				<input type="radio" id="Pluvieux" name="meteo" value="Pluvieux">
				<label for="Pluvieux">Pluvieux</label>
				<input type="radio" id="Neige_Orage" name="meteo" value="Neige_Orage">
				<label for="Neige_Orage">Neige/Orage</label><br/>
				Type d'activité <select name="activité" required>
					<?php
						$req->execute();
						$i = 1;
						while($data = $req -> fetch()){
							echo"<option value=$i name='activité'>$data[0]</option>";
							$i++;
						}
						echo"<option value=0 name='activité'>Ajouter une nouvelle activité</option>";

					?>
				</select><br/>
				<?php
					if($_POST['activité'] == 0){
						echo"Nom de l'activité<input type='text' name='nom_activité'><br/>";
					}
				?>
				Seul/Groupe : <input type="radio" id="seul" name="groupe" value="seul">
				<label for="seul">Seul</label>
				<input type="radio" id="groupe"name="groupe" value="groupe">
				<label for="groupe">Groupe</label>
				HomeTrainer : <input type="radio" id="home"name="hometrainer" value="home">
				<label for="home">Oui</label>
				<input type="radio" id="Non"name="hometrainer" value="non">
				<label for="non">Non</label>
				Personne :<select name="Personne">
				<?php 
					$req2 = $db ->prepare('select Id_Personne, Nom,Prénom from Personne');
					$req2->execute();
					while($data = $req2 -> fetch()){
						echo"<option value=$data[0] name='Personne'>$data[1] $data[2]</option>";
					}
				?>
				</select>

		</body>
	</html>

