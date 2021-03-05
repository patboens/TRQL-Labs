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
    {*file                  trql.creativework.class.php *}
    {*purpose               The most generic kind of creative work, including books,
                            movies, photographs, software programs, etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 11:51 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*todo                  1) Make the difference between [c]render()[/c] and
                               [c]speak()[/c][br]
                            2) Implement [c]render()[/c] (in its simplest form)
    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 11:51 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 18-02-21 09:20 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\creativework;

use \trql\mother\Mother         as Mother;
use \trql\mother\iContext       as iContext;
use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\thing\Thing           as Thing;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'CREATIVEWORK_CLASS_VERSION' ) or define( 'CREATIVEWORK_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class CreativeWork=

    {*desc

        The most generic kind of creative work, including books, movies,
        photographs, software programs, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CreativeWork[/url] *}

    *}}
 */
/* ================================================================================== */
class CreativeWork extends Thing implements iContext
/*------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $about                      = null;                 /* {*property   $about                      (Thing)                         The subject matter of the content. Inverse property: [c]subjectOf[/c] *} */
    public      $accessMode                 = null;                 /* {*property   $accessMode                 (string)                        The human sensory perceptual system or cognitive faculty
                                                                                                                                                through which a person may process or perceive information.
                                                                                                                                                Expected values include: auditory, tactile, textual, visual,
                                                                                                                                                colorDependent, chartOnVisual, chemOnVisual, diagramOnVisual,
                                                                                                                                                mathOnVisual, musicOnVisual, textOnVisual. *} */
    public      $accessModeSufficient       = null;                 /* {*property   $accessModeSufficient       (ItemList)                      A list of single or combined accessModes that are sufficient
                                                                                                                                                to understand all the intellectual content of a resource.
                                                                                                                                                Expected values include: auditory, tactile, textual, visual. *} */
    public      $accessibilityAPI           = null;                 /* {*property   $accessibilityAPI           (string)                        Indicates that the resource is compatible with the referenced
                                                                                                                                                accessibility API (WebSchemas wiki lists possible values). *} */
    public      $accessibilityControl       = null;                 /* {*property   $accessibilityControl       (string)                        Identifies input methods that are sufficient to fully
                                                                                                                                                control the described resource (WebSchemas wiki lists
                                                                                                                                                possible values). *} */
    public      $accessibilityFeature       = null;                 /* {*property   $accessibilityFeature       (string)                        Content features of the resource, such as accessible media,
                                                                                                                                                alternatives and supported enhancements for accessibility
                                                                                                                                                (WebSchemas wiki lists possible values). *} */
    public      $accessibilityHazard        = null;                 /* {*property   $accessibilityHazard        (string)                        A characteristic of the described resource that is
                                                                                                                                                physiologically dangerous to some users. Related to WCAG 2.0
                                                                                                                                                guideline 2.3 (WebSchemas wiki lists possible values). *} */
    public      $accessibilitySummary       = null;                 /* {*property   $accessibilitySummary       (string)                        A human-readable summary of specific accessibility features
                                                                                                                                                or deficiencies, consistent with the other accessibility
                                                                                                                                                metadata but expressing subtleties such as "short
                                                                                                                                                descriptions are present but long descriptions will be needed
                                                                                                                                                for non-visual users" or "short descriptions are present and
                                                                                                                                                no long descriptions are needed." *} */
    public      $accountablePerson          = null;                 /* {*property   $accountablePerson          (Person)                        Specifies the Person that is legally accountable for the
                                                                                                                                                CreativeWork. *} */
    public      $aggregateRating            = null;                 /* {*property   $aggregateRating            (AggregateRating)               The overall rating, based on a collection of reviews or ratings,
                                                                                                                                                of the item. *} */
    public      $alternativeHeadline        = null;                 /* {*property   $alternativeHeadline        (string)                        A secondary title of the CreativeWork. *} */
    public      $associatedMedia            = null;                 /* {*property   $associatedMedia            (MediaObject)                   A media object that encodes this CreativeWork. This property
                                                                                                                                                is a synonym for encoding. *} */
    public      $audience                   = null;                 /* {*property   $audience                   (Audience)                      An intended audience, i.e. a group for whom something was
                                                                                                                                                created. *} */
    public      $audio                      = null;                 /* {*property   $audio                      (AudioObject|Clip)              An embedded audio object. *} */
    public      $author                     = null;                 /* {*property   $author                     (Organization|Person)           The author of this content or rating. Please note that author
                                                                                                                                                is special in that HTML 5 provides a special mechanism for
                                                                                                                                                indicating authorship via the rel tag. That is equivalent to
                                                                                                                                                this and may be used interchangeably. *} */
    public      $award                      = null;                 /* {*property   $award                      (string)                        An award won by or for this item. Supersedes awards. *} */
    public      $character                  = null;                 /* {*property   $character                  (Person                         Fictional person connected with a creative work. *} */
    public      $citation                   = null;                 /* {*property   $citation                   (CreativeWork|string)           A citation or reference to another creative work, such
                                                                                                                                                as another publication, web page, scholarly article, etc. *} */
    public      $comment                    = null;                 /* {*property   $comment                    (Comment)                       Comments, typically from users. *} */
    public      $commentCount               = null;                 /* {*property   $commentCount               (int)                           The number of comments this CreativeWork (e.g. Article,
                                                                                                                                                Question or Answer) has received. This is most applicable to
                                                                                                                                                works published in Web sites with commenting system;
                                                                                                                                                additional comments may exist elsewhere. *} */
    public      $conditionsOfAccess         = null;                 /* {*property   $conditionsOfAccess         (string)                        Conditions that affect the availability of, or method(s) of
                                                                                                                                                access to, an item. Typically used for real world items such
                                                                                                                                                as an ArchiveComponent held by an ArchiveOrganization.
                                                                                                                                                This property is not suitable for use as a general Web access
                                                                                                                                                control mechanism. It is expressed only in natural language. *} */
    public      $contentLocation            = null;                 /* {*property   $contentLocation            (Place)                         The location depicted or described in the content. For example,
                                                                                                                                                the location in a photograph or painting. *} */
    public      $contentRating              = null;                 /* {*property   $contentRating              (Rating|string)                 Official rating of a piece of content—for example,'MPAA PG-13'. *} */
    public      $contentReferenceTime       = null;                 /* {*property   $contentReferenceTime       (DateTime)                      The specific time described by a creative work, for works
                                                                                                                                                (e.g. articles, video objects etc.) that emphasise a
                                                                                                                                                particular moment within an Event. *} */
    public      $contributor                = null;                 /* {*property   $contributor                (Organization|Person)           A secondary contributor to the CreativeWork or Event. *} */
    public      $copyrightHolder            = null;                 /* {*property   $copyrightHolder            (Organization|Person)           The party holding the legal copyright to the CreativeWork. *} */
    public      $copyrightYear              = null;                 /* {*property   $copyrightYear              (Number)                        The year during which the claimed copyright for the
                                                                                                                                                CreativeWork was first asserted. *} */
    public      $correction                 = null;                 /* {*property   $correction                 (CorrectionComment|string|URL)  Indicates a correction to a CreativeWork, either via a
                                                                                                                                                CorrectionComment, textually or in another document. *} */
    public      $creativeWorkStatus         = null;                 /* {*property   $creativeWorkStatus         (DefinedTerm|string)            The status of a creative work in terms of its stage in a lifecycle.
                                                                                                                                                Example terms include Incomplete, Draft, Published, Obsolete.
                                                                                                                                                Some organizations define a set of terms for the stages of their
                                                                                                                                                publication lifecycle. *} */
    public      $creator                    = null;                 /* {*property   $creator                    (Organization|Person)           The creator/author of this CreativeWork. This is the same as
                                                                                                                                                the Author property for CreativeWork. *} */
    public      $dateCreated                = null;                 /* {*property   $dateCreated                (Date|DateTime)                 The date on which the CreativeWork was created or the item was
                                                                                                                                                added to a DataFeed. *} */
    public      $dateModified               = null;                 /* {*property   $dateModified               (Date|DateTime)                 The date on which the CreativeWork was most recently modified or
                                                                                                                                                when the item's entry was modified within a DataFeed. *} */
    public      $datePublished              = null;                 /* {*property   $datePublished              (Date)                          Date of first broadcast/publication. *} */
    public      $discussionUrl              = null;                 /* {*property   $discussionUrl              (URL)                           A link to the page containing the comments of the CreativeWork. *} */
    public      $editor                     = null;                 /* {*property   $editor                     (Person)                        Specifies the Person who edited the CreativeWork. *} */
    public      $educationalAlignment       = null;                 /* {*property   $educationalAlignment       (AlignmentObject)               An alignment to an established educational framework. *} */
    public      $educationalUse             = null;                 /* {*property   $educationalUse             (string)                        The purpose of a work in the context of education;
                                                                                                                                                for example, 'assignment', 'group work'. *} */
    public      $encoding                   = null;                 /* {*property   $encoding                   (MediaObject)                   A media object that encodes this CreativeWork. This property is
                                                                                                                                                a synonym for associatedMedia. Supersedes encodings.
                                                                                                                                                Inverse property: encodesCreativeWork. *} */
    public      $encodingFormat             = null;                 /* {*property   $encodingFormat             (string|URL)                    Media type typically expressed using a MIME format
                                                                                                                                                (see IANA site and MDN reference) e.g. application/zip for
                                                                                                                                                a SoftwareApplication binary, audio/mpeg for .mp3 etc.). *} */
    public      $exampleOfWork              = null;                 /* {*property   $exampleOfWork              (CreativeWork)                  A creative work that this work is an
                                                                                                                                                example/instance/realization/derivation of.
                                                                                                                                                Inverse property: workExample. *} */
    public      $expires                    = null;                 /* {*property   $expires                    (Date)                          Date the content expires and is no longer useful or available.
                                                                                                                                                For example a VideoObject or NewsArticle whose availability or
                                                                                                                                                relevance is time-limited, or a ClaimReview fact check whose
                                                                                                                                                publisher wants to indicate that it may no longer be relevant
                                                                                                                                                (or helpful to highlight) after some date. *} */
    public      $funder                     = null;                 /* {*property   $funder                     (Organization|Person)           A person or organization that supports (sponsors) something
                                                                                                                                                through some kind of financial contribution. *} */
    public      $genre                      = null;                 /* {*property   $genre                      (string|URL)                    Genre of the creative work, broadcast channel or group. *} */
    public      $hasPart                    = null;                 /* {*property   $hasPart                    (CreativeWork)                  Indicates an item or CreativeWork that is part of this item,
                                                                                                                                                or CreativeWork (in some sense). Inverse property: isPartOf. *} */
    public      $headline                   = null;                 /* {*property   $headline                   (string)                        Headline of the article. *} */
    public      $inLanguage                 = null;                 /* {*property   $inLanguage                 (Language|string)               The language of the content or performance or used in an
                                                                                                                                                action. Please use one of the language codes from the
                                                                                                                                                IETF BCP 47 standard. See also availableLanguage.
                                                                                                                                                Supersedes language. *} */
    public      $interactionStatistic       = null;                 /* {*property   $interactionStatistic       (InteractionCounter)            The number of interactions for the CreativeWork using the
                                                                                                                                                WebSite or SoftwareApplication. The most specific child
                                                                                                                                                type of InteractionCounter should be used.
                                                                                                                                                Supersedes interactionCount. *} */
    public      $interactivityType          = null;                 /* {*property   $interactivityType          (string)                        The predominant mode of learning supported by the learning
                                                                                                                                                resource. Acceptable values are 'active',
                                                                                                                                                'expositive', or 'mixed'. *} */
    public      $isAccessibleForFree        = null;                 /* {*property   $isAccessibleForFree        (Boolean)                       A flag to signal that the item, event, or place is accessible
                                                                                                                                                for free. Supersedes free. *} */
    public      $isBasedOn                  = null;                 /* {*property   $isBasedOn                  (CreativeWork|Product|URL)      A resource from which this work is derived or from which it
                                                                                                                                                is a modification or adaption. Supersedes isBasedOnUrl. *} */
    public      $isFamilyFriendly           = null;                 /* {*property   $isFamilyFriendly           (Boolean)                       Indicates whether this content is family friendly. *} */
    public      $isPartOf                   = null;                 /* {*property   $isPartOf                   (CreativeWork)                  Indicates an item or CreativeWork that this item, or
                                                                                                                                                CreativeWork (in some sense), is part of.
                                                                                                                                                Inverse property: hasPart. *} */
    public      $keywords                   = null;                 /* {*property   $keywords                   (string)                        Keywords or tags used to describe this content. Multiple
                                                                                                                                                entries in a keywords list are typically delimited by commas. *} */
    public      $learningResourceType       = null;                 /* {*property   $learningResourceType       (string)                        The predominant type or kind characterizing the learning
                                                                                                                                                resource. For example, 'presentation', 'handout'. *} */
    public      $license                    = null;                 /* {*property   $license                    (CreativeWork|URL)              A license document that applies to this content, typically
                                                                                                                                                indicated by URL. *} */
    public      $locationCreated            = null;                 /* {*property   $locationCreated            (Place)                         The location where the CreativeWork was created, which may
                                                                                                                                                not be the same as the location depicted in the CreativeWork. *} */
    public      $mainEntity                 = null;                 /* {*property   $mainEntity                 (Thing)                         Indicates the primary entity described in some page or
                                                                                                                                                other CreativeWork. Inverse property: mainEntityOfPage. *} */
    public      $material                   = null;                 /* {*property   $material                   (Product|string|URL)            A material that something is made from,
                                                                                                                                                e.g. leather, wool, cotton, paper. *} */
    public      $materialExtent             = null;                 /* {*property   $materialExtent             (QuantitativeValue|string)      The quantity of the materials being described or an expression
                                                                                                                                                of the physical space they occupy. *} */
    public      $mentions                   = null;                 /* {*property   $mentions                   (Thing)                         Indicates that the CreativeWork contains a reference to, but
                                                                                                                                                is not necessarily about a concept. *} */
    public      $offers                     = null;                 /* {*property   $offers                     (Offer)                         An offer to provide this item—for example, an offer to sell
                                                                                                                                                a product, rent the DVD of a movie, perform a service, or
                                                                                                                                                give away tickets to an event. *} */
    public      $position                   = null;                 /* {*property   $position                   (int|string)                    The position of an item in a series or sequence of items. *} */
    public      $producer                   = null;                 /* {*property   $producer                   (Organization|Person)           The person or organization who produced the work
                                                                                                                                                (e.g. music album, movie, tv/radio series etc.). *} */
    public      $provider                   = null;                 /* {*property   $provider                   (Organization|Person)           The service provider, service operator, or service performer;
                                                                                                                                                the goods producer. Another party (a seller) may offer those
                                                                                                                                                services or goods on behalf of the provider. A provider may
                                                                                                                                                also serve as the seller. Supersedes carrier. *} */
    public      $publication                = null;                 /* {*property   $publication                (PublicationEvent)              A publication event associated with the item. *} */
    public      $publisher                  = null;                 /* {*property   $publisher                  (Organization|Person)           The publisher of the creative work. *} */
    public      $publisherImprint           = null;                 /* {*property   $publisherImprint           (Organization)                  The publishing division which published the comic. *} */
    public      $publishingPrinciples       = null;                 /* {*property   $publishingPrinciples       (CreativeWork|URL)              The publishingPrinciples property indicates (typically via URL)
                                                                                                                                                a document describing the editorial principles of an Organization
                                                                                                                                                (or individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                activities as a publisher, e.g. ethics or diversity policies.
                                                                                                                                                When applied to a CreativeWork (e.g. NewsArticle) the principles
                                                                                                                                                are those of the party primarily responsible for the creation of
                                                                                                                                                the CreativeWork.
                
                                                                                                                                                While such policies are most typically expressed in natural
                                                                                                                                                language, sometimes related information (e.g. indicating a funder)
                                                                                                                                                can be expressed using schema.org terminology. *} */
                
    public      $recordedAt                 = null;                 /* {*property   $recordedAt                 (Event)                         The Event where the CreativeWork was recorded. The CreativeWork may capture
                                                                                                                                                all or part of the event. Inverse property: recordedIn. *} */
    public      $releasedEvent              = null;                 /* {*property   $releasedEvent              (PublicationEvent)              The place and time the release was issued, expressed as a PublicationEvent. *} */
    public      $review                     = null;                 /* {*property   $review                     (Review)                        A review of the item. Supersedes reviews. *} */
    public      $schemaVersion              = null;                 /* {*property   $schemaVersion              (string|URL)                    Indicates (by URL or string) a particular version of a schema used
                                                                                                                                                in some CreativeWork. For example, a document could declare a
                                                                                                                                                schemaVersion using an URL such as http://schema.org/version/2.0/ if
                                                                                                                                                precise indication of schema version was required by some application. *} */
    public      $sdDatePublished            = null;                 /* {*property   $sdDatePublished            (Date)                          Indicates the date on which the current structured data was
                                                                                                                                                generated / published. Typically used alongside sdPublisher *} */
    public      $sdLicense                  = null;                 /* {*property   $sdLicense                  (CreativeWork|URL)              A license document that applies to this structured data, typically
                                                                                                                                                indicated by URL. *} */
    public      $sdPublisher                = null;                 /* {*property   $sdPublisher                (Organization|Person)           Indicates the party responsible for generating and publishing the current
                                                                                                                                                structured data markup, typically in cases where the structured data is
                                                                                                                                                derived automatically from existing published content but published on a
                                                                                                                                                different site. For example, student projects and open data initiatives
                                                                                                                                                often re-publish existing content with more explicitly structured metadata.
                                                                                                                                                The sdPublisher property helps make such practices more explicit. *} */
    public      $sourceOrganization         = null;                 /* {*property   $sourceOrganization         (Organization)                  The Organization on whose behalf the creator was working. *} */
    public      $spatial                    = null;                 /* {*property   $spatial                    (Place)                         The "spatial" property can be used in cases when more specific properties
                                                                                                                                                (e.g. locationCreated, spatialCoverage, contentLocation) are not known
                                                                                                                                                to be appropriate. *} */
    public      $spatialCoverage            = null;                 /* {*property   $spatialCoverage            (Place)                         The spatialCoverage of a CreativeWork indicates the place(s) which are
                                                                                                                                                the focus of the content. It is a subproperty of contentLocation intended
                                                                                                                                                primarily for more technical and detailed materials. For example with a
                                                                                                                                                Dataset, it indicates areas that the dataset describes: a dataset of
                                                                                                                                                New York weather would have spatialCoverage which was the place:
                                                                                                                                                the state of New York. *} */
    public      $sponsor                    = null;                 /* {*property   $sponsor                    (Organization|Person)           A person or organization that supports a thing through a pledge, promise,
                                                                                                                                                or financial contribution. e.g. a sponsor of a Medical Study or a corporate
                                                                                                                                                sponsor of an event. *} */
    public      $temporal                   = null;                 /* {*property   $temporal                   (DateTime|string)               The "temporal" property can be used in cases where more specific
                                                                                                                                                properties (e.g. temporalCoverage, dateCreated, dateModified, datePublished)
                                                                                                                                                are not known to be appropriate. *} */
    public      $temporalCoverage           = null;                 /* {*property   $temporalCoverage           (DateTime|string|URL)           The temporalCoverage of a CreativeWork indicates the period that the
                                                                                                                                                content applies to, i.e. that it describes, either as a DateTime or as a
                                                                                                                                                textual string indicating a time period in ISO 8601 time interval format.
                                                                                                                                                In the case of a Dataset it will typically indicate the relevant time
                                                                                                                                                period in a precise notation (e.g. for a 2011 census dataset, the year 2011
                                                                                                                                                would be written "2011/2012"). Other forms of content e.g. ScholarlyArticle,
                                                                                                                                                Book, TVSeries or TVEpisode may indicate their temporalCoverage in broader
                                                                                                                                                terms - textually or via well-known URL. Written works such as books may
                                                                                                                                                sometimes have precise temporal coverage too, e.g. a work set in
                                                                                                                                                1939 - 1945 can be indicated in ISO 8601 interval format format via
                                                                                                                                                "1939/1945".
                
                                                                                                                                                Open-ended date ranges can be written with ".." in place of the end date.
                                                                                                                                                For example, "2015-11/.." indicates a range beginning in November 2015 and
                                                                                                                                                with no specified final date. This is tentative and might be updated in
                                                                                                                                                future when ISO 8601 is officially updated. Supersedes datasetTimeInterval. *} */
                
    public      $text                       = null;                 /* {*property   $text                       (string)                        The textual content of this CreativeWork. *} */
    public      $thumbnailUrl               = null;                 /* {*property   $thumbnailUrl               (URL)                           A thumbnail image relevant to the Thing. *} */
    public      $timeRequired               = null;                 /* {*property   $timeRequired               (Duration)                      Approximate or typical time it takes to work with or through this learning
                                                                                                                                                resource for the typical intended target audience, e.g. 'PT30M', 'PT1H25M'. *} */
    public      $translationOfWork          = null;                 /* {*property   $translationOfWork          (CreativeWork)                  The work that this work has been translated from. e.g. 物种起源 is a
                                                                                                                                                translationOf “On the Origin of Species” Inverse property: workTranslation. *} */
    public      $translator                 = null;                 /* {*property   $translator                 (Organization|Person)           Organization |Person) who adapts a creative work to different languages,
                                                                                                                                                regional differences and technical requirements of a target market, or that
                                                                                                                                                translates during some event. *} */
    public      $typicalAgeRange            = null;                 /* {*property   $typicalAgeRange            (string)                        The typical expected age range, e.g. '7-9', '11-'. *} */
    public      $version                    = null;                 /* {*property   $version                    (Number|string)                 The version of the CreativeWork embodied by a specified resource. *} */
    public      $video                      = null;                 /* {*property   $video                      (Clip|VideoObject)              An embedded video object. *} */
    public      $workExample                = null;                 /* {*property   $workExample                (CreativeWork)                  Example/instance/realization/derivation of the concept of this creative
                                                                                                                                                work. eg. The paperback edition, first edition, or eBook.
                                                                                                                                                Inverse property: exampleOfWork. *} */
    public      $workTranslation            = null;                 /* {*property   $workTranslation            (CreativeWork)                  A work that is a translation of the content of this work. e.g. 西遊記 has
                                                                                                                                                an English workTranslation “Journey to the West”,a German workTranslation
                                                                                                                                                “Monkeys Pilgerfahrt” and a Vietnamese translation Tây du ký bình khảo.
                                                                                                                                                Inverse property: translationOfWork. *} */
    /*


    A REPLACER OÙ DE DROIT

    For example "Available by appointment from the Reading Room" or "Accessible only from logged-in accounts ".



    In cases where a CreativeWork has several media type representations, encoding can be used to indicate each MediaObject alongside particular encodingFormat information.

    Unregistered or niche encoding and file formats can be indicated instead via the most appropriate URL, e.g. defining Web page or a Wikipedia/Wikidata entry. Supersedes fileFormat.


    FIN DE A REPLACER OU DE DROIT

    */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q17537576';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Distinct artistic creation such as 
                                                                                                                                                    artwork, literature, music, and paintings. *} */
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
    }   /* End of CreativeWork.__construct() ========================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of CreativeWork.speak() ================================================ */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of CreativeWork.sing() ================================================= */
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
    }   /* End of CreativeWork.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class CreativeWork ====================================================== */
/* ==================================================================================== */
?>