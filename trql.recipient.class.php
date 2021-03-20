<?php
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

/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.recipient.class.php *}
    {*purpose               Person or organization to whom a information, letter or 
                            note is addressed *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 20-03-21 22:06 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 20-03-21 22:06 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\quitus\PersonOrOrganization   as PersonOrOrganization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PERSONORORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.personororganization.class.php' );

defined( 'RECIPIENT_CLASS_VERSION' ) or define( 'RECIPIENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Subject=

    {*desc

        Person or organization to whom a information, letter or note is
        addressed

    *}

    *}}
 */
/* ==================================================================================== */
class Recipient extends PersonOrOrganization
/*----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q28008314';      /* {*property   $wikidataId                 (string)                        Wikidata ID. Addressee ... Person or organization 
                                                                                                                                                to whom a information, letter or note is addressed *} */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__destruct
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
    }   /* End of Recipient.__construct() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__construct
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
    }   /* End of Recipient.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class Recipient ========================================================= */
/* ==================================================================================== */
