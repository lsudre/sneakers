<?php
	require_once 'parts/header.php';
	require_once 'parts/navbar.php';
	require('config/db.php');
	require_once 'lib/form/class.formr.php';
	require('func.php');
?>
<body>
	<div class="container">
		<?php
		if ($_GET['admin'] == "create") {
			$form = new Formr('bootstrap');
			echo $form->form_open('','','index.php?admin=create');
			echo $form->create("Marque, Modele, Designation, Prix d'achat USD|number, Lien stockX, Lien dhgate");
			echo $form->input_submit();
			echo $form->form_close();
			
			if (isset($_POST['submit'])) {
				$brand = $_POST['marque'];
				$model = $_POST['modele'];
				$designation = $_POST['designation'];
				$priceUsd = $_POST['prix_d\'achat_usd'];
				$urlX = $_POST['lien_stockx'];
				$imgX = getImgFromUrl($urlX);
				$urlDhgate = $_POST['lien_dhgate'];
				$query = "INSERT INTO dev.sneakers
				(
					marque,
					modele,
					designation,
					prix_achat_USD,
					stockx_url,
					stockx_url_img,
					dhgate_url,
					created_date
				) VALUES
				(
					'$brand',
					'$model',
					'$designation',
					'$priceUsd',
					'$urlX',
					'$imgX'
					'$urlDhgate',
					now()
				)";
				dbQuery($query);
			}
		} else if ($_GET['admin'] == "prix") {
			require_once 'parts/products.php';
		} else {
			$countSneakers = getQuery("select count(sneakers.id) from dev.sneakers");
			$nb = 1;
			  getCardByBrand(null);
		}	
			?>
		</div>
	</body>
  <?php
  require 'parts/footer.php';
  ?>