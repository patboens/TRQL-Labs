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
    {*file                  trql.touristdestination.class.php *}
    {*purpose               A tourist destination. In principle any Place can be a
                            TouristDestination from a City, Region or Country to an
                            AmusementPark or Hotel. This Type can be used on its own to
                            describe a general TouristDestination, or be used as an
                            additionalType to add tourist relevant properties to any
                            other Place. A TouristDestination is defined as a Place that
                            contains, or is colocated with, one or more
                            TouristAttractions, often linked by a similar theme or
                            interest to a particular touristType. The UNWTO defines
                            Destination (main destination of a tourism trip) as the
                            place visited that is central to the decision to take the
                            trip. (See examples below). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\touristdestination;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\schema\Place       as Place;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );

defined( 'TOURISTDESTINATION_CLASS_VERSION' ) or define( 'TOURISTDESTINATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class TouristDestination=

    {*desc

        A tourist destination. In principle any Place can be a TouristDestination
        from a City, Region or Country to an AmusementPark or Hotel. This Type can
        be used on its own to describe a general TouristDestination, or be used as
        an additionalType to add tourist relevant properties to any other Place. A
        TouristDestination is defined as a Place that contains, or is colocated
        with, one or more TouristAttractions, often linked by a similar theme or
        interest to a particular touristType. The UNWTO defines Destination (main
        destination of a tourism trip) as the place visited that is central to the
        decision to take the trip. (See examples below).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/TouristDestination[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

    {*todo
        Search if there is any WikidataId corresponding to this class
        (use the [c]wikidata()[/c] method, which does not do anything at 
        the moment)
    *}

    *}}

 */
/* ==================================================================================== */
class TouristDestination extends Place
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

    public      $includesAttraction             = null;             /* {*property   $includesAttraction             (TouristAttraction)             Attraction located at destination. *} */
    public      $touristType                    = null;             /* {*property   $touristType                    (string|Audience)               Attraction suitable for type(s) of tourist. eg. Children, visitors
                                                                                                                                                    from a particular country, etc. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT LOOKED AT IT YET. *} */


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
    }   /* End of TouristDestination.__construct() ==================================== */
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
    }   /* End of TouristDestination.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class TouristDestination ================================================ */
/* ==================================================================================== */
?>