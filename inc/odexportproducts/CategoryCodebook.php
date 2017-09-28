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
     * @const string
     * @since 1.0.0
     */
    const DEFAULT_CATEGORY = 'Ostatní';

    /**
     * @return array Returns array with categories codebook.
     * @since 1.0.0
     */
    public static function getCategories() {
        return array(
            'Psychologie, filozofie, duchovo, náboženství, zdraví' => 'Psychologie',
            'Próza, romány, povídky, detektivky, beletrie' => 'Beletrie',
            'Místopis' => 'Místopis',
            'Sci-fi, fantasy, upíři' => 'Sci-fi',
            'Historie, politika' => 'Historie',
            'Umění, poezie, architektura' => 'Umění',
            'Učebnice' => 'Učebnice',
            'Pro děti' => 'Pro děti',
            'Vojenské, válečné' => 'Vojenské',
            'Fauna, flóra, zahrada, zemědělství' => 'Příroda',
            'Osobnosti, životopis' => 'Osobnosti',
            'Odborné, slovníky' => 'Odborné',
            'Ostatní' => 'Ostatní',
            'Cizojazyčná' => 'Cizojazyčná',
        );
    }

    /**
     * Vrátí správný název kategorie (dle názvu).
     *
     * @param string $category
     * @return string
     * @since 1.0.0
     */
    public static function getCategoryByName( $category ) {
        $cats = self::getCategories();
        $ret = array_filter(
                $cats,
                function( $k ) use ( $category ) {
                    return ( $k == $category);
                },
                ARRAY_FILTER_USE_KEY
        );

        if( count( $ret ) > 0 ) {
            return $ret[0];
        }

        return self::DEFAULT_CATEGORY;
    }
}
