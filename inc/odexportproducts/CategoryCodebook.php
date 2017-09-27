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
 * Číselník pro kategorie.
 *
 * @since 1.0.0
 */
class CategoryCodebook {

    /**
     * @const array
     * @since 1.0.0
     */
    const DEFAULT_CATEGORIES = [];

    /**
     * @const string
     * @since 1.0.0
     */
    const DEFAULT_CATEGORY = '';

    /**
     * Vrátí správný název kategorie (dle názvu).
     *
     * @param string $category
     * @return string
     * @since 1.0.0
     */
    public static getCategoryByName( $category ) {
        $ret = '';

        if( array_key_exists( $category, self::DEFAULT_CATEGORIES ) ) {
            return self::DEFAULT_CATEGORIES[$category];
        }

        return self::DEFAULT_CATEGORY;
    }
    
    /**
     * Vrátí správný název kategorie (dle ID).
     *
     * @param integer $categoryId
     * @return string
     * @since 1.0.0
     */
    public static getCategoryById( $categoryId ) {
        $ret = '';
        //...
        return $ret;
    }
}
