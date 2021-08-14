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
    {*file                  trql.newsmediaorganization.class.php *}
    {*purpose               A News/Media organization such as a newspaper or TV station. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 21:40 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 21:40 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 09:16 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\newsmediaorganization;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\organization\Organization     as Organization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'NEWSMEDIAORGANIZATION_CLASS_VERSION' ) or define( 'NEWSMEDIAORGANIZATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class NewsMediaOrganization=

    {*desc

        A News/Media organization such as a newspaper or TV station.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/NewsMediaOrganization[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:40.
    *}

    {*todo
        Search if there is any WikidataId corresponding to this class
        (use the [c]wikidata()[/c] method, which does not do anything at 
        the moment)
    *}

    *}}

 */
/* ==================================================================================== */
class NewsMediaOrganization extends Organization
/*--------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $actionableFeedbackPolicy       = null;             /* {*property   $actionableFeedbackPolicy       (URL|CreativeWork)              For a NewsMediaOrganization or other news-related Organization, a
                                                                                                                                                    statement about public engagement activities (for news media, the
                                                                                                                                                    newsroom’s), including involving the public - digitally or otherwise
                                                                                                                                                    -- in coverage decisions, reporting and activities after publication. *} */
    public      $correctionsPolicy              = null;             /* {*property   $correctionsPolicy              (URL|CreativeWork)              For an Organization (e.g. NewsMediaOrganization), a statement
                                                                                                                                                    describing (in news media, the newsroom’s) disclosure and correction
                                                                                                                                                    policy for errors. *} */
    public      $diversityPolicy                = null;             /* {*property   $diversityPolicy                (CreativeWork|URL)              Statement on diversity policy by an Organization e.g. a
                                                                                                                                                    NewsMediaOrganization. For a NewsMediaOrganization, a statement
                                                                                                                                                    describing the newsroom’s diversity policy on both staffing and
                                                                                                                                                    sources, typically providing staffing data. *} */
    public      $diversityStaffingReport        = null;             /* {*property   $diversityStaffingReport        (Article|URL)                   For an Organization (often but not necessarily a
                                                                                                                                                    NewsMediaOrganization), a report on staffing diversity issues. In a
                                                                                                                                                    news context this might be for example ASNE or RTDNA (US) reports, or
                                                                                                                                                    self-reported. *} */
    public      $ethicsPolicy                   = null;             /* {*property   $ethicsPolicy                   (URL|CreativeWork)              Statement about ethics policy, e.g. of a NewsMediaOrganization
                                                                                                                                                    regarding journalistic and publishing practices, or of a Restaurant, a
                                                                                                                                                    page describing food source policies. In the case of a
                                                                                                                                                    NewsMediaOrganization, an ethicsPolicy is typically a statement
                                                                                                                                                    describing the personal, organizational, and corporate standards of
                                                                                                                                                    behavior expected by the organization. *} */
    public      $masthead                       = null;             /* {*property   $masthead                       (URL|CreativeWork)              For a NewsMediaOrganization, a link to the masthead page or a page
                                                                                                                                                    listing top editorial management. *} */
    public      $missionCoveragePrioritiesPolicy = null;             /* {*property   $missionCoveragePrioritiesPolicy(CreativeWork|URL)              For a NewsMediaOrganization, a statement on coverage priorities,
                                                                                                                                                    including any public agenda or stance on issues. *} */
    public      $noBylinesPolicy                = null;             /* {*property   $noBylinesPolicy                (CreativeWork|URL)              For a NewsMediaOrganization or other news-related Organization, a
                                                                                                                                                    statement explaining when authors of articles are not named in
                                                                                                                                                    bylines. *} */
    public      $ownershipFundingInfo           = null;             /* {*property   $ownershipFundingInfo           (CreativeWork|AboutPage|URL|string)For an Organization (often but not necessarily a
                                                                                                                                                    NewsMediaOrganization), a description of organizational ownership
                                                                                                                                                    structure; funding and grants. In a news/media setting, this is with
                                                                                                                                                    particular reference to editorial independence. Note that the funder
                                                                                                                                                    is also available and can be used to make basic funder information
                                                                                                                                                    machine-readable. *} */
    public      $unnamedSourcesPolicy           = null;             /* {*property   $unnamedSourcesPolicy           (CreativeWork|URL)              For an Organization (typically a NewsMediaOrganization), a statement
                                                                                                                                                    about policy on use of unnamed sources and the decision process
                                                                                                                                                    required. *} */
    public      $verificationFactCheckingPolicy = null;             /* {*property   $verificationFactCheckingPolicy (URL|CreativeWork)              Disclosure about verification and fact-checking processes for a
                                                                                                                                                    NewsMediaOrganization or other fact-checking Organization. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NO SEARCH PERFORMED. *} */


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
    }   /* End of NewsMediaOrganization.__construct() ================================= */
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
    }   /* End of NewsMediaOrganization.__destruct() ================================== */
    /* ================================================================================ */
}   /* End of class NewsMediaOrganization ============================================= */
/* ==================================================================================== */
?>