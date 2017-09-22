<?php
/**
 * @author Ondřej Doněk <ondrejd@gmail.com>
 * @link https://github.com/ondrejd/odexportproducts for the canonical source repository
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @version 1.0.0
 * @package odexportproducts
 * @link http://muj-antikvariat.cz/pro-programatory for the output XML feed specification.
 */

include( '../../config/config.inc.php' );
include( '../../init.php' );
include( 'inc/OdXmlExporter.php' );

// Make export
$xmlExporter = new OdXmlExporter( $id_lang );
$xmlExporter->createXmlFeed();
