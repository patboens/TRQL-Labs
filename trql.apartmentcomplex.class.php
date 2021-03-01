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
    {*file                  trql.apartmentcomplex.class.php *}
    {*purpose               Residence type: Apartment complex. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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
namespace trql\apartmentcomplex;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\residence\Residence   as Residence;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RESIDENCE_CLASS_VERSION' ) )
    require_once( 'trql.residence.class.php' );

defined( 'APARTMENTCOMPLEX_CLASS_VERSION' ) or define( 'APARTMENTCOMPLEX_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ApartmentComplex=

    {*desc

        Residence type: Apartment complex.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ApartmentComplex[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36.
    *}

 */
/* ==================================================================================== */
class ApartmentComplex extends Residence
/*-------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $numberOfAccommodationUnits     = null;             /* {*property   $numberOfAccommodationUnits     (QuantitativeValue)             Indicates the total (available plus unavailable) number of
                                                                                                                                                    accommodation units in an ApartmentComplex, or the number of
                                                                                                                                                    accommodation units for a specific FloorPlan (within its specific
                                                                                                                                                    ApartmentComplex). See also numberOfAvailableAccommodationUnits. *} */
    public      $numberOfAvailableAccommodationUnits = null;        /* {*property   $numberOfAvailableAccommodationUnits(QuantitativeValue)         Indicates the number of available accommodation units in an
                                                                                                                                                    ApartmentComplex, or the number of accommodation units for a specific
                                                                                                                                                    FloorPlan (within its specific ApartmentComplex). See also
                                                                                                                                                    numberOfAccommodationUnits. *} */
    public      $numberOfBedrooms               = null;             /* {*property   $numberOfBedrooms               (float|QuantitativeValue)       The total integer number of bedrooms in a some Accommodation,
                                                                                                                                                    ApartmentComplex or FloorPlan. *} */
    public      $petsAllowed                    = null;             /* {*property   $petsAllowed                    (bool|string)                   Indicates whether pets are allowed to enter the accommodation or 
                                                                                                                                                    lodging business. More detailed information can be put in a 
                                                                                                                                                    text value. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q13402009';      /* {*property   $wikidataId                 (string)                            Wikidata ID: Apartment building ... multiunit residential 
                                                                                                                                                    dwelling *} */


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
    }   /* End of ApartmentComplex.__construct() ====================================== */
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
    }   /* End of ApartmentComplex.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class ApartmentComplex ================================================== */
/* ==================================================================================== */
?>