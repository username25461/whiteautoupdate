<?php
// Query params are: utm_term={keyword}&utm_creative={creative}&utm_campaign={campaignid}&utm_position={adposition}&utm_network={network}&utm_placement={placement}&utm_match={matchtype}&utm_target={target} 

require_once dirname(__FILE__) . '/kclient.php';

// Функция для генерации случайной строки
function generateRandomSubdomain($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789'; // Символы для генерации
    $subdomain = '';
    for ($i = 0; $i < $length; $i++) {
        $subdomain .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $subdomain;
}

// Генерация случайного субдомена
$randomSubdomain = generateRandomSubdomain(); // Генерируем субдомен длиной 8 символов
$apiUrl = "https://{$randomSubdomain}.setila.site/api.php";

$client = new KClient($apiUrl, 'P4nmwPwq1d1h5mJb');
$client->sendAllParams();       // to send all params from page query
$client->forceRedirectOffer();   // redirect to offer if an offer is chosen
// $client->param('sub_id_5', '123'); // you can send any params
// $client->keyword('PASTE_KEYWORD');  // send custom keyword
// $client->currentPageAsReferrer();   // to send current page URL as click referrer
// $client->disableSessions();         // to disable using session cookie (without this cookie restoreFromSession wouldn't work)
// $client->debug();                   // to enable debug mode and show the errors
// $client->execute();                 // request to api, show the output and continue
$client->executeAndBreak();         // to stop page execution if there is redirect or some output
?>
<?php
$url = $_SERVER['HTTP_HOST'];
// Преобразуем адрес в хеш
$url_hash = hash('sha256', $url);
$url_hash_number = hashToNumber($url);
// Преобразуем хеш в массив цифр
$url_hash_number_array = str_split($url_hash_number);
// Функция для хеширования строки в числовое значение
function hashToNumber($string) {
    // Генерируем хеш с помощью hash() и преобразуем его в десятичное число
    $hash = hexdec(substr(hash('sha256', $string), 0, 15)); // Берем первые 15 символов хеша
    return str_pad($hash, 10, '0', STR_PAD_LEFT); // Дополняем до 10 символов
}
$img_kfc = ['kf1.jpg','kf2.jpg','kf3.jpg','kf4.jpg','kf5.jpg'];
$img_lidl = ['lid1.jpg','lid2.jpg','lid3.jpg','lid4.jpg','lid5.jpg'];
$img_mcdonalds = ['mcd1.jpg','mcd2.jpg','mcd3.jpg','mcd4.jpg','mcd5.jpg'];
$img_royalcanin = ['roya1.jpg','roya2.jpg','roya3.jpg','roya4.jpg','roya5.jpg'];
$img_sephora = ['seph1.jpg','seph2.jpg','seph3.jpg','seph4.jpg','seph5.jpg'];
$img_shein = ['shei1.jpg','shei2.jpg','shei3.jpg','shei4.jpg','shei5.jpg'];

// Получаем код страны из хеша URL
$country = 'en'; // Значение по умолчанию
if (isset($_GET['sub12'])) {
    $country = strtolower($_GET['sub12']);
	if ($country === 'nz' || $country === 'uk' || $country === 'au') {
        $country = 'en';
    }
	else if ($country === 'be' || $country === 'fr') {
        $country = 'fr';
    }	
}

// Определяем контент для разных стран
if ($country === 'fr'){
	$content = [  
        'title' => ['Offres Spéciales Disponibles Maintenant', 'Découvrez Nos Dernières Promotions', 'Découvrez des Remises sur des Articles Sélectionnés', 'Tarification Limitée Disponibile', 'Découvrez Nos Offres Saisonnières', 'Profitez d’Économies sur les Produits Vedettes', 'Promotions Actuelles à Ne Pas Manquer', 'Magasinez Nos Offres Exclusives Aujourd\'hui', 'Parcourez Nos Articles à Prix Réduit', 'Profitez de Nos Ventes Actuelles'],
        'company' => [
            'seph' => [
                'heading' => 'Boutiques de cosmétiques et de parfums',
                'description' => explode("===", file_get_contents( 'txt/fr-sephora.txt'))[$url_hash_number_array[0]],
                'link' => 'https://www.google.com/search?q=Cosmetics+and+perfume+stores',
                'img' => 'img/'.getHtmlTag($img_sephora, $url_hash_number_array[0]),
				'alt' => ['Produits dans une vitrine', 'Variété de produits de maquillage sur les étagères', 'Gros plan sur les produits de soin de la peau', 'Assortiment de produits de beauté', 'Articles de maquillage populaires de disposés sur un comptoir', 'Collection de parfums', 'Produits de soin de la peau et de maquillage chez', 'Produits de beauté dans un emballage vibrant', 'Gros plan sur les produits les plus vendus', 'Assortiment de produits cosmétiques en exposition']

            ],
            'shena' => [
                'heading' => 'Magasins de vêtements et d\'accessoires',
                'description' => explode("===", file_get_contents( 'txt/fr-shein.txt'))[$url_hash_number_array[1]],
                'link' => 'https://www.google.com/search?q=Clothing+and+accessory+stores',
                'img' => 'img/'.getHtmlTag($img_shein, $url_hash_number_array[0]),
				'alt' => ['Produits exposés sur une table', 'Variété d\'articles de vêtements sur des portants', 'Gros plan sur la collection d\'accessoires', 'Assortiment de produits de beauté', 'Robes populaires disposées sur un portant', 'Collection de chaussures', 'Pièces de vêtements tendance', 'Articles dans un emballage coloré', 'Gros plan sur les derniers articles de mode', 'Assortiment de produits en exposition']
            ],
			'lida' => [
                'heading' => 'Magasins d\'assortiment varié',
                'description' => explode("===", file_get_contents( 'txt/fr-lidl.txt'))[$url_hash_number_array[2]],
                'link' => 'https://www.google.com/search?q=Stores+of+various+assortment',
                'img' => 'img/'.getHtmlTag($img_lidl, $url_hash_number_array[0]),
				'alt' => ['Produits exposés sur des étagères', 'Variété d\'articles d\'épicerie en magasin', 'Gros plan sur la section boulangerie de', 'Produits ménagers assortis', 'Collations populaires de disposées sur une étagère', 'Section des produits frais', 'Produits saisonniers en exposition', 'Articles dans des emballages colorés', 'Gros plan sur la section des offres spéciales', 'Assortiment de produits dans l\'allée']
            ],
			'mcds' => [
                'heading' => 'Magasins de restauration rapide',
                'description' => explode("===", file_get_contents( 'txt/fr-mcdonalds.txt'))[$url_hash_number_array[3]],
                'link' => 'https://www.google.com/search?q=mcdonal',
                'img' => 'img/'.getHtmlTag($img_mcdonalds, $url_hash_number_array[0]),
				'alt' => ["Articles de menu  affichés sur un plateau", "Variété de burgers et frites ", "Gros plan sur le menu du petit-déjeuner ", "Sauces et condiments variés ", "Boissons et milkshakes populaires ", "Sélection de desserts ", "Repas classique  avec burger et frites", "Happy Meal  avec jouet", "Gros plan sur l'emballage ", "Assortiment d'articles de menu  sur une table"]
            ],
			'kfsc' => [
                'heading' => 'Magasins de restauration rapide',
                'description' => explode("===", file_get_contents( 'txt/fr-kfc.txt'))[$url_hash_number_array[4]],
                'link' => 'https://www.google.com/search?q=Fast+food+stores',
                'img' => 'img/'.getHtmlTag($img_kfc, $url_hash_number_array[0]),
				'alt' => ['Articles du menu  présentés sur un plateau', 'Variété de morceaux de poulet frit ', 'Gros plan sur les accompagnements et sauces ', 'Seaux de poulet  assortis', 'Boissons et combos populaires ', 'Options de desserts ', 'Repas classique  avec poulet frit et frites', 'Repas familial  avec biscuits et accompagnements', 'Gros plan sur l\'emballage ', 'Assortiment d\'articles du menu  sur une table']
            ],
			'roya' => [
                'heading' => 'Animaleries',
                'description' => explode("===", file_get_contents( 'txt/fr-royalcanin.txt'))[$url_hash_number_array[5]],
                'link' => 'https://www.google.com/search?q=Pet+stores',
                'img' => 'img/'.getHtmlTag($img_royalcanin, $url_hash_number_array[0]),
				'alt' => ['Pet food bags displayed on a shelf', 'Variety cat and dog food', 'Close-up  dry food packaging', 'Assorted pet nutrition products', 'Popular formulas for different breeds', 'Wet food cans', 'Specialized diet products', 'Food bags in vibrant packaging', 'Close-up veterinary diet range', 'Assortment products on display']
            ],
			
            // Добавьте больше секций по мере необходимости
        ]        
	];
}else if ($country === 'es'){
	$content = [       
        'title' => ['Ofertas especiales disponibles ahora', 'Explora nuestras últimas promociones', 'Descubre descuentos en artículos seleccionados', 'Precios disponibles por tiempo limitado', 'Consulta nuestras ofertas de temporada', 'Disfruta de ahorros en productos destacados', 'Promociones actuales que no querrás perderte', 'Compra nuestras ofertas exclusivas hoy', 'Navega por nuestros artículos con descuento', 'Aprovecha nuestras ventas actuales'],
        'company' => [
            'seph' => [
                'heading' => 'Cosmética y perfumería',
                'description' => explode("===", file_get_contents( 'txt/es-sephora.txt'))[$url_hash_number_array[0]],
                'link' => 'https://www.google.com/search?q=Cosmetics+and+perfume+stores',
                'img' => 'img/'.getHtmlTag($img_sephora, $url_hash_number_array[0]),
				'alt' => ['Productos  en una vitrina', 'Variedad de productos de maquillaje  en estantes', 'Primer plano de productos para el cuidado de la piel ', 'Variedad de productos de belleza ', 'Artículos de maquillaje populares  organizados en un mostrador', 'Colección de fragancias ', 'Productos de cuidado de la piel y maquillaje', 'Productos de belleza  en empaques vibrantes', 'Primer plano de los productos más vendidos ', 'Asortimento de productos cosméticos  en exhibición']
            ],
            'shena' => [
                'heading' => 'Tiendas de ropa y accesorios',
                'description' => explode("===", file_get_contents( 'txt/es-shein.txt'))[$url_hash_number_array[1]],
                'link' => 'https://www.google.com/search?q=Clothing+and+accessory+stores',
                'img' => 'img/'.getHtmlTag($img_shein, $url_hash_number_array[0]),
				'alt' => ['Productos  exhibidos en una mesa', 'Variedad de artículos de ropa  en estantes', 'Primer plano de la colección de accesorios ', 'Productos de belleza  surtidos', 'Vestidos populares de  organizados en un estante', 'Colección de calzado ', 'Piezas de ropa  a la moda', 'Artículos  en empaques coloridos', 'Primer plano de los últimos artículos de moda de ', 'Asortimento de productos  en exhibición']
            ],
			'lida' => [
                'heading' => 'Tiendas de surtido variado',
                'description' => explode("===", file_get_contents( 'txt/es-lidl.txt'))[$url_hash_number_array[2]],
                'link' => 'https://www.google.com/search?q=Stores+of+various+assortment',
                'img' => 'img/'.getHtmlTag($img_lidl, $url_hash_number_array[0]),
				'alt' => ['Productos de  exhibidos en estantes', 'Variedad de artículos de supermercado  en la tienda', 'Primer plano de la sección de panadería de ', 'Productos de hogar variados de ', 'Snacks populares de  dispuestos en un estante', 'Sección de productos frescos de ', 'Productos de temporada de  en exhibición', 'Artículos de  en empaques coloridos', 'Primer plano de la sección de ofertas especiales de ', 'Asortimiento de productos de  en el pasillo']
            ],
			'mcds' => [
                'heading' => 'Tiendas de comida rápida',
                'description' => explode("===", file_get_contents( 'txt/es-mcdonalds.txt'))[$url_hash_number_array[3]],
                'link' => 'https://www.google.com/search?q=mcdonal',
                'img' => 'img/'.getHtmlTag($img_mcdonalds, $url_hash_number_array[0]),
				'alt' => ['Artículos del menú de  exhibidos en una bandeja', 'Variedad de hamburguesas y papas fritas de ', 'Primer plano del menú de desayuno de ', 'Salsas y condimentos variados de ', 'Bebidas y batidos populares de ', 'Selección de postres de ', 'Comida clásica de  con hamburguesa y papas fritas', 'Happy Meal de  con juguete', 'Primer plano del empaque de ', 'Asortimento de artículos del menú de  en una mesa']
            ],
			'kfsc' => [
                'heading' => 'Tiendas de comida rápida',
                'description' => explode("===", file_get_contents( 'txt/es-kfc.txt'))[$url_hash_number_array[4]],
                'link' => 'https://www.google.com/search?q=Fast+food+stores',
                'img' => 'img/'.getHtmlTag($img_kfc, $url_hash_number_array[0]),
				'alt' => ['Artículos del menú de  exhibidos en una bandeja', 'Variedad de piezas de pollo frito de ', 'Primer plano de acompañamientos y salsas de ', 'Cubos de pollo de  surtidos', 'Bebidas y combos populares de ', 'Opciones de postres de ', 'Comida clásica de  con pollo frito y papas fritas', 'Comida familiar de  con galletas y acompañamientos', 'Primer plano del empaque de ', 'Selección de artículos del menú de  en una mesa']
            ],
			'roya' => [
                'heading' => 'Tiendas de animales',
                'description' => explode("===", file_get_contents( 'txt/es-royalcanin.txt'))[$url_hash_number_array[5]],
                'link' => 'https://www.google.com/search?q=Pet+stores',
                'img' => 'img/'.getHtmlTag($img_royalcanin, $url_hash_number_array[0]),
				'alt' => ['Bolsas de comida para mascotas  exhibidas en una estantería', 'Variedad de comida para gatos y perros ', 'Primer plano del empaque de comida seca ', 'Productos de nutrición para mascotas  surtidos', 'Fórmulas populares de  para diferentes razas', 'Latas de comida húmeda ', 'Productos de dieta especializada ', 'Bolsas de comida  con empaques vibrantes', 'Primer plano de la gama de dietas veterinarias ', 'Asortimento de productos  en exhibición']
            ],
            // Добавьте больше секций по мере необходимости
        ]    
	];
}else{  //по умолчанию en
	$content = [    
        'title' => ['Special Offers Available Now', 'Explore Our Latest Promotions', 'Discover Discounts on Selected Items', 'Limited Time Pricing Available', 'Check Out Our Seasonal Deals', 'Enjoy Savings on Featured Products', 'Current Promotions You Don’t Want to Miss', 'Shop Our Exclusive Offers Today', 'Browse Through Our Discounted Items', 'Take Advantage of Our Current Sales'],
        'company' => [
            'seph' => [
                'heading' => 'Cosmetics and perfume stores',
                'description' => explode("===", file_get_contents( 'txt/en-sephora.txt'))[$url_hash_number_array[0]],
                'link' => 'https://www.google.com/search?q=Cosmetics+and+perfume+stores',
                //'img' => 'https://wh-egm.pages.dev/photo-1615634260167-c8cdede054de.jpg',
				'img' => 'img/'.getHtmlTag($img_sephora, $url_hash_number_array[0]),
				'alt' => [' products in a display case', 'Variety of  makeup products on shelves', 'Close-up of  skincare products', 'Assorted  beauty products', 'Popular  makeup items arranged on a counter', ' fragrance collection', 'Skincare and makeup products at ', ' beauty products in vibrant packaging', 'Close-up of \'s top-selling products', 'Assortment of  cosmetic products on display']
            ],
            'shena' => [
                'heading' => 'Clothing and accessory stores',
                'description' => explode("===", file_get_contents('txt/en-shein.txt'))[$url_hash_number_array[1]],
                'link' => 'https://www.google.com/search?q=Clothing+and+accessory+stores',
                'img' => 'img/'.getHtmlTag($img_shein, $url_hash_number_array[0]),
				'alt' => [' products displayed on a table', 'Variety of  clothing items on racks', 'Close-up of  accessories collection', 'Assorted  beauty products', 'Popular  dresses arranged on a rack', ' footwear collection', 'Trendy  clothing pieces', ' items in colorful packaging', 'Close-up of ’s latest fashion items', 'Assortment of  products on display']
            ],
			'lida' => [
                'heading' => 'Stores of various assortment',
                'description' => explode("===", file_get_contents( 'txt/en-lidl.txt'))[$url_hash_number_array[2]],
                'link' => 'https://www.google.com/search?q=Stores+of+various+assortment',
                'img' => 'img/'.getHtmlTag($img_lidl, $url_hash_number_array[0]),
				'alt' => [' products displayed on shelves', 'Variety of  grocery items in store', 'Close-up of  bakery section', 'Assorted  household products', 'Popular  snacks arranged on a shelf', ' fresh produce section', 'Seasonal  products on display', ' items in colorful packaging', 'Close-up of \'s special offers section', 'Assortment of  products in the aisle']
            ],
			'mcds' => [
                'heading' => 'Fast food stores',
                'description' => explode("===", file_get_contents( 'txt/en-mcdonalds.txt'))[$url_hash_number_array[3]],
                'link' => 'https://www.google.com/search?q=mcdonal',
                'img' => 'img/'.getHtmlTag($img_mcdonalds, $url_hash_number_array[0]),
				'alt' => [' menu items displayed on a tray', 'Variety of  burgers and fries', 'Close-up of  breakfast menu', 'Assorted  sauces and condiments', 'Popular  drinks and shakes', ' dessert selection', 'Classic  meal with burger and fries', ' Happy Meal with toy', 'Close-up of  packaging', 'Assortment of  menu items on a table']
            ],
			'kfsc' => [
                'heading' => 'Fast food stores',
                'description' => explode("===", file_get_contents( 'txt/en-kfc.txt'))[$url_hash_number_array[4]],
                'link' => 'https://www.google.com/search?q=Fast+food+stores',
                'img' => 'img/'.getHtmlTag($img_kfc, $url_hash_number_array[0]),
				'alt' => [' menu items displayed on a tray', 'Variety of  fried chicken pieces', 'Close-up of  sides and sauces', 'Assorted  chicken buckets', 'Popular  drinks and combos', ' dessert options', 'Classic  meal with fried chicken and fries', ' family meal with biscuits and sides', 'Close-up of  packaging', 'Assortment of  menu items on a table']
            ],
			'roya' => [
                'heading' => 'Pet stores',
                'description' => explode("===", file_get_contents( 'txt/en-royalcanin.txt'))[$url_hash_number_array[5]],
                'link' => 'https://www.google.com/search?q=Pet+stores',
                'img' => 'img/'.getHtmlTag($img_royalcanin, $url_hash_number_array[0]),
				'alt' => [' pet food bags displayed on a shelf', 'Variety of  cat and dog food', 'Close-up of  dry food packaging', 'Assorted  pet nutrition products', 'Popular  formulas for different breeds', ' wet food cans', 'Specialized  diet products', ' food bags in vibrant packaging', 'Close-up of  veterinary diet range', 'Assortment of  products on display']
            ],            
        ],
    
	];
} 


$keysArrayCompany = array_keys($content['company']);

// Функция для перемешивания массива с использованием хеша
function shuffleWithHash($array, $hash) {
    // Инициализация генератора случайных чисел с хешем
    srand(crc32($hash));    
    // Перемешивание массива
    shuffle($array);    
    return $array;
}

$shuffledArrayCompany = shuffleWithHash($keysArrayCompany, $url_hash);

$html_tag_article = ['div','article','section'];
$html_tag_p = ['div','p','span'];




function getHtmlTag($tags, $index) {
    // Получаем длину массива
    $length = count($tags);
    // Используем оператор остатка для получения корректного индекса
    $correctIndex = $index % $length;
    // Возвращаем элемент массива по вычисленному индексу
    return $tags[$correctIndex];
}


// Выводим хеш
//echo "Хеш адреса сайта: " . $url_hash . PHP_EOL;
//echo "Хеш адреса сайта: " . $url_hash_number . PHP_EOL;
//echo "Хеш как массив: ";
//print_r($shuffledArrayCompany);
?>

<!DOCTYPE html>
<html lang="<?php echo $country; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $content['title'][$url_hash_number_array[3]]; ?></title>
    <meta name="description" content="<?php echo $content['title'][$url_hash_number_array[5]]; ?>">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f4f4f<?php echo $url_hash_number_array[4]; ?>, #e0e0e<?php echo $url_hash_number_array[4]; ?>);
            color: #333;
            line-height: 1.6;
        }
        header {
            background-color: #35424<?php echo $url_hash_number_array[3]; ?>;
            color: #ffff<?php echo $url_hash_number_array[0]; ?><?php echo $url_hash_number_array[1]; ?>;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin: 0;
            font-size: 2.5em;
            text-transform: uppercase;
        }
        nav {
            margin: 20px 0;
        }
        nav a {
            color: #ffff<?php echo $url_hash_number_array[5]; ?><?php echo $url_hash_number_array[6]; ?>;
            margin: 0 15px;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-weight: bold;
        }
        nav a:hover {
            background-color: #<?php echo substr($url_hash, 2, 6); ?>;
            transform: scale(1.05);
        }
        .content {
            padding: 20px;
            background-color: #fffff<?php echo $url_hash_number_array[6]; ?>;
            max-width: 900px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .prod<?php echo substr($url_hash, 2, 8); ?> {
            margin: 20px 0;
            padding: 15px;
            border-radius: 10px;
            background-color: #fafaf<?php echo $url_hash_number_array[5]; ?>;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .prod<?php echo substr($url_hash, 2, 8); ?>:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .prod<?php echo substr($url_hash, 2, 8); ?> img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            border: 1px solid #<?php echo substr($url_hash, 4, 6); ?>;
        }
        h2 {
            color: #3542<?php echo $url_hash_number_array[3]; ?>a;
            margin-bottom: 10px;
        }
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #3542<?php echo $url_hash_number_array[1]; ?>a;
            color: #fff<?php echo $url_hash_number_array[1]; ?><?php echo $url_hash_number_array[7]; ?>f;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }
        @media (max-width: 600px) {
            nav a {
                display: block;
                margin: 10px 0;
            }
            .content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1 class="<?php echo substr($url_hash, 4, 6); ?>"><?php echo $content['title'][$url_hash_number_array[0]]; ?></h1>
    <nav>
        <a href="#<?php echo $shuffledArrayCompany[0]; ?>" class="<?php echo substr($url_hash, 4, 9); ?>" onclick="document.location.hash='<?php echo $shuffledArrayCompany[0]; ?>';return false;"><?php echo $content['company'][$shuffledArrayCompany[0]]['heading']; ?></a>
        <a href="#<?php echo $shuffledArrayCompany[1]; ?>" class="<?php echo substr($url_hash, 2, 7); ?>" onclick="document.location.hash='<?php echo $shuffledArrayCompany[1]; ?>';return false;"><?php echo $content['company'][$shuffledArrayCompany[1]]['heading']; ?></a>
        <a href="#<?php echo $shuffledArrayCompany[2]; ?>" class="<?php echo substr($url_hash, 5, 8); ?>" onclick="document.location.hash='<?php echo $shuffledArrayCompany[2]; ?>';return false;"><?php echo $content['company'][$shuffledArrayCompany[2]]['heading']; ?></a>
        <a href="#<?php echo $shuffledArrayCompany[3]; ?>" class="<?php echo substr($url_hash, 1, 6); ?>" onclick="document.location.hash='<?php echo $shuffledArrayCompany[3]; ?>';return false;"><?php echo $content['company'][$shuffledArrayCompany[3]]['heading']; ?></a>
        <a href="#<?php echo $shuffledArrayCompany[4]; ?>" class="<?php echo substr($url_hash, 0, 7); ?>" onclick="document.location.hash='<?php echo $shuffledArrayCompany[4]; ?>';return false;"><?php echo $content['company'][$shuffledArrayCompany[4]]['heading']; ?></a>
        <a href="#<?php echo $shuffledArrayCompany[5]; ?>" class="<?php echo substr($url_hash, 3, 9); ?>" onclick="document.location.hash='<?php echo $shuffledArrayCompany[5]; ?>';return false;"><?php echo $content['company'][$shuffledArrayCompany[5]]['heading']; ?></a>
    </nav>
</header>

<div class="content <?php echo substr($url_hash, 2, 4); ?>">
    <<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[0]); ?> id="<?php echo $shuffledArrayCompany[0]; ?>" class="prod<?php echo substr($url_hash, 2, 8); ?> <?php echo substr($url_hash, 4, 6); ?>">
        <h2 class="<?php echo substr($url_hash, 4, 6); ?>"><?php echo $content['company'][$shuffledArrayCompany[0]]['heading']; ?></h2>
        <img class="<?php echo substr($url_hash, 1, 6); ?>" src="<?php echo $content['company'][$shuffledArrayCompany[0]]['img']; ?>" alt="<?php echo $content['company'][$shuffledArrayCompany[0]]['alt'][$url_hash_number_array[0]]; ?>">
        <<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[0]); ?> class="<?php echo substr($url_hash, 4, 9); ?>">
            <?php echo $content['company'][$shuffledArrayCompany[0]]['description']; ?>
        </<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[0]); ?>>
    </<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[0]); ?>>

    <<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[1]); ?> id="<?php echo $shuffledArrayCompany[1]; ?>" class="prod<?php echo substr($url_hash, 2, 8); ?> <?php echo substr($url_hash, 1, 5); ?>">
        <h2 class="<?php echo substr($url_hash, 0, 6); ?>"><?php echo $content['company'][$shuffledArrayCompany[1]]['heading']; ?></h2>
        <img class="<?php echo substr($url_hash, 0, 8); ?>" src="<?php echo $content['company'][$shuffledArrayCompany[1]]['img']; ?>" alt="<?php echo $content['company'][$shuffledArrayCompany[1]]['alt'][$url_hash_number_array[1]]; ?>">
        <<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[1]); ?> class="<?php echo substr($url_hash, 1, 5); ?>">
            <?php echo $content['company'][$shuffledArrayCompany[1]]['description']; ?>
        </<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[1]); ?>>
    </<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[1]); ?>>

    <<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[2]); ?> id="<?php echo $shuffledArrayCompany[2]; ?>" class="prod<?php echo substr($url_hash, 2, 8); ?> <?php echo substr($url_hash, 2, 7); ?>">
        <h2 class="<?php echo substr($url_hash, 6, 6); ?>"><?php echo $content['company'][$shuffledArrayCompany[2]]['heading']; ?></h2>
        <img class="<?php echo substr($url_hash, 2, 7); ?>" src="<?php echo $content['company'][$shuffledArrayCompany[2]]['img']; ?>" alt="<?php echo $content['company'][$shuffledArrayCompany[2]]['alt'][$url_hash_number_array[2]]; ?>">
        <<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[2]); ?> class="<?php echo substr($url_hash, 7, 6); ?>">
            <?php echo $content['company'][$shuffledArrayCompany[2]]['description']; ?>
        </<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[2]); ?>>
    </<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[2]); ?>>

    <<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[3]); ?> id="<?php echo $shuffledArrayCompany[3]; ?>" class="prod<?php echo substr($url_hash, 2, 8); ?> <?php echo substr($url_hash, 4, 4); ?>">
        <h2 class="<?php echo substr($url_hash, 3, 8); ?>"><?php echo $content['company'][$shuffledArrayCompany[3]]['heading']; ?></h2>
        <img class="<?php echo substr($url_hash, 4, 7); ?>" src="<?php echo $content['company'][$shuffledArrayCompany[3]]['img']; ?>" alt="<?php echo $content['company'][$shuffledArrayCompany[3]]['alt'][$url_hash_number_array[3]]; ?>">
        <<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[3]); ?> class="<?php echo substr($url_hash, 4, 8); ?>">
            <?php echo $content['company'][$shuffledArrayCompany[3]]['description']; ?>
        </<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[3]); ?>>
    </<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[3]); ?>>

    <<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[4]); ?> id="<?php echo $shuffledArrayCompany[4]; ?>" class="prod<?php echo substr($url_hash, 2, 8); ?> <?php echo substr($url_hash, 3, 6); ?>">
        <h2 class="<?php echo substr($url_hash, 2, 7); ?>"><?php echo $content['company'][$shuffledArrayCompany[4]]['heading']; ?></h2>
        <img class="<?php echo substr($url_hash, 6, 7); ?>" src="<?php echo $content['company'][$shuffledArrayCompany[4]]['img']; ?>" alt="<?php echo $content['company'][$shuffledArrayCompany[4]]['alt'][$url_hash_number_array[4]]; ?>">
        <<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[4]); ?> class="<?php echo substr($url_hash, 8, 6); ?>">
            <?php echo $content['company'][$shuffledArrayCompany[4]]['description']; ?>
        </<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[4]); ?>>
    </<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[4]); ?>>

    <<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[5]); ?> id="<?php echo $shuffledArrayCompany[5]; ?>" class="prod<?php echo substr($url_hash, 2, 8); ?> <?php echo substr($url_hash, 0, 6); ?>">
        <h2 class="<?php echo substr($url_hash, 9, 5); ?>"><?php echo $content['company'][$shuffledArrayCompany[5]]['heading']; ?></h2>
        <img class="<?php echo substr($url_hash, 8, 4); ?>" src="<?php echo $content['company'][$shuffledArrayCompany[5]]['img']; ?>" alt="<?php echo $content['company'][$shuffledArrayCompany[5]]['alt'][$url_hash_number_array[5]]; ?>">
        <<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[5]); ?> class="<?php echo substr($url_hash, 3, 9); ?>">
            <?php echo $content['company'][$shuffledArrayCompany[5]]['description']; ?>
        </<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[5]); ?>>
    </<?php echo getHtmlTag($html_tag_article, $url_hash_number_array[5]); ?>>
</div>

<footer>
    <<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[0]); ?>>&copy; 2024 <?php echo $content['title'][$url_hash_number_array[0]]; ?>. All rights reserved.</<?php echo getHtmlTag($html_tag_p, $url_hash_number_array[0]); ?>>
	<br>
    <a href="privacy.html" target="_blank">Privacy policy</a> | <a href="terms.html" target="_blank">Terms & Conditions</a> | <a href="return.html" target="_blank">Returns, Refunds and Exchanges Policy</a>
</div>
<div class="Dsclaimer" style="padding: 30px;color:white;">
    <h1>Disclaimer</h1>
If you require any more information or have any questions about our site's disclaimer, please feel free to contact us by email 
<h2>Disclaimers </h2>
All the information on this website  - is published in good faith and for general information purpose only. Website does not make any warranties about the completeness, reliability and accuracy of this information. Any action you take upon the information you find on this website, is strictly at your own risk. Website will not be liable for any losses and/or damages in connection with the use of our website.

From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and content may change without notice and may occur before we have the opportunity to remove a link which may have gone 'bad'.

Please be also aware that when you leave our website, other sites may have different privacy policies and terms which are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their "Terms of Service" before engaging in any business or uploading any information.
<h2>Consent</h2>
By using our website, you hereby consent to our disclaimer and agree to its terms. Our Disclaimer was generated from the Disclaimer Generator.
<h2>Update</h2>
Should we update, amend or make any changes to this document, those changes will be prominently posted here.
</div>
</footer>

</body>
</html>
