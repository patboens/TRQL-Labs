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
    {*file                  trql.comment.class.php *}
    {*purpose               A comment on an item - for example, a comment on a blog
                            post. The comment's content is expressed via the text
                            property, and its topic via about, properties shared with
                            all CreativeWorks. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 11-12-20 18:37 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Spruce up
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\comment;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );


defined( 'COMMENT_CLASS_VERSION' ) or define( 'COMMENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Comment=

    {*desc

        A comment on an item - for example, a comment on a blog post. The comment's
        content is expressed via the text property, and its topic via about,
        properties shared with all CreativeWorks.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Comment[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class Comment extends CreativeWork
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $downvoteCount                  = null;             /* {*property   $downvoteCount              (int)                           The number of downvotes this question, answer or comment has received
                                                                                                                                                from the community. *} */
    public      $parentItem                     = null;             /* {*property   $parentItem                 (Question)                      The parent of a question, answer or item in general. *} */
    public      $upvoteCount                    = null;             /* {*property   $upvoteCount                (int)                           The number of upvotes this question, answer or comment has received
                                                                                                                                                from the community. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q58897583';      /* {*property   $wikidataId                 (string)                        Wikidata ID. Work consisting of a critical or explanatory note written 
                                                                                                                                                to discuss, support, or dispute an article or other presentation 
                                                                                                                                                previously published *} */


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

        //$this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of Comment.__construct() =============================================== */
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

    }   /* End of Comment.__destruct() ================================================ */
    /* ================================================================================ */

}   /* End of class Comment =========================================================== */
/* ==================================================================================== */

?>