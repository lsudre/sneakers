<table class="table table-striped">
  <thead>
  <h3>Visualisation des prix</h3>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Marque</th>
      <th scope="col">Modèle</th>
      <th scope="col">Désignation</th>
      <th scope="col">Prix achat EUR</th>
      <th scope="col">Prix vente EUR</th>
      <th scope="col">Marge brut</th>
      <th scope="col">Edition</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $products = getQuery("select sneakers.id, sneakers.marque, sneakers.modele, sneakers.designation, sneakers.prix_achat_USD, sneakers.prix_vente_eur, sneakers.stockx_url_img from dev.sneakers");    
        // $eurPrice = currency("usd","eur",(int)$products['prix_achat_USD']);
        // var_dump($products);*
        // currency(100);
        // exit;
        foreach($products as $product) {
          $marge = ((float)$product['prix_vente_eur']) - (currency((int)$product['prix_achat_USD']));

            echo '<tr>';
            echo '<th scope="row">' . $product['id'] . '</th>
                    <td contenteditable="true">' . $product['marque'] . '</td>
                    <td>' . $product['modele'] . '</td>
                    <td>' . $product['designation'] . '</td>
                    <td>' . currency((int)$product['prix_achat_USD']) . " €" . '</td>
                    <td>' . $product['prix_vente_eur'] . " €" .'</td>
                    <td>' . $marge . " €" .'</td>
                    <td><label class="switch-wrap">
                    <input type="checkbox" />
                    <div class="switch"></div>
                  </label></td>';
            echo '</tr>';
        }
    ?>
  </tbody>
</table>
<style>

</style>
<script>
  $("#editable-button").click(function(){
    if ((this).class("btn btn-light")) {
      $(this).removeClass("btn-light");
      $(this).class("btn-dark");
    } else {
      $(this).removeClass("btn-dark");
      $(this).class("btn-light");
    }
    
    
  
});
</script>