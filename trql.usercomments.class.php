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
    {*file                  trql.usercomments.class.php *}
    {*purpose               UserInteraction and its subtypes is an old way 
                            of talking about users interacting with pages. 
                            It is generally better to use Action-based 
                            vocabulary, alongside types such as Comment. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 03:33 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 03:33 *}
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
namespace trql\usercomments;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\userinteraction\UserInteraction   as UserInteraction;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'USERINTERACTION_CLASS_VERSION' ) )
    require_once( 'trql.userinteraction.class.php' );

defined( 'USERCOMMENTS_CLASS_VERSION' ) or define( 'USERCOMMENTS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class UserComments=

    {*desc

        UserInteraction and its subtypes is an old way of talking about users 
        interacting with pages. It is generally better to use Action-based 
        vocabulary, alongside types such as Comment.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/UserComments[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c]
    *}

 */
/* ==================================================================================== */
class UserComments extends UserInteraction
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $commentText    = null;                             /* {*property   $commentText                (string)                        The text of the UserComment. *} */
    public      $commentTime    = null;                             /* {*property   $commentTime                (Date|DateTime)                 The time at which the UserComment was made. *} */
    public      $creator        = null;                             /* {*property   $creator                    (Organization|Person)           The creator/author of this CreativeWork. This is the same as 
                                                                                                                                                the Author property for CreativeWork. *} */
    public      $discusses      = null;                             /* {*property   $discusses                  (CreativeWork)                  Specifies the CreativeWork associated with the UserComment. *} */
    public      $replyToUrl     = null;                             /* {*property   $replyToUrl                 (URL)                           The URL at which a reply may be posted to the specified 
                                                                                                                                                UserComment. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                    Wikidata ID. No equivalent. *} */


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
    }   /* End of UserComments.__construct() ========================================== */
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
    }   /* End of UserComments.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class UserComments ====================================================== */
/* ==================================================================================== */
?>