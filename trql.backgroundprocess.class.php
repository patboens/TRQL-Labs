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
    {*file                  trql.smallAPIGW.class.php *}

    {*purpose               A server that acts as an API front-end, receives API
                            requests, enforces throttling and security policies, passes
                            requests to the back-end service and then passes the
                            response back to the requester. A gateway often includes a
                            transformation engine to orchestrate and modify the
                            requests and responses on the fly. A gateway can also
                            provide functionality such as collecting analytics data
                            and providing caching. The gateway can provide functionality
                            to support authentication, authorization, security, audit
                            and regulatory compliance. *}

    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 06-02-21 10:54 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*remark                A source of inspiration may come from the following Wikipedia
                            page [url]https://en.wikipedia.org/wiki/API_management[/url] *}
    {*warning               THIS CLASS DOES NOT WORK ACCORDING TO OUR EXPECTATIONS *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 06-02-21 10:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\BackgroundProcess;

use \trql\vaesoli\Vaesoli   as v;
use \trql\schema\Thing       as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'BACKGROUNDPROCESS_CLASS_VERSION' ) or define( 'BACKGROUNDPROCESS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BackgroundProcess=

    {*desc

        Utility class to start a process in the background

    *}

    {*credits
        The whole concept is derived from the work of Florian Eckerstorfer
        ([url]https://florian.ec/about/[/url]
    *}

    {*doc [url]https://florian.ec/blog/php-background-processes/[/url] *}


 */
/* ==================================================================================== */
class BackgroundProcess extends Thing
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                        wikidata ID: No equivalent *} */

    private $command;
    private $pid;

    /* ================================================================================ */
    /** {{*__construct( $command )=

        Class constructor

        {*params
            $xHandler           (APIHandler|array)  The API Handler (the one thing that
                                                    really does the job) or an array of
                                                    handlers
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*example
            use trql\BackgroundProcess\BackgroundProcess;

            $process = new BackgroundProcess( 'sleep 5' );
            $process->run();

            echo sprintf( 'Crunching numbers in process %d',$process->getPid() );

            while ( $process->isRunning() )
            {
                echo '.';
                sleep(1);
            }

            echo "\nDone.\n"
        *}


        *}}
    */
    /* ================================================================================ */
    public function __construct( $command )
    /*-----------------------------------*/
    {
        parent::__construct();

        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->command = $command;

        return ( $this );
    }   /* End of BackgroundProcess.__construct() ===================================== */
    /* ================================================================================ */


    public function run( $outputFile = '/dev/null' )
    /*--------------------------------------------*/
    {
        $this->pid = shell_exec( sprintf( '%s > %s 2>&amp;1 &amp; echo $!',$this->command,$outputFile ) );
    }   /* End of BackgroundProcess.run() ============================================= */
    /* ================================================================================ */


    public function isRunning()
    /*-----------------------*/
    {
        try
        {
            $result = shell_exec( sprintf( 'ps %d',$this->pid ) );

            if ( count( preg_split( "/\n/",$result ) ) > 2 )
            {
                return ( true );
            }
        }
        catch( Exception $e )
        {
        }

        return ( false );
    }   /* End of BackgroundProcess.isRunning() ======================================= */
    /* ================================================================================ */


    public function getPid()
    /*--------------------*/
    {
        return ( $this->pid );
    }   /* End of BackgroundProcess.getPid() ========================================== */
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
    }   /* End of BackgroundProcess.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class BackgroundProcess ================================================= */
/* ==================================================================================== */
?>