<?php
/**
 * PrestaShop 1.6+ module which adds custom XML export feed for other shop.
 *
 * @author Ondřej Doněk <ondrejd@gmail.com>
 * @link https://github.com/ondrejd/odexportproducts for the canonical source repository
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @version 1.0.0
 * @package odexportproducts
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
     *
     * @see Module::__construct()
     * @since 1.0.0
     */
    public function __construct() {
        $this->name = 'odexportproducts';
        $this->tab = 'export';
        $this->version = '1.0.0';
        $this->author = 'Ondřej Doněk';
        $this->need_instance = false;
        $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l( 'Products export' );
        $this->description = $this->l( 'Custom XML export feed for e-shop muj-antikvariat.cz.' );
        $this->confirmUninstall = $this->l( 'Are you sure you want to uninstall?' );
    }

    /**
     * Install module.
     *
     * @see Module::install()
     * @since 1.0.0
     */
    public function install() {
        if( ! parent::install() ) {
            return false;
        }

        return true;
    }

    /**
     * Uninstall module.
     *
     * @see Module::uninstall()
     * @since 1.0.0
     */
    public function uninstall() {
        if( ! parent::uninstall() ) {
            return false;
        }

        return true;
    }
}
