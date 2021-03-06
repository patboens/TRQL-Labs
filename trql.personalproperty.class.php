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
    {*file                  trql.personalproperty.class.php *}
    {*purpose               Type of property *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 06-03-21 12:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              Person *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 06-03-21 12:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\personalproperty;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\property\Property     as Property;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PROPERTY_CLASS_VERSION' ) )
    require_once( 'trql.property.class.php' );

defined( 'PERSONALPROPERTY_CLASS_VERSION' ) or define( 'PERSONALPROPERTY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PersonalProperty=

    {*desc

        Type of property

    *}

 */
/* ==================================================================================== */
class PersonalProperty extends Property
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q37787614';       /* {*property   $wikidataId         (string)       Wikidata ID. Type of property. *} */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();

        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of PersonalProperty.__construct() ====================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of PersonalProperty.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class PersonalProperty ================================================== */
/* ==================================================================================== */
