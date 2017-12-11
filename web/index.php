<html>
	<head>
		<title>Pizzerie</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<?php
		$n=50;
		$citta="bergamo";
		$richiesta="pizzeria";
		# questo script chiama un'API e la inserisce in una tabella 
		# Indirizzo dell'API da richiedere
		$indirizzo_pagina="https://api.foursquare.com/v2/venues/search?v=20161016&query=$richiesta&nit=$n&intent=checkin&client_id=XTT32MSNDEPOVNS4SCCQEEHT4JJXB3P12AXWR50GNM4KUN1Q&client_secret=FIWH4MQRDDMZH4ZDWFD2XXAEXXTJXMN1SMMFRARQAKBX2L5N&near=$citta";
		# Codice di utilizzo di cURL
		# chiama l'API e la immagazzina in $json
		
		$chiamata = curl_init() or die(curl_error());
		curl_setopt($chiamata, CURLOPT_URL,$indirizzo_pagina);
		curl_setopt($chiamata, CURLOPT_RETURNTRANSFER, 1);
		$json=curl_exec($chiamata) or die(curl_error());
		# Decodifico la stringa json e la salvo nella variabile $data
		$data = json_decode($json);
		
		echo "<table>";
			echo "<tr>";
				echo "<th>PIZZERIA</th>";
				echo "<th>LATITUDINE</th>";
				echo "<th>LONGITUDINE</th>";
			echo "</tr>";
			for($i=0; $i<$n; $i++)
			{	
				echo "<tr>";
					echo "<td>";
					echo $data->response->venues[$i]->name;
					echo "</td>";
					echo "<td>";
					echo $data->response->venues[$i]->location->lat;
					echo "</td>";
					echo "<td>";
					echo $data->response->venues[$i]->location->lng;
					echo "</td>";
				echo "</tr>";
			}
		echo "</table>";
		echo curl_error($chiamata);
		curl_close($chiamata);
	?>
	</body>
</html>
