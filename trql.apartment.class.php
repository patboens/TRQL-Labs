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
    {*file                  trql.apartment.class.php *}
    {*purpose               An apartment (in American English) or flat (in British
                            English) is a self-contained housing unit (a type of
                            residential real estate) that occupies only part of a
                            building (Source: Wikipedia, the free encyclopedia, see
                            http://en.wikipedia.org/wiki/Apartment). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:36 *}
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
namespace trql\apartment;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\accommodation\Accommodation   as Accommodation;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ACCOMMODATION_CLASS_VERSION' ) )
    require_once( 'trql.accommodation.class.php' );

defined( 'APARTMENT_CLASS_VERSION' ) or define( 'APARTMENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Apartment=

    {*desc

        An apartment (in American English) or flat (in British English) is a
        self-contained housing unit (a type of residential real estate) that
        occupies only part of a building (Source: Wikipedia, the free
        encyclopedia, see http://en.wikipedia.org/wiki/Apartment).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Apartment[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36.
    *}

 */
/* ==================================================================================== */
class Apartment extends Accommodation
/*---------------------------------*/
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
    public      $occupancy                      = null;             /* {*property   $occupancy                      (QuantitativeValue)             The allowed total occupancy for the accommodation in persons
                                                                                                                                                    (including infants etc). For individual accommodations, this is not
                                                                                                                                                    necessarily the legal maximum but defines the permitted usage as per
                                                                                                                                                    the contractual agreement (e.g. a double room used by a single
                                                                                                                                                    person).Typical unit code(s): C62 for person *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1920566';       /* {*property   $wikidataId                     (string)                        Wikidata ID. a response to a question *} */


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
    }   /* End of Apartment.__construct() ============================================= */
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
    }   /* End of Apartment.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class Apartment ========================================================= */
/* ==================================================================================== */
?>