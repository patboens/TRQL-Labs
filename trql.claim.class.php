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
    {*file                  trql.claim.class.php *}
    {*purpose               A Claim in Schema.org represents a specific,
                            factually-oriented claim that could be the itemReviewed in a
                            ClaimReview. The content of a claim can be summarized with
                            the text property. Variations on well known claims can have
                            their common identity indicated via sameAs links, and
                            summarized with a name. Ideally, a Claim description
                            includes enough contextual information to minimize the risk
                            of ambiguity or inclarity. In practice, many claims are
                            better understood in the context in which they appear or the
                            interpretations provided by claim reviews.Beyond
                            ClaimReview, the Claim type can be associated with related
                            creative works - for example a ScholaryArticle or Question
                            might be about some Claim.At this time, Schema.org does not
                            define any types of relationship between claims. This is a
                            natural area for future exploration. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:40 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:40 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\claim;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork    as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'CLAIM_CLASS_VERSION' ) or define( 'CLAIM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Claim=

    {*desc

        A Claim in Schema.org represents a specific, factually-oriented claim that
        could be the itemReviewed in a ClaimReview. The content of a claim can be
        summarized with the text property. Variations on well known claims can have
        their common identity indicated via sameAs links, and summarized with a
        name. Ideally, a Claim description includes enough contextual information
        to minimize the risk of ambiguity or inclarity. In practice, many claims
        are better understood in the context in which they appear or the
        interpretations provided by claim reviews.Beyond ClaimReview, the Claim
        type can be associated with related creative works - for example a
        ScholaryArticle or Question might be about some Claim.At this time,
        Schema.org does not define any types of relationship between claims. This
        is a natural area for future exploration.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Claim[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:40.
    *}

 */
/* ==================================================================================== */
class Claim extends CreativeWork
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $appearance                     = null;             /* {*property   $appearance                     (CreativeWork)                  Indicates an occurence of a Claim in some CreativeWork. *} */
    public      $firstAppearance                = null;             /* {*property   $firstAppearance                (CreativeWork)                  Indicates the first known occurence of a Claim in some CreativeWork. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR *} */


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
    }   /* End of Claim.__construct() ================================================= */
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
    }   /* End of Claim.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Claim ============================================================= */
/* ==================================================================================== */
?>