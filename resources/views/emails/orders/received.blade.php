<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Votre inscription pour le CICA à bien été reçu !</title>
    <style>
        * {box-sizing: border-box}
    
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            background-color: rgba(228, 230, 240, 0.2);
            padding: 30px 0;
            color: rgb(70, 76, 88);
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
    
        table, td, th {
            border: 1px solid lightgrey;
        }
    
        table td {
            padding: 10px 20px;
        }
    
        ul {
            padding: 0;
            list-style-type: none;
        }
    
        .h2 {
            font-weight: bolder;
            font-size: 28px;
        }
    
        .message-container {
            max-width: 480px;
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
                {{$inscription->utilisateur->prenom ?? "Prenom"}} </strong>
        </p>
        <p>
            Merci pour votre inscription pour le
            <span class="h2">Congrès International de Cicatrisation des Antilles</span>
        </p>
        <p>Voici les détails de votre inscription :</p>
        <table>
            <thead>
                <th>Description</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{$inscription->pack->qualification ?? ""}}
                        <ul>
                            @foreach ($inscription['programmes'] as $programme)
                                <li>{{$programme->titre ?? ""}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{$inscription->prix ?? ""}} €</td>
                    <td>{{$inscription->prix ?? ""}} €</td>
                </tr>
            </tbody>
        </table>
        <p>
            Vous avez des questions ? Vous pouvez nous contacter à l'adresse suivante: 
            <a href="mailto:info@cica2022.com">info@cica2022.com</a>
        </p>
    </div>
</body>
</html>