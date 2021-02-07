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
    {*file                  trql.postaladdress.class.php *}
    {*purpose               Mailing address. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 23-08-20 14:04 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 23-08-20 14:04 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\postaladdress;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\place\Place                               as Place;
use \trql\structuredvalue\StructuredValue           as StructuredValue;
use \trql\contactpoint\ContactPoint                 as ContactPoint;
use \trql\mercator\Mercator                         as Mercator;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );

if ( ! defined( 'CONTACTPOINT_CLASS_VERSION' ) )
    require_once( 'trql.contactpoint.class.php' );

if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
    require_once( 'trql.mercator.class.php' );

defined( 'POSTALADDRESS_CLASS_VERSION' ) or define( 'POSTALADDRESS_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ==================================================================================== */
/** {{*class PostalAddress=

    {*desc

        The mailing address.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/PostalAddress[/url] *}

    {*todo  [ol]
                [li]Implement a basic [c]speak/render[/c] by generating microformat tags
                    for a complete address[/li]
            [/ol]
    *}

    *}}
 */
/* ==================================================================================== */
class PostalAddress extends ContactPoint implements iContext
/*--------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $addressCountry             = null;                 /* {*property   $addressCountry             (Country|string)        The country. For example, USA. You can also provide the
                                                                                                                                        two-letter ISO 3166-1 alpha-2 country code. *} */
    public      $addressLocality            = null;                 /* {*property   $addressLocality            (string)                The locality in which the street address is, and which is
                                                                                                                                        in the region. For example, Mountain View. *} */
    public      $addressRegion              = null;                 /* {*property   $addressRegion              (string)                The region in which the locality is, and which is in the
                                                                                                                                        country. For example, California or another appropriate
                                                                                                                                        first-level Administrative division *} */
    public      $postOfficeBoxNumber        = null;                 /* {*property   $postOfficeBoxNumber        (string)                The post office box number for PO box addresses. *} */
    public      $postalCode                 = null;                 /* {*property   $postalCode                 (string)                The postal code. For example, 94043. *} */
    public      $streetAddress              = null;                 /* {*property   $streetAddress              (string)                The street address. For example, 1600 Amphitheatre Pkwy. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q319608';        /* {*property   $wikidataId                 (string)                WikidataId ... pointing to "Collection of information
                                                                                                                                        that describes the location of a building, apartment, or
                                                                                                                                        other structure address."[br]

                                                                                                                                        Wikidata is a free and open knowledge base that can be read
                                                                                                                                        and edited by both humans and machines.[br]

                                                                                                                                        Wikidata acts as central storage for the structured data of
                                                                                                                                        its Wikimedia sister projects including Wikipedia,
                                                                                                                                        Wikivoyage, Wiktionary, Wikisource, and others.[br]

                                                                                                                                        Wikidata also provides support to many other sites and
                                                                                                                                        services beyond just Wikimedia projects! The content of
                                                                                                                                        Wikidata is available under a free license, exported using
                                                                                                                                        standard formats, and can be interlinked to other open
                                                                                                                                        data sets on the linked data web.[br]

                                                                                                                                        [url]https://www.wikidata.org/wiki/Wikidata:Main_Page[/url]
                                                                                                                                        [url]https://www.wikidata.org/wiki/Special:Statistics[/url] *} */


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
    }   /* End of PostalAddress.__construct() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*speak()=

        Generate a text about the class itself

        {*params
        *}

        {*return
            (string)    A text representing the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of PostalAddress.speak() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*sing()=

        Generate a text-to-speech file corresponding to the class itself

        {*params
        *}

        {*return
            (string)    A URL where the text-to-speech file (.mp3) is available
        *}

        *}}
    */
    /* ================================================================================ */
    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of PostalAddress.sing() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*countriesIn( $szStr )=

        Search a string for all occurrences of country names

        {*params
            $szStr      (string)    The string to be examined
        *}

        {*return
            (array)     An array of countries
        *}

        {*warning

            This method has been imported from [c]trql.voltaire.class.php[/c] and
            has NOT been tested yet in the context of the PostalAddress class.

        *}

        *}}
    */
    /* ================================================================================ */
    protected function countriesIn( $szStr )
    /*------------------------------------*/
    {
        $aRetVal        = null;

        $aAllCountries  = $this->countries();

        //var_dump( $aAllCountries );

        foreach( $aAllCountries as $aCountry )
        {
            if     ( vaesoli::STR_iPos( $szStr,$aCountry['en'] ) !== -1 )
                $aRetVal['en'] = array( 'match' => $aCountry['en'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['fr'] ) !== -1 )
                $aRetVal['fr'] = array( 'match' => $aCountry['fr'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['nl'] ) !== -1 )
                $aRetVal['nl'] = array( 'match' => $aCountry['nl'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['es'] ) !== -1 )
                $aRetVal['es'] = array( 'match' => $aCountry['es'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['de'] ) !== -1 )
                $aRetVal['de'] = array( 'match' => $aCountry['de'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['pt'] ) !== -1 )
                $aRetVal['pt'] = array( 'match' => $aCountry['pt'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['it'] ) !== -1 )
                $aRetVal['it'] = array( 'match' => $aCountry['it'],'country' => $aCountry );
        }   /* foreach( $aAllCountries as $aCountry ) */

        return ( $aRetVal );
    }   /* End of PostalAddress.countriesIn() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*isAddressNumber( $szStr )=

        Determines if

        {*params
            $szStr      (string)    The string to be examined
        *}

        {*return
            (boolean)   [c]true[/c] if $szStr matches a street number; [c]false[/c]
                        otherwise.
        *}

        {*warning

            This method has been imported from [c]trql.voltaire.class.php[/c] and
            has NOT been tested yet in the context of the PostalAddress class.

        *}

        *}}
    */
    /* ================================================================================ */
    protected function isAddressNumber( $szStr )
    /*----------------------------------------*/
    {
        return ( preg_match( '%(?:\d)+(A|B|C)?(/|-)?(\d+(A|B|C)?)?%si',$szStr ) );
    }   /* End of PostalAddress.isAddressNumber() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*isCity( $szWord )=

        Determines if $szWord is a city (WARNING: only Belgian cities for now -
        06-09-20 07:21:20)

        {*params
            $szWord     (string)    The word to be examined
        *}

        {*return
            (boolean)   [c]true[/c] if $szWord matches a belgian city; [c]false[/c]
                        otherwise.
        *}

        {*warning

            This method has been imported from [c]trql.voltaire.class.php[/c] and
            has NOT been tested yet in the context of the PostalAddress class.[br]

            Only Belgian cities!

        *}

        *}}
    */
    /* ================================================================================ */
    protected function isCity( $szWord )
    /*--------------------------------*/
    {
        $bRetVal = false;

        $oMercator = new Mercator();

        $aCities = $oMercator->BELCities();

        $bRetVal = isset( $aCities[trim( strtolower( $szWord ) )] );

        return ( $bRetVal );
    }   /* End of PostalAddress.isCity() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*isCountry( $szWord )=

        Determines if $szWord is a country

        {*params
            $szWord     (string)    The word to be examined
        *}

        {*return
            (boolean)   [c]true[/c] if $szWord is a country; [c]false[/c]
                        otherwise.
        *}

        {*warning

            This method has been imported from [c]trql.voltaire.class.php[/c] and
            has NOT been tested yet in the context of the PostalAddress class.[br]

        *}

        *}}
    */
    /* ================================================================================ */
    protected function isCountry( $szWord )
    /*-----------------------------------*/
    {
        $bRetVal = false;

        static $staticData = null;

        if ( is_null( $staticData ) )
        {
            $oMercator = new Mercator();
            $aCountries = $oMercator->countries();

            foreach( $aCountries as $aCountry )
            {
                foreach ( $aCountry['names'] as $aName )
                {
                    //var_dump( $aName );

                    $staticData[trim( strtolower( $aName['value']   ?? '??' ) ) ] = $aCountry['id'];
                    $staticData[trim( strtolower( $aName['cleaned'] ?? '??' ) ) ] = $aCountry['id'];

                    //$this->die();
                }
            }   /* foreach( $aCountries as $aCountry ) */
        }   /* if ( is_null( $staticData ) ) */

        //var_dump( $staticData );
        //var_dump( isset( $staticData[trim( strtolower( "België" ) )] ) );
        //$this->die();

        $bRetVal = isset( $staticData[trim( strtolower( $szWord ) )] );

        return ( $bRetVal );
    }   /* End of PostalAddress.isCountry() =========================================== */
    /* ================================================================================ */


    protected function isSeparator( $szWord )
    /*-------------------------------------*/
    {
        $bRetVal = false;

        switch ( $szWord )
        {
            case ''     :
            case '-'    :
            case '--'   :
            case '/'    :
            case '\\'   :
                $bRetVal = true;
        }   /* switch ( $szWord ) */

        return ( $bRetVal );
    }   /* End of PostalAddress.isSeparator() ========================================= */
    /* ================================================================================ */


    protected function isCityGroup( $aGroup )
    /*--------------------------------------*/
    {
        $bRetVal = false;

        //var_dump( __METHOD__ . '():',$aGroup );

        if ( count( $aGroup ) === 2 )
        {
            $szTypes = trim( strtolower( $aGroup[0]['type'] . $aGroup[1]['type'] ) );

            $bRetVal = ( $szTypes === 'numberlocality' || $szTypes === 'localitynumber' );
        }   /* if ( count( $aGroup ) === 2 ) */

        return ( $bRetVal );

    }   /* End of PostalAddress.isCityGroup() ========================================= */
    /* ================================================================================ */


    protected function isCountryGroup( $aGroup )
    /*----------------------------------------*/
    {
        $bRetVal = false;

        //var_dump( __METHOD__ . '():',$aGroup );

        if ( count( $aGroup ) === 1 )
        {
            $szTypes = trim( strtolower( $aGroup[0]['type'] ) );
            //var_dump( $szTypes );

            $bRetVal = ( $szTypes === 'country' );
        }   /* if ( count( $aGroup ) === 1 ) */

        return ( $bRetVal );

    }   /* End of PostalAddress.isCountryGroup() ====================================== */
    /* ================================================================================ */


    protected function isBoxGroup( $aGroup )
    /*------------------------------------*/
    {
        $bRetVal = false;

        return ( $bRetVal );

    }   /* End of PostalAddress.isBoxGroup() ========================================== */
    /* ================================================================================ */


    protected function qualifyGroup( &$aGroup )
    /*---------------------------------------*/
    {
        $szType = 'not set';

        if     ( $this->isCityGroup( $aGroup ) )
            $szType = 'city';
        elseif ( $this->isCountryGroup( $aGroup ) )
            $szType = 'country';
        elseif ( $this->isBoxGroup( $aGroup ) )
            $szType = 'box';
        else
            $szType = 'street';

        if ( $szType === 'street' )
        {
            // On pourrait même avoir un groupe "street" qui contienne TOUT
            // la ville, le pays, la box !!!
            // var_dump( $aGroup );

            $oMercator = new Mercator();

            foreach ( $aGroup as $xKey => $aWord )
            {
                //var_dump( $aWord );

                /* If this word has NOT been qualified yet */
                if ( $aWord['type'] === 'string' )
                {
                    $aNature = $oMercator->pathNatures( $aWord['value'] );

                    if ( ! is_null( $aNature ) )
                    {
                        /* We have an array that looks like ...

                            array (size=4)
                              'code' => string 'RUE' (length=3)
                              'cleaned' => string 'rue' (length=3)
                              'lang' => string 'fr' (length=2)
                              'name' => string 'Rue' (length=3)

                        */
                        //var_dump( $aNature );
                        //$this->die("AFTER NATURE");
                        $aGroup[$xKey]['type'] = "path-{$aNature['cleaned']}";
                    }   /* if ( ! is_null( $aNature ) ) */
                }
            }

            //var_dump( $aGroup );

            //$this->die( "SHOULD QUALIFY EACH WORD OF A STREET GROUP!" );

            // SHould use pathNatures !!! Mais attention, car dans certaines
            // langues comme le flamand ou l'Allemand, on a des natures de
            // voie dans le nom de la rue : Nieuwstraat, De Nayerlaan,
            // Colmardstrasse, ...
            $oMercator->pathNatures();
        }

        return ( array( 'values'    => $aGroup      ,
                        'type'      => $szType      ,
                      ) );
    }   /* End of PostalAddress.qualifyGroup() ======================================== */
    /* ================================================================================ */


    protected function hasCountryGroup( $aGroups )
    /*------------------------------------------*/
    {
        $bWithCountryGroup = false;

        // Should use $this->getAddressGroup()

        foreach( $aGroups as $aGroup )
        {
            if ( $aGroup['type'] === 'country' )
            {
                $bWithCountryGroup = true;
                break;
            }   /* if ( $aGroup['type'] === 'country' ) */
        }   /* foreach( $aGroups as $aGroup ) */

        return ( $bWithCountryGroup );
    }   /* End of PostalAddress.hasCountryGroup() ===================================== */
    /* ================================================================================ */


    protected function getAddressGroup( $aGroups,$szType )
    /*--------------------------------------------------*/
    {
        $aRetVal = null;

        foreach( $aGroups as $aGroup )
        {
            if ( $aGroup['type'] === $szType )
            {
                $aRetVal = $aGroup;
                break;
            }   /* if ( $aGroup['type'] === $szType ) */
        }   /* foreach( $aGroups as $aGroup ) */

        return ( $aRetVal );
    }   /* End of PostalAddress.getAddressGroup() ===================================== */
    /* ================================================================================ */


    protected function qualifyAddressToken( $szWord )
    /*---------------------------------------------*/
    {
        $szRetVal = 'string';

        if ( $this->isAddressNumber( $szWord ) )
            $szRetVal = 'number';
        elseif ( $this->isCity( $szWord ) )
            $szRetVal = 'locality';
        elseif ( $this->isCountry( $szWord ) )
            $szRetVal = 'country';

        return ( $szRetVal );
    }   /* End of PostalAddress.qualifyAddressToken() ================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parseAddress( $szText )=

        Parses an address to build a structured set of address blocks

        {*params
            $szText     (string)    The word to be examined
        *}

        {*return
            (array)     An associative array representing $szText in structured
                        blocks.
        *}

        {*warning

            This method has been imported from [c]trql.voltaire.class.php[/c] and
            has NOT been tested yet in the context of the PostalAddress class.[br]

        *}

        *}}
    */
    /* ================================================================================ */
    public function parseAddress( $szText )
    /*-----------------------------------*/
    {
        $aRetVal = null;

        // Avant l'utilisation de preg_split() (06-08-20 08:15:12)
        //if ( preg_match_all( '/[[:word:]]+/si',$szText,$aMatches,PREG_PATTERN_ORDER ) )
        //{
        //    $iCount = count( $aWords = $aMatches[0] );
        //    //var_dump( "Parsing de " . $szText . ':',$aWords );
        //}

        //if ( is_array( $aWords = preg_split( '~[^\p{L}\p{N}\'-/]+~u',$szText ) ) )
        //if ( is_array( $aWords = preg_split( '/[[:space:][:punct:][:cntrl:]]/si',$szText ) ) )
        if ( is_array( $aWords = preg_split( '/( +|,+)/si',$szText ) ) )
        {
            //var_dump( "'" . $szText . "' :",$aWords );

            $aGroups = null;
            $thisGroup = null;

            /* Group words together and qualify each word */
            foreach( $aWords as $szWord )
            {
                if ( ! $this->isSeparator( $szWord ) )
                    $thisGroup[] = array( 'value' => $szWord,'type' => $this->qualifyAddressToken( $szWord ) );
                else
                {
                    /* If separator found, we need to store this
                       group in the list of groups, and we need to
                       qualify the group (is it a country group,
                       a city group, a postalCode group, etc. */
                    //var_dump( $this->qualifyGroup( $thisGroup ) );
                    $aGroups[] = $this->qualifyGroup( $thisGroup );
                    $thisGroup = null;
                }
            }   /* foreach( $aWords as $szWord ) */

            if ( ! is_null( $thisGroup ) )
                $aGroups[] = $this->qualifyGroup( $thisGroup );

            /*  If we didn't find any country in the groups we've parsed
                add a default country group made of Belgium */
            if ( ! $bWithCountryGroup = $this->hasCountryGroup( $aGroups ) )
            {
                $aGroups[] = array( 'values' => array( array( 'value' => 'Belgique','type' => 'country' ) ) ,
                                    'type'   => 'country'                                                   ,
                                  );
            }   /* if ( ! $bWithCountryGroup = $this->hasCountryGroup( $aGroups ) ) */

            //var_dump( "'" . $szText . "' :",$aGroups );

            //var_dump( $szText );
            //var_dump( $aGroups[2] );
            //var_dump( $aGroups );

            $aRetVal['street'   ] = $this->getAddressGroup( $aGroups,'street'   );
            //var_dump( "Street:",$aRetVal['street'] );
            $aRetVal['box'      ] = $this->getAddressGroup( $aGroups,'box'      );
            //var_dump( "Box:",$aRetVal['box'] );
            $aRetVal['city'     ] = $this->getAddressGroup( $aGroups,'city'     );
            //var_dump( "City:",$aRetVal['city'] );
            $aRetVal['country'  ] = $this->getAddressGroup( $aGroups,'country'  );
            //var_dump( "Country:",$aRetVal['country'] );

            //var_dump( $aRetVal );
        }

        // 20200804 ... if ( preg_match_all( '/[[:word:]]+/si',$szText,$aMatches,PREG_PATTERN_ORDER ) )
        // 20200804 ... {
        // 20200804 ...     $iCount = count( $aMatches[0] );
        // 20200804 ...
        // 20200804 ...     var_dump( $aMatches[0] );
        // 20200804 ...
        // 20200804 ...     for ( $i=0;$i < $iCount;$i++ )
        // 20200804 ...     {
        // 20200804 ...         $szWord     = $aMatches[0][$i];
        // 20200804 ...         $szPrevious = ( $i > 0          ? $aMatches[0][$i-1] : null );
        // 20200804 ...         $szNext     = ( $i < $iCount -1 ? $aMatches[0][$i+1] : null );
        // 20200804 ...
        // 20200804 ...         // En fait, il faut faire des push des previous et next
        // 20200804 ...
        // 20200804 ...         if ( ! isset( $aWords[$szWord] ) )
        // 20200804 ...         {
        // 20200804 ...             $aWords[$szWord] = array ( 'previous'   => array( $szPrevious ),
        // 20200804 ...                                        'word'       => $szWord,
        // 20200804 ...                                        'next'       => array( $szNext ) );
        // 20200804 ...         }
        // 20200804 ...         else
        // 20200804 ...         {
        // 20200804 ...             array_push( $aWords[$szWord]['previous'],$szPrevious );
        // 20200804 ...             array_push( $aWords[$szWord]['next']    ,$szNext     );
        // 20200804 ...         }
        // 20200804 ...     }
        // 20200804 ...     // Il faut encore traiter le dernier mot
        // 20200804 ...
        // 20200804 ...     //var_dump( $aWords['process'] );
        // 20200804 ...     //var_dump( $aWords );
        // 20200804 ...     //var_dump( nextOccurrences( 'translation',$aWords ) );
        // 20200804 ...     //var_dump( nextProbableWords( 'translation',$aWords ) );
        // 20200804 ...
        // 20200804 ...     //var_dump( nextOccurrences( 'The',$aWords ) );
        // 20200804 ...     //var_dump( nextProbableWords( 'The',$aWords ) );
        // 20200804 ...
        // 20200804 ...     $szWord     = "The";
        // 20200804 ...     $szWord     = "La";
        // 20200804 ...     $i          = 0;
        // 20200804 ...     $szSentence = $szWord . ' ';
        // 20200804 ...
        // 20200804 ...     do
        // 20200804 ...     {
        // 20200804 ...         //var_dump( "NEXT OF :" . $szWord );
        // 20200804 ...         $aNext = nextOccurrences( $szWord,$aWords );
        // 20200804 ...
        // 20200804 ...         if ( is_array( $aNext ) && count( $aNext ) > 0 )
        // 20200804 ...         {
        // 20200804 ...             //var_dump( $aNext );
        // 20200804 ...
        // 20200804 ...             $key = array_rand( $aNext );
        // 20200804 ...
        // 20200804 ...             //$szWord = key( $aNext );
        // 20200804 ...
        // 20200804 ...             //var_dump( array_rand( $aNext ) );
        // 20200804 ...             //die();
        // 20200804 ...             //$key = key( array_rand( $aNext ) );
        // 20200804 ...
        // 20200804 ...             $szWord = array_rand( $aNext );
        // 20200804 ...
        // 20200804 ...             //var_dump( 'NEXT WORD: ' . $szWord );
        // 20200804 ...             //die();
        // 20200804 ...
        // 20200804 ...             $szSentence .= $szWord . ' ';
        // 20200804 ...         }
        // 20200804 ...     } while ( ! is_null( $szWord ) && ++$i < 70 );
        // 20200804 ...
        // 20200804 ...     echo $szSentence;
        // 20200804 ... }   /* if ( preg_match_all( '/[[:word:]]+/si',$szText,$aMatches,PREG_PATTERN_ORDER ) ) */

        return ( $aRetVal );
    }   /* End of PostalAddress.parseAddress() ======================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getAPIKey([$szSystem])=

        Get the API Key for reverse geocoding

        {*params
            $szSystem       (string)        Optional. [c]null[/c] by default
        *}

        {*return
            (string)        The API Key or [c]null[/c] if not found
        *}

        *}}
    */
    /* ================================================================================ */
    private function getAPIKey( $szSystem = null )
    /*------------------------------------------*/
    {
        if ( ! is_null( $szSystem ) )
            $szCave = "/api.{$szSystem}.key.txt";
        else
            $szCave = '/api.key.txt';

        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->szHome . $szCave ) ) )
            return ( vaesoli::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of PostalAddress.getAPIKey() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*reverseGeo( $szAddress )=

        Reverse geo an address (from street name to lat,lng)

        {*params
            $szAddress      (string)        The address to process
        *}

        {*return
            (string)        The API Key or [c]null[/c] if not found
        *}

        *}}
    */
    /* ================================================================================ */
    public function reverseGeo( $szAddress )
    /*-------------------------------------*/
    {
        static $szAPIKey = null;

        if ( is_null( $szAPIKey ) )
            $szAPIKey = $this->getAPIKey();

        //echo $szAPIKey,"\n";

        $szAddress      = urlencode( $szAddress );
        $szAddress2     = vaesoli::STR_Sort( $szAddress );
        $szCountry      = null;
        $szXML          = null;
        $aRetVal        = null;

        $szCacheFile    = $this->cacheName( __METHOD__,$szAddress2 );

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            //var_dump( "Data retrieved from cache" );
            $szXML = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
        }
        else
        {
            $szURL = "http://dev.virtualearth.net/REST/v1/Locations?addressLine={$szAddress}{$szCountry}&maxResults=20&key={$szAPIKey}&o=xml";

            if ( ! empty( $szXML = $this->getURL( $szURL ) ) )
            {
                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$szXML );
                    $this->addInfo( __METHOD__ . "(): reverseGeo data stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }
        }

        if ( ! is_null( $szXML ) )
        {
            //echo $szXML;

            /* On reçoit qqch comme :
            <?xml version="1.0" encoding="utf-8"?>
            <Response xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                      xmlns="http://schemas.microsoft.com/search/local/ws/rest/v1">
                <Copyright>Copyright © 2020 Microsoft and its suppliers. All
                rights reserved. This API cannot be accessed and the content
                and any results may not be used, reproduced or transmitted
                in any manner without express written permission from
                Microsoft Corporation.</Copyright>
                
                <BrandLogoUri>http://dev.virtualearth.net/Branding/logo_powered_by.png</BrandLogoUri>
                <StatusCode>200</StatusCode>
                <StatusDescription>OK</StatusDescription>
                <AuthenticationResultCode>ValidCredentials</AuthenticationResultCode>
                <TraceId>548ac0b133aa46c78097ad47d14e62b1|DU00000D5F|0.0.0.1|Ref A: 5CB8EF25100E4CB89B43CE48A8C9A7D7 Ref B:DB3EDGE1607 Ref C: 2020-10-31T18:12:20Z</TraceId>
                <ResourceSets>
                    <ResourceSet>
                        <EstimatedTotal>1</EstimatedTotal>
                        <Resources>
                            <Location>
                                <Name>Basse Voie 10, 1370 Jodoigne</Name>
                                <Point>
                                    <Latitude>50.74572</Latitude>
                                    <Longitude>4.85748</Longitude>
                                </Point>
                                <BoundingBox>
                                    <SouthLatitude>50.74482</SouthLatitude>
                                    <WestLongitude>4.85606</WestLongitude>
                                    <NorthLatitude>50.74662</NorthLatitude>
                                    <EastLongitude>4.8589</EastLongitude>
                                </BoundingBox>
                                <EntityType>Address</EntityType>
                                <Address>
                                    <AddressLine>Basse Voie 10</AddressLine>
                                    <AdminDistrict>Walloon Region</AdminDistrict>
                                    <AdminDistrict2>Walloon Brabant</AdminDistrict2>
                                    <CountryRegion>Belgium</CountryRegion>
                                    <FormattedAddress>Basse Voie 10, 1370 Jodoigne</FormattedAddress>
                                    <Locality>Jodoigne</Locality>
                                    <PostalCode>1370</PostalCode>
                                </Address>
                                <Confidence>High</Confidence>
                                <MatchCode>Good</MatchCode>
                                <GeocodePoint>
                                    <Latitude>50.74572</Latitude>
                                    <Longitude>4.85748</Longitude>
                                    <CalculationMethod>None</CalculationMethod>
                                    <UsageType>Display</UsageType>
                                </GeocodePoint>
                            </Location>
                        </Resources>
                    </ResourceSet>
                </ResourceSets>
            </Response>
            */

            $aRetVal = $this->parse( $szXML );
            //var_dump( $aRetVal );
        }

        return ( $aRetVal );

    }   /* End of PostalAddress.reverseGeo() ========================================== */
    /* ================================================================================ */


    public function parse( &$szXML )
    /*----------------------------*/
    {
        $aRetVal = null;

        if ( preg_match( '%<GeocodePoint><Latitude\b[^>]*>(?P<lat>.*?)</Latitude>.*<Longitude\b[^>]*>(?P<lng>.*?)</Longitude>%si',$szXML,$aMatches ) )
        {
            $fLatitude  = (float) $aMatches['lat'];
            $fLongitude = (float) $aMatches['lng'];

            $aRetVal    =  array( 'latitude'    => $fLatitude   ,
                                  'longitude'   => $fLongitude  ,
                                );
        }

        return ( $aRetVal );
    }   /* End of PostalAddress.parse() =============================================== */
    /* ================================================================================ */


    /* Final */
    protected function cacheName( $szMethod,$xParams,$xAdditional = null )
    /*------------------------------------------------------------------*/
    {
        $szMethod = str_replace( array( '\\',':','::','..' ),
                                 array( '.' ,'.','.' ,'.'  ),
                                 $szMethod );

        if ( is_null( $xAdditional ) )
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . '.cache' );
        else
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . md5( serialize( $xAdditional ) ) . '.cache' );

        return ( $szCacheFile );
    }   /* End of Mercator.cacheName() ================================================ */
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

    }   /* End of PostalAddress.__destruct() ========================================== */
    /* ================================================================================ */

}   /* End of class PostalAddress ===================================================== */
/* ==================================================================================== */
?>