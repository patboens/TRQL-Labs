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
    {*file                  trql.creativeworkseries.class.php *}
    {*purpose               A CreativeWorkSeries in schema.org is a group of related
                            items, typically but not necessarily of the same kind.
                            CreativeWorkSeries are usually organized into some order,
                            often chronological. Unlike ItemList which is a general
                            purpose data structure for lists of things, the emphasis
                            with CreativeWorkSeries is on published materials (written
                            e.g. books and periodicals, or media such as tv, radio and
                            games).Specific subtypes are available for describing
                            TVSeries, RadioSeries, MovieSeries, BookSeries, Periodical
                            and VideoGameSeries. In each case, the hasPart / isPartOf
                            properties can be used to relate the CreativeWorkSeries to
                            its parts. The general CreativeWorkSeries type serves
                            largely just to organize these more specific and practical
                            subtypes.It is common for properties applicable to an item
                            from the series to be usefully applied to the containing
                            group. Schema.org attempts to anticipate some of these
                            cases, but publishers should be free to apply properties of
                            the series parts to the series as a whole wherever they seem
                            appropriate. *}
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
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\creativeworkseries;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'CREATIVEWORKSERIES_CLASS_VERSION' ) or define( 'CREATIVEWORKSERIES_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CreativeWorkSeries=

    {*desc

        A CreativeWorkSeries in schema.org is a group of related items, typically
        but not necessarily of the same kind. CreativeWorkSeries are usually
        organized into some order, often chronological. Unlike ItemList which is a
        general purpose data structure for lists of things, the emphasis with
        CreativeWorkSeries is on published materials (written e.g. books and
        periodicals, or media such as tv, radio and games).Specific subtypes are
        available for describing TVSeries, RadioSeries, MovieSeries, BookSeries,
        Periodical and VideoGameSeries. In each case, the hasPart / isPartOf
        properties can be used to relate the CreativeWorkSeries to its parts. The
        general CreativeWorkSeries type serves largely just to organize these more
        specific and practical subtypes.It is common for properties applicable to
        an item from the series to be usefully applied to the containing group.
        Schema.org attempts to anticipate some of these cases, but publishers
        should be free to apply properties of the series parts to the series as a
        whole wherever they seem appropriate.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CreativeWorkSeries[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class CreativeWorkSeries extends CreativeWork
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $endDate                        = null;             /* {*property   $endDate                        (Date|DateTime)                 The end date and time of the item (in ISO 8601 date format). *} */
    public      $issn                           = null;             /* {*property   $issn                           (string)                        The International Standard Serial Number (ISSN) that identifies this
                                                                                                                                                    serial publication. You can repeat this property to identify different
                                                                                                                                                    formats of, or the linking ISSN (ISSN-L) for, this serial publication. *} */
    public      $startDate                      = null;             /* {*property   $startDate                      (DateTime|Date)                 The start date and time of the item (in ISO 8601 date format). *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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
    }   /* End of CreativeWorkSeries.__construct() ==================================== */
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
    }   /* End of CreativeWorkSeries.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class CreativeWorkSeries ================================================ */
/* ==================================================================================== */
?>