<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php. In general the material
    presented here is available under the conditions of 
    https://creativecommons.org/licenses/by-sa/4.0/

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.house.class.php *}
    {*purpose               A house is a building or structure that has the ability to
                            be occupied for habitation by humans or other creatures
                            (Source: Wikipedia, the free encyclopedia, see
                            http://en.wikipedia.org/wiki/House). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\house;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\accommodation\Accommodation       as Accommodation;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ACCOMMODATION_CLASS_VERSION' ) )
    require_once( 'trql.accommodation.class.php' );

defined( 'HOUSE_CLASS_VERSION' ) or define( 'HOUSE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class House=

    {*desc

        A house is a building or structure that has the ability to be occupied for
        habitation by humans or other creatures (Source: Wikipedia, the free
        encyclopedia, see http://en.wikipedia.org/wiki/House).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/House[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    {*todo
        Search if there is any WikidataId corresponding to this class
        (use the [c]wikidata[/c] method, which does not do anything at 
        the moment)
    *}

    *}}

 */
/* ==================================================================================== */
class House extends Accommodation
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $numberOfRooms                  = null;             /* {*property   $numberOfRooms                  (QuantitativeValue|float)       The number of rooms (excluding bathrooms and closets) of the
                                                                                                                                                    accommodation or lodging business.Typical unit code(s): ROM for room
                                                                                                                                                    or C62 for no unit. The type of room can be put in the unitText
                                                                                                                                                    property of the QuantitativeValue. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NO SEARCH. *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of House.__construct() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of House.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class House ============================================================= */
/* ==================================================================================== */

?>