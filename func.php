<?php
// require ('config/db.php');

function getImgFromUrl($url) {
    $the_tag = "div";
    $the_class = "image-container";
    $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, $agent);
    curl_setopt($curl, CURLOPT_URL, $url);
    $page = curl_exec($curl);

    if(curl_errno($curl)) {
        echo 'Scraper error: ' . curl_error($curl);
        exit;
    }
    curl_close($curl);
    $dom = new DOMDocument();
    $internalErrors = libxml_use_internal_errors(true);
    $dom->loadHTML($page);
    libxml_use_internal_errors($internalErrors);
    $xpath = new DOMXPath($dom);
    foreach ($xpath->query('//'.$the_tag.'[contains(@class,"'.$the_class.'")]/img') as $item) {
        $img_src =  $item->getAttribute('src');
    }
    $urlImg = explode("?", $img_src);
    return $urlImg[0];
}

function getCardByBrand($brand) {
    if (isset($brand)) {
        $products = getQuery("select sneakers.id, sneakers.marque, sneakers.modele, sneakers.designation, sneakers.stockx_url, sneakers.stockx_url_img from dev.sneakers where sneakers.marque = '${brand}'");    
    } else {
        $products = getQuery("select sneakers.id, sneakers.marque, sneakers.modele, sneakers.designation, sneakers.stockx_url, sneakers.stockx_url_img from dev.sneakers");
    }
    $nbCards = getQuery("select count(sneakers.id) from dev.sneakers");
    $nb = 0;

    foreach($products as $product) {
        if ($nb % 3 == 0) {
            echo '<div class="row" style="margin:10px 0;">';
        }
        $nb ++;
        echo '<div class="col-md-4">';
        echo '<div class="card" style="height:450px;">
                <img src="'. $product['stockx_url_img'] .'" class="card-img-top" alt="...">  
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title" >' . $product['marque'] . "<br>" . $product['modele'] . " " . $product['designation'] .' </h5> 
                    <p class="card-text">120€</p>
                    <a href="#" class="btn btn-primary mt-auto">Ajouter au panier</a>
                </div>
            </div></div>';
        if ($nb % 3 == 0) {
            echo '</div>';
        } 
        
    }
}

function currency($value) {
    $rates = file_get_contents("http://data.fixer.io/api/latest?access_key=49db15e62a013328923d99d949e58891&symbols=USD&format=1");
    $ratesArray = json_decode($rates);
    $USDRate = $ratesArray->rates->USD;
    return round($value / (float)$USDRate, 2);
}

?>
    