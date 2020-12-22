<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture MAGASIN APP</title>
    <link rel="stylesheet" href="{{ asset('css/print.min.css') }}">

    <script src="{{ asset('js/print.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/facture.css') }}">
</head>
<body>



    <div class="main-content" id="printJS-form">
        <div class="noprint header-element">
            
            <button onclick="print()" class="noprint">Imprimmer</button>

            <a href="{{ route('ventes.index') }}">Retourner</a>
        </div>
        <header>
         <div class="header-facture">FACTURE</div>

         <div>N° {{ $order->id }} du {{ $order->created_at->format('d-m-Y') }}</div>

     </header>

     <main>
        <h5>A. Indentification du vendeur</h5>

        <span>Nom et Prénom ou Raison Social :<b> NDIKUMANA JACQUELINE </b></span>


        <div class="header-doc">

            <div>
                NIF : 4001 272899 <br>
                Registre de commerce N° : 2020202
                <br>
                B.P : ..... Tél: 79 903 600 <br>
                Commune : ......... Quartier: ........

                Av: ....... Rue: .... N°: ...... <br>

                Assujeti à la TVA : OUI ... NON ...  
            </div>

            <div class="line"></div>

            <div>
                Centre Fiscale : ....... <br>
                Secteur d'activité : .... 
                <br>
                Forme jurdique : ....
            </div>

            
        </div>


    </main>

    <section>
        <h5> Le Client : </h5>
        Nom et Prénom ou Raison sociale * : {{  collect(json_decode($order->client))->get('name') ?? "" }} <br>

        TEL : {{  collect(json_decode($order->client))->get('telephone') ?? "" }}  <br>
        NIF : ............  <br>
        Résident à : ........... <br>

        Assujeti à la TVA : OUI 🚒 NON 🚳

    </section>

    <h5>dout pour ce qui suit : </h5>

    <article>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nature de l'articel ou service *</th>
                    <th>Qté *</th>
                    <th> PU*</th>
                    <th>PV-HTVA*</th>
                </tr>

                

            </thead>

            <tbody>



                @foreach(unserialize($order->products) as $key=> $product)

                <tr>
                    <td>{{ $key +1 }}</td>

                    <td> {{ $product['name'] }}</td>
                    <td> {{ $product['quantite'] }}</td>
                    <td> {{ getPrice($product['price'] ) }}</td>
                    <td> {{ getPrice( $product['price'] * $product['quantite'])  }}</td>
                </tr>

                @endforeach

                <tr>
                    <td colspan="3">PVT HTVA </td>

                    <td>{{ getPrice( $order->amount_tax )}}</td>
                </tr>
                <tr>
                    <td colspan="3">TVA</td>

                    <td>{{ getPrice($order->tax )}}</td>
                </tr>

                <tr>
                    <td colspan="3">TOTAL TVAC</td>
                    <td>{{ getPrice($order->amount) }}</td>

                </tr>
            </tbody>
        </table>
    </article>

    <footer>
        * Mention obligatoire

        <br>
        <u>NB:</u> <span>Les non assujettis à la TVA ne remplissent pas les deux dernières lignes .</span>
    </footer>

</div>

<script>
    function print(){

       printJS({
        printable: "printJS-form",
        type: 'html',
        css : {{ asset('css/facture.css') }}

    }
    );
   }


</script>
</body>
</html>

