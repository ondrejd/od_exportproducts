<?php
/**
 * @author Ondřej Doněk <ondrejd@gmail.com>
 * @link https://github.com/ondrejd/odexportproducts for the canonical source repository
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @version 1.0.0
 * @package odexportproducts
 * @link http://muj-antikvariat.cz/pro-programatory for the output XML feed specification.
 */

 /**
  * Class that implements XML exporter self.
  *
  * @since 1.0.0
  */
 class OdXmlExporter {
     /**
      * @var int $langId ID of the currently used language.
      * @since 1.0.0
      */
     protected $langId;

     /**
      * @var SimpleXMLElement $xml
      * @since 1.0.0
      */
     protected $xml;

     /**
      * Constructor.
      *
      * @param int $langId
      * @return void
      */
     public function __construct( $langId ) {
         $this->langId = $langId;
     }

     /**
      * Creates output XML feed.
      *
      * @return void
      * @since 1.0.0
      */
     public function createXmlFeed() {
         $productObj = new Product();
         $products = $productObj->getProducts( $this->langId, 0, 0, 'id_product', 'DESC' );

         // Create XML from them
         $this->xml = new SimpleXMLElement( '<books/>' );

         foreach( $products as $product ) {
             $this->createProductXml( $product );
         }

         $this->outputXml();
         header( 'Content-type: text/xml' );
         print( $xml->asXML() );
     }

     /**
      * Creates XML from given product.
      *
      * @var Product $product
      * @return void
      */
     protected function createProductXml( Product $product ) {
         $productXml = $this->xml->addChild( '<book>' );
         $productXml->addChild( 'id', $product->id );
         $productXml->addChild( 'title', $product->name );
         //$productXml->addChild( 'author', $product->xxx );
         //$productXml->addChild( 'illustrator', $product->xxx );
         //$productXml->addChild( 'publisher', $product->xxx );
         //$productXml->addChild( 'year', $product->xxx );
         //$productXml->addChild( 'pages', $product->xxx );
         $productXml->addChild( 'description', $product->description );
         //$productXml->addChild( 'category', $product->xxx );
         $productXml->addChild( 'url', getPrettyUrl( $product->id ) );
         //$productXml->addChild( 'imgurl', $product->xxx );
         //$productXml->addChild( 'price', $product->xxx );
         //$productXml->addChild( 'inserted', $product->xxx );
     }

     /**
      * Retrieves name of the product's category.
      *
      * @param Product $product
      * @return string
      * @since 1.O.0
      */
     protected function getCategoryName( Product $product ) {
         $category = new Category( $product->id_category_default, $this->langId );
         return $category->name;
     }

     /**
      * Returns product's pretty URL.
      *
      * @link https://stackoverflow.com/questions/22633395/get-product-url-using-prestashop-api
      * @param int $productId
      * @return string
      * @since 1.0.0
      */
     protected function getPrettyUrl( $productId ) {
         $url = 'http://antikvariatelement.cz/index.php?controller=product&id_product=' . $product->id;
         $ch = curl_init( $url );
         curl_exec( $ch );
         $rurl = curl_getinfo( $ch, CURLINFO_REDIRECT_URL );

         return empty( $rurl ) ? $url : $rurl;
     }

     /**
      * Prints output XML and exits.
      *
      * @return void
      * @since 1.0.0
      */
     public function outputXml() {
         header( 'Content-type: text/xml' );
         print( $this->xml->asXML() );
     }
 }
