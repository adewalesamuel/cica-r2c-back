<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <title>Votre Ticket pour le CICA</title>
    <style>
        * {box-sizing: border-box}
        
        body {
            font-family: system-ui,-apple-system,"Segoe UI","Roboto","Helvetica Neue",
            Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji",
            "Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-size: 16px;
            background-color: rgba(228, 230, 240, 0.2);
            padding: 30px 0;
            color: rgb(70, 76, 88);
        }
   
        .h2 {
            font-weight: bolder;
            font-size: 28px;
        }

        .message-container {
            max-width: 520px;
            background-color: white;
            padding: 30px 25px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="message-container">
        <p>
            Bonjour <strong>{{ $inscription->utilisateur->civilite ?? "Monsieur" }} 
                {{$inscription->utilisateur->nom ?? "Nom"}}  
                {{$inscription->utilisateur->prenom ?? "Prenom"}}</strong>,
        </p>
        <p>
            Veuillez trouver ci-joint votre ticket pour le
            <span class="h2"> Congrès International de Cicatrisation des Antilles</span>
        </p>
        <p>Du 17 au 18 Novembre 2022</p>
        <img src="{{ asset('images/arawak-hotel-map.jpg')}}" alt="Hotel Arawak google map" width="100%"/>
        <p>ARAWAK BEACH RESORT 41, RUE DES HÔTES - POINTE DE LA VERDURE 97190 LE GOSIER</p>

        <br />
        <br />
        <hr />
        <small style="text-align: center; display: inline-block">
            Merci de noter que certaines données relatives à votre participation peuvent figurer sur une 
            liste de participants rendue publique par l’organisateur. Si vous ne souhaitez pas que vos 
            données figurent sur cette liste ou si vous désirez obtenir de plus amples informations à ce
            sujet, n’hésitez pas à nous contacter à l'adresse info@cica2022.com.
        <small>
    </div>
</body>
</html>