<?php
/**
 * PrestaShop 1.6+ module which adds custom XML export feed for other shop.
 *
 * @author Ondřej Doněk <ondrejd@gmail.com>
 * @link https://github.com/ondrejd/odexportproducts for the canonical source repository
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @version 1.0.0
 * @package odexportproducts
 *
 * @link http://muj-antikvariat.cz/pro-programatory for the output XML feed specification.
 */

include( '../../config/config.inc.php' );
include( '../../init.php' );

$productObj = new Product();
$products = $productObj->getProducts( $id_lang, 0, 0, 'id_product', 'DESC' );

$xml = new SimpleXMLElement( '<books/>' );
foreach( $products as $product ) {
    $productXml = $xml->addChild( 'product' );
    $productXml->addChild( 'id', $product->id );
    $productXml->addChild( 'name', $product->name );
    $productXml->addChild( 'description', $product->description );
}

header( 'Content-type: text/xml' );
print( $xml->asXML() );
