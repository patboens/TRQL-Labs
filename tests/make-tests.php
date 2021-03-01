<?php
use \trql\vaesoli\Vaesoli   as v;
use \trql\thing\Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.thing.class.php' );
    
$oThing = new Thing();
$aFiles = $oThing->self['family'];
$szTemplate = v::FIL_FileToStr( __DIR__ . '/template.txt' );
//echo $szTemplate;

$aPatterns['%filename%']        = '%filename%';
$aSubst['%filename%']           = 'WAIT';

$aPatterns['%date(d-m-Y H:i)%'] = '%date(d-m-Y H:i)%';
$aSubst['%date(d-m-Y H:i)%']    = date( 'd-m-Y H:i' );

$aPatterns['%CLASS%']           = '%CLASS%';
$aSubst['%CLASS%']              = 'WAIT';

$aPatterns['%class%']           = '%class%';
$aSubst['%class%']              = 'WAIT';

$aPatterns['%namespace%']       = '%namespace%';
$aSubst['%namespace%']          = 'WAIT';

die( "CHECK THIS SCRIPT BEFORE USING IT! IT CAN BE DANGEROUS IN THAT IT MAY OVERWRITE ALL YOUR TEST FILES!!!" );

foreach( $aFiles as $szFile )
{
    var_dump( $szFile );

    $szFileName             = str_replace( array('trql.','.class.php'),'',basename( $szFile ) );

    $aSubst['%filename%']   = $szFileName;
    $aSubst['%CLASS%']      = strtoupper( $szFileName );
    $aSubst['%class%']      = strtolower( $szFileName );
    $aSubst['%namespace%']  = '\trql\\' . $aSubst['%class%'] . '\\' . ucfirst( $aSubst['%class%'] );

    $szOutput = $szTemplate;
    foreach( $aPatterns as $szKey => $szPattern )
    {
        $szOutput = str_replace( $szPattern,$aSubst[$szKey],$szOutput );
        v::FIL_StrToFile( $szOutput,__DIR__ . '/' . $szFileName . '.test.php' );
    }
}
?>