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
    {*file                  trql.actionaccessspecification.class.php *}
    {*purpose               A set of requirements that a must be fulfilled in order to 
                            perform an Action. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 08:25 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 08:25 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\actionaccessspecification;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\intangible\Intangible         as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'ACTIONACCESSSPECIFICATION_CLASS_VERSION' ) or define( 'ACTIONACCESSSPECIFICATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ActionAccessSpecification=

    {*desc

        A set of requirements that a must be fulfilled in order to perform an Action.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ActionAccessSpecification[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 08:25.
    *}

 */
/* ==================================================================================== */
class ActionAccessSpecification extends Intangible
/*----------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,                                                                                                           
                               'name'   => null         ,                                                                                                           
                               'birth'  => null         ,                                                                                                           
                               'home'   => null         ,                                                                                                           
                               'family' => null         ,                                                                                                           
                               'UIKey'  => null         ,                                                                                                           
                             );                                                                                                                                     
                                                                                                                                                                    
    public      $availabilityEnds               = null;             /* {*property   $availabilityEnds               (DateTime|Date|Time)                            The end of the availability of the product or service included in the
                                                                                                                                                                    offer. *} */
    public      $availabilityStarts             = null;             /* {*property   $availabilityStarts             (Date|Time|DateTime)                            The beginning of the availability of the product or service included
                                                                                                                                                                    in the offer. *} */
    public      $category                       = null;             /* {*property   $category                       (Thing|PhysicalActivityCategory|URL|string)     A category for the item. Greater signs or slashes can be used to
                                                                                                                                                                    informally indicate a category hierarchy. *} */
    public      $eligibleRegion                 = null;             /* {*property   $eligibleRegion                 (Place|string|GeoShape)                         The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or
                                                                                                                                                                    the GeoShape for the geo-political region(s) for which the offer or
                                                                                                                                                                    delivery charge specification is valid.See also ineligibleRegion. *} */
    public      $expectsAcceptanceOf            = null;             /* {*property   $expectsAcceptanceOf            (Offer)                                         An Offer which must be accepted before the user can perform the
                                                                                                                                                                    Action. For example, the user may need to buy a movie before being
                                                                                                                                                                    able to watch it. *} */
    public      $ineligibleRegion               = null;             /* {*property   $ineligibleRegion               (Place|string|GeoShape)                         The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or
                                                                                                                                                                    the GeoShape for the geo-political region(s) for which the offer or
                                                                                                                                                                    delivery charge specification is not valid, e.g. a region where the
                                                                                                                                                                    transaction is not allowed.See also eligibleRegion. *} */
    public      $requiresSubscription           = null;             /* {*property   $requiresSubscription           (boolean|MediaSubscription)                     Indicates if use of the media require a subscription (either paid or
                                                                                                                                                                    free). Allowed values are true or false (note that an earlier version
                                                                                                                                                                    had 'yes', 'no'). *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                                        Wikidata ID. No equivalent *} */


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
    }   /* End of ActionAccessSpecification.__construct() ============================= */
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
    }   /* End of ActionAccessSpecification.__destruct() ============================== */
    /* ================================================================================ */
}   /* End of class ActionAccessSpecification ========================================= */
/* ==================================================================================== */
?>