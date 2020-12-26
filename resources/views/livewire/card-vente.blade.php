<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    PRICE EST {{ $price }}
    <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">MARGE DES PRIX ( #FBU)</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">

                    <div class="p-2 px-3">
                      PRIX UNITAIRE
                    </div>



                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">PRIX</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">QUANTITE</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">SUPPRIMMER</div>
                  </th>
                </tr>
              </thead>
              <tbody>


                @foreach ($products as $product)
                {{-- expr --}}

                <tr>
                  <th scope="row" class="border-0">
                    {{$product->name}}
                  </th>

                   <th scope="row" class="border-0">
                    {{getPrice($product->model->price_min) . ' - '. getPrice($product->model->price_max)}} 
                     
                  </th>

                  <th>

                    <input type="number" wire:keydown="changePrice({{ $product->rowId  }})" class="price_input"  value="{{ $product->price }}" class="form-control">

                  </th>

                  <th>
                    {{ getPrice($product->subtotal())  }}
                  </th>

                  <td class="border-0 align-middle">

                   <select name="qty" id="qty" class="quantite quantite_select" data-id="{{ $product->rowId }}" class="custom-select">
                     @for ($i = 1; $i <=$product->model->quantite ; $i++)

                     {{-- expr --}}
                     <option value="{{ $i }}" {{ ($i == $product->qty) ? 'selected':'' }}>{{ $i }}</option>
                     @endfor
                   </select>
                 </td>
                 <td class="border-0 align-middle">

                   <form action="{{ route('cart.destroy',$product->rowId) }}" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" ><i class="fa fa-trash"></i></button>
                   </form>

                 </td>
               </tr>
               @endforeach

             </tbody>
           </table>
         </div>
         <!-- End -->
       </div>
     </div>

     <div class="row py-5 p-4 bg-white rounded shadow-sm">
      <div class="col-lg-6">
        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">INFORMATION DU CLIENT</div>
        <div class="p-1">

         <form action="{{ route('payement') }}" method="post">
          @csrf

          @method('post')

          <div class="form-group">
            <input required="" type="text" name="name" value="{{ old('name') }}" placeholder="Entrer le nom ici" aria-describedby="button-addon3" class="form-control border-2">


        
         </div>

         <div class="form-group">
           <input type="text" name="telephone" placeholder="Entrer le numéro du téléphone" aria-describedby="button-addon3" class="form-control border-2">
         </div>


          <div class="form-group">
            <label for="type_paiement">MODE DE PAIEMENT</label>
           <select required="" class="form-control" name="type_paiement" id="">
             <option value="">Choisissez ...</option>
             <option value="CACHE">EN CACHE</option>
             <option value="DETTE">DETTE</option>
           </select>
         </div>

         <button type="submit" class="btn btn-dark rounded-pill py-2 btn-block">Valider</button>
       </form>


        {{--  <div class="input-group mb-4 border rounded-pill p-2">
          <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
          <div class="input-group-append border-0">
            <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Enregistrer</button>
          </div>
        </div> --}}
      </div>
      <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions pour le client</div>


    </div>
    <div class="col-lg-6">
      <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Déscription  </div>
      <div class="p-4">

        <ul class="list-unstyled mb-4">
          <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">PHTVA </strong><strong>{{getPrice(Cart::subtotal())}}</strong></li>

          <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">TVA</strong><strong>{{ getPrice(Cart::tax()) }}</strong></li>
          <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
            <h5 class="font-weight-bold">{{ getPrice(Cart::total()) }}</h5>
          </li>
        </ul>

        

      </div>
    </div>
  </div>
</div>
