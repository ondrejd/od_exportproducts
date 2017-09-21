<?php
/**
 * PrestaShop 1.6+ module which adds custom XML export feed for other shop.
 * 
 * @author Ondřej Doněk <ondrejd@gmail.com>
 * @link https://github.com/ondrejd/odexportproducts for the canonical source repository
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @version 1.0.0
 * @package od_exportproducts
 */

if( !defined( '_PS_VERSION_' ) ) {
    exit;
}
 
/**
 * Main class of the module.
 *
 * @since 1.0.0
 */
class OdExportProducts extends Module {
    /**
     * Constructor.
     * @see Module::__construct()
     * @since 1.0.0
     */
    public function __construct() {
        $this->name = 'odexportproducts';
        $this->tab = 'export';
        $this->version = '1.0.0';
        $this->author = 'Ondřej Doněk'
        $this->need_instance = false;
        $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_];
        $this->bootstrap = false;

        parent::__construct();

        $this->displayName = $this->l( 'OdExportProducts' );
        $this->description = $this->l( 'Custom XML export feed.' );
        $this->confirmUninstall = $this->l( 'Are you sure you want to uninstall?' );

        if( ! Configuration::get( 'ODEXPORTPRODUCTS_NAME' ) ) {
             $this->warning = $this->l( 'No name provided' );
        }
    }
}
