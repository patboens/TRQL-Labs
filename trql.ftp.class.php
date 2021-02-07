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
    {*file                  trql.documentor.class.php *}
    {*purpose               TRQL Labs Classes Documentor *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 16-08-20 19:19 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    {*abstract              The [c]Documentor[/c] class helps document ALL TRQL Labs classes
                            defined in [file]d:\websites\snippet-center\[/file].[br][br]

                            All TRQL classes share a common naming convention:
                            [c]trql.<classname>.class.php[/c]. Because the
                            [c]Documentor[/c] is itself a TRQL Labs class, it documents
                            itself. Because the [c]Documentor[/c] is based on the most
                            basic class, [c]Thing[/c], itself based on[c]Mother[/c], the
                            [c]mother[/c] of all TRQL classes (the foundation of the
                            foundation), we share a common behavior that is consistent
                            across all the classes defined.[br][br]

                            To document all the classes &#8213; meaning &hellip;
                            generating the documentation of each class &#8213; there is
                            little effort:[br][br]

                            [code][br]
                                $o = new Documentor();[br]
                                $o->documentAll();[br]
                            [/code][br][br]

                            There is no need to tell the [c]Documentor[/c] class what
                            must be documented. It goes without saying as it knows it![br][br]

                            Many of the classes of TRQL Labs have been based on the fabulous
                            work available at [url]https://www.schema.org/[/url]. Therefore,
                            it the present documentation is lacky on some parts, please head
                            to schema.org to benefit from additional information.

    *}

    {*todo                  [ol]
                                [li]Document [c]trql.tazieff.class.php[/c][/li]
                                [li]Implement the [c]trql.uikey.class.php[/c] class[/li]
                                [li]Implement the [c]trql.cursor.class.php[/c] class[/li]
                                [li]De même qu'une classe fait son propre backup, il serait
                                utile qu'une classe s'autodocumente. Le résultat de cette
                                documentation devrait être un fichier XML et on peut même
                                envisager que chaque doc soit sauvée dans un .zip pour disposer
                                d'un historique.[/li]
                                [li]Je devrais utiliser les labels ([c]trql.label.class.php[/c])[/li]
                                [li]Create the [c]trql.radio.class.php[/c] which must be based
                                    on [c]trql.radiostation.class.php[/c] AND on
                                    [c]trql-radio.radio.class.php[/c]. This work will be huge
                                    as it will probably imply many associated classes to be
                                    imported as well :playlist, track, ...[/li]
                                [li]When documenting a class, we must create an instance of
                                    the class in order to get the name of all defined
                                    properties, even the one of the parent class. Use
                                    [c]get_class_vars()[/c][/li]
                                [li]When documenting a class, we must create an instance of
                                    the class in order to get the name of the parent class
                                    OR ... we take what "extends" mentions (can also use
                                    [c]get_parent_class()[/c])[/li]
                                [li]Properties of a class must be sorted alphabetically[/li]
                                [li]Methods of a class must be sorted alphabetically[/li]
                                [li]Extract warning and remark from file header and publish[/li]
                            [/ol]
    *}

    {*remark

        Such declarations should be made available in the php.ini file.

        Unfortunately, I don't know why, PHP overwrites these settings
        each time it gets restarted. That's the reason why I have documented
        them in here.

        [code]
            [Date]
            ; Defines the default timezone used by the date functions
            ; http://php.net/date.timezone
            date.timezone ="Europe/Brussels"

            ; http://php.net/date.default-latitude
            date.default_latitude = 50.3852051

            ; http://php.net/date.default-longitude
            date.default_longitude = 4.6582953
        [/code]

        geonames can be invoked with these values:
            [url]http://api.geonames.org/timezone?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]

        geonameId de Lato Sensu Management:
            [url]http://api.geonames.org/findNearby?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]
            [url]http://api.geonames.org/get?geonameId=8520400&username=demo&style=full[/url]

    *}

    {*image                 https://www.trql.fm/images/logos/trql.documentor.jpg *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 19:19 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 23-08-20 15:40 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Additional classes are now (partially) documented
                            2)  Class description + class credits are documented
                            3)  Adding an accountablePerson (Person)
                            4)  Adding an address (PostalAddress)
                            5)  Adding an audience (Audience)
                            6)  Adding an AdministrativeArea.
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\FTP;

use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\thing\Thing                               as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'FTP_CLASS_VERSION' ) or define( 'FTP_CLASS_VERSION','0.1' );



/* ==================================================================================== */
/** {{*class FTP=

    {*desc

        FTP wrapper

    *}

    *}}
 */
/* ==================================================================================== */
class FTP extends Thing
/*--------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;


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
    }   /* End of FTP.__construct() =================================================== */
    /* ================================================================================ */


    public function connectToTRQL()
    /*---------------------------*/
    {
        return( @ftp_connect( '193.105.73.146' ) );
    }   /* End of FTP.connectToTRQL() ================================================= */
    /* ================================================================================ */


    function loginToTRQL( $rID )
    /*------------------------*/
    {
        if ( $bConnected = ftp_login( $rID,'trql.fm','DecemberR7#TFwvj' ) )
        {
            ftp_pasv( $rID,true );

            //ftp_chdir( $rID,$szWatchDogDir = 'websites/vaesoli.org/www/httpdocs/vaesoli/watchdog' );

            //if ( STR_iPos( $szServerDir = ftp_pwd( $rID ),$szWatchDogDir ) != -1 )
            //{
            //    if ( @ftp_put( $rID,basename( $szArchiveFile ),$szArchiveFile,FTP_BINARY ) )
            //    {
            //        echo "<p>'{$szArchiveFile}' sent on server</p>\n";
            //    }
            //}
            //else
            //{
            //    echo "<p>'{$szServerDir}' not found on server</p>\n";
            //}
        }

        return ( $bConnected );
    }

    function closeConnectionToTRQL( $rID )
    /*----------------------------------*/
    {
        ftp_close( $rID );
    }








    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of FTP.__destruct() ============================================= */
    /* ================================================================================ */

}   /* End of class FTP =============================================================== */
/* ==================================================================================== */
?>