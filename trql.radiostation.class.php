<?php
/****************************************************************************************/

/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.radiostation.class.php *}
    {*purpose               A radio station. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 30-07-20 10:31 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*todo                  1) Implement the [c]RadioSeries[/c] class as we have done
                               it on the TRQL Radio web site and for the California
                               Spirit Radioshow. This class must be modified as to
                               make sure we can, if applicable, assign it a radio
                               station.
    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 30-07-20 10:31 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\radiostation;

use \trql\quitus\Mother                 as Mother;
use \trql\quitus\iContext               as iContext;
use \trql\context\Context               as Context;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\business\LocalBusiness   as LocalBusiness;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LOCALBUSINESS_CLASS_VERSION' ) )
    require_once( 'trql.localbusiness.class.php' );

defined( 'RADIOSTATION_CLASS_VERSION' ) or define( 'RADIOSTATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class RadioStation=

    {*desc

        A radio station.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/RadioStation[/url] *}


    *}}
 */
/* ==================================================================================== */
class RadioStation extends LocalBusiness implements iContext
/*--------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    }   /* End of RadioStation.__construct() ========================================== */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        $this->__echo( __METHOD__ . "() : SHOULD RETURN TEMPLATES\n" );
        die();

        return ( $aRetVal );
    }   /* End of RadioStation.templates() ============================================ */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n" );

        return ( $aRetVal );
    }   /* End of RadioStation.substitutions() ======================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of RadioStation.speak() ================================================ */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of RadioStation.sing() ================================================= */
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
    }   /* End of RadioStation.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class RadioStation ====================================================== */
/* ==================================================================================== */
?>