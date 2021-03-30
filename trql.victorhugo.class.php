<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.victorhugo.class.php *}
    {*purpose               Multi-purpose treatments of the French language. Search of 
                            synonyms, of antonymns, flexed forms of lemmas, etc.

                            [c]VictorHugo[/c] examines a sentence in search of "patterns"
                            that  correspond to a notion expressed in  a specific 
                            "context"  (e.g. %Mercator.city('Brussels')%' ... where 
                            'Mercator' is  the context and 'city' is the notion'.

                            [c]VictorHugo[/c] renders results in the French language.
                            Such results can then be translated thanks to 
                            [c]Polylogos[/c]. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 22/08/2020 - 10:20:02 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate auto *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 22-08-20 10:17 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Adding Documentor-oriented comments
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\victorhugo;


use \trql\quitus\Mother                 as Mother;
use \trql\context\Context               as Context;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\substitution\Substitution     as Substitution;
use \trql\utility\Utility               as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'SUBSTITUTION_CLASS_VERSION' ) )
    require_once( 'trql.substitution.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'VICTORHUGO_CLASS_VERSION' ) or define( 'VICTORHUGO_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class VictorHugo=

    {*desc

        Multi-purpose treatments of the French language. Search of Synonyms, of
        antonymns, flexed forms of lemmas, etc.

        VictorHugo examines a sentence in search of "patterns" that correspond to
        a notion expressed in a specific "context" (e.g. %Mercator.city('Brussels')%'
        ... where 'Mercator' is the context and 'city' is the notion'.

        victorHugo renders results in the French language. Such results can then be
        translated thanks to [c]Polylogos[/c].

    *}

    {*Seealso [c]Voltaire[/c],[c]Polylogos[/c]  *}

    *}}
 */
/* ================================================================================== */
class VictorHugo extends Utility
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    protected   $aSubstitutions         = null;                     /* {*property   $aSubstitutions             (array)                 An array of substitutions *} */
    protected   $aContexts              = null;                     /* {*property   $aContexts                  (array)                 An array of contexts that influence how VictorHugo responds *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = null;                     /* {*property   $wikidataId                 (string)                Wikidata ID. No equivalent. *} */


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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );
        //$this->setHome(  ); /* Set the home folder of the class and create it if it does not exist */

        return ( $this );
    }   /* End of VictorHugo.__construct() ============================================ */
    /* ================================================================================ */


    /* Get/Set */
    public function setContexts( $aContexts = null )
    /*-------------------------------------------*/
    {
        $aOld = $this->aContexts;

        if ( is_array( $aContexts ) )
        {
            $this->aContexts = $aContexts;
        }   /* if ( is_array( $aContexts) ) */

        return ( $aOld );

    }   /* End of VictorHugo.setContexts() ============================================ */
    /* ================================================================================ */


    /* Je n'ai pas encore défini ce qu'un contexte peut être !!! Les seuls contextes définis sont ceux utilisés par Castafiore */
    public function addContext( $oContext )
    /*-----------------------------------*/
    {
        $this->aContexts[] = $oContext;

        return ( $this );
    }   /* End of VictorHugo.addContext() ============================================= */
    /* ================================================================================ */


    public function clearContexts()
    /*---------------------------*/
    {
        $this->aContexts = null;

        return ( $this );
    }   /* End of VictorHugo.clearContexts() ========================================== */
    /* ================================================================================ */


    public function hasContexts()
    /*-------------------------*/
    {
        return ( is_array( $this->aContexts ) && count( $this->aContexts ) > 0 );
    }   /* End of VictorHugo.hasContexts() ============================================ */
    /* ================================================================================ */


    public function addSubstitution( $szPattern,$szReplacement )
    /*--------------------------------------------------------*/
    {
        $this->aSubstitutions['patterns'      ][] = $szPattern;
        $this->aSubstitutions['replacements'  ][] = $szReplacement;

        return ( $this );
    }   /* End of VictorHugo.addSubstitution() ======================================== */
    /* ================================================================================ */


    /* Get/Set */
    public function setSubstitutions( $aSubsts = null )
    /*-----------------------------------------------*/
    {
        $aOld = $this->aSubstitutions;

        if ( is_array( $aSubsts ) )
        {
            $this->aSubstitutions = $aSubsts;
        }   /* if ( is_array( $aSubsts ) ) */

        return ( $aOld );

    }   /* End of VictorHugo.setSubstitutions() ======================================= */
    /* ================================================================================ */


    public function clearSubstitutions()
    /*--------------------------------*/
    {
        $this->aSubstitutions = null;

        return ( $this );
    }   /* End of VictorHugo.clearSubstitutions() ===================================== */
    /* ================================================================================ */


    public function substitute( $szStr )
    /*--------------------------------*/
    {
        return ( preg_replace( $this->aSubstitutions['patterns'],$this->aSubstitutions['replacements'],$szStr ) );
        //return ( str_replace( $this->aSubstitutions['patterns'],$this->aSubstitutions['replacements'],$szStr ) );
    }   /* End of VictorHugo.substitute() ============================================= */
    /* ================================================================================ */


    public function templates()
    /*-----------------------*/
    {
        $aRetVal = null;
        //var_dump( $this->self );
        //var_dump( $this->szHome );
        //var_dump( $oContext->originator->self );
        //var_dump( $oContext->originator->szHome );

        $oContext = func_get_arg( 0 );

        /*  On doit charger des templates par défaut correspondant à un contexte donné.

            szHome          = là où les données (et donc aussi les templates) sont stockées
            self['class']   = la classe qui est à l'origine de la demande (e.g. "trql\anaximandre\Anaximandre")
        */

        if ( ! is_dir( $szDir = vaesoli::FIL_RealPath( $this->szHome . '/' . $oContext->originator->self['class'] ) ) )
            vaesoli::FIL_MkDir( $szDir );

        if ( is_file( $szFile = vaesoli::FIL_RealPath( $szDir . "/templates.{$oContext->verb}.txt" ) ) )
        {
            //echo __LINE__," ... SHOULD LOAD DEFAULT TEMPLATES FROM {$szFile}\n";
            $aRetVal = $this->loadSentences( $szFile );
        }
        //else
        //{
        //    echo __LINE__," ... DEFAULT TEMPLATES NOT FOUND: {$szFile}\n";
        //}

        //die( "===========================Dying at line " . __LINE__ . " of " . __METHOD__ . "()\n" );

        end:
        return ( $aRetVal );
    }   /* End of VictorHugo.templates() ============================================== */
    /* ================================================================================ */


    public function speak()
    /*-------------------*/
    {
        $szRetVal = null;

        if ( $this->hasContexts() )
        {
            /*  Pour l'instant, je ne peux gérer qu'UN SEUL contexte ! C'est donc TOUJOURS
                le premier contexte qu'on trouve qui est considéré !!!

                Si, par exemple, on voulait dire la météo dans le contexte de TRQL Radio,
                il serait intéressant qu'un deuxième contexte soit considéré : un conetxte
                radio par exemple !!! Voici un exemple d'une template qui mélange les
                contextes : "Vous écoutez %radio% ! %demain%, la température à %city% sera de %temperature-max%° celsius maximum."

                On en déduit que les templates doivent se charger au départ d'UN et UN SEUL
                contexte "maître" tandis que les substitutions doivent être effectuées sur
                base de TOUS les contextes présents !

            */

            /* Faudrait essayer une syntaxe "functional programming" */
            foreach( $this->aContexts as $oContext )
            {
                // $this->loadTemplates->loadSubstitutions( $oContext );

            }

            // À la fin ... this.run( 'text' );




            if ( ( $oContext = $this->aContexts[0] ) instanceof Context )
            {
                //echo __LINE__," ... ON A UN CONTEXTE CORRECT\n";

                /* Let's try to load the templates of the originator requestor, and if NO template
                   returned, maybe we have our own templates we can use ! */
                if ( ! is_array( $aTemplates = $oContext->originator->templates( $oContext ) ) )
                {
                    //echo __LINE__," ... LOADING DEFAULT TEMPLATES\n";
                    $aTemplates = $this->templates( $oContext );
                }   /* if ( ! is_array( $aTemplates ) ) */


                //$szRetVal = $aTemplates[array_rand( $aTemplates )];
                $szRetVal = $aTemplates[1];

                /* Do we finally have templates ? If yes, then we can try loading the substitutions */
                if ( is_array( $aTemplates ) )
                {
                    $aSubstitutions = $oContext->originator->substitutions( $oContext );

                    if ( ! is_array( $aSubstitutions ) )
                    {
                        //echo __LINE__," ... PAS DE SUBSTITUTIONS. DEVRAIT CHARGER DES SUBSTITUTIONS PAR DEFAUT.\n";
                    }

                    if ( is_array( $aSubstitutions ) )
                    {
                        $oSubst = new Substitution();
                        $oSubst->load( $aSubstitutions );
                        $szRetVal = $oSubst->run( $szRetVal );
                    }
                }
                else
                {
                    goto end;                                       /* Go to the end of the method */
                }
            }
            else
            {
                echo __LINE__," ... ON A UN MAUVAIS CONTEXTE\n";
                //var_dump( get_class( $oContext ) );
            }
        }

        //echo __LINE__," ... ON EST DANS VICTORHUGO.SPEAK(). PAS CERTAIN DU RETOUR OU DES PARAMETRES!!!\n";
        //die( "Dying at line " . __LINE__ . " in " . __METHOD__ . "()" );

        end:
        return ( $szRetVal );

    }   /* End of VictorHugo.speak() ================================================== */
    /* ================================================================================ */


    /* Documentation: https://inferkit.com/docs/generation-api */
    public function generate( $szText,$iLength = 250 )
    /*---------------------------------------------*/
    {
        // TOUS LES DETAILS DE L'APPEL DEVRAIENT ETRE CACHES !!!

        $aHeaders   = array( "Accept: application/json"         ,
                             "Content-Type: application/json"   ,
                             "Authorization: Bearer 4ec4d19e-fb87-4c5f-99a4-64da032df1ab" );

        $szURL      = "https://api.inferkit.com/v1/models/standard/";

        $aFields = array( 'prompt'  => array( 'text' => $szText ),
                          'length'  => $iLength );

        var_dump( json_encode( $aFields ) );
        die();


        try
        {
            $ch = curl_init();

            curl_setopt( $ch, CURLOPT_URL,$szURL );
            //curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST,false );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER,false );
            curl_setopt( $ch, CURLOPT_HTTPHEADER,$aHeaders );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true );

            // Je devrais encore vérifier si $aFields est null ou non
            // Si pas null, alors, c'est un POST avec des fields
            // qui se trouvent dans aFields

            if ( ! is_null( $aFields ) )
            {
                /* Example of aFields
                $aFields = array( 'foo'     =>'bar'     ,
                                  'baz'     =>'boom'    ,
                                  'cow'     =>'milk'    ,
                                  'php'     =>'hypertext processor');
                */

                curl_setopt( $ch,CURLOPT_POST,true );
                curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode( $aFields ) );
            }

            if ( ( $xResult = curl_exec( $ch ) ) === false )
            {
                $szErrMsg = curl_error( $ch );

                //var_dump( 'PROBLEM' );

                if ( error_reporting() != 0 )
                {
                    var_dump( $xResult );
                    var_dump( $szErrMsg );
                }
            }   /* if ( ( $xResult = curl_exec( $ch ) ) === false ) */
            else    /* Else of ... if ( ( $xResult = curl_exec( $ch ) ) === false ) */
            {
                echo "\nseems OK\n";
                var_dump( $xResult );

                //if ( error_reporting() != 0 )
                //    var_dump( $xResult );

                if ( $oJSON = json_decode( $xResult ) )
                {
                    //var_dump( $oJSON );

                    if ( isset( $oJSON->errorMessage ) )
                    {
                        $szErrMsg   = $oJSON->errorMessage;
                        $oJSON      = null;

                        if ( error_reporting() != 0 )
                            var_dump( $szErrMsg );
                    }   /* if ( isset( $oJSON->errorMessage ) ) */
                }   /* if ( $oJSON = json_decode( $xResult ) ) */
                elseif ( error_reporting() != 0 )
                {
                    var_dump( 'Cannot create the JSON object' );
                    var_dump( 'URL: ' . $szURL );
                    var_dump( $oJSON );
                }
            }   /* End of ... Else of ... if ( ( $xResult = curl_exec( $ch ) ) === false ) */
        }
        catch ( Exception $e )
        {
            $szErrMsg = $e->getMessage();
            var_dump( $szErrMsg );
        }

        if ( $ch )
            curl_close( $ch );

        return ( $oJSON );
    }   /* End of VictorHugo.generate() =============================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
    }   /* End of VictorHugo.__destruct() ============================================= */
    /* ================================================================================ */

}   /* End of class VictorHugo ======================================================== */
/* ==================================================================================== */
?>