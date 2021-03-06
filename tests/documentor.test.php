<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  documentor.test.php *}
    {*purpose               Script that tests the documentor class and each
                            TRQL Labs class (minus few exceptions. *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.trql.fm[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 25-02-2021 22:18 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 25-02-2021 22:18 *}
        {*v 2.0.0001 *}
        {*desc              1)   Original creation
        *}
    *}

    *}}} */

    /** {{*documentor()=

        Basic test of the documentor class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/documentor.test.php
        *}

        c:\wamp64\bin\php\php7.0.10\php documentor.test.php

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli           as v;
use \trql\documentor\Documentor     as Documentor;

set_time_limit( 0 );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

spl_autoload_register(
    function ( $szClass )
    {
        $aParts = explode('\\',$szClass );
        $szFile = 'd:/websites/snippet-center/trql.' . end( $aParts ) . '.class.php';
        if ( is_file( $szFile ) )
            require_once( $szFile );
        //else
            //var_dump( $szFile );
    } );

if ( false )
{
    $o = new Documentor();

    $o->document();
    $o->addInfo( 'Documentation updated' );

    $o->backup( $forced = false );
    //$o->addInfo( 'Backup performed' );

    var_dump( $o->lastInfo );
}

if ( true )
{
    $oDoc = new Documentor();
    //var_dump( $oDoc->self['family'] );

    $noTest[] = 'backgroundprocess';
    $noTest[] = '3dmodel';
    $noTest[] = 'bankaccount';
    $noTest[] = 'class';
    $noTest[] = 'cursor';
    $noTest[] = 'documentor';
    $noTest[] = 'french';
    $noTest[] = 'mail';
    $noTest[] = 'mother';
    $noTest[] = 'paradeigma';
    $noTest[] = 'personororganization';
    $noTest[] = 'pulse';
    $noTest[] = 'uikey';
    $noTest[] = 'vaesoli';
    $noTest[] = 'version';
    $noTest[] = 'websitegenerator';
    $noTest[] = 'zip';

    // Excluded because causes problems: should look for the reason of the problems
    $noTest[] = 'browser';
    $noTest[] = 'footnotes';
    $noTest[] = 'ledger';
    $noTest[] = 'mercator';
    $noTest[] = 'tazieff';

    $i = 0;

    foreach( $oDoc->self['family'] as $szFile )
    {
        if ( preg_match('/trql\.(?P<class>.*?)\.class\.php/i',$szFile,$aMatches ) )
        {
            $szClass = strtolower( $aMatches['class'] );

            if ( ! in_array( $szClass,$noTest ) )
            {
                $szClass = '\\trql\\' . strtolower( $aMatches['class'] ) . '\\' . $aMatches['class'];

                /* Adapt to restart at a givne class */
                //if ( strtolower( $szClass ) > '\trql\comicissue' )
                //if ( strtolower( $szClass ) > '\trql\healthplannetwork' )
                //if ( strtolower( $szClass ) > '\trql\movieseries' )
                //if ( strtolower( $szClass ) > '\trql\readaction' )
                //if ( strtolower( $szClass ) > '\trql\radioclip' )
                if ( strtolower( $szClass ) > '\trql\travelagency' )
                {
                    var_dump( ++$i . ': ' . $szClass );
                    flush();

                    $o = new $szClass();
                    $o->document();

                    $o = null;
                    unset( $o );

                    //if ( $i % 97 === 0 )
                    //    usleep( 2000000 );
                    //ob_flush();
                    //var_dump( $o->lastInfo );
                }
            }
        }
    }
}

end:
echo "\n\n",__LINE__," ... end of the script\n";
?>
