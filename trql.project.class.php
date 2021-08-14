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
    {*file                  trql.project.class.php *}
    {*purpose               Collaborative enterprise (potentially individual but typically
                            collaborative), frequently involving research or design,
                            planned to achieve a particular aim. Use properties from
                            Organization,  subOrganization/parentOrganization to indicate
                            project sub-structures. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 19-01-21 20:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Adding Documents extraction
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\schema;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use trql\schema\organization\Organization   as Organization;
use \trql\XML\XML                           as XML;
use \trql\businesscase\BusinessCase         as BusinessCase;
use \trql\schema\Person                     as Person;
use \trql\quitus\Budget                     as Budget;
use \trql\quitus\Sprint                     as Sprint;
use \trql\schema\DigitalDocument            as DigitalDocument;
use \trql\user\User                         as User;
use \ReflectionClass                        as RF;
use \trql\html\Form                         as Form;
use \trql\html\Fieldset                     as Fieldset;
use \trql\html\Formset                      as Formset;
use \trql\html\Input                        as Input;
use \trql\quitus\Portfolio                  as Portfolio;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

if ( ! defined( 'BUSINESSCASE_CLASS_VERSION' ) )
    require_once( 'trql.businesscase.class.php' );

if ( ! defined( 'SPRINT_CLASS_VERSION' ) )
    require_once( 'trql.sprint.class.php' );

if ( ! defined( 'DIGITALDOCUMENT_CLASS_VERSION' ) )
    require_once( 'trql.digitaldocument.class.php' );

if ( ! defined( 'USER_CLASS_VERSION' ) )
    require_once( 'trql.user.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

if ( ! defined( 'PORTFOLIO_CLASS_VERSION' ) )
    require_once( 'trql.portfolio.class.php' );


defined( 'PROJECT_CLASS_VERSION'    ) or define( 'PROJECT_CLASS_VERSION'    ,'0.1' );
defined( 'ASPIRATION_CLASS_VERSION' ) or define( 'ASPIRATION_CLASS_VERSION' ,'0.1' );

/* ==================================================================================== */
/** {{*class Project=

    {*desc

        Collaborative enterprise (potentially individual but typically
        collaborative), frequently involving research or design, planned to
        achieve a particular aim. Use properties from Organization,
        subOrganization/parentOrganization to indicate project sub-structures.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Project[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

    *}}
 */
/* ==================================================================================== */
class Project extends Organization
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q170584';        /* {*property   $wikidataId                     (string)            Collaborative enterprise, frequently involving research
                                                                                                                                        or design, that is carefully planned to achieve a
                                                                                                                                        particular aim *} */
    public      $oParentPortfolio               = null;             /* {*property   $oParentPortfolio               (Portfolio)         The portfolio this project belongs to. *} */
    public      $portfolioId                    = null;             /* {*property   $portfolioId                    (string)            Parent Portfolio ID. *} */
    public      $oBusinessCase                  = null;             /* {*property   $oBusinessCase                  (BusinessCase)      Reasoning for initiating a project or task, presented in
                                                                                                                                        a well-structured written document, but may also come in
                                                                                                                                        the form of a short verbal agreement or presentation
                                                                                                                                        (wikidataId: Q1896170) *} */
    public      $szCodeName                     = null;             /* {*property   $szCodeName                     (string)            Code name of the Project. *} */
    public      $oLeader                        = null;             /* {*property   $oLeader                        (Person)            Leader of the Project (othen the Project Manager). *} */
    public      $aStakeholders                  = null;             /* {*property   $aStakeholders                  (array)             Array of Persons. *} */
    public      $aMeetings                      = null;             /* {*property   $aMeetings                      (array)             Array of meetings held in this Aspiration. *} */
    public      $aSprints                       = null;             /* {*property   $aSprints                       (array)             Array of sprints ([c]trql.sprint.class.php[/c]). *} */
    public      $aScope                         = null;             /* {*property   $aScope                         (array)             Array of items included in the scope; other which are excluded from the code. *} */
    public      $aDeliverables                  = null;             /* {*property   $aDeliverables                  (array)             Array of expected deliverables ([c]trq.deliverable.class.php[/c]). *} */
    public      $aDocuments                     = null;             /* {*property   $aDocuments                     (array)             Array of documents ([c]trq.document.class.php[/c]). *} */
    public      $aInDependencies                = null;             /* {*property   $aInDependencies                (array)             Array of projects that must deliver an output for THIS project to be able to go ahead *} */
    public      $aOutDependencies               = null;             /* {*property   $aOutDependencies               (array)             Array of projects that are expecting THIS project to deliver an output to be able to go ahead *} */
    public      $aDraft                         = null;             /* {*property   $aDraft                         (array)             Array of short draft messages *} */
    public      $szPhase                        = null;             /* {*property   $szPhase                        (string)            Enumeration: bubble, to-start, started, done (used in Kanban column) *} */
    public      $szStatus                       = null;             /* {*property   $szStatus                       (string)            Enumeration: running, on-hold, abandonned, completed *} */
    public      $szStorage                      = null;             /* {*property   $szStorage                      (string)            File in which the Project maintains its state (all project properties) *} */
    public      $oBudget                        = null;             /* {*property   $oBudget                        (Budget)            Budget of the project *} */
    public      $endDate                        = null;             /* {*property   $endDate                        (Date|DateTime)     The end date and time of the item (in ISO 8601 date format). *} */
    public      $startDate                      = null;             /* {*property   $startDate                      (Date|DateTime)     The start date and time of the item (in ISO 8601 date format). *} */
    public      $szGroups                       = null;             /* {*property   $szGroups                       (string)            ';' separated list of groups whose member can have access to the Project. *} */
    public      $szMailto                       = 'mailto:';        /* {*property   $szMailto                       (string)            The page that should be used to send a mail. If value is 'mailto:', then the local
                                                                                                                                        email facility will be used *} */
    public      $ref                            = null;             /* {*property   $ref                            (string)            Identifies a unique object. It differs from @var.identifier in the sense that the latter
                                                                                                                                        serves internal purposes while @var.ref is more public reference, something that the global
                                                                                                                                        system uses *} */
    public      $backColor                      = null;             /* {*property   $backColor                      (string)            The background color that must be used when displaying this project in a kanban or taskboard *} */
    public      $foreColor                      = null;             /* {*property   $foreColor                      (string)            The foreground color that must be used when displaying this project in a kanban or taskboard *} */

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

        //if ( is_array( $this->self['family'] ) )
        //{
        //    var_dump( $this->self['family'] );
        //    $this->die('BOUM');
        //}

        $tStart         = microtime( true );

        // La classe "Business Case" n'est pas encore utilisée.
        // On ne la charge donc pas d'emblée. On verra plus tard
        // comment faire.
        //$this->oBusinessCase    = new BusinessCase();
        $this->oLeader          = new Person();
        //$this->oBudget          = new Budget();

        //var_dump( "Business Case, Leader and Budget created in " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );

        //var_dump( $this );
        //$this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of Project.__construct() =============================================== */
    /* ================================================================================ */


    // Résout des variables du style $szCodeName
    public function resolveVars( $szExpr )
    /*----------------------------------*/
    {
        $szRetVal = $szExpr;

        //var_dump( $szExpr );

        if ( preg_match_all( '/&?\$([[:word:]]*)/si',$szExpr,$aMatches,PREG_PATTERN_ORDER ) )
        {
            //var_dump( $aMatches[0] );

            foreach( $aMatches[0] as $szMatch )
            {
                $szProperty = substr( $szMatch,1 );
                $szRetVal   = str_replace( $szMatch,$this->$szProperty,$szRetVal );
            }   /* foreach( $aMatches[0] as $szMatch ) */

        }   /* if ( preg_match_all( '/&?\$([[:word:]]*)/si',$szExpr,$aMatches,PREG_PATTERN_ORDER ) ) */

        return ( $szRetVal );
    }   /* End of Project.resolveVars() =============================================== */
    /* ================================================================================ */


    // Afin d'éviter de perdre du temps lors de la création de l'objet, on
    // charge les classes dont on a éventuellement besoin plus tard, ICI!
    protected function loadClassesIfNotFound()
    /*--------------------------------------*/
    {
        if ( ! class_exists( 'Budget') )
        {
            if ( ! defined( 'BUDGET_CLASS_VERSION' ) )
                require_once( 'trql.budget.class.php' );

            $this->oBudget = new Budget();
            $this->oBudget->noFamily();

        }   /* if ( ! class_exists( 'Budget') ) */

        if ( ! class_exists( 'Person') )
        {
            if ( ! defined( 'PERSON_CLASS_VERSION' ) )
                require_once( 'trql.person.class.php' );

            $this->oLeader = new Person();

        }   /* if ( ! class_exists( 'Person') ) */
    }   /* End of Project.loadClassesIfNotFound() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*load( $szFile )=

        Load a project

        {*params
            $szFile         (string)            File to load
        *}

        {*return
            (bool)      [c]true[/c] if $szFile loaded successfully; [c]false[/c] if not
        *}

        *}}
    */
    /* ================================================================================ */
    public function load( $szFile ): bool
    /*---------------------------------*/
    {
        $bRetVal = false;

        end:
        return ( $bRetVal );
    }   /* End of Project.load() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save( $szFile )=

        Saves a project to a file

        {*params
            $szFile         (string)        The file the project must be saved to
        *}

        {*return
            (bool)      [c]true[/c] if $szFile successfully saved; [c]false[/c] otherwise
        *}

        *}}
    */
    /* ================================================================================ */
    public function save( $szFile ): bool
    /*---------------------------------*/
    {
        $bRetVal = false;

        if ( ! empty( $szXML = $this->__toXML() ) )
        {
            $bRetVal = vaesoli::FIL_StrToFile( $szXML,$szFile );
        }   /* if ( ! empty( $szXML = $this->__toXML() ) ) */

        end:
        return ( $bRetVal );
    }   /* End of Project.save() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders the Project in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML(): string
    /*-----------------------------*/
    {
        static $oXML = null;
        $szRetVal = null;


        if ( is_null( $oXML ) )
            $oXML = new XML();

        $oDom                       = new \DOMDocument( '1.0' );

        $oDom->preserveWhiteSpace   = true;
        $oDom->formatOutput         = true;

        if ( $oDom->loadXML( $oXML->__toXML( $this ) ) )
            $szRetVal = $oDom->saveXML();

        end:
        return ( $szRetVal );
    }   /* End of Project.__toXML() =================================================== */
    /* ================================================================================ */


    public function WhoAmI()
    /*--------------------*/
    {
        return ( $this->self['name'] );
    }


    public function __call( $szMethod,$args )
    /*-------------------------------------*/
    {
        switch ( strtolower( trim( $szMethod ) ) )
        {
            case 'whoami'   :   return ( $this->self['name'] );
            default         :   echo "Unknown method " . $szMethod . '()';
                                die;
        }
    }


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
    }   /* End of Project.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Project =========================================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class Aspiration=

    {*desc

        Extends the Project class, which is not supposed to be used (use
        Aspiration instead). Collaborative enterprise (potentially individual
        but typically collaborative), frequently involving research or design,
        planned to achieve a particular aim. Use properties from Organization,
        subOrganization/parentOrganization to indicate project sub-structures.

    *}

    *}}

 */
/* ==================================================================================== */
class Aspiration extends Project
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q170584';        /* {*property   $wikidataId                     (string)            Collaborative enterprise, frequently involving research
                                                                                                                                        or design, that is carefully planned to achieve a
                                                                                                                                        particular aim *} */

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
    }   /* End of Aspiration.__construct() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*load( $szFile )=

        Load an Aspiration

        {*params
            $szFile         (string)            File to load
        *}

        {*return
            (bool)      [c]true[/c] if $szFile loaded successfully; [c]false[/c] if not
        *}

        *}}
    */
    /* ================================================================================ */
    public function load( $szFile ): bool
    /*---------------------------------*/
    {
        $bRetVal        = false;
        $szCacheFile    = $szFile . '.hash';

        $this->loadClassesIfNotFound();

        if ( false && $this->remembering && vaesoli::FIL_File1OlderThanFile2( $szCacheFile,$szFile ) )
        {
            $tStart     = microtime( true );
            $o          = vaesoli::FIL_getHashFile( $szCacheFile );

            $reflect    = new RF( $this );
            $aProps     = $reflect->getProperties( \ReflectionProperty::IS_PUBLIC      |
                                                   \ReflectionProperty::IS_PROTECTED   |
                                                   \ReflectionProperty::IS_PRIVATE );

            foreach ( $aProps as $oProperty )
            {
                $szName = $oProperty->name;

                if ( property_exists( $this,$szName) )
                    $this->$szName = $o->$szName;
                else
                {
                    var_dump( $szName . ": UNKNOWN PROPERTY" );
                    die();
                }
            }   /* foreach ( $aProps as $oProperty ) */

            //var_dump( "Aspiration loaded in " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );
            $bRetVal = true;
            goto end;
        }
        elseif ( is_file( $szFile ) )
        {
            //var_dump( $szFile . ' exists' );
            //var_dump( $szFile );

            $oDom = new \DOMDocument( '1.0' );

            if ( $oDom->load( $szFile ) )
            {
                $bRetVal = true;

                $this->szStorage            = $szFile;

                $this->identifier           =            trim( $oDom->documentElement->getAttribute( 'identifier'   ) );
                $this->ref                  =            trim( $oDom->documentElement->getAttribute( 'ref'          ) );
                $this->startDate            = strtotime( trim( $oDom->documentElement->getAttribute( 'startDate'    ) ) );
                $this->endDate              = strtotime( trim( $oDom->documentElement->getAttribute( 'endDate'      ) ) );
                $this->szPriority           =            trim( $oDom->documentElement->getAttribute( 'priority'     ) );
                $this->szPhase              =            trim( $oDom->documentElement->getAttribute( 'kanban-phase' ) );
                $this->szStatus             =            trim( $oDom->documentElement->getAttribute( 'status'       ) );
                $this->oBudget->value       =    (float) trim( $oDom->documentElement->getAttribute( 'budget'       ) );
                $this->oBudget->currency    =            trim( $oDom->documentElement->getAttribute( 'currency'     ) );
                $this->szGroups             =            trim( $oDom->documentElement->getAttribute( 'groups'       ) );
                $this->portfolioId          =            trim( $oDom->documentElement->getAttribute( 'portfolio-id' ) );

                //var_dump( $this->oBudget );
                //die();

                $oXPath = new \DOMXPath( $oDom );

                if ( ( $o = $oXPath->query( 'Name' ) ) && ( $o->length > 0 ) )
                    $this->name = $o->item(0)->nodeValue;

                if ( ( $o = $oXPath->query( 'CodeName' ) ) && ( $o->length > 0 ) )
                    $this->szCodeName = $o->item(0)->nodeValue;

                if ( ( $o = $oXPath->query( 'Mailto' ) ) && ( $o->length > 0 ) )
                    $this->szMailto = $o->item(0)->nodeValue;

                {   /* Leader ============================================================= */
                    if ( ( $o = $oXPath->query( 'Leader' ) ) && ( $o->length > 0 ) )
                    {
                        $oLeaderNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'FirstName',$oLeaderNode ) ) && ( $o->length > 0 ) )
                            $this->oLeader->givenName = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'LastName',$oLeaderNode ) ) && ( $o->length > 0 ) )
                            $this->oLeader->familyName = $o->item(0)->nodeValue;
                    }   /* if ( ( $o = $oXPath->query( 'Leader' ) ) && ( $o->length > 0 ) ) */
                }   /* Leader ============================================================= */

                {   /* Team =============================================================== */
                    if ( ( $o = $oXPath->query( 'Team' ) ) && ( $o->length > 0 ) )
                    {
                        $oTeamNode = $o->item(0);

                        if ( ( $oMembers = $oXPath->query( 'Member',$oTeamNode ) ) && ( $oMembers->length > 0 ) )
                        {
                            foreach( $oMembers as $oPersonNode )
                            {
                                $oPerson            = new Person();

                                $szName             = $oPersonNode->nodeValue;
                                $aNameParts         = $oPerson->splitName( $szName );

                                if ( count( $aNameParts ) >= 2 )
                                {
                                    $oPerson->givenName     = $aNameParts['firstname'];
                                    $oPerson->familyName    = $aNameParts['lastname'];
                                }

                                $oPerson->email     = $oPersonNode->getAttribute( 'email' );
                                $oPerson->jobTitle  = $oPersonNode->getAttribute( 'role'  );
                                $oPerson->telephone = $oPersonNode->getAttribute( 'phone' );

                                $this->member[]     = $oPerson;
                                //var_dump( $oPerson );
                            }   /* foreach( $oMembers as $oPersonNode ) */
                        }   /* if ( ( $oMembers = $oXPath->query( 'Member',$oTeamNode ) ) && ( $oMembers->length > 0 ) ) */
                    }   /* if ( ( $o = $oXPath->query( 'Team' ) ) && ( $o->length > 0 ) ) */
                }   /* Team =============================================================== */

                {   /* Stakeholders ======================================================= */
                    if ( ( $o = $oXPath->query( 'Stakeholders' ) ) && ( $o->length > 0 ) )
                    {
                        //var_dump( $o );

                        $oStakeholderNode = $o->item(0);

                        if ( ( $oPersons = $oXPath->query( 'Person',$oStakeholderNode ) ) && ( $oPersons->length > 0 ) )
                        {
                            //var_dump( $oPersons );

                            foreach( $oPersons as $oPersonNode )
                            {
                                $oPerson = new Person();

                                $oPerson->email = $oPersonNode->getAttribute( 'email' );

                                if ( ( $o = $oXPath->query( 'FirstName',$oPersonNode ) ) && ( $o->length > 0 ) )
                                    $oPerson->givenName     = $o->item(0)->nodeValue;

                                if ( ( $o = $oXPath->query( 'LastName' ,$oPersonNode ) ) && ( $o->length > 0 ) )
                                    $oPerson->familyName    = $o->item(0)->nodeValue;


                                $this->aStakeholders[] = $oPerson;
                                //var_dump( $oPersonNode );
                            }
                        }
                    }   /* if ( ( $o = $oXPath->query( 'Stakeholders' ) ) && ( $o->length > 0 ) ) */
                }   /* Stakeholders ======================================================= */

                {   /* Deliverables ======================================================= */
                    if ( ( $o = $oXPath->query( 'Deliverables' ) ) && ( $o->length > 0 ) )
                    {
                        $oDeliverablesNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'Item',$oDeliverablesNode ) ) && ( $o->length > 0 ) )
                        {
                            foreach( $o as $oNode )
                                $this->aDeliverables[] = $oNode->nodeValue;
                        }
                    }   /* if ( ( $o = $oXPath->query( 'Deliverables' ) ) && ( $o->length > 0 ) ) */
                }   /* Deliverables ======================================================= */

                {   /* Scope ============================================================== */
                    if ( ( $o = $oXPath->query( 'Scope' ) ) && ( $o->length > 0 ) )
                    {
                        $oScopeNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'In',$oScopeNode ) ) && ( $o->length > 0 ) )
                        {
                            foreach( $o as $oNode )
                                $this->aScope[] = $oNode->nodeValue;
                        }
                    }   /* if ( ( $o = $oXPath->query( 'Scope' ) ) && ( $o->length > 0 ) ) */
                }   /* Scope ============================================================== */

                {   /* Draft ============================================================== */
                    if ( ( $o = $oXPath->query( 'Draft' ) ) && ( $o->length > 0 ) )
                    {
                        $oScopeNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'Message',$oScopeNode ) ) && ( $o->length > 0 ) )
                        {
                            foreach( $o as $oNode )
                                $this->aDraft[] = $oNode->nodeValue;
                        }
                    }   /* if ( ( $o = $oXPath->query( 'Draft' ) ) && ( $o->length > 0 ) ) */
                }   /* Draft ============================================================== */

                {   /* Dependencies ======================================================= */
                    if ( ( $o = $oXPath->query( 'Dependencies' ) ) && ( $o->length > 0 ) )
                    {
                        $oDependenciesNode = $o->item(0);

                        if ( ( $oIn = $oXPath->query( 'In',$oDependenciesNode ) ) && ( $oIn->length > 0 ) )
                            foreach( $oIn as $oNode )
                                $this->aInDependencies[] = $oNode->nodeValue;

                        if ( ( $oOut = $oXPath->query( 'Out',$oDependenciesNode ) ) && ( $oOut->length > 0 ) )
                            foreach( $oOut as $oNode )
                                $this->aOutDependencies[] = $oNode->nodeValue;

                    }   /* if ( ( $o = $oXPath->query( 'Dependencies' ) ) && ( $o->length > 0 ) ) */

                    //var_dump( $this->aInDependencies );
                    //var_dump( $this->aOutDependencies );
                }   /* Dependencies ======================================================= */

                {   /* Documents ========================================================== */
                    if ( ( $o = $oXPath->query( 'Documents' ) ) && ( $o->length > 0 ) )
                    {
                        var_dump( "Il y a des docs" );
                        $oDocumentsNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'Item',$oDocumentsNode ) ) && ( $o->length > 0 ) )
                        {
                            // ICI, ON DEVRAIT CRÉER DES OBJETS DIGITALDOCUMENT
                            foreach( $o as $oNode )
                                $this->aDocuments[] = $oNode->nodeValue;
                        }   /* if ( ( $o = $oXPath->query( 'Item',$oDocumentsNode ) ) && ( $o->length > 0 ) ) */
                    }   /* if ( ( $o = $oXPath->query( 'Documents' ) ) && ( $o->length > 0 ) ) */
                }   /* Documents ========================================================== */

                {   /* Display ============================================================ */
                    if ( ( $o = $oXPath->query( 'Display' ) ) && ( $o->length > 0 ) )
                    {
                        $oDisplayNode    = $o->item(0);

                        $this->backColor = $oDisplayNode->getAttribute( 'backColor' );
                        $this->foreColor = $oDisplayNode->getAttribute( 'foreColor' );
                    }   /* if ( ( $o = $oXPath->query( 'Display' ) ) && ( $o->length > 0 ) ) */
                }   /* Display ============================================================ */


                vaesoli::FIL_saveHashFile( $szCacheFile,$this );

                //var_dump( $this->aStakeholders );
                //die();
            }
            else
            {
                die( "CANNOT LOAD" );
            }
        }   /* if ( is_file( $szFile ) ) */

        if ( $bRetVal )
            $this->oParentPortfolio = $this->findPortfolio();

        end:
        return ( $bRetVal );
    }   /* End of Aspiration.load() =================================================== */
    /* ================================================================================ */


    public function findPortfolio( $szID = null )
    /*-----------------------------------------*/
    {
        $oRetVal = null;

        if ( ! is_string( $szID ) )
            $szID = $this->portfolioId;

        if ( is_string( $szID ) && ! empty( $szID ) )
        {
            $szDir = vaesoli::FIL_RealPath( vaesoli::FIL_ResolveRoot( dirname( $this->szStorage ) ) );

            if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( vaesoli::FIL_RealPath( $szDir . '/*.portfolio.xml' ) ) ) && count( $aFiles ) > 0 )
            {
                $oPortfolio = new Portfolio();

                foreach( $aFiles as $szFile )
                {
                    $oPortfolio->load( $szFile );

                    if ( $oPortfolio->identifier === $szID )
                    {
                        $oRetVal = $oPortfolio;
                        break;
                    }   /* if ( $oAspiration->identifier === $szID ) */
                }   /* foreach( $aFiles as $szFile ) */
            }   /* if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( vaesoli::FIL_RealPath( $szDir . '/*.portfolio.xml' ) ) ) && count( $aFiles ) > 0 ) */
        }   /* if ( is_string( $szID ) && ! empty( $szID ) ) */

        return ( $oRetVal );
    }   /* End of Aspiration.findPortfolio() ========================================== */
    /* ================================================================================ */


    public function render( $szMode = 'HTML',$aSections = null ):string
    /*---------------------------------------------------------------*/
    {
        $szRetVal = '';

        switch ( strtoupper( trim( $szMode ) ) )
        {
            case 'HTML' :   if ( is_null( $aSections ) || ( is_array( $aSections ) && $aSections['all'] ?? true ) )
                            {
                                $szRetVal = $this->__toHTML();
                            }
                            else
                            {
                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['general'      ] ?? true ) ) )
                                    $szRetVal .= $this->renderGeneral();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['stakeholders' ] ?? true ) ) )
                                    $szRetVal .= $this->renderStakeholders();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['team'         ] ?? true ) ) )
                                    $szRetVal .= $this->renderTeam();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['scope'        ] ?? true ) ) )
                                    $szRetVal .= $this->renderScope();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['deliverables' ] ?? true ) ) )
                                    $szRetVal .= $this->renderDeliverables();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['dependencies' ] ?? true ) ) )
                                    $szRetVal .= $this->renderDependencies();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['sprints'      ] ?? true ) ) )
                                    $szRetVal .= $this->renderSprints();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['reports'      ] ?? true ) ) )
                                    $szRetVal .= $this->renderReports();

                                if ( is_null( $aSections ) || ( is_array( $aSections ) && ( $aSections['draft'        ] ?? true ) ) )
                                    $szRetVal .= $this->renderDrafts();

                            }
                            break;
            case 'XML'  :   $szRetVal = $this->__toXML();
                            break;
        }   /* switch ( strtoupper( trim( $szMode ) ) ) */

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.render() ================================================= */
    /* ================================================================================ */


    /* Temporary */
    protected function renderReports()
    /*------------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle reports">Reports</h2>';

        $szRetVal .= "<p>Not yet implemented. Stay tuned!</p>\n";

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderReports() ========================================== */
    /* ================================================================================ */


    /* Temporary */
    protected function renderSprints()
    /*------------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle sprints">Sprints</h2>';

        if ( is_array( $this->aSprints ) && count( $this->aSprints ) > 0 )
        {
            $szRetVal .= "<ol>\n";
            $szRoot    = vaesoli::FIL_RealPath( $_SERVER['DOCUMENT_ROOT'] . '/../' );

            // Il faut transformer un nom de fichier physique en
            // un nom de fichier logique

            foreach ( $this->aSprints as $oSprint )
            {
                //var_dump( $oSprint );
                //die();
                $szFile = str_replace( array( $szRoot,'\\' ),
                                       array( '/../' ,'/'  ),
                                       $oSprint->szStorage );
                $szRetVal .= "<li><a href=\"/sprint/?storage={$szFile}\">Sprint {$oSprint->szSprintNo}: {$oSprint->name}</a> (" . date( 'd-m-Y',$oSprint->startDate ) . ' &#8211; ' . date( 'd-m-Y',$oSprint->endDate ) . ")</li>\n";
            }   /* foreach ( $this->aSprints as $oSprint ) */

            $szRetVal .= "</ol>\n";
        }   /* if ( is_array( $this->aSprints ) && count( $this->aSprints ) > 0 ) */
        else
        {
            $szRetVal .= "<p class=\"warning\">No Sprint found</p>\n";
        }

        $szRetVal .= '<h3 class="sectionTitle newSprint">New Sprint</h3>';

        $oSprint = new Sprint();
        $szRetVal .= $oSprint->__toForm();

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderSprints() ========================================== */
    /* ================================================================================ */


    /* Temporary */
    protected function renderTeam()
    /*---------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle team">Team</h2>';

        if ( is_array( $this->member ) && count( $this->member ) > 0 )
        {
            $szRetVal .= "<ul>\n";

            foreach( $this->member as $oPerson )
            {
                if ( $oPerson instanceof Person )
                    $szRetVal .= "<li>{$oPerson->givenName} {$oPerson->familyName}</li>\n";
            }

            $szRetVal .= "</ul>\n";

        }   /* if ( is_array( $this->member ) && count( $this->member ) > 0 ) */

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderTeam() ============================================= */
    /* ================================================================================ */


    /* Temporary */
    protected function renderDependencies()
    /*-----------------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle dependencies">Dependencies</h2>';

        if ( is_array( $this->aInDependencies ) && count( $this->aInDependencies ) > 0 )
        {
            $szRetVal = '<h3 class="sectionTitle inDependencies">«In» Dependencies</h2>';

            $szRetVal .= "<ul>\n";

            foreach( $this->aInDependencies as $szDependency )
            {
                $szRetVal .= "<li>{$szDependency}</li>\n";
            }

            $szRetVal .= "</ul>\n";

        }   /* if ( is_array( $this->aInDependencies ) && count( $this->aInDependencies ) > 0 ) */

        if ( is_array( $this->aOutDependencies ) && count( $this->aOutDependencies ) > 0 )
        {
            $szRetVal = '<h3 class="sectionTitle outDependencies">«Out» Dependencies</h2>';

            $szRetVal .= "<ul>\n";

            foreach( $this->aOutDependencies as $szDependency )
            {
                $szRetVal .= "<li>{$szDependency}</li>\n";
            }

            $szRetVal .= "</ul>\n";

        }   /* if ( is_array( $this->aOutDependencies ) && count( $this->aOutDependencies ) > 0 ) */

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderDependencies() ===================================== */
    /* ================================================================================ */


    /* Temporary */
    protected function renderGeneral()
    /*------------------------------*/
    {
        $szRetVal   = '<h2 class="sectionTitle general">General</h2>';
        $szRetVal  .= $this->__toHTML();

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderGeneral() ========================================== */
    /* ================================================================================ */


    /* Temporary */
    protected function renderStakeholders()
    /*-----------------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle stakeholders">Stakeholders</h2>';

        if ( is_array( $this->aStakeholders ) && count( $this->aStakeholders ) > 0 )
        {
            //var_dump( $this->szMailto );
            //die();
            //var_dump( $_SESSION['user'] );

            /* On permet d'envoyer directement un message à l'un des stakeholders.
               On va chercher qui est loggué pour indiquer le From du message */

            if ( isset( $_SESSION['user'] ) )
                $aUser = (array) $_SESSION['user'];
            else
                $szFrom = '';

            if ( isset( $aUser['email'] ) )
                $szFrom = $aUser['email'];

            $szRetVal .= "<ul>\n";
            foreach( $this->aStakeholders as $oPerson )
            {
                if ( $oPerson instanceof Person )
                {
                    //var_dump( $oPerson );
                    if     ( empty( $oPerson->email ) )
                        $szRetVal .= "<li vocab=\"https://schema.org/\" typeof=\"Person\"><span property=\"givenName\">{$oPerson->givenName}</span> <span property=\"familyName\">{$oPerson->familyName}</span></li>\n";
                    elseif ( empty( $this->szMailto ) || strtolower( trim( $this->szMailto ) ) === 'mailto:' )
                        $szRetVal .= "<li vocab=\"https://schema.org/\" typeof=\"Person\"><a href=\"mailto:{$oPerson->email}\"><span property=\"givenName\">{$oPerson->givenName}</span> <span property=\"familyName\">{$oPerson->familyName}</span> (<span property=\"email\">{$oPerson->email}</span>)</a></li>\n";
                    else
                        $szRetVal .= "<li vocab=\"https://schema.org/\" typeof=\"Person\"><a href=\"{$this->szMailto}?from={$szFrom}&to={$oPerson->email}&subject=Aspiration '{$this->szCodeName}' (ID: {$this->identifier})&body=\"><span property=\"givenName\">{$oPerson->givenName}</span> <span property=\"familyName\">{$oPerson->familyName}</span> (<span property=\"email\">{$oPerson->email}</span>)</a></li>\n";
                }
            }   /* foreach( $this->aStakeholders as $oPerson ) */
            $szRetVal .= "</ul>\n";
        }   /* if ( is_array( $this->aStakeholders ) && count( $this->aStakeholders ) > 0 ) */

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderStakeholders() ===================================== */
    /* ================================================================================ */


    /* Temporary */
    protected function renderDeliverables()
    /*-----------------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle deliverables">Deliverables</h2>';

        if ( is_array( $this->aDeliverables ) && count( $this->aDeliverables ) > 0 )
        {
            $szRetVal .= "<ul>\n";
            foreach( $this->aDeliverables as $szItem )
            {
                $szRetVal .= "<li>{$szItem}</li>\n";
            }   /* foreach( $this->aDeliverables as $szItem ) */
            $szRetVal .= "</ul>\n";
        }   /* if ( is_array( $this->aDeliverables ) && count( $this->aDeliverables ) > 0 ) */

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderDeliverables() ===================================== */
    /* ================================================================================ */


    /* Temporary */
    protected function renderScope()
    /*----------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle scope">Scope</h2>';

        if ( is_array( $this->aScope ) && count( $this->aScope ) > 0 )
        {
            $szRetVal .= "<ul>\n";
            foreach( $this->aScope as $szItem )
            {
                $szRetVal .= "<li>{$szItem}</li>\n";
            }   /* foreach( $this->aScope as $szItem ) */
            $szRetVal .= "</ul>\n";
        }   /* if ( is_array( $this->aScope ) && count( $this->aScope ) > 0 ) */

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderScope() ============================================ */
    /* ================================================================================ */


    /* Temporary */
    protected function renderDrafts()
    /*-----------------------------*/
    {
        $szRetVal = '<h2 class="sectionTitle draft">Draft</h2>';

        if ( is_array( $this->aDraft ) && count( $this->aDraft ) > 0 )
        {
            $szRetVal .= "<ul>\n";
            foreach( $this->aDraft as $szItem )
            {
                $szRetVal .= "<li>{$szItem}</li>\n";
            }   /* foreach( $this->aDraft as $szItem ) */
            $szRetVal .= "</ul>\n";
        }   /* if ( is_array( $this->aDraft ) && count( $this->aDraft ) > 0 ) */

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.renderDrafts() =========================================== */
    /* ================================================================================ */


    public function findSprints()
    /*-------------------------*/
    {
        //var_dump( $this->szStorage );
        $szMask = preg_replace('/\.xml\z/si','',$this->szStorage ) . '.sprint.*.xml';
        //var_dump( $szMask );
        //die();

        $tStart = microtime( true );
        if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( $szMask ) ) && count( $aFiles ) > 0 )
        {
            // 'FIL_aFilesEx() en 0.00061sec'
            //var_dump( "FIL_aFilesEx() en " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );

            foreach( $aFiles as $szFile )
            {
                $tStart = microtime( true );
                $oSprint = new Sprint();
                // 'Création Sprint en 0.0713sec'
                // var_dump( "Création Sprint en " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );

                $tStart = microtime( true );
                if ( $oSprint->load( $szFile ) )
                {
                    // 'Load d'un Sprint en 0.96934sec' ... cr'est ici qu'on perd du temps!!!
                    // var_dump( "Load d'un Sprint en " . round( ( $tEnd = microtime( true ) ) - $tStart,5 ) . 'sec' );

                    $this->aSprints[] = $oSprint;
                }
            }   /* foreach( $aFiles as $szFile ) */
            // Bon, ici, je devrais loader chaque sprint
            //var_dump( $aFiles );
        }   /* if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( $szMask ) ) && count( $aFiles ) > 0 ) */
    }   /* End of Aspiration.findSprints() ============================================ */
    /* ================================================================================ */


    public function identity():string
    /*------------------------------*/
    {
        $szRetVal = '';

        $szRetVal = "<span class=\"identity\"><b class=\"name\">{$this->name}</b> (<span class=\"codeName\">{$this->szCodeName}</span><span class=\"ref\"> &#8212; {$this->ref}</span><span class=\"identifier\"> &#8212; {$this->identifier}</span>)<br />" .
                    date( 'd-m-Y',$this->startDate ) . " &#8213; " .
                    date( 'd-m-Y',$this->endDate   ) . "</span>";

        //$szRetVal = "<span class=\"identity\">Hello</span>";
        //var_dump( $this );
        //die();

        return ( $szRetVal );
    }   /* End of Aspiration.identity() =============================================== */
    /* ================================================================================ */


    public function __toHTML():string
    /*-----------------------------*/
    {
        $szRetVal = '';

        $szRetVal .= "<p>ID: {$this->identifier}</p>\n";
        $szRetVal .= "<p>Ref: {$this->ref}</p>\n";
        $szRetVal .= "<p>Name: {$this->name}</p>\n";
        $szRetVal .= "<p>CodeName: {$this->szCodeName}</p>\n";
        $szRetVal .= "<p>Budget: {$this->oBudget->value} {$this->oBudget->currency}</p>\n";

        if ( isset( $this->oLeader ) )
            $szRetVal .= "<p>Led by: {$this->oLeader->givenName} {$this->oLeader->familyName}</p>\n";
        //var_dump( $this );
        $szRetVal .= "<p>Dates: " . date( 'd-m-Y',$this->startDate ) . "&#8212;" . date( 'd-m-Y',$this->endDate ) . "</p>\n";

        end:
        return ( $szRetVal );
    }   /* End of Aspiration.__toHTML() =============================================== */
    /* ================================================================================ */


    public function __toString():string
    /*-------------------------------*/
    {
        return ( $this->__toHTML() );
    }   /* End of Aspiration.__toString() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toForm()=

        Returns the object as a form

        {*params
        *}

        {*return
            (string)        HTML Code corresponding to a form of the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toForm(): string
    /*------------------------------*/
    {
        $oForm                      = new Form();
        $oForm->szClass             = $this->szClass;
        $oForm->szOnSubmit          = $this->szOnSubmit;

        $oForm->settings['withBR']  = false;

        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'Aspiration';

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'ID'                                                                                ,
                                                   'type'           =>  'txt'                                                                               ,
                                                   'label'          =>  'ID'                                                                                ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'ID of the aspiration. Leave it empty for a new aspiration.'                        ,
                                                   'required'       =>  false                                                                               ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  $this->identifier                                                                   ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'ref'                                                                               ,
                                                   'type'           =>  'txt'                                                                               ,
                                                   'label'          =>  'Ref.'                                                                              ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Public identification number of the aspiration.'                                   ,
                                                   'required'       =>  true                                                                                ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  $this->ref                                                                          ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Name'                                                                              ,
                                                   'type'           =>  'txt'                                                                               ,
                                                   'label'          =>  'Name'                                                                              ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Enter a name for this aspiration'                                                  ,
                                                   'required'       =>  true                                                                                ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  $this->name                                                                         ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'CodeName'                                                                          ,
                                                   'type'           =>  'txt'                                                                               ,
                                                   'label'          =>  'Code Name'                                                                         ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Enter a code name for this aspiration'                                             ,
                                                   'required'       =>  true                                                                                ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  $this->szCodeName                                                                   ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Phase'                                                                             ,
                                                   'type'           =>  'cbo'                                                                               ,
                                                   'label'          =>  'Phase'                                                                             ,
                                                   'options'        =>  '<option value="bubble">Bubble</option><option value="tostart">To Start</option>'   .
                                                                        '<option value="started">Started</option><option value="done">Done</option>'        ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Enter the Kanban phase of the Aspiration'                                          ,
                                                   'required'       =>  true                                                                                ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  strtolower( trim( $this->szPhase ) )                                                ,
                                                 ) ) );

                /*
                $oFieldset->add( new Input( array( 'name'           =>  'Agent'                                         ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Assignee'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Who this task is assigned to'                  ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->agent                                    ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Type'                                          ,
                                                   'type'           =>  'cbo'                                           ,
                                                   'label'          =>  'Task type'                                     ,
                                                   'options'        =>  '<option value="change">Change</option><option value="defect">Defect</option>',
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter the type of task'                        ,
                                                   'maxlength'      =>  3                                               ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'step'           =>  1                                               ,
                                                   'style'          =>  'max-width:11em;width:11em;min-width:11em;'     ,
                                                   'value'          =>  'change'                                        ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Priority'                                      ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Priority'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter the priority of this task'               ,
                                                   'maxlength'      =>  3                                               ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'step'           =>  1                                               ,
                                                   'style'          =>  'max-width:5em;width:5em;min-width:5em;'        ,
                                                   'value'          =>  $this->priority                                 ,
                                                 ) ) );

                // Créé : commentaire JUSTE pour le UTF-8
                $oFieldset->add( new Input( array( 'name'           =>  'Credits'                                       ,
                                                   'type'           =>  'num'                                           ,
                                                   'label'          =>  'Credits'                                       ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Credits of the task'                           ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'step'           =>  1                                               ,
                                                   'style'          =>  'max-width:5em;width:5em;min-width:5em;'        ,
                                                   'value'          =>  $this->credits                                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Due'                                           ,
                                                   'type'           =>  'dat'                                           ,
                                                   'label'          =>  'Due date'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Date the task is due'                          ,
                                                   'required'       =>  false                                           ,
                                                   'help'           =>  false                                           ,
                                                   'style'          =>  'max-width:11em;width:11em;min-width:11em;'     ,
                                                   'value'          =>  ''                                              ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Description'                               ,
                                                   'type'           =>  'edt'                                       ,
                                                   'label'          =>  'Description'                               ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Enter a name for this task'                ,
                                                   'required'       =>  true                                        ,
                                                   'delete'         =>  true                                        ,
                                                   'help'           =>  false                                       ,
                                                   'rows'           =>  8                                           ,
                                                   'style'          =>  'resize:vertical;'                          ,
                                                   'value'          =>  trim( $this->description )                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Late'                                      ,
                                                   'type'           =>  'chk'                                       ,
                                                   'label'          =>  'Late'                                      ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Is this task late?'                        ,
                                                   'required'       =>  false                                       ,
                                                   'style'          =>  'max-width:3em;width:3em;min-width:3em;'    ,
                                                   'value'          =>  false                                       ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Attention'                                 ,
                                                   'type'           =>  'chk'                                       ,
                                                   'label'          =>  'Attention'                                 ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Requires attention?'                       ,
                                                   'required'       =>  false                                       ,
                                                   'style'          =>  'max-width:3em;width:3em;min-width:3em;'    ,
                                                   'value'          =>  false                                       ,
                                                 ) ) );
                */

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                    ,
                                                   'type'           =>  'cmd'                                       ,
                                                   'class'          =>  'shadow'                                    ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Click to submit the values of a new task'  ,
                                                   'value'          =>  'Create'                                    ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $oForm->add( $oFieldset );

        }   /* Create a fieldset and add the field set to the form */

        return ( (string) $oForm );
    }   /* End of Aspiration.__toForm() =============================================== */
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
    }   /* End of Aspiration.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class Aspiration ======================================================== */
/* ==================================================================================== */
