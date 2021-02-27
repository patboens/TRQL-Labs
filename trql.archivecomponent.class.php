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
    {*file                  trql.archivecomponent.class.php *}
    {*purpose               An intangible type to be applied to any archive content,
                            carrying with it a set of properties required to describe
                            archival items and collections. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:36 *}
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
namespace trql\archivecomponent;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork    as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'ARCHIVECOMPONENT_CLASS_VERSION' ) or define( 'ARCHIVECOMPONENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ArchiveComponent=

    {*desc

        An intangible type to be applied to any archive content, carrying with it a
        set of properties required to describe archival items and collections.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ArchiveComponent[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:36. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class ArchiveComponent extends CreativeWork
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

    public      $about                          = null;             /* {*property   $about                          (Thing)                         The subject matter of the content. *} */
    public      $abstract                       = null;             /* {*property   $abstract                       (string)                        An abstract is a short description that summarizes a CreativeWork. *} */
    public      $accessMode                     = null;             /* {*property   $accessMode                     (string)                        The human sensory perceptual system or cognitive faculty through which
                                                                                                                                                    a person may process or perceive information. Expected values include:
                                                                                                                                                    auditory, tactile, textual, visual, colorDependent, chartOnVisual,
                                                                                                                                                    chemOnVisual, diagramOnVisual, mathOnVisual, musicOnVisual,
                                                                                                                                                    textOnVisual. *} */
    public      $accessModeSufficient           = null;             /* {*property   $accessModeSufficient           (ItemList)                      A list of single or combined accessModes that are sufficient to
                                                                                                                                                    understand all the intellectual content of a resource. Expected values
                                                                                                                                                    include: auditory, tactile, textual, visual. *} */
    public      $accessibilityAPI               = null;             /* {*property   $accessibilityAPI               (string)                        Indicates that the resource is compatible with the referenced
                                                                                                                                                    accessibility API (WebSchemas wiki lists possible values). *} */
    public      $accessibilityControl           = null;             /* {*property   $accessibilityControl           (string)                        Identifies input methods that are sufficient to fully control the
                                                                                                                                                    described resource (WebSchemas wiki lists possible values). *} */
    public      $accessibilityFeature           = null;             /* {*property   $accessibilityFeature           (string)                        Content features of the resource, such as accessible media,
                                                                                                                                                    alternatives and supported enhancements for accessibility (WebSchemas
                                                                                                                                                    wiki lists possible values). *} */
    public      $accessibilityHazard            = null;             /* {*property   $accessibilityHazard            (string)                        A characteristic of the described resource that is physiologically
                                                                                                                                                    dangerous to some users. Related to WCAG 2.0 guideline 2.3 (WebSchemas
                                                                                                                                                    wiki lists possible values). *} */
    public      $accessibilitySummary           = null;             /* {*property   $accessibilitySummary           (string)                        A human-readable summary of specific accessibility features or
                                                                                                                                                    deficiencies, consistent with the other accessibility metadata but
                                                                                                                                                    expressing subtleties such as "short descriptions are present but long
                                                                                                                                                    descriptions will be needed for non-visual users" or "short
                                                                                                                                                    descriptions are present and no long descriptions are needed." *} */
    public      $accountablePerson              = null;             /* {*property   $accountablePerson              (Person)                        Specifies the Person that is legally accountable for the CreativeWork. *} */
    public      $acquireLicensePage             = null;             /* {*property   $acquireLicensePage             (URL|CreativeWork)              Indicates a page documenting how licenses can be purchased or
                                                                                                                                                    otherwise acquired, for the current item. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $aggregateRating                = null;             /* {*property   $aggregateRating                (AggregateRating)               The overall rating, based on a collection of reviews or ratings, of
                                                                                                                                                    the item. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $alternativeHeadline            = null;             /* {*property   $alternativeHeadline            (string)                        A secondary title of the CreativeWork. *} */
    public      $assesses                       = null;             /* {*property   $assesses                       (string|DefinedTerm)            The item being described is intended to assess the competency or
                                                                                                                                                    learning outcome defined by the referenced term. *} */
    public      $associatedMedia                = null;             /* {*property   $associatedMedia                (MediaObject)                   A media object that encodes this CreativeWork. This property is a
                                                                                                                                                    synonym for encoding. *} */
    public      $audience                       = null;             /* {*property   $audience                       (Audience)                      An intended audience, i.e. a group for whom something was created. *} */
    public      $audio                          = null;             /* {*property   $audio                          (AudioObject|MusicRecording|Clip)An embedded audio object. *} */
    public      $author                         = null;             /* {*property   $author                         (Organization|Person)           The author of this content or rating. Please note that author is
                                                                                                                                                    special in that HTML 5 provides a special mechanism for indicating
                                                                                                                                                    authorship via the rel tag. That is equivalent to this and may be used
                                                                                                                                                    interchangeably. *} */
    public      $award                          = null;             /* {*property   $award                          (string)                        An award won by or for this item. *} */
    public      $awards                         = null;             /* {*property   $awards                         (string)                        Awards won by or for this item. *} */
    public      $character                      = null;             /* {*property   $character                      (Person)                        Fictional person connected with a creative work. *} */
    public      $citation                       = null;             /* {*property   $citation                       (CreativeWork|string)           A citation or reference to another creative work, such as another
                                                                                                                                                    publication, web page, scholarly article, etc. *} */
    public      $comment                        = null;             /* {*property   $comment                        (Comment)                       Comments, typically from users. *} */
    public      $commentCount                   = null;             /* {*property   $commentCount                   (int)                           The number of comments this CreativeWork (e.g. Article, Question or
                                                                                                                                                    Answer) has received. This is most applicable to works published in
                                                                                                                                                    Web sites with commenting system; additional comments may exist
                                                                                                                                                    elsewhere. *} */
    public      $conditionsOfAccess             = null;             /* {*property   $conditionsOfAccess             (string)                        Conditions that affect the availability of, or method(s) of access to,
                                                                                                                                                    an item. Typically used for real world items such as an
                                                                                                                                                    ArchiveComponent held by an ArchiveOrganization. This property is not
                                                                                                                                                    suitable for use as a general Web access control mechanism. It is
                                                                                                                                                    expressed only in natural language.For example "Available by
                                                                                                                                                    appointment from the Reading Room" or "Accessible only from logged-in
                                                                                                                                                    accounts ". *} */
    public      $contentLocation                = null;             /* {*property   $contentLocation                (Place)                         The location depicted or described in the content. For example, the
                                                                                                                                                    location in a photograph or painting. *} */
    public      $contentRating                  = null;             /* {*property   $contentRating                  (Rating|string)                 Official rating of a piece of content&#x2014;for example,'MPAA PG-13'. *} */
    public      $contentReferenceTime           = null;             /* {*property   $contentReferenceTime           (DateTime)                      The specific time described by a creative work, for works (e.g.
                                                                                                                                                    articles, video objects etc.) that emphasise a particular moment
                                                                                                                                                    within an Event. *} */
    public      $contributor                    = null;             /* {*property   $contributor                    (Person|Organization)           A secondary contributor to the CreativeWork or Event. *} */
    public      $copyrightHolder                = null;             /* {*property   $copyrightHolder                (Person|Organization)           The party holding the legal copyright to the CreativeWork. *} */
    public      $copyrightYear                  = null;             /* {*property   $copyrightYear                  (float)                         The year during which the claimed copyright for the CreativeWork was
                                                                                                                                                    first asserted. *} */
    public      $correction                     = null;             /* {*property   $correction                     (string|CorrectionComment|URL)  Indicates a correction to a CreativeWork, either via a
                                                                                                                                                    CorrectionComment, textually or in another document. *} */
    public      $creativeWorkStatus             = null;             /* {*property   $creativeWorkStatus             (DefinedTerm|string)            The status of a creative work in terms of its stage in a lifecycle.
                                                                                                                                                    Example terms include Incomplete, Draft, Published, Obsolete. Some
                                                                                                                                                    organizations define a set of terms for the stages of their
                                                                                                                                                    publication lifecycle. *} */
    public      $creator                        = null;             /* {*property   $creator                        (Person|Organization)           The creator/author of this CreativeWork. This is the same as the
                                                                                                                                                    Author property for CreativeWork. *} */
    public      $dateCreated                    = null;             /* {*property   $dateCreated                    (Date|DateTime)                 The date on which the CreativeWork was created or the item was added
                                                                                                                                                    to a DataFeed. *} */
    public      $dateModified                   = null;             /* {*property   $dateModified                   (Date|DateTime)                 The date on which the CreativeWork was most recently modified or when
                                                                                                                                                    the item's entry was modified within a DataFeed. *} */
    public      $datePublished                  = null;             /* {*property   $datePublished                  (DateTime|Date)                 Date of first broadcast/publication. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $discussionUrl                  = null;             /* {*property   $discussionUrl                  (URL)                           A link to the page containing the comments of the CreativeWork. *} */
    public      $editEIDR                       = null;             /* {*property   $editEIDR                       (URL|string)                    An EIDR (Entertainment Identifier Registry) identifier representing a
                                                                                                                                                    specific edit / edition for a work of film or television.For example,
                                                                                                                                                    the motion picture known as "Ghostbusters" whose titleEIDR is
                                                                                                                                                    "10.5240/7EC7-228A-510A-053E-CBB8-J", has several edits e.g.
                                                                                                                                                    "10.5240/1F2A-E1C5-680A-14C6-E76B-I" and
                                                                                                                                                    "10.5240/8A35-3BEE-6497-5D12-9E4F-3".Since schema.org types like Movie
                                                                                                                                                    and TVEpisode can be used for both works and their multiple
                                                                                                                                                    expressions, it is possible to use titleEIDR alone (for a general
                                                                                                                                                    description), or alongside editEIDR for a more edit-specific
                                                                                                                                                    description. *} */
    public      $editor                         = null;             /* {*property   $editor                         (Person)                        Specifies the Person who edited the CreativeWork. *} */
    public      $educationalAlignment           = null;             /* {*property   $educationalAlignment           (AlignmentObject)               An alignment to an established educational framework.This property
                                                                                                                                                    should not be used where the nature of the alignment can be described
                                                                                                                                                    using a simple property, for example to express that a resource
                                                                                                                                                    teaches or assesses a competency. *} */
    public      $educationalLevel               = null;             /* {*property   $educationalLevel               (DefinedTerm|URL|string)        The level in terms of progression through an educational or training
                                                                                                                                                    context. Examples of educational levels include 'beginner',
                                                                                                                                                    'intermediate' or 'advanced', and formal sets of level indicators. *} */
    public      $educationalUse                 = null;             /* {*property   $educationalUse                 (string)                        The purpose of a work in the context of education; for example,
                                                                                                                                                    'assignment', 'group work'. *} */
    public      $encoding                       = null;             /* {*property   $encoding                       (MediaObject)                   A media object that encodes this CreativeWork. This property is a
                                                                                                                                                    synonym for associatedMedia. *} */
    public      $encodingFormat                 = null;             /* {*property   $encodingFormat                 (URL|string)                    Media type typically expressed using a MIME format (see IANA site and
                                                                                                                                                    MDN reference) e.g. application/zip for a SoftwareApplication binary,
                                                                                                                                                    audio/mpeg for .mp3 etc.).In cases where a CreativeWork has several
                                                                                                                                                    media type representations, encoding can be used to indicate each
                                                                                                                                                    MediaObject alongside particular encodingFormat
                                                                                                                                                    information.Unregistered or niche encoding and file formats can be
                                                                                                                                                    indicated instead via the most appropriate URL, e.g. defining Web page
                                                                                                                                                    or a Wikipedia/Wikidata entry. *} */
    public      $encodings                      = null;             /* {*property   $encodings                      (MediaObject)                   A media object that encodes this CreativeWork. *} */
    public      $exampleOfWork                  = null;             /* {*property   $exampleOfWork                  (CreativeWork)                  A creative work that this work is an
                                                                                                                                                    example/instance/realization/derivation of. *} */
    public      $expires                        = null;             /* {*property   $expires                        (Date)                          Date the content expires and is no longer useful or available. For
                                                                                                                                                    example a VideoObject or NewsArticle whose availability or relevance
                                                                                                                                                    is time-limited, or a ClaimReview fact check whose publisher wants to
                                                                                                                                                    indicate that it may no longer be relevant (or helpful to highlight)
                                                                                                                                                    after some date. *} */
    public      $fileFormat                     = null;             /* {*property   $fileFormat                     (URL|string)                    Media type, typically MIME format (see IANA site) of the content e.g.
                                                                                                                                                    application/zip of a SoftwareApplication binary. In cases where a
                                                                                                                                                    CreativeWork has several media type representations, 'encoding' can be
                                                                                                                                                    used to indicate each MediaObject alongside particular fileFormat
                                                                                                                                                    information. Unregistered or niche file formats can be indicated
                                                                                                                                                    instead via the most appropriate URL, e.g. defining Web page or a
                                                                                                                                                    Wikipedia entry. *} */
    public      $funder                         = null;             /* {*property   $funder                         (Person|Organization)           A person or organization that supports (sponsors) something through
                                                                                                                                                    some kind of financial contribution. *} */
    public      $genre                          = null;             /* {*property   $genre                          (URL|string)                    Genre of the creative work, broadcast channel or group. *} */
    public      $hasPart                        = null;             /* {*property   $hasPart                        (CreativeWork)                  Indicates an item or CreativeWork that is part of this item, or
                                                                                                                                                    CreativeWork (in some sense). *} */
    public      $headline                       = null;             /* {*property   $headline                       (string)                        Headline of the article. *} */
    public      $holdingArchive                 = null;             /* {*property   $holdingArchive                 (ArchiveOrganization)           ArchiveOrganization that holds, keeps or maintains the
                                                                                                                                                    ArchiveComponent. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $inLanguage                     = null;             /* {*property   $inLanguage                     (string|Language)               The language of the content or performance or used in an action.
                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                    See also availableLanguage. *} */
    public      $interactionStatistic           = null;             /* {*property   $interactionStatistic           (InteractionCounter)            The number of interactions for the CreativeWork using the WebSite or
                                                                                                                                                    SoftwareApplication. The most specific child type of
                                                                                                                                                    InteractionCounter should be used. *} */
    public      $interactivityType              = null;             /* {*property   $interactivityType              (string)                        The predominant mode of learning supported by the learning resource.
                                                                                                                                                    Acceptable values are 'active', 'expositive', or 'mixed'. *} */
    public      $isAccessibleForFree            = null;             /* {*property   $isAccessibleForFree            (boolean)                       A flag to signal that the item, event, or place is accessible for
                                                                                                                                                    free. *} */
    public      $isBasedOn                      = null;             /* {*property   $isBasedOn                      (CreativeWork|Product|URL)      A resource from which this work is derived or from which it is a
                                                                                                                                                    modification or adaption. *} */
    public      $isBasedOnUrl                   = null;             /* {*property   $isBasedOnUrl                   (CreativeWork|Product|URL)      A resource that was used in the creation of this resource. This term
                                                                                                                                                    can be repeated for multiple sources. For example,
                                                                                                                                                    http://example.com/great-multiplication-intro.html. *} */
    public      $isFamilyFriendly               = null;             /* {*property   $isFamilyFriendly               (boolean)                       Indicates whether this content is family friendly. *} */
    public      $isPartOf                       = null;             /* {*property   $isPartOf                       (CreativeWork|URL)              Indicates an item or CreativeWork that this item, or CreativeWork (in
                                                                                                                                                    some sense), is part of. *} */
    public      $itemLocation                   = null;             /* {*property   $itemLocation                   (PostalAddress|string|Place)    Current location of the item. *} */
    public      $keywords                       = null;             /* {*property   $keywords                       (string)                        Keywords or tags used to describe this content. Multiple entries in a
                                                                                                                                                    keywords list are typically delimited by commas. *} */
    public      $learningResourceType           = null;             /* {*property   $learningResourceType           (string)                        The predominant type or kind characterizing the learning resource. For
                                                                                                                                                    example, 'presentation', 'handout'. *} */
    public      $license                        = null;             /* {*property   $license                        (URL|CreativeWork)              A license document that applies to this content, typically indicated
                                                                                                                                                    by URL. *} */
    public      $locationCreated                = null;             /* {*property   $locationCreated                (Place)                         The location where the CreativeWork was created, which may not be the
                                                                                                                                                    same as the location depicted in the CreativeWork. *} */
    public      $mainEntity                     = null;             /* {*property   $mainEntity                     (Thing)                         Indicates the primary entity described in some page or other
                                                                                                                                                    CreativeWork. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $maintainer                     = null;             /* {*property   $maintainer                     (Organization|Person)           A maintainer of a Dataset, software package (SoftwareApplication), or
                                                                                                                                                    other Project. A maintainer is a Person or Organization that manages
                                                                                                                                                    contributions to, and/or publication of, some (typically complex)
                                                                                                                                                    artifact. It is common for distributions of software and data to be
                                                                                                                                                    based on "upstream" sources. When maintainer is applied to a specific
                                                                                                                                                    version of something e.g. a particular version or packaging of a
                                                                                                                                                    Dataset, it is always possible that the upstream source has a
                                                                                                                                                    different maintainer. The isBasedOn property can be used to indicate
                                                                                                                                                    such relationships between datasets to make the different maintenance
                                                                                                                                                    roles clear. Similarly in the case of software, a package may have
                                                                                                                                                    dedicated maintainers working on integration into software
                                                                                                                                                    distributions such as Ubuntu, as well as upstream maintainers of the
                                                                                                                                                    underlying work. *} */
    public      $material                       = null;             /* {*property   $material                       (string|URL|Product)            A material that something is made from, e.g. leather, wool, cotton,
                                                                                                                                                    paper. *} */
    public      $materialExtent                 = null;             /* {*property   $materialExtent                 (string|QuantitativeValue)      The quantity of the materials being described or an expression of the
                                                                                                                                                    physical space they occupy. *} */
    public      $mentions                       = null;             /* {*property   $mentions                       (Thing)                         Indicates that the CreativeWork contains a reference to, but is not
                                                                                                                                                    necessarily about a concept. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $offers                         = null;             /* {*property   $offers                         (Offer|Demand)                  An offer to provide this item&#x2014;for example, an offer to sell a
                                                                                                                                                    product, rent the DVD of a movie, perform a service, or give away
                                                                                                                                                    tickets to an event. Use businessFunction to indicate the kind of
                                                                                                                                                    transaction offered, i.e. sell, lease, etc. This property can also be
                                                                                                                                                    used to describe a Demand. While this property is listed as expected
                                                                                                                                                    on a number of common types, it can be used in others. In that case,
                                                                                                                                                    using a second type, such as Product or a subtype of Product, can
                                                                                                                                                    clarify the nature of the offer. *} */
    public      $pattern                        = null;             /* {*property   $pattern                        (string|DefinedTerm)            A pattern that something has, for example 'polka dot', 'striped',
                                                                                                                                                    'Canadian flag'. Values are typically expressed as text, although
                                                                                                                                                    links to controlled value schemes are also supported. *} */
    public      $position                       = null;             /* {*property   $position                       (string|int)                    The position of an item in a series or sequence of items. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $producer                       = null;             /* {*property   $producer                       (Person|Organization)           The person or organization who produced the work (e.g. music album,
                                                                                                                                                    movie, tv/radio series etc.). *} */
    public      $provider                       = null;             /* {*property   $provider                       (Person|Organization)           The service provider, service operator, or service performer; the
                                                                                                                                                    goods producer. Another party (a seller) may offer those services or
                                                                                                                                                    goods on behalf of the provider. A provider may also serve as the
                                                                                                                                                    seller. *} */
    public      $publication                    = null;             /* {*property   $publication                    (PublicationEvent)              A publication event associated with the item. *} */
    public      $publisher                      = null;             /* {*property   $publisher                      (Person|Organization)           The publisher of the creative work. *} */
    public      $publisherImprint               = null;             /* {*property   $publisherImprint               (Organization)                  The publishing division which published the comic. *} */
    public      $publishingPrinciples           = null;             /* {*property   $publishingPrinciples           (URL|CreativeWork)              The publishingPrinciples property indicates (typically via URL) a
                                                                                                                                                    document describing the editorial principles of an Organization (or
                                                                                                                                                    individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                    activities as a publisher, e.g. ethics or diversity policies. When
                                                                                                                                                    applied to a CreativeWork (e.g. NewsArticle) the principles are those
                                                                                                                                                    of the party primarily responsible for the creation of the
                                                                                                                                                    CreativeWork.While such policies are most typically expressed in
                                                                                                                                                    natural language, sometimes related information (e.g. indicating a
                                                                                                                                                    funder) can be expressed using schema.org terminology. *} */
    public      $recordedAt                     = null;             /* {*property   $recordedAt                     (Event)                         The Event where the CreativeWork was recorded. The CreativeWork may
                                                                                                                                                    capture all or part of the event. *} */
    public      $releasedEvent                  = null;             /* {*property   $releasedEvent                  (PublicationEvent)              The place and time the release was issued, expressed as a
                                                                                                                                                    PublicationEvent. *} */
    public      $review                         = null;             /* {*property   $review                         (Review)                        A review of the item. *} */
    public      $reviews                        = null;             /* {*property   $reviews                        (Review)                        Review of the item. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $schemaVersion                  = null;             /* {*property   $schemaVersion                  (string|URL)                    Indicates (by URL or string) a particular version of a schema used in
                                                                                                                                                    some CreativeWork. For example, a document could declare a
                                                                                                                                                    schemaVersion using an URL such as http://schema.org/version/2.0/ if
                                                                                                                                                    precise indication of schema version was required by some application. *} */
    public      $sdDatePublished                = null;             /* {*property   $sdDatePublished                (Date)                          Indicates the date on which the current structured data was generated
                                                                                                                                                    / published. Typically used alongside sdPublisher *} */
    public      $sdLicense                      = null;             /* {*property   $sdLicense                      (CreativeWork|URL)              A license document that applies to this structured data, typically
                                                                                                                                                    indicated by URL. *} */
    public      $sdPublisher                    = null;             /* {*property   $sdPublisher                    (Organization|Person)           Indicates the party responsible for generating and publishing the
                                                                                                                                                    current structured data markup, typically in cases where the
                                                                                                                                                    structured data is derived automatically from existing published
                                                                                                                                                    content but published on a different site. For example, student
                                                                                                                                                    projects and open data initiatives often re-publish existing content
                                                                                                                                                    with more explicitly structured metadata. ThesdPublisher property
                                                                                                                                                    helps make such practices more explicit. *} */
    public      $size                           = null;             /* {*property   $size                           (DefinedTerm|QuantitativeValue|string)A standardized size of a product or creative work, often simplifying
                                                                                                                                                    richer information into a simple textual string, either through
                                                                                                                                                    referring to named sizes or (in the case of product markup), by
                                                                                                                                                    adopting conventional simplifications. Use of QuantitativeValue with a
                                                                                                                                                    unitCode or unitText can add more structure; in other cases, the
                                                                                                                                                    /width, /height, /depth and /weight properties may be more applicable. *} */
    public      $sourceOrganization             = null;             /* {*property   $sourceOrganization             (Organization)                  The Organization on whose behalf the creator was working. *} */
    public      $spatial                        = null;             /* {*property   $spatial                        (Place)                         The "spatial" property can be used in cases when more specific
                                                                                                                                                    properties(e.g. locationCreated, spatialCoverage, contentLocation) are
                                                                                                                                                    not known to be appropriate. *} */
    public      $spatialCoverage                = null;             /* {*property   $spatialCoverage                (Place)                         The spatialCoverage of a CreativeWork indicates the place(s) which are
                                                                                                                                                    the focus of the content. It is a subproperty of contentLocation
                                                                                                                                                    intended primarily for more technical and detailed materials. For
                                                                                                                                                    example with a Dataset, it indicates areas that the dataset describes:
                                                                                                                                                    a dataset of New York weather would have spatialCoverage which was the
                                                                                                                                                    place: the state of New York. *} */
    public      $sponsor                        = null;             /* {*property   $sponsor                        (Person|Organization)           A person or organization that supports a thing through a pledge,
                                                                                                                                                    promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                    or a corporate sponsor of an event. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $teaches                        = null;             /* {*property   $teaches                        (DefinedTerm|string)            The item being described is intended to help a person learn the
                                                                                                                                                    competency or learning outcome defined by the referenced term. *} */
    public      $temporal                       = null;             /* {*property   $temporal                       (DateTime|string)               The "temporal" property can be used in cases where more specific
                                                                                                                                                    properties(e.g. temporalCoverage, dateCreated, dateModified,
                                                                                                                                                    datePublished) are not known to be appropriate. *} */
    public      $temporalCoverage               = null;             /* {*property   $temporalCoverage               (string|DateTime|URL)           The temporalCoverage of a CreativeWork indicates the period that the
                                                                                                                                                    content applies to, i.e. that it describes, either as a DateTime or as
                                                                                                                                                    a textual string indicating a time period in ISO 8601 time interval
                                                                                                                                                    format. In the case of a Dataset it will typically indicate the
                                                                                                                                                    relevant time period in a precise notation (e.g. for a 2011 census
                                                                                                                                                    dataset, the year 2011 would be written "2011/2012"). Other forms of
                                                                                                                                                    content e.g. ScholarlyArticle, Book, TVSeries or TVEpisode may
                                                                                                                                                    indicate their temporalCoverage in broader terms - textually or via
                                                                                                                                                    well-known URL. Written works such as books may sometimes have precise
                                                                                                                                                    temporal coverage too, e.g. a work set in 1939 - 1945 can be indicated
                                                                                                                                                    in ISO 8601 interval format format via "1939/1945".Open-ended date
                                                                                                                                                    ranges can be written with ".." in place of the end date. For example,
                                                                                                                                                    "2015-11/.." indicates a range beginning in November 2015 and with no
                                                                                                                                                    specified final date. This is tentative and might be updated in future
                                                                                                                                                    when ISO 8601 is officially updated. *} */
    public      $text                           = null;             /* {*property   $text                           (string)                        The textual content of this CreativeWork. *} */
    public      $thumbnailUrl                   = null;             /* {*property   $thumbnailUrl                   (URL)                           A thumbnail image relevant to the Thing. *} */
    public      $timeRequired                   = null;             /* {*property   $timeRequired                   (Duration)                      Approximate or typical time it takes to work with or through this
                                                                                                                                                    learning resource for the typical intended target audience, e.g.
                                                                                                                                                    'PT30M', 'PT1H25M'. *} */
    public      $translationOfWork              = null;             /* {*property   $translationOfWork              (CreativeWork)                  The work that this work has been translated from. e.g. 物种起源 is
                                                                                                                                                    a translationOf “On the Origin of Species” *} */
    public      $translator                     = null;             /* {*property   $translator                     (Person|Organization)           Organization or person who adapts a creative work to different
                                                                                                                                                    languages, regional differences and technical requirements of a target
                                                                                                                                                    market, or that translates during some event. *} */
    public      $typicalAgeRange                = null;             /* {*property   $typicalAgeRange                (string)                        The typical expected age range, e.g. '7-9', '11-'. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $usageInfo                      = null;             /* {*property   $usageInfo                      (CreativeWork|URL)              The schema.org usageInfo property indicates further information about
                                                                                                                                                    a CreativeWork. This property is applicable both to works that are
                                                                                                                                                    freely available and to those that require payment or other
                                                                                                                                                    transactions. It can reference additional information e.g. community
                                                                                                                                                    expectations on preferred linking and citation conventions, as well as
                                                                                                                                                    purchasing details. For something that can be commercially licensed,
                                                                                                                                                    usageInfo can provide detailed, resource-specific information about
                                                                                                                                                    licensing options.This property can be used alongside the license
                                                                                                                                                    property which indicates license(s) applicable to some piece of
                                                                                                                                                    content. The usageInfo property can provide information about other
                                                                                                                                                    licensing options, e.g. acquiring commercial usage rights for an image
                                                                                                                                                    that is also available under non-commercial creative commons licenses. *} */
    public      $version                        = null;             /* {*property   $version                        (float|string)                  The version of the CreativeWork embodied by a specified resource. *} */
    public      $video                          = null;             /* {*property   $video                          (VideoObject|Clip)              An embedded video object. *} */
    public      $workExample                    = null;             /* {*property   $workExample                    (CreativeWork)                  Example/instance/realization/derivation of the concept of this
                                                                                                                                                    creative work. eg. The paperback edition, first edition, or eBook. *} */
    public      $workTranslation                = null;             /* {*property   $workTranslation                (CreativeWork)                  A work that is a translation of the content of this work. e.g.
                                                                                                                                                    西遊記 has an English workTranslation “Journey to the West”,a
                                                                                                                                                    German workTranslation “Monkeys Pilgerfahrt” and a Vietnamese
                                                                                                                                                    translation Tây du ký bình khảo. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR (27-02-21 06:56:22). *} */


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
    }   /* End of ArchiveComponent.__construct() ====================================== */
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
    }   /* End of ArchiveComponent.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class ArchiveComponent ================================================== */
/* ==================================================================================== */
?>