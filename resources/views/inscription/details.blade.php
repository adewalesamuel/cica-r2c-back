<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'inscription | {{ env('APP_NAME') ?? "CICA Admin" }}}</title>
    <style>
        * {box-sizing: border-box}

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 1.09rem;
        }

        ul {
            list-style-type: none;
            padding: 0 10px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            background-color: lightgrey;
        }

        .en-attente {
            background-color: orange;
        }

        .annule {
            color: white;
            background-color: grey;
        }

        .paye {
            background-color: limegreen;
        }

        ul li {
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <main>
        <div class="inscription">
            <ul>
                <li>
                    <strong>Status :</strong>
                    <span class="badge {{$inscription->status_paiement ?? ''}}">
                        {{$inscription->status_paiement ?? ""}}
                    </span>
                </li>
                <li>
                    <strong>Pack :</strong>
                    {{$inscription->pack->qualification ?? ""}}
                </i>
                <li>
                    <strong>Prix :</strong>
                    {{$inscription->prix ?? ""}}
                </i>
                <li>
                    <strong>Mode de paiement :</strong>
                    {{$inscription->mode_paiement ?? ""}}
                </i>
                <li>
                    <strong>Programmes :</strong>
                    @foreach ($inscription['programmes'] as $programme)
                        <div>{{$programme->titre ?? ""}}</div>
                    @endforeach
                </li>
                <li>
                    <strong>Utilisateur :</strong>
                    {{$inscription->utilisateur->civilité ?? ""}} 
                     {{$inscription->utilisateur->nom ?? ""}} 
                     {{$inscription->utilisateur->prenom ?? ""}}
                </i>
            </ul>
        </div>
    </main>
</body>
</html>