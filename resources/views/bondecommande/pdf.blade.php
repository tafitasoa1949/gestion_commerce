<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bon de commande</title>
    <style>
        .left{
            float: left;
        }
        .right{
            float: right;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>
    <div style="text-align: center">
        <h5>MINISTERE DE L'INDUSTRIALISATION,</h5>
        <h5>DU COMMERCE ET DE LA CONSOMMATION</h5>
    </div>
    <div>
        <div class="left">
            <h5>E-TechKo</h5>
            <h5>NIF : 23k23JJJ8</h5>
            <h5>IMMEUBLE Itaosy</h5>
            <H5>SERVICE Informatique</H5>
        </div>
        <div class="right">
            <h5>Antananrivo, le {{ $dateHeureActuelles }}</h5>
            <h4>Departement : {{ $bondecommande[0]->departement }}</h4>
            <h4>N° facture : </h4>
        </div>
        <div class="clear"></div>
        <div class="container">
            <p>Doit(Frs) : {{ $bondecommande[0]->nom }} {{ $bondecommande[0]->prenom }}</p>
            <p>NIF : {{ $bondecommande[0]->nif }}</p>
            <p>STAT : {{ $bondecommande[0]->stat }}</p>
            <p>Email : {{ $bondecommande[0]->email }}</p>
            <p>Adresse : {{ $bondecommande[0]->adresse }}</p>
            <p>Contact : {{ $bondecommande[0]->contact }}</p>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Quantité</th>
                            <th>Prix Hors taxe</th>
                            <th>Tva</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listdetail as $detail)
                            <tr>
                                <td>{{ $detail->nom }}</td>
                                <td>{{ $detail->quantite }}</td>
                                <td>{{ $detail->prix_horstaxe }}</td>
                                <td>{{ $detail->tva }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td>Net à payer </td>
                            <td colspan="2">{{ $bondecommande[0]->montant_total }}</td>
                        </tr>
                    </tbody>
                </table>
                <p>Arretée la présente du facture à la somme de {{ $montant_lettre }} ariary</p>
            </div>
        </div>
        <div class="left" style="margin-left: 50px;">
            <p>Société</p>
        </div>
        <div class="right" style="margin-right: 50px;">
            <p>Fournisseur(s)</p>
        </div>
    </div>
</body>
</html>
