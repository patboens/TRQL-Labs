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
    {*file                  trql.user.class.php *}
    {*purpose               Person who interacts with a system, typically through an 
                            interface, to extract some functional benefit *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 13-01-21 11:08 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 13-01-21 11:08 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\user;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\person\Person             as Person;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PERSON_CLASS_VERSION' ) )
    require_once( 'trql.person.class.php' );

defined( 'USER_CLASS_VERSION' ) or define( 'USER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class User=

    {*desc

        Person who interacts with a system, typically through an interface, to
        extract some functional benefit.

    *}


 */
/* ==================================================================================== */
class User extends Person
/*---------------------*/
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
    public      $wikidataId                     = 'Q613354';        /* {*property   $wikidataId         (string)        Wikidata ID. Person who interacts with a system,
                                                                                                                        typically through an interface, to extract some 
                                                                                                                        functional benefit *} */

    public      $accessCode                     = null;             /* {*property   $accessCode         (string)        Password, PIN, or access code needed for delivery 
                                                                                                                        (e.g. from a locker). See https://schema.org/accessCode *} */

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
    }   /* End of User.__construct() ================================================== */
    /* ================================================================================ */


    /* Checks that THIS user is part of $szGroup */
    public function isMember( $szGroup )
    /*--------------------------------*/
    {
        //var_dump( "User is member of " . $this->memberOf );
        //var_dump( "Checking if User is member of " . $szGroup );

        $aMyGroups          = explode( ';',str_replace( ',',';',strtolower( trim( $this->memberOf ) ) ) );

        //var_dump( "My Groups",$aMyGroups );

        $aAcceptedGroups    = explode( ';',str_replace( ',',';',strtolower( trim( $szGroup        ) ) ) );

        //var_dump( "Accepted Groups",$aAcceptedGroups );

        foreach( $aMyGroups as $szGroup )
        {
            if ( in_array ( $szGroup,$aAcceptedGroups ) )
                return ( true );
        }   /* foreach( $aMyGroups as $szGroup ) */

        return ( false );
    }   /* End of User.isMember() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szType] )=

        Renders the form

        {*params
            $szType         (string)        Output type. Optional. 'HTML' by default.
        *}

        {*return
            (string)        HTML Code
        *}

        {*warning

        *}

        *}}
    */
    /* ================================================================================ */
    public function render( $szType = 'html' ): string
    /*----------------------------------------------*/
    {
        $szRetVal = '';

        switch( strtolower( trim( $szType ) ) )
        {
            case 'xml'  :   $szRetVal = $this->__toXML();
                            break;
            case 'html' :
            default     :   $szRetVal = $this->__toHTML();
        }   /* switch( strtolower( trim( $szType ) ) ) */

        end:
        return ( $szRetVal );
    }   /* End of User.render() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Renders the form in HTML

        {*params
        *}

        {*return
            (string)        HTML Code
        *}

        {*warning
            So far (25-12-20 13:29:10), the form is NOT rendered
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toHTML(): string
    /*------------------------------*/
    {
        $szRetVal  = '';


        return ( $szRetVal );
    }   /* End of User.__toHTML() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders the taskboard in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML(): string
    /*-----------------------------*/
    {
        static $oXML = null;
        $szRetVal = null;


        if ( is_null( $oXML ) )
            $oXML = new XML();

        $oDom                       = new \DOMDocument( '1.0' );

        $oDom->preserveWhiteSpace   = true;
        $oDom->formatOutput         = true;

        if ( $oDom->loadXML( $oXML->__toXML( $this ) ) )
            $szRetVal = $oDom->saveXML();

        end:
        return ( $szRetVal );
    }   /* End of User.__toXML() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toArray()=

        Turns the object into an array

        {*params
        *}

        {*return
            (array)     The array corresponding to the object
        *}

        {*remark
            Protected properties are formatted as: [c]'&#0;*&#0;<property>'[/c] (e.g. [c]'&#0;*&#0;self'[/c])[br]
            Private   properties are formatted as: [c]'&#0;trql\form\Form&#0;<property>'[/c] (e.g. [c]'&#0;trql\form\Form&#0;test'[/c])[br]
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toArray(): array
    /*------------------------------*/
    {
        return ( (array) $this );
    }   /* End of User.__toArray() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Renders the form in HTML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString(): string
    /*--------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of User.__toString() =================================================== */
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

    }   /* End of User.__destruct() =================================================== */
    /* ================================================================================ */

}   /* End of class User ============================================================== */
/* ==================================================================================== */

?>