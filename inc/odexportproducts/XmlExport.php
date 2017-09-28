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
 * @since 1.0.0
 */
namespace odexportproducts;

/**
 * Class that implements XML exporter self.
 *
 * @since 1.0.0
 */
class XmlExport {

    /**
     * @var int $langId ID of the currently used language.
     * @since 1.0.0
     */
    protected $langId;

    /**
     * @var \SimpleXMLElement $xml
     * @since 1.0.0
     */
    protected $xml;

    /**
     * Constructor.
     *
     * @param int $langId
     * @return void
     * @since 1.0.0
     * @uses \Context::getContext()
     */
    public function __construct( $langId ) {
        $context = \Context::getContext();

        $this->langId = $context->language->id;
        $this->xml = new \SimpleXMLElement( '<books></books>' );
        
    }

    /**
     * Creates output XML feed.
     *
     * @return void
     * @since 1.0.0
     */
    public function createXmlFeed() {
        $productObj = new \Product();
        $products = $productObj->getProducts( $this->langId, 0, 0, 'id_product', 'DESC' );

        foreach( $products as $productArr ) {
            $product = new \Product( $productArr['id_product'], true, $this->langId );
            $this->createProductXml( $product );
        }

        $this->outputXml();
    }

    /**
     * Creates XML from given product (commented out are fields that are not 
     * used in export for now).
     *
     * @var \Product $product
     * @return void
     * @since 1.0.0
     */
    protected function createProductXml( \Product $product ) {
        $productXml = $this->xml->addChild( 'book' );
        $productXml->addChild( 'id', $product->id );
        $productXml->addChild( 'title', $product->name );
        $productXml->addChild( 'description', $product->description );

        if( ! empty( $product->description_short ) ) {
            $productXml->addChild( 'author', $product->description_short );
        }

        $productCat = $this->getCategoryName( $product );
        $exportCat = CategoryCodebook::getCategoryByName( $productCat );
        $productXml->addChild( 'category', $exportCat );

        //$productUrl = $this->getPrettyUrl( $product );
        //$productXml->addChild( 'url', $productUrl );
    }

    /**
     * Retrieves name of the product's category.
     *
     * @param \Product $product
     * @return string
     * @since 1.O.0
     */
    protected function getCategoryName( \Product $product ) {
        $category = new \Category( $product->id_category_default, $this->langId );
        return $category->name;
    }

    /**
     * Returns product's pretty URL.
     *
     * @link https://stackoverflow.com/questions/22633395/get-product-url-using-prestashop-api
     * @param \Product $product
     * @return string
     * @since 1.0.0
     */
    protected function getPrettyUrl( \Product $product ) {
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
        print( $this->xml->asXML() );
    }
}
