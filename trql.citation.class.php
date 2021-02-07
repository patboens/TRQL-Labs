<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.citation.class.php *}
    {*purpose               A quotation. Often but not necessarily from some written work,
                            attributable to a real world author and - if associated with
                            a fictional character - to any fictional [c]Person[/c]. Use 
                            [c]isBasedOn[/c] to link to source/origin. The [c]recordedIn[/c]
                            property can be used to reference a Quotation from an Event. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 15-08-20 10:14 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 15-08-20 10:14 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\citation;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\creativework\creativework                 as Creativework;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'CITATION_CLASS_VERSION' ) or define( 'CITATION_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Citation=

    {*desc

        A quotation. Often but not necessarily from some written work,
        attributable to a real world author and - if associated with a fictional
        character - to any fictional Person. Use isBasedOn to link to
        source/origin. The recordedIn property can be used to reference a
        Quotation from an Event.

    *}

    {*remark

        The class is called "Quotation" in schema.org but I have preferred calling
        it "Citation" in the context of TRQL as it was called this way long before
        starting this homogenous work.

        The class is very incomplete at this stage (15-08-20 10:11:21) and I need
        to import a whole lot of code from the LSCitation class of Vaesoli that,
        over other things, takes advantage of the "citations.xml" resource.

    *}


    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}


    {*warning

        15-08-20 10:07:30 : This term is proposed for full integration into
        Schema.org, pending implementation feedback and adoption from
        applications and websites.

    *}

    {*doc [url]https://schema.org/Quotation[/url] *}

    *}}
 */
/* ================================================================================== */
class Citation extends CreativeWork implements iContext
/*---------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $spokenByCharacter      = null;                     /* {*property   $spokenByCharacter          (Organization|Person)       The (e.g. fictional) character, Person or Organization to whom 
                                                                                                                                            the quotation is attributed within the containing CreativeWork. *} */

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
    }   /* End of Citation.__construct() ============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Citation.speak() ==================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Citation.sing() ===================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        //parent::__destruct();
        $this->backup();
    }   /* End of Citation.__destruct() =============================================== */
    /* ================================================================================ */

}   /* End of class Citation ========================================================== */
/* ==================================================================================== */
?>