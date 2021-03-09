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
    {*file                  trql.newsarticle.class.php *}
    {*purpose               A NewsArticle is an article whose content reports news, or
                            provides background context and supporting materials for
                            understanding the news.A more detailed overview of
                            schema.org News markup is also available. *}
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
        {*mdate 23-01-21 11:31 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  First intensive use in OpenPMO
                            2)  First official use of vaesoli class konwn as "v"
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\newsarticle;

use \trql\vaesoli\Vaesoli           as v;
use \trql\article\Article           as Article;
use \trql\form\Form                 as Form;
use \trql\fieldset\Fieldset         as Fieldset;
use \trql\formset\Formset           as Formset;
use \trql\input\Input               as Input;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ARTICLE_CLASS_VERSION' ) )
    require_once( 'trql.article.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );


defined( 'NEWSARTICLE_CLASS_VERSION' ) or define( 'NEWSARTICLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class NewsArticle=

    {*desc

        A NewsArticle is an article whose content reports news, or provides
        background context and supporting materials for understanding the news. A
        more detailed overview of schema.org News markup is also available.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/NewsArticle[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:40.
    *}

    *}}

 */
/* ==================================================================================== */
class NewsArticle extends Article
/*-----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $dateline                       = null;             /* {*property   $dateline                       (string)                        A dateline is a brief piece of text included in news articles that
                                                                                                                                                    describes where and when the story was written or filed though the
                                                                                                                                                    date is often omitted. Sometimes only a placename is
                                                                                                                                                    provided.Structured representations of dateline-related information
                                                                                                                                                    can also be expressed more explicitly using locationCreated (which
                                                                                                                                                    represents where a work was created e.g. where a news report was
                                                                                                                                                    written). For location depicted or described in the content, use
                                                                                                                                                    contentLocation.Dateline summaries are oriented more towards human
                                                                                                                                                    readers than towards automated processing, and can vary substantially.
                                                                                                                                                    Some examples: "BEIRUT, Lebanon, June 2.", "Paris, France", "December
                                                                                                                                                    19, 2017 11:43AM Reporting from Washington", "Beijing/Moscow", "QUEZON
                                                                                                                                                    CITY, Philippines". *} */
    public      $printColumn                    = null;             /* {*property   $printColumn                    (string)                        The number of the column in which the NewsArticle appears in the print
                                                                                                                                                    edition. *} */
    public      $printEdition                   = null;             /* {*property   $printEdition                   (string)                        The edition of the print product in which the NewsArticle appears. *} */
    public      $printPage                      = null;             /* {*property   $printPage                      (string)                        If this NewsArticle appears in print, this field indicates the name of
                                                                                                                                                    the page on which the article is found. Please note that this field is
                                                                                                                                                    intended for the exact page name (e.g. A5, B18). *} */
    public      $printSection                   = null;             /* {*property   $printSection                   (string)                        If this NewsArticle appears in print, this field indicates the print
                                                                                                                                                    section in which the article appeared. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q5707594';       /* {*property   $wikidataId                     (string)                        Article that is published in news media *} */
    public      $oForm                          = null;             /* {*property   $oForm                          (Form)                          Form that is generated via [c]__toForm()[/c] *} */
    public      $szStorage                      = null;             /* {*property   $szStorage                      (string)                        The folder where news articles are stored. This property is used in
                                                                                                                                                    the [c]browse()[/c] method AND NOT in the [c]save()[/c] method. *} */


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
    }   /* End of NewsArticle.__construct() =========================================== */
    /* ================================================================================ */


    public function __toString() : string
    /*---------------------------------*/
    {

    }   /* End of NewsArticle.__toString() ============================================ */
    /* ================================================================================ */


    public function __toForm() : string
    /*-------------------------------*/
    {
        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'News';

            $this->die( __METHOD__ . "() has never been tested! Sorry for the inconvenience" );

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'Title'                                                 ,
                                                   'type'           =>  'txt'                                                   ,
                                                   'label'          =>  'Title'                                                 ,
                                                   'lang'           =>  'en'                                                    ,
                                                   'tooltip'        =>  'RSS feed - Item Title'                                 ,
                                                   'required'       =>  true                                                    ,
                                                   'delete'         =>  true                                                    ,
                                                   'help'           =>  false                                                   ,
                                                   'value'          =>  ''                                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                                ,
                                                   'type'           =>  'cmd'                                                   ,
                                                   'class'          =>  'shadow'                                                ,
                                                   'lang'           =>  'en'                                                    ,
                                                   'value'          =>  'Submit'                                                ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $this->oForm->add( $oFieldset );

        }   /* Create a fieldset and add the field set to the form */

        return ( $this->oForm->render() );

    }   /* End of NewsArticle.__toForm() ============================================== */
    /* ================================================================================ */


    public function save( $szFile )
    /*---------------------------*/
    {
        $bRetVal = false;

        // https://www.afp.com/communication/iris/Guide_to_AFP_NewsML-G2.html

        $szXML = '';
        $szXML .= '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
        $szXML .= "<newsMessage>\n";
        $szXML .= "  <itemSet>\n";
        $szXML .= "    <newsItem>\n";
        $szXML .= "      <itemMeta>\n";
        $szXML .= "        <firstCreated>" . date( 'c',strtotime( $this->dateCreated   ) ) . "</firstCreated>\n";
        $szXML .= "        <pubDate>"      . date( 'c',strtotime( $this->datePublished ) ) . "</pubDate>\n";
        $szXML .= "      </itemMeta>\n";
        $szXML .= "      <contentMeta>\n";
        $szXML .= "          <creator>\n";
        $szXML .= "              <name><![CDATA[{$this->author->givenName} {$this->author->familyName}]]></name>\n";
        $szXML .= "          </creator>\n";
        // lignes données pour exemple ... $szXML .= "                <keyword>culture</keyword>\n";
        // lignes données pour exemple ... $szXML .= "                <keyword>arts</keyword>\n";
        // lignes données pour exemple ... $szXML .= "                <keyword>fashion</keyword>\n";
        // lignes données pour exemple ... $szXML .= "                <keyword>auction<keyword>\n";
        $szXML .= "      </contentMeta>\n";
        $szXML .= "      <contentSet>\n";
        $szXML .= "        <title><![CDATA[{$this->headline}\n]]></title>\n";
        $szXML .= "        <body><![CDATA[{$this->articleBody}\n]]></body>\n";
        $szXML .= "      </contentSet>\n";
        $szXML .= "    </newsItem>\n";
        $szXML .= "  </itemSet>\n";
        $szXML .= "</newsMessage>\n";

        //var_dump( $this );

        if ( ! is_dir( $szDir = dirname( $szFile ) ) )
            v::FIL_MkDir( $szDir );

        $bRetVal = v::FIL_StrToFile( $szXML,$szFile );

        end:
        return ( $bRetVal );
    }   /* End of NewsArticle.save() ================================================== */
    /* ================================================================================ */


    public function parse( $szFile ) : array
    /*------------------------------------*/
    {
        $aRetVal = array();

        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new \DOMDocument();

        if ( $oDom->load( $szFile ) )
        {
            //var_dump( "Loaded" );

            $oXPath = new \DOMXPath( $oDom );

            $oItems = $oXPath->query( 'itemSet/newsItem' );

            if ( $oItems && $oItems->length > 0 )
            {
                //var_dump( $oItems );

                foreach( $oItems as $oNode )
                {
                    $tCreationDate  = strtotime( $x = $oXPath->query( 'itemMeta/firstCreated'   ,$oNode )->item(0)->nodeValue );
                    $tPubDate       = strtotime( $x = $oXPath->query( 'itemMeta/pubDate'        ,$oNode )->item(0)->nodeValue );
                    $szAuthor       =                 $oXPath->query( 'contentMeta/creator/name',$oNode )->item(0)->nodeValue;
                    $szTitle        =                 $oXPath->query( 'contentSet/title'        ,$oNode )->item(0)->nodeValue;
                    $szBody         =                 $oXPath->query( 'contentSet/body'         ,$oNode )->item(0)->nodeValue;

                    $aRetVal[]      = array( 'headline'       => $szTitle         ,
                                             'author'         => $szAuthor        ,
                                             'dateCreated'    => $tCreationDate   ,
                                             'datePublished'  => $tPubDate        ,
                                             'articleBody'    => $szBody          ,
                                           );
                    //var_dump( $x,$szAuthor,$tCreationDate,$szTitle,$szBody,date('d-m-Y H:i',$tCreationDate ) );
                    //$tCreationDate = strtotime( )
                }   /* foreach( $oItems as $oNode ) */
            }   /* if ( $oItems && $oItems->length > 0 ) */
            /* Voici la tête de la plus simple des News ! 
            <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
            <newsMessage>
              <itemSet>
                <newsItem>
                  <itemMeta>
                    <firstCreated>2021-01-23T11:45:07+00:00</firstCreated>
                    <pubDate>2021-01-23T00:00:00+00:00</pubDate>
                  </itemMeta>
                  <contentMeta>
                      <creator>
                          <name><![CDATA[Patrick Boens]]></name>
                      </creator>
                  </contentMeta>
                  <contentSet>
                    <title><![CDATA[bla bla bla]]</title>
                    <body><![CDATA[bla bla bla]]></body>
                  </contentSet>
                </newsItem>
              </itemSet>
            </newsMessage> 
            */
        }   /* if ( $oDom->load( $szFile ) ) */

        end:
        return ( $aRetVal );
    }   /* End of NewsArticle.parse() ================================================= */
    /* ================================================================================ */


    public function browse( $szFolder = null )
    /*--------------------------------------*/
    {
        $aRetVal = array();
        if ( ! is_null( $szFolder = $szFolder ?? $this->szStorage ) )
        {
            $iThisYear = (int) date( 'Y' );
            $iLastYear = $iThisYear - 1;

            $aNewsOfLastYear = '';
            $aFiles                      = v::FIL_aFilesEx( v::FIL_RealPath( $szFolder . '/' . $iLastYear . '/*.news.xml' ) );
            //var_dump( $aFiles );
            $aFiles = array_merge( $aFiles,v::FIL_aFilesEx( v::FIL_RealPath( $szFolder . '/' . $iThisYear . '/*.news.xml' ) ) );
            //var_dump( $aFiles );

            foreach( $aFiles as $szFile )
            {
                $aRetVal = array_merge( $aRetVal,$this->parse( $szFile ) );
            }
        }
        else
        {
            throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": no FOLDER (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")",EXCEPTION_CODE_INVALID_PARAMETER );
        }

        end:
        return ( $aRetVal );
    }   /* End of NewsArticle.browse() ================================================ */
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
    }   /* End of NewsArticle.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class NewsArticle ======================================================= */
/* ==================================================================================== */