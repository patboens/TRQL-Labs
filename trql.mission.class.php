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
    {*file                  trql.mission.class.php *}
    {*purpose               A specific task with which a person or a group is charged, 
                            i.e. military mission, rescue mission, diplomatic mission, 
                            moon landing mission. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\XML\XML               as XML;
use \trql\quitus\Task           as Task;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' ); 

if ( ! defined( 'TASK_CLASS_VERSION' ) )
    require_once( 'trql.task.class.php' ); 

defined( 'MISSION_CLASS_VERSION' ) or define( 'MISSION_CLASS_VERSION' ,'0.1' );

/* ==================================================================================== */
/** {{*class Mission=

    {*desc

        A specific task with which a person or a group is charged, i.e. military 
        mission, rescue mission, diplomatic mission, moon landing mission.

    *}

    *}}
 */
/* ==================================================================================== */
class Mission extends Task
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q170584';        /* {*property   $wikidataId                     (string)            A specific task with which a person or a group is charged, 
                                                                                                                                        i.e. military mission, rescue mission, diplomatic mission, 
                                                                                                                                        moon landing mission. *} */


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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of Mission.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Returns the mission in XML

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
    }   /* End of Mission.__toXML() =================================================== */
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
    }   /* End of Mission.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Mission =========================================================== */
/* ==================================================================================== */
