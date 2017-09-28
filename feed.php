<?php
/**
 * @author Ondřej Doněk <ondrejd@gmail.com>
 * @link https://github.com/ondrejd/odexportproducts for the canonical source repository
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @version 1.0.0
 * @package odexportproducts
 * @link http://muj-antikvariat.cz/pro-programatory for the output XML feed specification.
 */

error_reporting( E_NONE );

if( ! function_exists( 'odexportproducts_error_handler' ) ) :
    /**
     * Náš error handler.
     *
     * @paran string $no
     * @param string $str
     * @param string $file
     * @param string $line
     * @return void
     * @since 1.0.0
     */
    function odexportproducts_error_handler( $no, $str, $file, $line ) {
        if( ! ( error_reporting() & $errno ) ) {
            // Execute internal PHP error handler
            return false;
        }

        switch( $errno ) {
            case E_USER_ERROR:
                echo '<!-- [ERROR]:#' . $errno . str_replace( '"', "'", $errstr ) .
                     PHP_EOL . 'Fatal error on line ' . $errline . ' in file "' . $errfile .
                     '" -->'.PHP_EOL;
                exit(1);
                break;

            case E_USER_WARNING:
                echo '<!-- [WARNING]:#' . $errno . str_replace( '"', "'", $errstr ) . ' -->'.PHP_EOL;
                break;

            case E_USER_NOTICE:
                echo '<!-- [NOTICE]:#' . $errno . str_replace( '"', "'", $errstr ) . ' -->'.PHP_EOL;
                break;

            default:
                echo '<!-- [UNKNOWN]:#' . $errno . str_replace( '"', "'", $errstr ) . ' -->'.PHP_EOL;
                break;
        }

        // Don't execute internal PHP error handler
        return true;
    }
endif;

/**
 * @var resource $old_err_handler Original error handler.
 * @since 1.0.0
 */
$old_err_handler = set_error_handler( 'odexportproducts_error_handler' );

header( 'Content-type: text/xml' );
/* echo <<<XML
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE
    html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
    [
        <!ENTITY bull  "&#8226;">
        <!ENTITY ldquo "&#8220;">
        <!ENTITY rdquo "&#8221;">
        <!ENTITY auml  "&#xE4;">
    ]
>
XML; */

include( '../../config/config.inc.php' );
include( '../../init.php' );

include( 'inc/odexportproducts/CategoryCodebook.php' );
include( 'inc/odexportproducts/XmlExport.php' );

// Make export
$xmlExporter = new \odexportproducts\XmlExport();
$xmlExporter->createXmlFeed();
