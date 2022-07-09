<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket ID {{ $inscription->paiement_id ?? "" }}</title>
    <style>
        * {box-sizing: border-box}

        body, html {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.02rem;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        table {
            border-spacing: 2px;
        }
    
        th {
            background-color: lightgrey;
        }

        th, td {
            padding: 5px 0;
            text-align: center
        }

        table td:first-child {
            text-align: left;
        }
    
        table td {
            padding: 10px 20px;
        }

        .ticket-container {
            display: flex;
            justify-content: flex-end;
            flex-flow: row wrap;
            padding: 2rem 1.5rem;
        }

        .ticket-info {
            text-align: right;
        }

        .order-table, table { width: 100%;}

        .order-table {
            margin-top: 100px;
        }

        .qr-code {
            display: inline-block;
            position: absolute;
            top: 20px;
            left: 30px;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="qr-code">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data= {{ env('APP_URL') . "/inscriptions/" . $inscription->paiement_id . "/details" }}" width="220px" height="220px">
        </div>
        <div class="ticket-info">
            <h2>Ticket # {{  $inscription->id ?? ""}}</h2>
            <ul>
                <li>Date de commande : {{ date_format(date_create($inscription->created_at), 'd-m-Y') }}</li>
                <li>Numero de commande : {{ $inscription->id ?? ""}}</li>
                <li>Method de paiement : {{ $inscription->mode_paiement ?? "" }}</li>
            </ul>
        </div>
        <div class="order-table">
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
        </div>
    </div>
</body>
</html>