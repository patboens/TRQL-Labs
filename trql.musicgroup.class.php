<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.musicgroup.class.php *}
    {*purpose               A musical group, such as a band, an orchestra, or a choir.
                            Can also be a solo musician. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 31-07-20 16:08 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 31-07-20 16:08 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\schema\organization;

use \trql\vaesoli\Vaesoli                       as V;
use \trql\quitus\iContext                       as iContext;
use \trql\context\Context                       as Context;
use \trql\schema\organization\PerformingGroup   as PerformingGroup;
use \trql\quitus\Wikipedia                      as Wikipedia;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PERFORMINGGROUP_CLASS_VERSION' ) )
    require_once( 'trql.performinggroup.class.php' );

if ( ! defined( 'WIKIPEDIA_CLASS_VERSION' ) )
    require_once( 'trql.wikipedia.class.php' );

defined( 'PROP_BIRTH_NAME'              ) or define( 'PROP_BIRTH_NAME'              ,'P1477'    );
defined( 'PROP_PLACE_OF_BIRTH'          ) or define( 'PROP_PLACE_OF_BIRTH'          ,'P19'      );
defined( 'PROP_DATE_OF_BIRTH'           ) or define( 'PROP_DATE_OF_BIRTH'           ,'P569'     );
defined( 'PROP_PLACE_OF_DEATH'          ) or define( 'PROP_PLACE_OF_DEATH'          ,'P20'      );
defined( 'PROP_DATE_OF_DEATH'           ) or define( 'PROP_DATE_OF_DEATH'           ,'P570'     );
defined( 'PROP_MANNER_OF_DEATH'         ) or define( 'PROP_MANNER_OF_DEATH'         ,'P1196'    );
defined( 'PROP_CAUSE_OF_DEATH'          ) or define( 'PROP_CAUSE_OF_DEATH'          ,'P509'     );
defined( 'PROP_PLACE_OF_BURIAL'         ) or define( 'PROP_PLACE_OF_BURIAL'         ,'P119'     );

defined( 'PROP_COUNTRY_OF_ORIGIN'       ) or define( 'PROP_COUNTRY_OF_ORIGIN'       ,'P495'     );
defined( 'PROP_DATE_OF_INCEPTION'       ) or define( 'PROP_DATE_OF_INCEPTION'       ,'P571'     );
defined( 'PROP_LOCATION_OF_FORMATION'   ) or define( 'PROP_LOCATION_OF_FORMATION'   ,'P740'     );

defined( 'PROP_COUNTRY_OF_CITIZENSHIP'  ) or define( 'PROP_COUNTRY_OF_CITIZENSHIP'  ,'P27'      );
defined( 'PROP_COUNTRY_OF_ORIGIN'       ) or define( 'PROP_COUNTRY_OF_ORIGIN'       ,'P495'     );
defined( 'PROP_NATIVE_LANGUAGE'         ) or define( 'PROP_NATIVE_LANGUAGE'         ,'P103'     );
defined( 'PROP_PARTNER'                 ) or define( 'PROP_PARTNER'                 ,'P451'     );  /* Someone NOT in couple */
defined( 'PROP_SPOUSE'                  ) or define( 'PROP_SPOUSE'                  ,'P26'      );  /* Someone in couple */
defined( 'PROP_GENDER'                  ) or define( 'PROP_GENDER'                  ,'P21'      );
defined( 'PROP_MEMBER_OF'               ) or define( 'PROP_MEMBER_OF'               ,'P463'     );

defined( 'PROP_ALLMUSIC_ARTIST_ID'      ) or define( 'PROP_ALLMUSIC_ARTIST_ID'      ,'P1728'    );
defined( 'PROP_DISCOGS_ARTIST_ID'       ) or define( 'PROP_DISCOGS_ARTIST_ID'       ,'P1953'    );
defined( 'PROP_SPOTIFY_ARTIST_ID'       ) or define( 'PROP_SPOTIFY_ARTIST_ID'       ,'P1902'    );
defined( 'PROP_DEEZER_ARTIST_ID'        ) or define( 'PROP_DEEZER_ARTIST_ID'        ,'P2722'    );
defined( 'PROP_SONGFACTS_ARTIST_ID'     ) or define( 'PROP_SONGFACTS_ARTIST_ID'     ,'P5287'    );
defined( 'PROP_ITUNES_ARTIST_ID'        ) or define( 'PROP_ITUNES_ARTIST_ID'        ,'P2850'    );

defined( 'PROP_OFFICIAL_WEBSITE'        ) or define( 'PROP_OFFICIAL_WEBSITE'        ,'P856'     );
defined( 'PROP_BILLBOARD_ARTIST_ID'     ) or define( 'PROP_BILLBOARD_ARTIST_ID'     ,'P4208'    );
defined( 'PROP_FACEBOOK_ID'             ) or define( 'PROP_FACEBOOK_ID'             ,'P2013'    );
defined( 'PROP_TWITTER_ACCOUNT'         ) or define( 'PROP_TWITTER_ACCOUNT'         ,'P2002'    );
defined( 'PROP_RESIDENCE'               ) or define( 'PROP_RESIDENCE'               ,'P551'     );
defined( 'PROP_GENRE'                   ) or define( 'PROP_GENRE'                   ,'P136'     );
defined( 'PROP_YOUTUBE_CHANNEL_ID'      ) or define( 'PROP_YOUTUBE_CHANNEL_ID'      ,'P2397'    );

defined( 'PROP_RECORD_LABEL'            ) or define( 'PROP_RECORD_LABEL'            ,'P264'     );
defined( 'PROP_NOMINATED_FOR'           ) or define( 'PROP_NOMINATED_FOR'           ,'P1411'    );
defined( 'PROP_AWARD_RECEIVED'          ) or define( 'PROP_AWARD_RECEIVED'          ,'P166'     );
defined( 'PROP_INSTRUMENT'              ) or define( 'PROP_INSTRUMENT'              ,'P1303'    );
defined( 'PROP_FATHER'                  ) or define( 'PROP_FATHER'                  ,'P22'      );
defined( 'PROP_MOTHER'                  ) or define( 'PROP_MOTHER'                  ,'P25'      );
defined( 'PROP_CHILD'                   ) or define( 'PROP_CHILD'                   ,'P40'      );
defined( 'PROP_OCCUPATION'              ) or define( 'PROP_OCCUPATION'              ,'P106'     );
defined( 'PROP_VOICE_TYPE'              ) or define( 'PROP_VOICE_TYPE'              ,'P412'     );
defined( 'PROP_EDUCATED_AT'             ) or define( 'PROP_EDUCATED_AT'             ,'P69'      );
defined( 'PROP_HAS_PARTS'               ) or define( 'PROP_HAS_PARTS'               ,'P527'     );
defined( 'PROP_COUNTRY_OF_ORIGIN'       ) or define( 'PROP_COUNTRY_OF_ORIGIN'       ,'P495'     );
defined( 'PROP_DISCOGRAPHY'             ) or define( 'PROP_DISCOGRAPHY'             ,'P358'     );
defined( 'PROP_HAS_LIST'                ) or define( 'PROP_HAS_LIST'                ,'P2354'    );
defined( 'PROP_PSEUDO'                  ) or define( 'PROP_PSEUDO'                  ,'P742'     );
defined( 'PROP_IMAGE'                   ) or define( 'PROP_IMAGE'                   ,'P18'      );
defined( 'PROP_MEDICAL_CONDITION'       ) or define( 'PROP_MEDICAL_CONDITION'       ,'P1050'    );

/*
 - P410 (military rank)
   - Q157696 (Type: wikibase-entityid)
*/



defined( 'MUSICGROUP_CLASS_VERSION' ) or define( 'MUSICGROUP_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MusicGroup=

    {*desc

        A musical group, such as a band, an orchestra, or a choir. Can also be a solo
        musician.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicGroup[/url] *}


    *}}
 */
/* ==================================================================================== */
class MusicGroup extends PerformingGroup
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q215380';                /* {*property   $wikidataId                 (string)                        Wikidata ID. Musical ensemble which performs music *} */

    public      $album                  = null;                     /* {*property   $album                      (MusicAlbum)                    A music album. Supersedes albums. *} */
    public      $genre                  = null;                     /* {*property   $genre                      (Text|URL)                      Genre of the creative work, broadcast channel or group. *} */
    public      $track                  = null;                     /* {*property   $track                      (ItemList|MusicRecording)       A music recording (track)—usually a single song. If an
                                                                                                                                                ItemList is given, the list should contain items of type
                                                                                                                                                MusicRecording. Supersedes tracks. *} */

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of MusicGroup.__construct() ============================================ */
    /* ================================================================================ */


    public function getInfo( $szArtist,$szLang = 'en' )
    /*-----------------------------------------------*/
    {
        $aInfo              = null;
        static $oWiki       = null;
        static $aProperties = null;

        if ( is_null( $oWiki ) )
            $oWiki = new Wikipedia();

        if ( is_null( $aProperties ) && is_file( $szFile = $oWiki->home() . '/data/wikidata-properties.hash' ) )
            $aProperties = V::getHashFile( $oWiki->home() . '/data/wikidata-properties.hash' );

        /* If Artist is something like "Q66725017" for example */
        if ( preg_match('/\AQ\d+/im',$szArtist ) )
            $szEntityID = $szArtist;
        else
            $szEntityID = $this->searchArtistEntity( $szArtist,$szLang );

        $this->name = $szArtist;

        $a = null;

        {   /* TRQL Radio ======================================================================== */
            $aInfo['trql'       ]['id'          ] = null;
            $aInfo['trql'       ]['name'        ] = $this->name;
            $aInfo['trql'       ]['storage'     ] = $this->getArtistFileNameEx( $this->name,$this->identifier );
            $aInfo['trql'       ]['id'          ] = $this->identifier;
            $aInfo['trql'       ]['url'         ] = null;
        }

        /* Here ... we cheat ! The overarching folder is maybe NOT "d:/websites/trql.fm/www/httpdocs" */
        if ( is_file( $szFile = "d:/websites/trql.fm/www/httpdocs" . $aInfo['trql']['storage'] ) )
            $a = V::getHashFile( $szFile );

        if ( is_array( $aRetVal = $oWiki->getEntity( $szEntityID ) ) )
        {
            if ( is_null( $this->name ) )
                $this->name = $aRetVal['label'];

            {   /* Wikidata ========================================================================== */
                $aInfo['wikidata'   ]['id'          ] = $aRetVal['id'          ];
                $aInfo['wikidata'   ]['url'         ] = $aRetVal['url'         ];
                $aInfo['wikidata'   ]['label'       ] = $aRetVal['label'       ];
                $aInfo['wikidata'   ]['description' ] = $aRetVal['description' ];

                if ( is_array( $aRetVal['aliases'] ) && count( $aRetVal['aliases'] ) > 0 )
                    $aInfo['wikidata']['aliases'] = $aRetVal['aliases'];

                if ( is_array( $aRetVal['properties'] ) && count( $aRetVal['properties'] ) > 0 )
                {
                    if ( isset( $aRetVal['properties'][PROP_IMAGE] ) )
                        $aInfo['wikidata']['picture']       = $aRetVal['properties'][PROP_IMAGE]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_BIRTH_NAME] ) )
                        $aInfo['wikidata']['birthname']     = $aRetVal['properties'][PROP_BIRTH_NAME]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_PSEUDO] ) )
                        $aInfo['wikidata']['pseudo']        = $aRetVal['properties'][PROP_PSEUDO]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_GENDER] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_GENDER]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['gender'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_MOTHER] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_MOTHER]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['mother'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_FATHER] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_FATHER]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['father'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_PLACE_OF_BIRTH] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_PLACE_OF_BIRTH]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['place-of-birth'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_DATE_OF_BIRTH] ) )
                        $aInfo['wikidata']['date-of-birth'] = $aRetVal['properties'][PROP_DATE_OF_BIRTH]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_DATE_OF_INCEPTION] ) )
                        $aInfo['wikidata']['date-of-inception'] = $aRetVal['properties'][PROP_DATE_OF_INCEPTION]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_LOCATION_OF_FORMATION] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_LOCATION_OF_FORMATION]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['location-of-formation'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_COUNTRY_OF_ORIGIN] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_COUNTRY_OF_ORIGIN]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['country-of-origin'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_PLACE_OF_DEATH] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_PLACE_OF_DEATH]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['place-of-death'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_DATE_OF_DEATH] ) )
                        $aInfo['wikidata']['date-of-death'] = $aRetVal['properties'][PROP_DATE_OF_DEATH]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_MANNER_OF_DEATH] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_MANNER_OF_DEATH]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['manners-of-death'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_CAUSE_OF_DEATH] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_CAUSE_OF_DEATH]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['causes-of-death'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_PLACE_OF_BURIAL] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_PLACE_OF_BURIAL]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['place-of-burial'] = $szValue . " ({$szEntityID})";
                    }

                    if     ( isset( $aRetVal['properties'][PROP_SPOUSE] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_SPOUSE]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['spouse'] = $szValue . " ({$szEntityID})";
                    }
                    elseif ( isset( $aRetVal['properties'][PROP_PARTNER] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_PARTNER]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['partner'] = $szValue . " ({$szEntityID})";
                    }
                    elseif ( isset( $aRetVal['properties'][PROP_HAS_PARTS] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_HAS_PARTS]['values'];

                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['members'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_MEDICAL_CONDITION] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_MEDICAL_CONDITION]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['medical-conditions'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_CHILD] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_CHILD]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['children'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_NATIVE_LANGUAGE] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_NATIVE_LANGUAGE]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['native-language'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_RESIDENCE] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_RESIDENCE]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['residence'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_COUNTRY_OF_CITIZENSHIP] ) )
                    {
                        $szValue = $szEntityID = $aRetVal['properties'][PROP_COUNTRY_OF_CITIZENSHIP]['values'][0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];

                        $aInfo['wikidata']['country-of-citizenship'] = $szValue . " ({$szEntityID})";
                    }

                    if ( isset( $aRetVal['properties'][PROP_MEMBER_OF] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_MEMBER_OF]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['member-of'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    /* La discographie n'est pas encore OK */
                    if ( isset( $aRetVal['properties'][PROP_DISCOGRAPHY] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_DISCOGRAPHY]['values'];
                        $szValue = $szEntityID = $aValues[0]['value'];

                        if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                            $szValue = $aLocalResult['label'];
                        // Quand ce sera bon, alors je peux afficher ce résultat
                        // Pour l'instant, je n'ai pas encore la liste des albums
                        //echo " - {$szValue} ($szEntityID)\n";

                        if ( isset( $aLocalResult['properties'][PROP_HAS_LIST] ) )
                        {
                            $aDiscoValues = $aLocalResult['properties'][PROP_HAS_LIST]['values'];
                            foreach ( $aDiscoValues as $aValue )
                            {
                                // Pfff ... que c'est compliqué !!!
                                // Code à continuer !!!
                                $szDiscoID = $aValue['value'];
                                if ( is_array( $aAlbums = $oWiki->getEntity( $szDiscoID ) ) )
                                {
                                    //var_dump( $aAlbums );
                                }
                            }
                        }
                        //die("SALUT");
                    }

                    if ( isset( $aRetVal['properties'][PROP_GENRE] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_GENRE]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['genres'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_INSTRUMENT] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_INSTRUMENT]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['instruments'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_RECORD_LABEL] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_RECORD_LABEL]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['record-labels'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_NOMINATED_FOR] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_NOMINATED_FOR]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['nominated-for'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_AWARD_RECEIVED] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_AWARD_RECEIVED]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['awards-received'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_OCCUPATION] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_OCCUPATION]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['occupations'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_VOICE_TYPE] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_VOICE_TYPE]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['voice-types'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    if ( isset( $aRetVal['properties'][PROP_OFFICIAL_WEBSITE] ) )
                    {
                        $szValue = $aRetVal['properties'][PROP_OFFICIAL_WEBSITE]['values'][0]['value'];
                        $aInfo['wikidata']['websites'][] = $szValue;
                    }

                    if ( isset( $aRetVal['properties'][PROP_EDUCATED_AT] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_EDUCATED_AT]['values'];
                        foreach ( $aValues as $xValue )
                        {
                            $szValue = $szEntityID = $xValue['value'];

                            if ( is_array( $aLocalResult = $oWiki->getEntity( $szEntityID ) ) )
                                $szValue = $aLocalResult['label'];

                            $aInfo['wikidata']['educated-at'][] = $szValue . " ({$szEntityID})";
                        }
                    }

                    /************************************************************/
                    /* External IDs                                             */
                    /************************************************************/

                    if ( isset( $aRetVal['properties'][PROP_ALLMUSIC_ARTIST_ID] ) )
                        $aInfo['wikidata']['IDs']['allmusic']   = $aRetVal['properties'][PROP_ALLMUSIC_ARTIST_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_BILLBOARD_ARTIST_ID] ) )
                        $aInfo['wikidata']['IDs']['billboard']  = $aRetVal['properties'][PROP_BILLBOARD_ARTIST_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_ITUNES_ARTIST_ID] ) )
                        $aInfo['wikidata']['IDs']['itunes']     = $aRetVal['properties'][PROP_ITUNES_ARTIST_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_SPOTIFY_ARTIST_ID] ) )
                        $aInfo['wikidata']['IDs']['spotify']    = $aRetVal['properties'][PROP_SPOTIFY_ARTIST_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_DEEZER_ARTIST_ID] ) )
                        $aInfo['wikidata']['IDs']['deezer']     = $aRetVal['properties'][PROP_DEEZER_ARTIST_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_SONGFACTS_ARTIST_ID] ) )
                        $aInfo['wikidata']['IDs']['songfacts']  = $aRetVal['properties'][PROP_SONGFACTS_ARTIST_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_DISCOGS_ARTIST_ID] ) )
                        $aInfo['wikidata']['IDs']['discogs']    = $aRetVal['properties'][PROP_DISCOGS_ARTIST_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_FACEBOOK_ID] ) )
                        $aInfo['wikidata']['IDs']['facebook']   = $aRetVal['properties'][PROP_FACEBOOK_ID]['values'][0]['value'];

                    if ( isset( $aRetVal['properties'][PROP_TWITTER_ACCOUNT] ) )
                        $aInfo['wikidata']['IDs']['twitter']    = $aRetVal['properties'][PROP_TWITTER_ACCOUNT]['values'][0]['value'];

                    /************************************************************/
                    /* Channels                                                 */
                    /************************************************************/

                    if ( isset( $aRetVal['properties'][PROP_YOUTUBE_CHANNEL_ID] ) )
                    {
                        $aValues = $aRetVal['properties'][PROP_YOUTUBE_CHANNEL_ID]['values'];
                        foreach ( $aValues as $xValue )
                            $aInfo['wikidata']['youtube-channels'][] = $xValue['value'];
                    }
                }   /* if ( is_array( $aRetVal['properties'] ) && ... ) */
            }

            {   /* Allmusic ========================================================================== */
                $aInfo['allmusic'   ]['id'          ] = null;
            }

            {   /* iTunes ============================================================================ */
                $aInfo['itunes'     ]['id'          ] = null;
            }

            {   /* Discogs =========================================================================== */
                $aInfo['discogs'    ]['id'          ] = null;
            }

            {   /* Deezer ============================================================================ */
                $aInfo['deezer'     ]['id'          ] = null;
            }

            {   /* Spotify =========================================================================== */
                $aInfo['spotify'    ]['id'          ] = null;
            }
        }   /* if ( is_array( $aRetVal = $oWiki->getEntity( $szEntityID ) ) ) */

        if ( ! empty( $a ) )
        {
            /* ============================== */

            if ( isset( $a['allmusic-url'] ) )
                $aInfo['allmusic']['url'] = $a['allmusic-url'];

            if ( isset( $a['allmusic-similar-artists'] ) )
            {
                foreach( $a['allmusic-similar-artists'] as $key => $x )
                {
                    $aInfo['allmusic']['similar'][] = array( 'name' => $x['allmusic-name'],
                                                             'url'  => $x['allmusic-url' ] );
                }
            }

            /* ============================== */

            if ( isset( $a['deezer-artist-id'] ) )
                $aInfo['deezer']['id'] = $a['deezer-artist-id'];

            if ( isset( $a['deezer-artist-url'] ) )
                $aInfo['deezer']['url'] = $a['deezer-artist-url'];

            if ( isset( $a['deezer-artist-picture'] ) )
                $aInfo['deezer']['picture'] = $a['deezer-artist-picture'];

            if ( isset( $a['deezer-artist-top-tracks'] ) )
                $aInfo['deezer']['top-tracks'] = $a['deezer-artist-top-tracks'];

            if ( isset( $a['deezer-artist-related-artists'] ) )
            {
                foreach( $a['deezer-artist-related-artists'] as $key => $x )
                {
                    $aInfo['deezer']['similar'][] = array( 'id'         => $x['id'      ],
                                                           'name'       => $x['name'    ],
                                                           'url'        => $x['url'     ],
                                                           'picture'    => $x['picture' ] );
                }
            }


            /*
                'deezer-artist-top-tracks-url' => string 'https://api.deezer.com/artist/12002184/top?limit=50' (length=51)
                'deezer-artist-fans' => int 17
            */


            /* ============================== */

            if ( isset( $a['spotify-artist-id'] ) )
                $aInfo['spotify']['id'] = $a['spotify-artist-id'];

            if ( isset( $a['spotify-artist-url'] ) )
                $aInfo['spotify']['url'] = $a['spotify-artist-url'];

            if ( isset( $a['spotify-artist-picture'] ) )
                $aInfo['spotify']['picture'] = $a['spotify-artist-picture'];

            if ( isset( $a['spotify-artist-top-tracks'] ) )
                $aInfo['spotify']['top-tracks'] = $a['spotify-artist-top-tracks'];

            if ( isset( $a['spotify-artist-related-artists'] ) )
            {
                foreach( $a['spotify-artist-related-artists'] as $key => $x )
                {
                    $aInfo['spotify']['similar'][] = array( 'id'        => $x['id'      ],
                                                            'name'      => $x['name'    ],
                                                            'url'       => $x['url'     ],
                                                            'picture'   => $x['picture' ] );
                }
            }


            /*
                'spotify-artist-popularity' => int 59
                'spotify-artist-fans' => int 91921
                'spotify-artist-genres' => string 'album rock, art rock, blues-rock, brill building pop, british blues, british folk, british invasion, bubblegum pop, classic funk rock, classic rock, folk, folk rock, glam rock, mellow gold, protopunk, psychedelic rock, rock, roots rock, singer-songwriter, soft rock, traditional folk' (length=283)
            */
        }   /* if ( ! empty( $a ) ) */

        //var_dump( $this );
        end:
        return ( $aInfo );
    }   /* End of MusicGroup.getInfo() ================================================ */
    /* ================================================================================ */


    public function searchArtistEntity( $szArtist,$szLang = 'en' ) : string
    /*-------------------------------------------------------------------*/
    {
        $szRetVal = '';
        static $oWiki = null;

        if ( is_null( $oWiki ) )
            $oWiki = new Wikipedia();

        $aPossibleResults = $oWiki->searchEntities( V::STR_stripAccents( $szArtist ),30 /* Maximum number of results */,$szLang );

        if ( is_array( $aPossibleResults ) && is_array( $aPossibleResults['results'] ) && count( $aPossibleResults['results'] ) > 0 )
        {
            foreach( $aPossibleResults['results'] as $aResult )
            {
                if ( $this->isArtist( $aResult ) )
                {
                    $szRetVal = $aResult['id'];
                    break;
                }
            }   /* foreach( $aPossibleResults['results'] as $aResult ) */
        }   /* if ( is_array( $aPossibleResults ) && ... ) */

        return ( $szRetVal );
    }   /* End of MusicGroup.searchArtistEntity() ===================================== */
    /* ================================================================================ */


    public function getArtistFileNameEx( $szArtist,&$szCompiled = null )
    /*----------------------------------------------------------------*/
    {
        static $iPrime = 4481;

        $szCompiled = $this->compile( $szArtist );
        $szHexa     = v::STR_hexa( $szCompiled );
        $iSum       = v::STR_Ascii2( $szHexa );
        $szFolder   = v::STR_padl( $iSum % $iPrime,5,'0' );

        $szFile = "/music-db/artists/{$szFolder}/{$szHexa}.artist";

        return ( $szFile );
    }   /* End of MusicGroup.getArtistFileNameEx() ==================================== */
    /* ================================================================================ */


    public function compile( $szStr )
    /*-----------------------------*/
    {
        // Ici, l'expression régulière devrait aussi transformer toute ponctuation!!!
        $szStr = preg_replace( '/ *?\(Feat\..*?\)/si'   ,
                               ''                       ,
                               str_ireplace( array( ' & '  ,' avec ',' with ',' the ' ),
                                             array( ' and ',' and ' ,' and ' ,''      ),
                                             $szStr ) );

        return ( V::STR_phonetique( $szStr ) . '-' . V::STR_SoundexFr( $szStr ) );
    }   /* End of MusicGroup.compile() ================================================ */
    /* ================================================================================ */


    protected function isArtist( $aResult ) : bool
    /*------------------------------------------*/
    {
        if ( isset( $aResult['description'] ) )
        {
            if     ( V::STR_iPos( $aResult['description'],'singer'          ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],' band'           ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'band '           ) !== -1 )
                return ( true );
            elseif ( trim( $aResult['description'] ) === 'band'             )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'composer'        ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],' group'          ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'guitarist'       ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'keyboardist'     ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'rapper'          ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'musical duo'     ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'musician'        ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'music artist'    ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'pianist'         ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],' pop duo'        ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'quartet'         ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'recording artist') !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'record producer' ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'singer'          ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],'songwriter'      ) !== -1 )
                return ( true );
            elseif ( V::STR_iPos( $aResult['description'],' supergroup'     ) !== -1 )
                return ( true );
        }   /* if ( isset( $aResult['description'] ) ) */

        return ( false );
    }   /* End of MusicGroup.isArtist() =============================================== */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN TEMPLATES\n" );

        return ( $aRetVal );
    }   /* End of MusicGroup.templates() ============================================== */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n" );

        return ( $aRetVal );
    }   /* End of MusicGroup.substitutions() ========================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of MusicGroup.speak() ================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of MusicGroup.sing() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__construct
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
    }   /* End of MusicGroup.__destruct() ============================================= */
    /* ================================================================================ */

}   /* End of class MusicGroup ======================================================== */
/* ==================================================================================== */


class Musician extends MusicGroup
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    }   /* End of Musician.__construct() ============================================== */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN TEMPLATES\n" );

        return ( $aRetVal );
    }   /* End of Musician.templates() ================================================ */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n" );

        return ( $aRetVal );
    }   /* End of Musician.substitutions() ============================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Musician.speak() ==================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Musician.sing() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__construct
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
    }   /* End of Musician.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class Musician ========================================================== */
/* ==================================================================================== */
