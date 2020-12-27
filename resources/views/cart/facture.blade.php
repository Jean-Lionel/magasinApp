<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture MAGASIN LE LEADER</title>
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
     
         <div class="header-facture">
             <h3>NDIKUMANA Jacqueline</h3>
             <span>ndikumanajacky@gmail.com</span>
         </div>

         <div class="fac_title">FACTURE PROFORMAT N° {{ $order->id }} du {{ $order->created_at->format('d-m-Y') }}</div>


  

     <main>
        <h5 style="margin-left: 4pc;">A. Indentification du vendeur</h5>


    </main>

    <section>
       {{--  
 --}}
        Nom et Prénom ou Raison sociale * : <b>NDIKUMANA Jacqueline</b>  <br>

        <div style="display: flex; justify-content: space-between;">

            <span>NIF : 4001272899</span>
           
            <span>Centre fiscal : <b>DPMC</b></span>
        </div>

        <div style="display:flex; justify-content:space-between;">
            <span>Registre de commerce n° 114146</span>
            <span>Secteur d'activité : <b>Matériel de Bureau et Divers</b></span>
        </div>

   {{--      TEL : {{  collect(json_decode($order->client))->get('telephone') ?? "" }}  <br> --}}
        <div style="display: flex;justify-content: space-between;">
            <span>Commune <b>MUKAZA</b>, Quartier <b>ROHERO I</b></span>

            <span>Forme jurdique : <b>personne physique</b></span>
        </div>
        <div style="margin-top: 3pc; display: flex;justify-content: space-between;">
            <div>
                AV . de la Révolution N° 1 <br>
            Assujetti à la TVA <span class="cadre"></span> Oui <span class="cadre">X</span> Non
            </div>
            <div>
                Client : <b>{{  collect(json_decode($order->client))->get('name') ?? "" }}</b>
                
            </div>
        </div>

    </section>

    <h5>Droit pour ce qui suit : </h5>

    <article>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nature de l'article ou service *</th>
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

