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
    {*file                  trql.car.class.php *}
    {*purpose               A car is a wheeled, self-powered motor vehicle used for
                            transportation. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:40 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:40 *}
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
namespace trql\car;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\vehicle\Vehicle    as Vehicle;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'VEHICLE_CLASS_VERSION' ) )
    require_once( 'trql.vehicle.class.php' );



defined( 'CAR_CLASS_VERSION' ) or define( 'CAR_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Car=

    {*desc

        A car is a wheeled, self-powered motor vehicle used for transportation.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Car[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:40.
    *}

 */
/* ==================================================================================== */
class Car extends Vehicle
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $acrissCode                     = null;             /* {*property   $acrissCode                     (string)                        The ACRISS Car Classification Code is a code used by many car rental
                                                                                                                                                    companies, for classifying vehicles. ACRISS stands for Association of
                                                                                                                                                    Car Rental Industry Systems and Standards. *} */
    public      $roofLoad                       = null;             /* {*property   $roofLoad                       (QuantitativeValue)             The permitted total weight of cargo and installations (e.g. a roof
                                                                                                                                                    rack) on top of the vehicle.Typical unit code(s): KGM for kilogram,
                                                                                                                                                    LBR for poundNote 1: You can indicate additional information in the
                                                                                                                                                    name of the QuantitativeValue node.Note 2: You may also link to a
                                                                                                                                                    QualitativeValue node that provides additional information using
                                                                                                                                                    valueReferenceNote 3: Note that you can use minValue and maxValue to
                                                                                                                                                    indicate ranges. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1420';          /* {*property   $wikidataId                     (string)                        Wikidata ID. Motor car ... Road vehicle powered by a motor to carry
                                                                                                                                                    driver and small number of passengers*} */


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
    }   /* End of Car.__construct() =================================================== */
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
    }   /* End of Car.__destruct() ==================================================== */
    /* ================================================================================ */
}   /* End of class Car =============================================================== */
/* ==================================================================================== */
?>