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
    {*file                  trql.question.class.php *}
    {*purpose               A specific question - e.g. from a user seeking answers 
                            online, or collected in a Frequently Asked Questions
                            (FAQ) document. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 15-08-20 10:14 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 15-08-20 10:14 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\question;

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

defined( 'QUESTION_CLASS_VERSION' ) or define( 'QUESTION_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class Question=

    {*desc

        A specific question - e.g. from a user seeking answers online, or collected
        in a Frequently Asked Questions (FAQ) document.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Question[/url] *}

    *}}
 */
/* ================================================================================== */
class Question extends CreativeWork implements iContext
/*---------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $acceptedAnswer         = null;                     /* {*property   $acceptedAnswer             (Answer|ItemList)               The answer(s) that has been accepted as best, typically on a
                                                                                                                                                Question/Answer site. Sites vary in their selection mechanisms,
                                                                                                                                                e.g. drawing on community opinion and/or the view of the
                                                                                                                                                Question author. *} */
    public      $answerCount            = null;                     /* {*property   $answerCount                (Integer)                       The number of answers this question has received. *} */
    public      $downvoteCount          = null;                     /* {*property   $downvoteCount              (Integer)                       The number of downvotes this question, answer or comment has
                                                                                                                                                received from the community. *} */
    public      $suggestedAnswer        = null;                     /* {*property   $suggestedAnswer            (Answer|ItemList)               An answer (possibly one of several, possibly incorrect) to a
                                                                                                                                                Question, e.g. on a Question/Answer site. *} */
    public      $upvoteCount            = null;                     /* {*property   $upvoteCount                (Integer)                       The number of upvotes this question, answer or comment has
                                                                                                                                                received from the community. *} */

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
    }   /* End of Question.__construct() ============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Question.speak() ==================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Question.sing() ===================================================== */
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
    }   /* End of Question.__destruct() =============================================== */
    /* ================================================================================ */

}   /* End of class Question ========================================================== */
/* ==================================================================================== */
?>