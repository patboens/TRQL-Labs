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
    {*file                  trql.audience.class.php *}
    {*purpose               Intended audience for an item, i.e. the group for 
                            whom the item was created. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 27/06/2012 - 18:12 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 27/06/2012 *}
        {*v 5.0.0003 *}
        {*desc              Original creation of [c]LSFile.class.php[/c]. Not much of
                            intelligence so far.
    *}

    {*chist
        {*mdate 13/09/2013 *}
        {*v 5.5.0000 *}
        {*desc              1)  Comments à la "guide" (guide.php)
                            2)  Code leveling to cope with coding rules
    *}

    {*chist
        {*mdate 15-08-20 14:10 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original work is [c]LSFile.class.php[/c] of Vae Soli!
                                Porting the work to be compatible with TRQL Labs classes
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\audience;

use \trql\quitus\Mother                 as Mother;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\Intangible             as Intangible;
use \trql\schema\AdministrativeArea     as AdministrativeArea;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'AUDIENCE_CLASS_VERSION' ) or define( 'AUDIENCE_CLASS_VERSION','0.1' );


/* ==================================================================================== */
/** {{*class Audience=

    {*desc
        Intended audience for an item, i.e. the group for whom the item was created.
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Audience[/url] *}


    *}}
 */
/* ==================================================================================== */
class Audience extends Intangible
/*-----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );
    public      $audienceType                   = null;             /* {*property   $audienceType               (string)                The target group associated with a given audience 
                                                                                                                                        (e.g. veterans, car owners, musicians, etc.). *} */
    public      $geographicArea                 = null;             /* {*property   $geographicArea             (AdministrativeArea)    The geographic area associated with the audience. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q211198';        /* {*property   $wikidataId                 (string)                Wikidata ID: Group of people who participate in a 
                                                                                                                                        show or encounter a work of art *} */

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
    }   /* End of Audience.__construct() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of Audience.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class Audience ========================================================== */
/* ==================================================================================== */
?>