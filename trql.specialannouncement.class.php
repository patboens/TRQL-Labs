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
    {*file                  trql.specialannouncement.class.php *}
    {*purpose               A SpecialAnnouncement combines a simple date-stamped textual
                            information update with contextualized Web links and other
                            structured data. It represents an information update made by
                            a locally-oriented organization, for example schools,
                            pharmacies, healthcare providers, community groups, police,
                            local government.For work in progress guidelines on
                            Coronavirus-related markup see this doc.The motivating
                            scenario for SpecialAnnouncement is the Coronavirus
                            pandemic, and the initial vocabulary is oriented to this
                            urgent situation. Schema.orgexpect to improve the markup
                            iteratively as it is deployed and as feedback emerges from
                            use. In addition to ourusual Github entry, feedback comments
                            can also be provided in this document.While this schema is
                            designed to communicate urgent crisis-related information,
                            it is not the same as an emergency warning technology like
                            CAP, although there may be overlaps. The intent is to
                            coverthe kinds of everyday practical information being
                            posted to existing websites during an emergency
                            situation.Several kinds of information can be provided:We
                            encourage the provision of "name", "text", "datePosted",
                            "expires" (if appropriate), "category" and"url" as a simple
                            baseline. It is important to provide a value for "category"
                            where possible, most ideally as a well knownURL from
                            Wikipedia or Wikidata. In the case of the 2019-2020
                            Coronavirus pandemic, this should be
                            "https://en.wikipedia.org/w/index.php?title=2019-20coronaviruspandemic"
                            or "https://www.wikidata.org/wiki/Q81068910".For many of the
                            possible properties, values can either be simple links or an
                            inline description, depending on whether a summary is
                            available. For a link, provide just the URL of the
                            appropriate page as the property's value. For an inline
                            description, use a WebContent type, and provide the url as a
                            property of that, alongside at least a simple "text" summary
                            of the page. It isunlikely that a single SpecialAnnouncement
                            will need all of the possible properties simultaneously.We
                            expect that in many cases the page referenced might contain
                            more specialized structured data, e.g. contact info,
                            openingHours, Event, FAQPage etc. By linking to those pages
                            from a SpecialAnnouncement you can help make it clearer that
                            the events are related to the situation (e.g. Coronavirus)
                            indicated by the category property of the
                            SpecialAnnouncement.Many SpecialAnnouncements will relate to
                            particular regions and to identifiable local organizations.
                            Use spatialCoverage for the region, and announcementLocation
                            to indicate specific LocalBusinesses and CivicStructures. If
                            the announcement affects both a particular region and a
                            specific location (for example, a library closure that
                            serves an entire region), use both spatialCoverage and
                            announcementLocation.The about property can be used to
                            indicate entities that are the focus of the announcement. We
                            now recommend using about onlyfor representing non-location
                            entities (e.g. a Course or a RadioStation). For places, use
                            announcementLocation and spatialCoverage. Consumers of this
                            markup should be aware that the initial design encouraged
                            the use of /about for locations too.The basic content of
                            SpecialAnnouncement is similar to that of an RSS or Atom
                            feed. For publishers without such feeds, basic feed-like
                            information can be shared by postingSpecialAnnouncement
                            updates in a page, e.g. using JSON-LD. For sites with
                            Atom/RSS functionality, you can point to a feedwith the
                            webFeed property. This can be a simple URL, or an inline
                            DataFeed object, with encodingFormat providingmedia type
                            information e.g. "application/rss+xml" or
                            "application/atom+xml". *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:30 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\specialannouncement;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'SPECIALANNOUNCEMENT_CLASS_VERSION' ) or define( 'SPECIALANNOUNCEMENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SpecialAnnouncement=

    {*desc

        A SpecialAnnouncement combines a simple date-stamped textual information
        update with contextualized Web links and other structured data. It
        represents an information update made by a locally-oriented organization,
        for example schools, pharmacies, healthcare providers, community groups,
        police, local government.For work in progress guidelines on
        Coronavirus-related markup see this doc.The motivating scenario for
        SpecialAnnouncement is the Coronavirus pandemic, and the initial vocabulary
        is oriented to this urgent situation. Schema.orgexpect to improve the
        markup iteratively as it is deployed and as feedback emerges from use. In
        addition to ourusual Github entry, feedback comments can also be provided
        in this document.While this schema is designed to communicate urgent
        crisis-related information, it is not the same as an emergency warning
        technology like CAP, although there may be overlaps. The intent is to
        coverthe kinds of everyday practical information being posted to existing
        websites during an emergency situation.Several kinds of information can be
        provided:We encourage the provision of "name", "text", "datePosted",
        "expires" (if appropriate), "category" and"url" as a simple baseline. It is
        important to provide a value for "category" where possible, most ideally as
        a well knownURL from Wikipedia or Wikidata. In the case of the 2019-2020
        Coronavirus pandemic, this should be
        "https://en.wikipedia.org/w/index.php?title=2019-20coronaviruspandemic" or
        "https://www.wikidata.org/wiki/Q81068910".For many of the possible
        properties, values can either be simple links or an inline description,
        depending on whether a summary is available. For a link, provide just the
        URL of the appropriate page as the property's value. For an inline
        description, use a WebContent type, and provide the url as a property of
        that, alongside at least a simple "text" summary of the page. It isunlikely
        that a single SpecialAnnouncement will need all of the possible properties
        simultaneously.We expect that in many cases the page referenced might
        contain more specialized structured data, e.g. contact info, openingHours,
        Event, FAQPage etc. By linking to those pages from a SpecialAnnouncement
        you can help make it clearer that the events are related to the situation
        (e.g. Coronavirus) indicated by the category property of the
        SpecialAnnouncement.Many SpecialAnnouncements will relate to particular
        regions and to identifiable local organizations. Use spatialCoverage for
        the region, and announcementLocation to indicate specific LocalBusinesses
        and CivicStructures. If the announcement affects both a particular region
        and a specific location (for example, a library closure that serves an
        entire region), use both spatialCoverage and announcementLocation.The about
        property can be used to indicate entities that are the focus of the
        announcement. We now recommend using about onlyfor representing
        non-location entities (e.g. a Course or a RadioStation). For places, use
        announcementLocation and spatialCoverage. Consumers of this markup should
        be aware that the initial design encouraged the use of /about for locations
        too.The basic content of SpecialAnnouncement is similar to that of an RSS
        or Atom feed. For publishers without such feeds, basic feed-like
        information can be shared by postingSpecialAnnouncement updates in a page,
        e.g. using JSON-LD. For sites with Atom/RSS functionality, you can point to
        a feedwith the webFeed property. This can be a simple URL, or an inline
        DataFeed object, with encodingFormat providingmedia type information e.g.
        "application/rss+xml" or "application/atom+xml".

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SpecialAnnouncement[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

    *}}

 */
/* ==================================================================================== */
class SpecialAnnouncement extends CreativeWork
/*------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $announcementLocation           = null;             /* {*property   $announcementLocation           (CivicStructure|LocalBusiness)                  Indicates a specific CivicStructure or LocalBusiness associated with
                                                                                                                                                                    the SpecialAnnouncement. For example, a specific testing facility or
                                                                                                                                                                    business with special opening hours. For a larger geographic region
                                                                                                                                                                    like a quarantine of an entire region, use spatialCoverage. *} */
    public      $category                       = null;             /* {*property   $category                       (Thing|PhysicalActivityCategory|URL|string)     A category for the item. Greater signs or slashes can be used to
                                                                                                                                                                    informally indicate a category hierarchy. *} */
    public      $datePosted                     = null;             /* {*property   $datePosted                     (Date|DateTime)                                 Publication date of an online listing. *} */
    public      $diseasePreventionInfo          = null;             /* {*property   $diseasePreventionInfo          (URL|WebContent)                                Information about disease prevention. *} */
    public      $diseaseSpreadStatistics        = null;             /* {*property   $diseaseSpreadStatistics        (WebContent|URL|Observation|Dataset)            Statistical information about the spread of a disease, either as
                                                                                                                                                                    WebContent, or described directly as a Dataset, or the specific
                                                                                                                                                                    Observations in the dataset. When a WebContent URL is provided, the
                                                                                                                                                                    page indicated might also contain more such markup. *} */
    public      $gettingTestedInfo              = null;             /* {*property   $gettingTestedInfo              (URL|WebContent)                                Information about getting tested (for a MedicalCondition), e.g. in the
                                                                                                                                                                    context of a pandemic. *} */
    public      $governmentBenefitsInfo         = null;             /* {*property   $governmentBenefitsInfo         (GovernmentService)                             governmentBenefitsInfo provides information about government benefits
                                                                                                                                                                    associated with a SpecialAnnouncement. *} */
    public      $newsUpdatesAndGuidelines       = null;             /* {*property   $newsUpdatesAndGuidelines       (WebContent|URL)                                Indicates a page with news updates and guidelines. This could often be
                                                                                                                                                                    (but is not required to be) the main page containing
                                                                                                                                                                    SpecialAnnouncement markup on a site. *} */
    public      $publicTransportClosuresInfo    = null;             /* {*property   $publicTransportClosuresInfo    (URL|WebContent)                                Information about public transport closures. *} */
    public      $quarantineGuidelines           = null;             /* {*property   $quarantineGuidelines           (URL|WebContent)                                Guidelines about quarantine rules, e.g. in the context of a pandemic. *} */
    public      $schoolClosuresInfo             = null;             /* {*property   $schoolClosuresInfo             (WebContent|URL)                                Information about school closures. *} */
    public      $travelBans                     = null;             /* {*property   $travelBans                     (WebContent|URL)                                Information about travel bans, e.g. in the context of a pandemic. *} */
    public      $typicalAgeRange                = null;             /* {*property   $typicalAgeRange                (string)                                        The typical expected age range, e.g. '7-9', '11-'. *} */
    public      $webFeed                        = null;             /* {*property   $webFeed                        (DataFeed|URL)                                  The URL for a feed, e.g. associated with a podcast series, blog, or
                                                                                                                                                                    series of date-stamped updates. This is usually RSS or Atom. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q58244868';      /* {*property   $wikidataId                     (string)                                        Wikidata ID. *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of SpecialAnnouncement.__construct() =================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of SpecialAnnouncement.__destruct() ==================================== */
    /* ================================================================================ */
}   /* End of class SpecialAnnouncement =============================================== */
/* ==================================================================================== */
