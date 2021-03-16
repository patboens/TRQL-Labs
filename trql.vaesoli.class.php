<?php
/************************************************************************************** */
/** {{{*fheader
    {*file                  trql.vaesoli.class.php *}
    {*purpose               Substitute to Vaesoli (limited set of functions
                            implemented as methods) *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.trql.fm[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 01/04/2017 - 00:00 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 01/04/2017 *}
        {*v 0.0.0001 *}
        {*desc              The first sources of TRQL Radio were indeed created
                            roughly on 01/04/2017. Then the code has evolved over
                            time to finally be structured in its definitive
                            format (as much as possible) on 05/09/2018
        *}
    *}

    {*chist
        {*mdate 15/07/2019 *}
        {*v 2.0.0001 *}
        {*desc              1)  Documentation of the script
                            2)  New method: DAT_Isvalid()
        *}
    *}

    *}}} */

/************************************************************************************** */
namespace trql\vaesoli;

defined( 'VAESOLI_CLASS_VERSION' ) or define( 'VAESOLI_CLASS_VERSION','0.3' );

if ( ! defined( 'VAESOLI_SLASH' ) )                                 /* If VAESOLI_SLASH not defined */
{
    /* {*define (VAESOLI_SHASH)  Define the value of the slash character in the file system *} */
    switch ( strtoupper( PHP_OS ) )                                 /* In function of the OS */
    {
        case 'WINNT'    :
        case 'WINDOWS'  :
        case 'WIN32'    :
        case 'WIN'      :   /**
                             *  DÃ©finition du slash en fonction du systÃ¨me d'exploitation
                             */
                            define( 'VAESOLI_SLASH','\\' );
                            break;
        case 'AIX'      :
        case 'LINUX'    :
        case 'OS400'    :
        case 'MAC'      :
        default         :   /**
                             *  Définition du slash en fonction du système d'exploitation
                             *  @ignore
                             */
                            define( 'VAESOLI_SLASH','/' );
                            break;
    }   /* switch ( strtoupper( PHP_OS ) ) */
}   /* if ( ! defined( 'VAESOLI_SLASH' ) ) */

class Vaesoli
/*---------*/
{
    public static function COLOR_rgb2hsv( $r,$g = null,$b = null )
    /*----------------------------------------------------------*/
    {
        if ( is_array( $r ) && isset( $r['r'] ) )
        {
            $g = $r['g'];
            $b = $r['b'];
            $r = $r['r'];
        }

        $r = ( $r / 255 );                                              //RGB values = 0 Ã· 255
        $g = ( $g / 255 );
        $b = ( $b / 255 );

        $iMin = min( $r,$g,$b );                                        //Min. value of RGB
        $iMax = max( $r,$g,$b );                                        //Max. value of RGB
        $delta = $iMax - $iMin;                                         //Delta RGB value

        $v = $iMax;

        if ( $delta == 0 )                                              //This is a gray, no chroma...
        {
            $h = $s = 0;                                                //HSV results = 0 Ã· 1
        }
        else                                                            //Chromatic data...
        {
            $s = $delta / $iMax;

            $delta_r = ( ( ( $iMax - $r ) / 6 ) + ( $delta / 2 ) ) / $delta;
            $delta_g = ( ( ( $iMax - $g ) / 6 ) + ( $delta / 2 ) ) / $delta;
            $delta_b = ( ( ( $iMax - $b ) / 6 ) + ( $delta / 2 ) ) / $delta;

            if      ( $r == $iMax ) $h = ( 0 / 3 ) + $delta_b - $delta_g;
            else if ( $g == $iMax ) $h = ( 1 / 3 ) + $delta_r - $delta_b;
            else if ( $b == $iMax ) $h = ( 2 / 3 ) + $delta_g - $delta_r;

            if ( $h < 0 )
                $h += 1;
            if ( $h > 1 )
                $h -= 1;
        }

        return ( array( 'h' => $h,
                        's' => $s,
                        'v' => $v
                       ) );
    }   /* End of vaesoli.COLOR_rgb2hsv() ============================================= */
    /* ================================================================================ */

    public static function WhoAmI()
    /*---------------------------*/
    {
        return ( __FILE__ );
    }   /* End of vaesoli.WhoAmI() ==================================================== */
    /* ================================================================================ */


    public static function COLOR_hsv2rgb( $h,$s = null,$v = null )
    /*----------------------------------------------------------*/
    {
        if ( is_array( $h ) && isset( $h['v'] ) )
        {
            $s = $h['s'];
            $v = $h['v'];
            $h = $h['h'];
        }

        if ( $s == 0 )                       //HSV values = 0 Ã· 1
        {
            $r = $g = $b = $v * 255;
        }   /* if ( $s == 0 ) */
        else
        {
            $h *= 6;

            if ( $h == 6 ) $h = 0;      //H must be < 1

            $var_i = (int) $h;             //Or ... var_i = floor( var_h )
            $var_1 = $v * ( 1 - $s );
            $var_2 = $v * ( 1 - $s * ( $h - $var_i ) );
            $var_3 = $v * ( 1 - $s * ( 1 - ( $h - $var_i ) ) );

            if      ( $var_i == 0 ) { $r = $v     ; $g = $var_3 ; $b = $var_1 ; }
            else if ( $var_i == 1 ) { $r = $var_2 ; $g = $v     ; $b = $var_1 ; }
            else if ( $var_i == 2 ) { $r = $var_1 ; $g = $v     ; $b = $var_3 ; }
            else if ( $var_i == 3 ) { $r = $var_1 ; $g = $var_2 ; $b = $v     ; }
            else if ( $var_i == 4 ) { $r = $var_3 ; $g = $var_1 ; $b = $v     ; }
            else                    { $r = $v     ; $g = $var_1 ; $b = $var_2 ; }

            $r *= 255;                  //RGB results = 0 Ã· 255
            $g *= 255;
            $b *= 255;
        }

        return ( array( 'r' => (int) round( $r,0 ),
                        'g' => (int) round( $g,0 ),
                        'b' => (int) round( $b,0 )
                       ) );
    }   /* End of vaesoli.COLOR_hsv2rgb() ============================================= */
    /* ================================================================================ */


    public static function DAT_aDaysAndMonths( &$aDays,&$aMonths,$szLang = 'fr' )
    /*-------------------------------------------------------------------------*/
    {
        switch ( $szLang )                                              /* Build month and day arrays in function of the language */
        {
            /* -- English --------------------------------------------------------------------------------------------------------- */
            case "en" : $aMonths = array( array( "January"  ,"February" ,"March"    ,"April"    ,"May"      ,"June"  ,
                                                 "July"     ,"August"   ,"September","October"  ,"November" ,"December"),
                                          array( "Jan"      ,"Feb"      ,"Mar"      ,"Apr"      ,"May"      ,"Jun"   ,
                                                 "Jul"      ,"Aug"      ,"Sep"      ,"Oct"      ,"Nov"      ,"Dec" ) );
                        $aDays   = array( array( "Monday"   ,"Tuesday"  ,"Wednesday","Thursday" ,"Friday"   ,"Saturday" ,"Sunday"),
                                          array( "Mo"       ,"Tu"       ,"We"       ,"Th"       ,"Fr"       ,"Sa"       ,"Su"    ) );
                        break;
            /* -- Dutch ----------------------------------------------------------------------------------------------------------- */
            case "nl" : $aMonths = array( array( "Januari"  ,"Februari" ,"Maart"    ,"April"    ,"Mei"      ,"Juni"  ,
                                                 "Juli"     ,"Augustus" ,"September","Oktober"  ,"November" ,"December"),
                                          array( "Janu"     ,"Feb"      ,"Maa"      ,"Apr"      ,"Mei"      ,"Jun"   ,
                                                 "Jul"      ,"Aug"      ,"Sep"      ,"Okt"      ,"Nov"      ,"Dec"     ) );
                        $aDays   = array( array( "Maandag"  ,"Dinsdag"  ,"Woensdag" ,"Donderdag","Vrijdag"  ,"Zaterdag","Zondag"),
                                          array( "Ma"       ,"Di"       ,"Wo"       ,"Do"       ,"Vr"       ,"Za"      ,"Zo"    ) );
                        break;
            /* -- French ---------------------------------------------------------------------------------------------------------- */
            default   : $aMonths = array( array( "Janvier"  ,"FÃ©vrier"  ,"Mars"     ,"Avril"    ,"Mai"      ,"Juin"  ,
                                                 "Juillet"  ,"AoÃ»t"     ,"Septembre","Octobre"  ,"Novembre" ,"DÃ©cembre"),
                                          array( "Jan"      ,"FÃ©v"      ,"Mar"      ,"Avr"      ,"Mai"      ,"Jun"   ,
                                                 "Jul"      ,"AoÃ»"      ,"Sep"      ,"Oct"      ,"Nov"      ,"DÃ©c"     ) );
                        $aDays   = array( array( "Lundi"    ,"Mardi"    ,"Mercredi" ,"Jeudi"    ,"Vendredi" ,"Samedi","Dimanche"),
                                          array( "Lu"       ,"Ma"       ,"Me"       ,"Je"       ,"Ve"       ,"Sa"    ,"Di"      ) );
                        break;
        }   /* switch ( $lang ) */
    }   /* End of vaesoli.DAT_aDaysAndMonths() ================================= */
    /* ========================================================================== */


    public static function DAT_cMonth( $xDate,$bLong = true,$szLang = 'fr' )
    /*--------------------------------------------------------------------*/
    {
        static $aDays      = null;                                      /* Make it static to avoid multiple filling */
        static $aMonths    = null;                                      /* Make it static to avoid multiple filling */
        static $szLanguage = null;                                      /* Language we have treated */

        $szRetVal   = null;                                             /* Default return value */

        if ( is_int( $xDate ) )                                         /* If integer */
        {
            if ( $xDate >= 1 && $xDate <= 12 )                          /* If integer between 1 and 12 */
            {
                $iMonth = $xDate;                                       /* That's the month */
            }   /* if ( $xDate >= 1 && $xDate <= 12 ) */
            else   /* Else of ... if ( $xDate >= 1 && $xDate <= 12 ) */
            {
                $iMonth = (int) date( 'm',$xDate );                     /* We expect $xDate to be a UNIX time */
            }   /* End of ... Else of ... if ( $xDate >= 1 && $xDate <= 12 ) */
        }   /* if ( is_int( $xDate ) ) */
        elseif ( is_string( $xDate ) )                                  /* If date string (expected to be a YYYYMMDD format) */
        {
            $iMonth = (int) date( 'm',self::TIM_MakeInt( $xDate ) ); /* Month of the year (1 to 12) */
        }
        else
        {
            $iMonth = 0;
        }

        if ( $iMonth >= 1 && $iMonth <= 12 )                            /* If month OK */
        {
            if ( is_null( $aDays ) || $szLanguage != $szLang )          /* If NULL ... or if language has changed */
            {
                $aDays      = array();                                  /* Create an array of the days */
                $aMonths    = array();                                  /* Create an array for the months */
                $szLanguage = $szLang;                                  /* Save language */
                self::DAT_aDaysAndMonths( $aDays,$aMonths,$szLang );    /* Fill array of days and months */
            }   /* if ( is_null( $aDays ) ) */

            if ( $bLong )                                               /* If long format */
            {
                $szRetVal = $aMonths[0][$iMonth-1];                     /* Return long name */
            }
            else
            {
                $szRetVal = $aMonths[1][$iMonth-1];                     /* Return short name */
            }
        }   /* if ( $iMonth >= 1 && $iMonth <= 12 ) */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* End of vaesoli.DAT_cMonth() ========================================== */
    /* ========================================================================== */


    public static function DAT_isValid( $szYYYYMMDD )
    /*---------------------------------------------*/
    {
        $szYYYYMMDD = self::STR_dionly( $szYYYYMMDD );

        if ( strlen( $szYYYYMMDD ) < 4 )
            return ( false );

        if ( strlen( $szYYYYMMDD ) < 8 )
            $szYYYYMMDD .= self::STR_Left( $szYYYYMMDD,4 ) . '0101';

        $szYYYYMMDD = self::STR_Left( $szYYYYMMDD,8 );

        return ( preg_match( '%(19|20|21)[0-9]{2}[- /.]?(0[1-9]|1[012])[- /.]?(0[1-9]|[12][0-9]|3[01])%',$szYYYYMMDD ) );
    }   /* End of vaesoli.DAT_isValid() ========================================= */
    /* ========================================================================== */


    /* ========================================================================== */
    /**  {{*DAT_firstDowOfMonth( $xDate,$iDow )=

        Returns the first day of the week of a given month (e.g. first Sunday of
        31-12-2018)

        {*params
            $xDate  (mixed)     Date (can be a "YYYYMMDD" string or an int
                                (typically resulting from a call to [c]time()[/c]).
        *}

        {*return
            (int)   The day that is the first day of the week of a month (return
                    similar to [c]time()[/c])
        *}

        {*cdate     31/07/2018 11:05 *}
        {*version   7.0.0009 *}

        {*assert
            DAT_Eom( "20181231" ) === DAT_stod( "20181201" )
        *}

        *}}
     */
    /* ========================================================================== */
    public static function DAT_firstDowOfMonth( $xDate,$iDow )
    /*------------------------------------------------------*/
    {
        if ( is_string( $xDate ) )
        {
            $tDate = self::DAT_stod( $xDate );
        }   /*  if ( is_string( $xDate ) ) */
        elseif ( is_integer( $xDate ) )
        {
            $tDate = $xDate;
        }   /* elseif ( is_integer( $xDate ) ) */
        else    /* Else of ... elseif ( is_integer( $xDate ) ) */
        {
            $tDate = time();
        }   /* End of ... Else of ... elseif ( is_integer( $xDate ) ) */

        $tBOM = self::DAT_Bom( $tDate );                            /* Beginning of the Month */

        while ( true )
        {
            if ( self::DAT_Dow( $tBOM ) === $iDow )
                break;

            $tBOM += 86400;
        }   /* while ( true ) */

        return ( $tBOM );
    }   /* End of vaesoli.DAT_firstDowOfMonth() ================================= */
    /* ========================================================================== */


    /* ========================================================================== */
    /** {{*DAT_Bow( $szDate[,$szFormat] )=

        Determines the beginning of the week (Monday) of a date

        {*params
            $szDate     (string)    A date string in YYYYMMDD or in a [c]time()[/c]
                                    format
            $szFormat   (string)    Output format. Optional. null by default in which
                                    case the return value is an integer ([c]time()[/c]
                                    format)
        *}

        {*return
            (int)   Time expressed in number of seconds since 01/01/1970 if
                    $szFormat == null; otherwise a string format (see [c]date()[/c]
                    function in PHP)
        *}

        {*cdate     22/07/2012 19:32:47 *}
        {*mdate     11/10/2014 11:21 *}
        {*author    {PYB} *}
        {*version   5.0.0005 *}

        {*remark
            [c]DAT_Bow()[/c] works with a specific date, either in a string format
            or in an integer format[br]
            [c]DAT_Sow()[/c] works with a specific week[br]
            [c]DAT_Eow()[/c] works with a specific week
        *}

        {*exec
            echo "<p>" . ( $iTime1  = DAT_Bow( "20120719"       ) ) . "</p>";
            echo "<p>" . ( $szTime1 = DAT_Bow( "20120719",'Ymd' ) ) . "</p>";
            echo "<p>" . ( $iTime2  = DAT_Bow( "20120722"       ) ) . "</p>";
            echo "<p>" . ( $szTime2 = DAT_Bow( "20120722",'Ymd' ) ) . "</p>";
            echo "<p>" . ( $szTime3 = DAT_Bow( TIM_MakeInt( '20141029'),'Ymd' ) ) . "</p>";

            echo LSUnitTesting::assert( $iTime1 === 1342396800                          ,
                                        'ASSERTION SUCCESSFUL: Date of the week correct',
                                        'ASSERTION FAILURE: Date of the week incorrect' ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( $iTime2 === 1342396800                          ,
                                        'ASSERTION SUCCESSFUL: Date of the week correct',
                                        'ASSERTION FAILURE: Date of the week incorrect' ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( $szTime1 === '20120716'                         ,
                                        'ASSERTION SUCCESSFUL: Date of the week correct',
                                        'ASSERTION FAILURE: Date of the week incorrect' ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( $szTime2 === '20120716'                         ,
                                        'ASSERTION SUCCESSFUL: Date of the week correct',
                                        'ASSERTION FAILURE: Date of the week incorrect' ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( $szTime3 === '20141027'                         ,
                                        'ASSERTION SUCCESSFUL: Date of the week correct',
                                        'ASSERTION FAILURE: Date of the week incorrect' ,
                                        'GuideAssert' );
        *}

        {*seealso
            DAT_Sow(), DAT_Dow(), DAT_Eow()
        *}

        *}}
     */
    /* ========================================================================== */
    public static function DAT_Bow( $xDate,$szFormat = null )
    /*-----------------------------------------------------*/
    {
        if ( is_int( $xDate ) )
        {
            $iTime = $xDate;
        }
        else
        {
            $iTime  = TIM_MakeInt( $xDate );
        }

        $iDay       = DAT_Dow( $iTime );
        $xRetVal    = $xDate;

        if ( $iDay >= 1 && $iDay <= 7 )
        {
            $aDate      = DAT_2Array( is_int( $xDate ) ? date( 'Ymd',$xDate ) : $xDate );
            $xRetVal    = DAT_Add( (int) $aDate['year'],(int) $aDate['month'],(int) $aDate['day'],-( $iDay - 1 ) );

            if ( ! is_null( $szFormat ) )
            {
                $xRetVal = date( $szFormat,$xRetVal );
            }
        }

        return ( $xRetVal );
    }   /* End of vaesoli.DAT_Bow() ============================================= */
    /* ========================================================================== */


    /* ========================================================================== */
    /**  {{*DAT_Bom( [$xDate] )=

        Returns the day that is the starting date of the month

        {*params
            $xDate  (mixed)     Optional date (can be a "YYYYMMDD" string or an int
                                (typically resukting from a call to [c]time()[/c]).
                                If not passed, current time is considered
        *}

        {*return
            (int)   The day that is the first day of the month
        *}

        {*cdate     31/07/2018 10:55 *}
        {*version   7.0.0009 *}

        {*assert
            DAT_Eom( "20181231" ) === DAT_stod( "20181201" )
        *}

        *}}
     */
    /* ========================================================================== */
    public static function DAT_Bom( $xDate = null )
    /*-------------------------------------------*/
    {
        if ( is_string( $xDate ) )
        {
            $tDate = self::DAT_stod( $xDate );
        }
        elseif( is_integer( $xDate ) )
        {
            $tDate = $xDate;
        }
        else
        {
            $tDate = time();
        }

        $szYear  = (string) date( 'Y',$tDate );
        $szMonth = (string) date( 'm',$tDate );
        $szDay   = "01";

        return ( self::DAT_stod( $szYear . $szMonth . $szDay ) );
    }   /* End of vaesoli.DAT_Bom() ============================================= */
    /* ========================================================================== */


    public static function DAT_Dow( $xDate = null )
    /*-------------------------------------------*/
    {
        if     ( is_null( $xDate ) )                                    /* If NO parameter */
        {
            $iDay   = (int) date( 'w' );                                /* Use current time */
        }
        elseif ( is_string( $xDate ) )                                  /* If string passed */
        {
            $iDay   = (int) date( 'w',self::TIM_MakeInt( $xDate ) );   /* Make an int */
        }
        elseif ( is_int( $xDate ) )                                     /* If int passed */
        {
            $iDay   = (int) date( 'w',$xDate );                         /* Direct use */
        }
        else                                                            /* Houston, we have a problem */
        {
            $iDay = -1;                                                 /* Bad return */
        }

        return ( $iDay === 0 ? 7 : $iDay );                             /* Return result to caller */
    }   /* End of vaesoli.DAT_Dow() =============================================== */
    /* ============================================================================ */


    /* ============================================================================ */
    /** {{*DAT_cDow( $xDate[,$bLong][,$szLang])=

        Returns the day of the week from a given date or day in a week

        {*params
            $xDate      (mixed)     Date [c]string[/c] in YYYYMMDD format, or UNIX
                                    time equivalent as an [c]int[/c], or day of the
                                    week (int between 1 and 7).
            $bLong      (bool)      Long (true) or short (false) format. Optional.
                                    Long by default.
            $szLang     (string)    Language (en,fr or nl). Optional: 'fr' by
                                    default.
        *}

        {*return
            (string)    Returns the name of the day of the week as a string in
                        proper noun format.
        *}

        {*cdate     23/07/2012 14:32:29 *}
        {*version   5.0.0005 *}

        {*assert
            DAT_cDow( 4,false,'fr' ) === 'Je'
        *}

        {*assert
            DAT_cDow( 5,false,'nl' ) === 'Vr'
        *}

        {*assert
            DAT_cDow( 5,true,'nl' ) === 'Vrijdag'
        *}

        {*exec
            echo '<ol>';
                echo '<li> ... ',( $szDate01 = DAT_cDow( "20120722"                ) ),'</li>';
                echo '<li> ... ',( $szDate02 = DAT_cDow( TIM_MakeInt( "20120722" ) ) ),'</li>';
                echo '<li> ... ',( $szDate03 = DAT_cDow( null                      ) ),'</li>';
                echo '<li> ... ',( $szDate04 = DAT_cDow( 1,true  ,'en'             ) ),'</li>';
                echo '<li> ... ',( $szDate05 = DAT_cDow( 7,true  ,'en'             ) ),'</li>';
                echo '<li> ... ',( $szDate06 = DAT_cDow( 1,true  ,'fr'             ) ),'</li>';
                echo '<li> ... ',( $szDate07 = DAT_cDow( 7,true  ,'fr'             ) ),'</li>';
                echo '<li> ... ',( $szDate08 = DAT_cDow( 1,true  ,'nl'             ) ),'</li>';
                echo '<li> ... ',( $szDate09 = DAT_cDow( 7,true  ,'nl'             ) ),'</li>';
                echo '<li> ... ',( $szDate10 = DAT_cDow( 3,false ,'fr'             ) ),'</li>';
            echo '</ol>';

            echo LSUnitTesting::assert( strtolower( $szDate01 ) === 'dimanche'                      ,
                                        'ASSERTION SUCCESSFUL: day of the week correctly determined',
                                        'ASSERTION FAILURE: incorrect day of the week'              ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( strtolower( $szDate09 ) === 'zondag'                        ,
                                        'ASSERTION SUCCESSFUL: day of the week correctly determined',
                                        'ASSERTION FAILURE: incorrect day of the week'              ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( strtolower( $szDate10 ) === 'me'                            ,
                                        'ASSERTION SUCCESSFUL: day of the week correctly determined',
                                        'ASSERTION FAILURE: incorrect day of the week'              ,
                                        'GuideAssert' );
        *}

        {*seealso
            DAT_Day()
        *}
        *}}
     */
    /* ============================================================================ */
    public static function DAT_cDow( $xDate,$bLong = true,$szLang = 'en' )
    /*------------------------------------------------------------------*/
    {
        static $aDays   = null;                                         /* Make it static to avoid multiple filling */
        static $aMonths = null;                                         /* Make it static to avoid multiple filling */
        static $szLanguage = null;                                      /* Language we have treated */

        $szRetVal   = null;                                             /* Default return value */

        if ( is_int( $xDate ) && ( $xDate >= 1 && $xDate <= 7 ) )       /* If integer between 1 and 7 */
        {
            $iDay = $xDate;                                             /* That's the day !!! */
        }
        else
        {
            $iDay = self::DAT_Dow( $xDate );                            /* Date of the week (1 to 7; Sunday = 7) */
        }

        if ( $iDay >= 1 && $iDay <= 7 )                                 /* If day OK */
        {
            if ( is_null( $aDays ) || $szLanguage != $szLang )          /* If NULL ... or if language has changed */
            {
                $aDays      = array();                                  /* Create an array of the days */
                $aMonths    = array();                                  /* Create an array for the months */
                $szLanguage = $szLang;                                  /* Save language */
                self::DAT_aDaysAndMonths( $aDays,$aMonths,$szLang );    /* Fill array of days and months */
            }   /* if ( is_null( $aDays ) ) */

            if ( $bLong )                                               /* If long format */
                $szRetVal = $aDays[0][$iDay-1];                         /* Return long name */
            else
                $szRetVal = $aDays[1][$iDay-1];                         /* Return short name */
        }   /* if ( $iDay >= 1 && $iDay <= 7 ) */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* End of vaesoli.DAT_cDow() ============================================== */
    /* ============================================================================ */


    public static function TIM_Stot( $szYYYYMMDDHHmmSS )
    /*------------------------------------------------*/
    {
        if ( self::STR_Empty( $szYYYYMMDDHHmmSS = self::STR_Dionly( $szYYYYMMDDHHmmSS ) ) )
            return ( -1 );

        $iLength    = strlen( $szYYYYMMDDHHmmSS );

        $iSeconds   =
        $iMinutes   =
        $iHours     = 0;

        switch ( $iLength )
        {
            case    14: $iSeconds = substr( $szYYYYMMDDHHmmSS,12,2 );
            case    12: $iMinutes = substr( $szYYYYMMDDHHmmSS,10,2 );
            case    10: $iHours   = substr( $szYYYYMMDDHHmmSS, 8,2 );
        }   /* switch ( $iLength ) */

        $iYear  = (int) substr( $szYYYYMMDDHHmmSS,0,4 );                /* Year */
        $iMonth = (int) substr( $szYYYYMMDDHHmmSS,4,2 );                /* Month */

        if ( $iLength > 6 )
            $iDay   = (int) substr( $szYYYYMMDDHHmmSS,6,2 );            /* Day */
        else
            $iDay   = 1;

        //echo "<p>Original: "    .         $szYYYYMMDDHHmmSS         . "</p>\n";
        //echo "<p>Length: "      .         $iLength                  . "</p>\n";
        //echo "<p>Year : "       . substr( $szYYYYMMDDHHmmSS,0,4 )   . "</p>\n";
        //echo "<p>Month: "       . substr( $szYYYYMMDDHHmmSS,4,2 )   . "</p>\n";
        //echo "<p>Day  : "       . substr( $szYYYYMMDDHHmmSS,6,2 )   . "</p>\n";

        return ( mktime( $iHours,$iMinutes,$iSeconds,$iMonth,$iDay,$iYear ) );
    }   /* End of vaesoli.TIM_Stot() =========================================== */
    public static function DAT_Stot( $x ) { return ( self::TIM_Stot( $x ) ); }
    public static function DAT_Stod( $x ) { return ( self::TIM_Stot( $x ) ); }


    public static function FIL_AddBS( $szStr,$cMark = null )
    /*----------------------------------------------------*/
    {
        if ( is_null( $cMark ) )                                        /* If no char passed to us */
        {
            $szOS = strtolower( PHP_OS );                               /* OS */

            switch ( $szOS )                                            /* In function of the OS */
            {
                // The following two lines have been commented out on
                // 1/01/2012 17:52
                //case 'linux':   $cMark = '/';   break;
                //default     :   $cMark = '\\';  break;
                default     :   $cMark = VAESOLI_SLASH;
                                break;
            }   /* switch ( $szOS ) */
        }   /* if ( is_null( $cMark ) ) */

        if ( substr( $szStr,strlen( $szStr ) - 1,1 ) != $cMark )        /* If there is NO trailing backslash ... add one */
        {
           $szStr .= $cMark;                                            /* Add it to the string */
        }   /* if ( substr( $szStr,strlen( $szStr ) - 1,1 ) != $cMark ) */

        return ( self::STR_Tran( $szStr,$cMark . $cMark,$cMark ) );            /* Make sure that double slashes are turned to single slashes */
    }   /* End of vaesoli.FIL_AddBS() =========================================== */
    /* ========================================================================== */


    public static function FIL_aFiles( $szDir,$szPattern = null,$bWithRoot = true,$bWithDir = false )
    /*---------------------------------------------------------------------------------------------*/
    {
        $aFiles = array();                                          /* Ready to return an empty array */

        //echo "<p>" . __METHOD__ . "() at line " . __LINE__ . ": Directory to read from = {$szDir}</p>\n";

        if ( self::FIL_IsDir( $szDir ) && ( $nHandle = opendir( $szDir ) ) )  /* Open the starting directory */
        {
            $szDir = self::FIL_AddBS( $szDir );                     /* Add a backslash (or slash) if needed */

            //if ( $bWithDir )
            //{
            //    echo "Avec directories";
            //}
            //else
            //{
            //    echo "Sans directories";
            //}

            while ( ( $szFile = readdir( $nHandle ) ) != false )
            {
                if ( $szFile === "." || $szFile === '..' )          /* Skip current path and parent path */
                {
                    continue;
                }

                //echo "<p>" . __METHOD__ . "() at line " . __LINE__ . ": '{$szFile}'</p>\n";

                $szFullFile = realpath( $szDir . $szFile );         /* Build full file name (including path) */

                //echo "<p>" . __METHOD__ . "() at line " . __LINE__ . ": '{$szFullFile}'</p>\n";

                if ( $bWithDir || ! is_dir( $szFullFile ) )         /* If this is NOT a directory */
                {
                    //echo "<p>On traite {$szFullFile}</p>";
                    if ( ! is_null( $szPattern ) )
                    {
                        //echo "<p>" . __METHOD__ . "() at line " . __LINE__ . ": Pattern = {$szPattern}'</p>\n";
                        if ( $szPattern === '*.*' )
                        {
                            $szPattern = '/(.*)(\.)?(.*)/';
                        }

                        if ( preg_match( $szPattern,$szFile ) )     /* If file matches our pattern */
                        {
                            $aFiles[] = $bWithRoot ? $szFullFile : $szFile; /* Push this file onto the list */
                            //echo "<p>" . __METHOD__ . "() at line " . __LINE__ . ": INSERTED: '{$szFullFile}'</p>\n";
                        }
                    }
                    else
                    {
                        $aFiles[] = $bWithRoot ? $szFullFile : $szFile; /* Push this file onto the list */
                        //echo "<p>" . __METHOD__ . "() at line " . __LINE__ . ": INSERTED: '{$szFullFile}'</p>\n";
                    }
                }   /* if ( $bWithDir || ! is_dir( $szFullFile ) ) */
            }   /* while ( ( $szFile = readdir( $nHandle ) ) != false ) */

            closedir( $nHandle );                                   /* Close root directory */

        }   /* if ( $nHandle = opendir( $szDir ) ) */

        return ( $aFiles );                                         /* Return array of dirs */
    }   /* End of vaesoli.FIL_aFiles() ========================================== */
    /* ========================================================================== */


    /* ========================================================================== */
    /** {{*FIL_aFilesEx( $szPattern[,$iFlags] )=

        Find pathnames matching a pattern

        {*params
            $szPattern  (string)    Pattern
            $iFlags     (int)       Optional. [c]0[/c] by default.[br][br]

                                    [c]GLOB_MARK[/c] : Adds a slash to each directory returned [br]
                                    [c]GLOB_NOSORT[/c] : Return files as they appear in the directory (no sorting)[br]
                                    [c]GLOB_NOCHECK[/c] : Return the search pattern if no files matching it were found[br]
                                    [c]GLOB_NOESCAPE[/c] : Backslashes do not quote metacharacters[br]
                                    [c]GLOB_BRACE[/c] : Expands a,b,c to match 'a', 'b', or 'c'[br]
                                    [c]GLOB_ONLYDIR[/c] : Return only directory entries which match the pattern[br]
                                    [c]GLOB_ERR[/c] : Stop on read errors (like unreadable directories), by default errors are ignored.[br]

        *}

        {*remark
            This function is a wrapper of [c]glob()[/c]
        *}

        {*return
            (array)     Returns an array containing the matched files/directories,
                        an empty array if no file matched or [c]false[/c] on error.
        *}

        {--*warning
            We discourage the use of this function. Please prefer the [c]FIL_aFiles()[/c] function instead.
        --*}

        {*example
            if ( count( $aFiles = FIL_aFilesEx( 'c:/mysite.com/images/*.png' ) ) > 0 && is_array( $aFiles ) )
            {
                foreach( $aFiles as $szFile )
                {
                    echo "<p>File: {$szFile}</p>\n";
                }
            }
        *}

        {*seealso
            FIL_aDirs(), FIL_aFiles()
        *}

        *}}
     */
    /* ========================================================================== */
    public static function FIL_aFilesEx( $szPattern,$iFlags = 0 )
    /*---------------------------------------------------------*/
    {
        $x = glob( $szPattern,$iFlags );
        return ( is_array( $x ) ? $x : array() );
    }   /* End of FIL_aFilesEx() ==================================================== */
    /* ============================================================================== */


    /* ================================================================================ */
    /** {{*isCommandLine()=

        Determines if PHP runs in Cleint mode (Command Line)

        {*params
        *}

        {*return
            (bool)          [c]true[/c] if PHP runs in CLI mode; [c]false[/c] otherwise
        *}

        *}}
     */
    /* ================================================================================ */
    public static function isCommandLine()
    /*----------------------------------*/
    {
    	if     ( defined( 'STDIN' ) )
    	    $bCommandLine = true;
        elseif ( self::empty( $_SERVER['REMOTE_ADDR'] ) && ! isset( $_SERVER['HTTP_USER_AGENT'] ) && count( $_SERVER['argv'] ) > 0 )
            $bCommandLine = true;
        else
            $bCommandLine = false;

        return ( $bCommandLine );
    }   /* End of vaesoli.isCommandLine() =========================================== */
    /* ============================================================================== */


    public static function getParam( $szParameter,$aParams )
    /*----------------------------------------------------*/
    {
        $szRetVal = null;

        foreach( $aParams as $szValue )
        {
            $szPattern = "/{$szParameter}=(?P<{$szParameter}>.*?)\z/si";
            //var_dump( "Pattern: {$szPattern}" );
            if ( preg_match( $szPattern,$szValue,$aMatches ) )
            {
                //var_dump("FOUND");
                //var_dump( $aMatches );
                $szRetVal = $aMatches[$szParameter];
                break;
            }   /* if ( preg_match( $szPattern,$szValue,$aMatches ) ) */
        }   /* foreach( $aParams as $szValue ) */

        //var_dump( "WIll return: " );
        //var_dump( $szRetVal );

        return ( $szRetVal );
    }   /* End of getParam() ======================================================== */
    /* ============================================================================== */



    public static function FIL_Append( $szFile,$szText )
    /*------------------------------------------------*/
    {
        return ( self::FIL_AppendNoNL( $szFile,$szText . "\r\n" ) );    /* Return result to caller */
    }   /* End of FIL_Append() ======================================================== */
    /* ================================================================================ */


    public static function FIL_AppendNoNL( $szFile,$szText )
    /*----------------------------------------------------*/
    {
        $bRetVal = false;                                               /* Prepare to return a logical false */

        if ( $handle = @fopen( $szFile,'a+' ) )                         /* Open the file (create if not existing) ... if we could open/create the file */
        {
            fwrite( $handle,$szText );                                  /* Write the line of text to it */
            fclose( $handle );                                          /* Close the handle */
            $bRetVal = true;                                            /* Return a logical true */
        }   /* if ( $handle ) */

        return ( $bRetVal );                                            /* Return result to caller */
    }   /* End of FIL_AppendNoNL() ==================================================== */
    /* ================================================================================ */


    public static function FIL_Copy( $szSrc,$szDest )
    /*---------------------------------------------*/
    {
        return ( @copy( $szSrc,$szDest ) );
    }   /* End of vaesoli.FIL_Copy() ================================================== */
    /* ================================================================================ */


    public static function FIL_recurseCopy( $szSrc,$szDest,$szChildFolder = '' )
    /*------------------------------------------------------------------------*/
    {
        $resDir = opendir( $szSrc );

        @mkdir( $szDest );

        if ( $szChildFolder != '' )
        {
            @mkdir( $szDest . '/' . $szChildFolder );

            while ( false !== ( $szFile = readdir( $resDir ) ) )
            {
                if ( ( $szFile != '.' ) && ( $szFile != '..' ) )
                {
                    if ( is_dir( $szSrc . '/' . $szFile ) )
                    {
                        self::FIL_recurseCopy( $szSrc . '/' . $szFile,$szDest . '/'. $szChildFolder . '/' . $szFile );
                    }
                    else
                    {
                        copy( $szSrc . '/' . $szFile,$szDest . '/'. $szChildFolder . '/' . $szFile );
                    }
                }
            }
        }
        else
        {
            while( false !== ( $szFile = readdir( $resDir ) ) )
            {
                if ( ( $szFile != '.' ) && ( $szFile != '..' ) )
                {
                    if ( is_dir( $szSrc . '/' . $szFile ) )
                    {
                        self::FIL_recurseCopy( $szSrc . '/' . $szFile,$szDest . '/' . $szFile );
                    }
                    else
                    {
                        copy( $szSrc . '/' . $szFile, $szDest . '/' . $szFile );
                    }
                }
            }
        }

        closedir( $resDir );
    }   /* End of vaesoli.FIL_recurseCopy() =========================================== */
    /* ================================================================================ */


    public static function FIL_Delete( $szFile )
    /*----------------------------------------*/
    {
        if ( ! ( $bRetVal = @unlink( $szFile ) ) )                      /* If deletion NOT successful */
        {
            if ( self::FIL_IsDir( $szFile ) )                                 /* If a directory */
            {
                $bRetVal = @rmdir( $szFile );                           /* Remove directory (must be empty) */
                //echo "DELETE DIR";
            }   /* if ( FIL_IsDir( $szFile ) ) */
        }   /* if ( ! ( $bRetVal = @unlink( $szFile ) ) ) */

        return ( $bRetVal );                                            /* Return result to caller */
    }   /* End of vaesoli.FIL_Delete() ================================================ */
    /* ================================================================================ */


    public static function FIL_Exists( $szFile,$szPath = null,&$szFileSpec = null )
    /*---------------------------------------------------------------------------*/
    {
        $bRetVal = false;                                               /* Default return value */

        if ( file_exists( $szFile ) )                                   /* Go away from here if file exists in current dir */
        {
            if ( func_num_args() === 3 )                                /* If 3rd parameter passed */
            {
                $szFileSpec = $szFile;                                  /* Update parameter (sent by reference) */
            }   /* if ( func_num_args() == 3 ) */
            return ( true );                                            /* Return a logical true */
        }   /* if ( file_exists( $szFile ) ) */

        if ( ! self::STR_Empty( $szPath ) )                            /* If we got down here ... it means that we need to use a path (if any) */
        {
            $aDirs = explode( ';',$szPath );                            /* Explode the path in smaller chunks */

            foreach ( $aDirs as $szDir )                                /* For each directory */
            {
                $szTmp = self::FIL_Normalize( trim( $szDir ) . '/' . $szFile );

                if ( file_exists( $szTmp ) )                            /* If file found */
                {
                    if ( func_num_args() === 3 )                        /* If 3rd parameter passed */
                    {
                        $szFileSpec = $szTmp;                           /* Update parameter (sent by reference) */
                    }   /* if ( func_num_args() == 3 ) */
                    return ( true );                                    /* Return a logical true */
                }   /* if ( is_file( $szTmp ) ) */
            }   /* foreach ( $aDirs as $szDir ) */
        }   /* if ( ! STR_Empty( $szPath ) ) */

        if ( func_num_args() === 3 )                                    /* If 3rd parameter passed */
        {
            $szFileSpec = null;                                         /* Update parameter (sent by reference) */
        }   /* if ( func_num_args() == 3 ) */

        return ( false );                                               /* Return result to caller (logical false) */
    }   /* End of vaesoli.FIL_Exists() ================================================ */
    /* ================================================================================ */


    public static function FIL_IsDir( $szDir )
    /*--------------------------------------*/
    {
        return ( is_dir( $szDir ) );
    }   /* End of vaesoli.FIL_IsDir() ================================================= */
    /* ================================================================================ */


    public static function FIL_KeepValidCharacters( $szFile )
    /*-----------------------------------------------------*/
    {
        static $aInvalid = null;

        if ( is_null( $aInvalid ) )
        {
            $aInvalid['<']  =
            $aInvalid['>']  =
            $aInvalid[':']  =
            $aInvalid['"']  =
            $aInvalid['/']  =
            $aInvalid['\\'] =
            $aInvalid['|']  =
            $aInvalid['?']  =
            $aInvalid['*']  =
            true;
        }

        $szRetVal = '';
        $iLen = strlen( $szFile );
        for( $i = 0;$i< $iLen;$i++ )
        {
            $c = $szFile[$i];

            if ( ! isset( $aInvalid[$c] ) && ord( $c ) > 31 )
            {
                $szRetVal .= $c;
            }
        }

        return ( $szRetVal );
    }   /* End of vaesoli.FIL_KeepValidCharacters() ============================= */
    /* ========================================================================== */


    /* ========================================================================== */
    /** {{*FIL_MDate( $szFile,$szFormat )=

        Determines the date and time of last modification of a file

        {*params
            $szFile     (string)    Name of the file whose last modification date
                                    and time must be returned
            $szFormat   (string)    The format of the output date string
        *}

        {*version
            5.0.0012
        *}

        {*mdate
            14/01/2013 - 12:03
        *}


        {*return
            (string)    Last modification date and time returned in
                        [c]'d/m/Y - H:i:s'[/c] format if $szFormat NOT passed
                        (see [c]date()[/c] function of PHP)
        *}

        {*example
            echo FIL_MDate( 'C:\\myfile.txt' );
        *}

        {*exec
            $szFile = 'c:\\websites\\vaesoli.org\\www\\httpdocs\\vaesoli\\resources\\ut\\bonjour.txt';
            echo LSUnitTesting::assert( FIL_MDate( $szFile ) === '04/10/2013 - 15:39:18'    ,
                                        'ASSERTION SUCCESS: bonjour.txt OK'                 ,
                                        'ASSERTION FAILURE: bonjour.txt NOT OK'             ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( FIL_MDate( $szFile,'Ymd' ) === '20131004'           ,
                                        'ASSERTION SUCCESS: bonjour.txt OK'                 ,
                                        'ASSERTION FAILURE: bonjour.txt NOT OK'             ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( FIL_MDate( $szFile,'YmdHis' ) === '20131004153918'  ,
                                        'ASSERTION SUCCESS: bonjour.txt OK'                 ,
                                        'ASSERTION FAILURE: bonjour.txt NOT OK'             ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( FIL_MDate( $szFile,'' ) === ''                      ,
                                        'ASSERTION SUCCESS: bonjour.txt OK'                 ,
                                        'ASSERTION FAILURE: bonjour.txt NOT OK'             ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( is_integer( FIL_MDate( $szFile ) )                  ,
                                        'ASSERTION SUCCESS: bonjour.txt OK'                 ,
                                        'ASSERTION FAILURE: bonjour.txt NOT OK'             ,
                                        'GuideAssert' );
        *}

        {*seealso
            FIL_Time(), FIL_CDate()
        *}

        *}}
     */
    /* ========================================================================== */
    public static function FIL_MDate( $szFile,$szFormat = 'd/m/Y - H:i:s' )
    /*-------------------------------------------------------------------*/
    {
        if ( $szFormat === 'int' )
        {
            return ( self::FIL_Time( $szFile,'m' ) );
        }
        else
        {
            return ( self::FIL_Time( $szFile,'m',$szFormat ) );
        }
    }   /* End of function FIL_MDate() ========================================== */
    /* ========================================================================== */


    public static function FIL_CDate( $szFile,$szFormat = 'd/m/Y - H:i:s' )
    /*-------------------------------------------------------------------*/
    {
        if ( $szFormat === 'int' )
        {
            //var_dump( "On me demande la date de création de {$szFile}" );
            return ( self::FIL_Time( $szFile,'c' ) );
        }
        else
        {
            //var_dump( "On me demande la date de création de {$szFile}" );
            return ( self::FIL_Time( $szFile,'c',$szFormat ) );
        }
    }   /* End of function FIL_CDate() ========================================== */
    /* ========================================================================== */


    public static function FIL_mTime( $szFile,$szFormat = null )
    /*--------------------------------------------------------*/
    {
        if ( is_null( $szFormat ) || $szFormat === 'int' )
        {
            return ( self::FIL_Time( $szFile,'m' ) );
        }
        else
        {
            return ( self::FIL_Time( $szFile,'m',$szFormat ) );
        }
    }   /* End of vaesoli.FIL_mtime() ================================================= */
    /* ================================================================================ */


    public static function FIL_Time( $szFile,$cType = 'm',$szFormat = null )
    /*--------------------------------------------------------------------*/
    {
        if ( self::FIL_Exists( $szFile ) )                          /* If file found */
        {
            switch ( $cType )                                       /* Depending on the type of operation */
            {
                case 'a'    :   $iTime = fileatime( $szFile );      /* Get last access time of file */
                                break;
                case 'c'    :   $iTime = filectime( $szFile );      /* Get creation time of file */
                                //var_dump( "On me demande la date de création de {$szFile}" );
                                //var_dump( date( $szFormat,$iTime ) );
                                break;
                case 'm'    :
                default     :   $iTime = filemtime( $szFile );      /* Get last modification time of file */
                                break;
            }   /* switch ( $szType ) */

            if ( is_null( $szFormat ) )                             /* If not format mentioned */
            {
                return ( $iTime );                                  /* Return modification time of the file (int) */
            }   /* if ( is_null( $szFormat ) ) */
            else   /* Else of ... if ( is_null( $szFormat ) ) */
            {
                return ( date( $szFormat,$iTime ) );                /* Return date as mentioned per format */
            }   /* End of ... Else of ... if ( is_null( $szFormat ) ) */
        }   /* if ( file_exists( $szFile ) ) */
        else   /* Else of ... if ( file_exists( $szFile ) ) */
        {
            if ( is_null( $szFormat ) )                             /* If not format mentioned */
            {
                return ( -1 );                                      /* Return -1 if file not found */
            }   /* if ( is_null( $szFormat ) ) */
            else   /* Else of ... if ( is_null( $szFormat ) ) */
            {
                return ( null );                                        /* Return a null */
            }   /* End of ... Else of ... if ( is_null( $szFormat ) ) */
        }   /* End of ... Else of ... if ( file_exists( $szFile ) ) */
    }   /* End of vaesoli.FIL_Time() ================================================== */
    /* ================================================================================ */


    public static function FIL_FileNoOlderThan( $szFile,$iSec )
    /*-------------------------------------------------------*/
    {
        $tLastMDate = self::FIL_MDate( $szFile,'int' );
        $tDiff      = time() - $tLastMDate;

        //var_dump( "TIME DIFF: " . $tDiff . "sec" );
        return ( $tDiff <= $iSec );
    }   /* End of vaesoli.FIL_FileNoOlderThan() ======================================= */
    /* ================================================================================ */


    public static function FIL_File1OlderThanFile2( $szFile1,$szFile2 )
    /*---------------------------------------------------------------*/
    {
        return ( self::FIL_MDate( $szFile1,'int' ) > self::FIL_MDate( $szFile2,'int' ) );
    }   /* End of vaesoli.FIL_File1OlderThanFile2() =================================== */
    /* ================================================================================ */


    public static function FIL_getHashFile( $szFile )
    /*---------------------------------------------*/
    {
        if ( is_file( $szFile ) )
            return ( unserialize( self::FIL_FileToStr( $szFile ) ) );

        return ( null );
    }   /* End of vaesoli.FIL_getHashFile() =========================================== */
    /* ================================================================================ */


    public static function FIL_saveHashFile( $szFile,$x )
    /*-------------------------------------------------*/
    {
        return ( self::FIL_StrToFile( serialize( $x ),$szFile ) );
    }   /* End of vaesoli.FIL_saveHashFile() ========================================== */
    /* ================================================================================ */


    public static function FIL_MkDir( $szDir )
    /*--------------------------------------*/
    {
        $bRetVal    = false;                                            /* Prepare to return a logical false */
        $szDir      = self::FIL_AddBS( str_replace( '\\','/',$szDir ),'/' );  /* Ending slash (all backslashes turned to slashes) */
        //echo "<p>Dir de base Ã  créer: {$szDir}</p>";
        $szDisk     = self::FIL_Split( $szDir,1 );                     /* Get disk specifier */
        $szDir      = self::FIL_split( $szDir,2 ) .
                      self::FIL_split( $szDir,3 ) .
                      self::FIL_split( $szDir,4 ); /* Treat only the path part */
        $szDir      = str_replace( '\\','/',$szDir );                   /* Be sure about backslashes */
        $szLast     = '';                                               /* Last directories we have created (concatenation) */

        //echo "<p>Dir juste avant les tokens: {$szDir}</p>";
        $token      = strtok( $szDir,'/' );                             /* For each directory */

        while ( $token )                                                /* If the token was found */
        {
            //echo "<p>Token: {$token}</p>";
            if ( ( ! self::STR_empty( $token   ) &&                    /* If valid token */
                 (   $token != '.'              ) &&
                 (   $token != '..'             )
               ) )
            {
                //echo "\n$token pas vide<br />\n";
                $theDir = $szDisk . '/' . $szLast . $token;             /* Make dir1/dir2/dir3/... */

                //echo "<p>Check de {$theDir}</p>";
                if ( ! is_dir( $theDir ) )                              /* If not a directory */
                {
                    //echo "<p>{$theDir} n'est pas trouvÃ©e. Il faut la crÃ©er</p>";
                    if ( ! @mkdir( $theDir ) )                          /* If the directory CANNOT be created */
                    {
                        //echo "<p>On arrÃªte Ã  {$theDir}</p>";
                        break;                                          /* Stop here */
                    }   /* if ( ! @mkdir( $theDir ) ) */
                    else
                    {
                        //echo "<p>{$theDir} est crÃ©Ã©e</p>";
                    }
                }   /* if ( ! is_dir( $theDir ) ) */
                else
                {
                    //echo "<p>{$theDir} existe!</p>";
                }

                $szLast .= $token . '/';                                /* Concatenate directories */
            }   /* if ( ( ! self::empty( $token ) && ... */

            $token = strtok( '/' );                                     /* Get next token */
        }   /* while ( $token ) */

        $bRetVal = is_dir( $szDir );                                    /* true = the final directory exists */

        //if ( is_dir( $szDir ) )
        //{
        //    echo "<p>" . __FUNCTION__ . ' at line ' . __LINE__ . " -- CONFIRMATION: le rÃ©pertoire {$szDir} a Ã©tÃ© crÃ©Ã©</p>";
        //}

        return ( $bRetVal );                                            /* Return value to caller */
    }   /* End of FIL_MkDir() */
    /* ========================================================================== */
    /* ========================================================================== */


    public static function FIL_Normalize( $szPath,$bShorten = false )
    /*-------------------------------------------------------------*/
    {
        $szPath = str_replace( '\\','/',$szPath );                      /* Let's first turn all backslashes to forward slashes */
        $szPath = str_replace( '//','/',$szPath );                      /* Turn double slashes into single slash */

        if ( $bShorten )                                                /* If '..' must be treated as parent dirs */
        {
            return ( self::FIL_RealPath( $szPath ) );                         /* Recursion ... BUT no shorten */
        }   /* if ( $bShorten ) */

        switch ( strtoupper( PHP_OS ) )                                 /* In function of the OS */
        {
            case 'WINNT'    :
            case 'WINDOWS'  :
            case 'WIN32'    :
            case 'WIN'      :   $szPath = str_replace( '/','\\',$szPath );
                                break;
            case 'AIX'      :
            case 'LINUX'    :
            case 'OS400'    :
            case 'MAC'      :
            default         :   $szPath = str_replace( '\\','/',$szPath );
                                break;
        }   /* switch ( strtoupper( PHP_OS ) ) */

        return ( $szPath );                                             /* Return result to caller */

    }   /* End of FIL_Normalize() ===================================================== */
    /* ================================================================================ */


    public static function FIL_RealPath( $szPath )
    /*------------------------------------------*/
    {
        $iLimit = 30;                                               /* Recursion limit */
        $i      = 0;                                                /* Current iteration */

        /* Turn slashes into backslashes */
        $szPath = str_replace( array('/','\\.\\'),array('\\','\\'),$szPath );
        /* TODO: treat \.\ and /./ */
        while ( true )                                              /* While true */
        {
            /* Change path */
            $szPath = str_replace( array('/..\\','/'),array('\\..\\','\\'),preg_replace('/\\\\[^\\\\]*\\\\\.\.\\\\/i','/',$szPath ) );

            /* If no parent dir found ... or recursion limit attained */
            if ( ( self::STR_Pos( $szPath,'\\..' ) === -1   &&
                   self::STR_Pos( $szPath,'/..'  ) === -1 ) ||
                   $i++ > $iLimit )
            {
                break;
            }
        }   /* while ( true ) */

        /* Return result to caller */
        return ( self::FIL_Normalize( str_replace( array( '//','\\\\' ),array( '/','\\' ),$szPath ) ) );
    }   /* End of vaesoli.FIL_RealPath() ======================================== */
    /* ========================================================================== */


    public static function FIL_ResolveRoot( $szFileSpec,$szRoot = null )
    /*----------------------------------------------------------------*/
    {
        if ( is_null( $szRoot ) )                                       /* If root NOT passed */
        {
            if ( self::isCommandLine() )
                $szRoot = getcwd();                                     /* Use the current directory as the root */
            else
                $szRoot = $_SERVER['DOCUMENT_ROOT'];                    /* Use the site root by default */
        }   /* if ( is_null( $szRoot ) ) */

        if ( strtoupper( PHP_OS ) == 'DARWIN' )                         /* If MAC */
        {
            if ( is_file( $szFileSpec ) )                               /* If file exists */
            {
                return ( $szFileSpec );                                 /* Return simply the name that was passed to us */
            }   /* if ( is_file( $szFileSpec ) ) */
        }   /* if ( strtoupper( PHP_OS ) == 'DARWIN' ) */

        /* If starting slash ... this must be the root of the site */
        if ( ! is_null( $szFileSpec ) && ! self::empty( $szFileSpec ) && ( $szFileSpec[0] == '/' || $szFileSpec[0] == '\\' ) )
        {                                                               /* then it must be evaluated towards the root of the site */
            //echo "<p>On commence par un slash</p>";
            $iFileSpecLength = strlen( $szFileSpec );                   /* Length of the Filename */
            $iRootLength     = strlen( $szRoot );                       /* Length of the root path of the site */

            if ( $iFileSpecLength >= $iRootLength )                     /* If FileSpec longer than root */
            {
                $szFirstPart = strtolower(                              /* Extract the n first characters of the FileSpec */
                                            self::STR_Left( $szFileSpec,$iRootLength )
                                         );

                if ( $szFirstPart != strtolower( $szRoot ) )            /* If root not already in front of the FileSpec */
                {
                    $szFileSpec = $szRoot . $szFileSpec;                /* Add the root to it */
                }   /* if ( $szFirstPart != strtolower( $szRoot ) ) */
            }   /* if ( $iFileSpecLength >= $iRootLength ) */
            else   /* Else of ... if ( $iFileSpecLength >= $iRootLength ) */
            {
                $szFileSpec = $szRoot . $szFileSpec;                    /* Add the root */
            }   /* End of ... Else of ... if ( $iFileSpecLength >= $iRootLength ) */

        } /* if ( $szFileSpec[0] == '/' ) */
        else
        {
            //echo "<p>-On commence par {$szFileSpec[0]}$szFileSpec[1]$szFileSpec[2]$szFileSpec[3] pour {$szFileSpec}</p>";
        }

        return ( $szFileSpec );
    }   /* End of vaesoli.FIL_ResolveRoot() ===================================== */
    /* ========================================================================== */


    public static function FIL_RevertRoot( $szFileSpec,$szRoot = null )
    /*---------------------------------------------------------------*/
    {
        $szFile = $szFileSpec;                                          /* Default return value */

        if ( is_null( $szRoot ) )                                       /* If root NOT passed */
        {
            $szRoot = $_SERVER['DOCUMENT_ROOT'];                        /* Use the site root by default */
        }   /* if ( is_null( $szRoot ) ) */

        if ( strlen( $szRoot ) )                                        /* If the root of the web site is known */
        {
            $szRoot = self::FIL_Normalize( $szRoot );                         /* Normalize the root spec */
            //echo "<p style=\"font-size:2em;color:#000;\">" . __FUNCTION__ . ": La root vaut : {$szRoot}</p>\n";

            if ( strlen( $szFileSpec ) )                                /* If file specifier */
            {
                $szFileSpec = self::FIL_Normalize( $szFileSpec );
                //echo "<p style=\"font-size:2em;color:#000;\">AprÃ¨s normalisation:" . $szFileSpec . "</p>\n";

                if ( $szFileSpec[0] != '/' )                            /* If NOT starting with '/' */
                {
                    //if ( stristr( $szFileSpec,'5522f83f-f238-4e8b-a633-a678b23fc4f9' ) )
                    //{
                    //    echo "<p style=\"font-size:2em;color:#000;\">" . __FUNCTION__ . " at line " . __LINE__ . " : Le fichier vaut : {$szFileSpec}</p>\n";
                    //    echo "<p style=\"font-size:2em;color:#000;\">" . __FUNCTION__ . " at line " . __LINE__ . " : La root vaut : {$szRoot}</p>\n";
                    //}

                    // -- Commentaire: le 19/03/2011
                    $szFileSpec = str_replace( array( $szRoot,dirname( __FILE__ ),'\\' ),
                                               array( ''     ,''                 ,'/'  ),
                                               $szFileSpec );
                    //if ( stristr( $szFileSpec,'5522f83f-f238-4e8b-a633-a678b23fc4f9' ) )
                    //{
                    //    echo "<p style=\"font-size:2em;color:#000;\">" . __FUNCTION__ . " at line " . __LINE__ . " : Le fichier vaut : {$szFileSpec}</p>\n";
                    //}

                    //$szFileSpec = realpath( $szFileSpec );

                    //if ( stristr( $szFileSpec,'5522f83f-f238-4e8b-a633-a678b23fc4f9' ) )
                    //{
                    //    echo "<p style=\"font-size:2em;color:#000;\">" . __FUNCTION__ . " at line " . __LINE__ . " : Le fichier vaut : {$szFileSpec}</p>\n";
                    //}

                    //echo "<p style=\"font-size:2em;color:#000;\">AprÃ¨s str_replace() des backslashes en slashes : szFileSpec = {$szFileSpec}</p>\n";
                    // -- Commentaire: le 19/03/2011
                    // -- $szFile = STRTRAN( STRTRAN( $szFileSpec,'\\','/' ),STRTRAN( $szRoot,'\\','/' ),'' );

                    //echo "<p>Je dois remplacer '{$szRoot}' par rien dans {$szFileSpec}</p>\n";

                    //$szFile = str_replace( $szRoot,'',$szFileSpec );
                    $szFile = $szFileSpec;

                    //if ( stristr( $szFileSpec,'5522f83f-f238-4e8b-a633-a678b23fc4f9' ) )
                    //{
                    //    echo "<p style=\"font-size:2em;color:#000;\">" . __FUNCTION__ . " at line " . __LINE__ . " : Le rÃ©sultat FINAL vaut : {$szFile}</p>\n";
                    //}

                    //echo "<p style=\"font-size:2em;color:#000;\">" . __FUNCTION__ . ": Fichier rÃ©sultat: {$szFile}</p>\n";
                }
            }   /* if ( strlen( $szFileSpec ) ) */
        }   /* if ( strlen( $szRoot ) ) */
        else
        {
            //echo "<p>Pas de root</p>";
        }

        //echo "<p style=\"font-size:2em;color:#000;\">RÃ©sultat final: szFileSpec = {$szFileSpec}</p>\n";

        return ( $szFile );
    }   /* End of FIL_RevertRoot() ============================================== */
    /* ========================================================================== */


    public static function FIL_FileToStr( $szFile )
    /*-------------------------------------------*/
    {
        $szRetVal   = '';                                               /* Return value of the function (empty by default) */

        if ( ( $rh = @fopen( $szFile,'r' ) ) == true )                  /* If file could be opened */
        {
            $aFileStats = stat( $szFile );                              /* File stats */
            $szRetVal   = @fread( $rh,$aFileStats['size'] );            /* Read the entire file */
            @fclose( $rh );
        }   /* if ( ( $rh = @fopen( $szFile,'r' ) ) == true ) */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* End of FIL_FileToStr() =============================================== */
    /* ========================================================================== */


    public static function FIL_readBytes( $szFile,$iBytes )
    /*---------------------------------------------------*/
    {
        $szRetVal   = '';                                               /* Return value of the function (empty by default) */

        if ( ! self::empty( $szFile ) && ( $rh = @fopen( $szFile,'r' ) ) == true )    /* If file could be opened */
        {
            $aFileStats = stat( $szFile );                              /* File stats */
            $szRetVal   = @fread( $rh,$iBytes );                        /* Read X bytes */
            @fclose( $rh );
        }   /* if ( ( $rh = @fopen( $szFile,'r' ) ) == true ) */

        return ( $szRetVal );                                           /* Return result to caller */

    }   /* End of vaesoli.FIL_readBytes() ======================================= */
    /* ========================================================================== */


    public static function FIL_StrToFile( $szText,$szFile,$bAppend = false )
    /*--------------------------------------------------------------------*/
    {
        $bRetVal = false;                                               /* Ready to return a logical false */

        /* Open file (create if does not exist). If Append mode ... open in 'a+' */
        if ( ! self::empty( $szFile ) && ( $handle = @fopen( $szFile,( $bAppend ? 'a+' : 'w+' ) ) ) == true )
        {
            if ( flock( $handle,LOCK_EX ) )                             /* Lock the file EXCLUSIVELY */
            {
                @fwrite( $handle,$szText );                             /* Write contents to file */
                flock( $handle, LOCK_UN );                              /* Eliminate the lock */
                $bRetVal = true;
            }   /* if ( flock( $handle,LOCK_EX ) ) */
            @fclose( $handle );                                         /* Close file when done */
        }   /* if ( ( $handle = @fopen( $szFile,( $bAppend ? 'a+' : 'w+' ) ) ) == true ) */

        return ( $bRetVal );                                            /* Return result to caller */
    }   /* End of vaesoli.FIL_StrToFile() ======================================= */
    /* ========================================================================== */


    public static function FIL_Split( $szFile,$i )
    /*------------------------------------------*/
    {
        $xRetVal    = null;                                             /* Default return value of the function */

        $aParts     = pathinfo( $szFile );

        switch ( $i )
        {
            case    2:  $iPos = strpos( $aParts['dirname'],':' );
                        if ( $iPos === false )
                        {
                            $xRetVal = self::FIL_Normalize( self::FIL_AddBS( $aParts['dirname'] ) );
                        }
                        else
                        {
                            $xRetVal = self::FIL_Normalize( self::FIL_AddBS( substr( $aParts['dirname'],$iPos + 1 ) ) );
                        }
                        break;
            case    3:  $xRetVal = $aParts['basename' ];
                        if ( isset( $aParts['extension'] ) )
                        {
                            $szExt    = $aParts['extension'];
                        }
                        else
                        {
                            $szExt    = '';
                        }
                        $xRetVal = self::STR_Tran( $xRetVal,'.' . $szExt,'' );
                        break;
            case    4:  if ( isset( $aParts['extension'] ) )
                        {
                            $xRetVal = '.' . $aParts['extension'];
                        }
                        else
                        {
                            $xRetVal = '';
                        }
                        break;
            case    5:  $xRetVal = $aParts;
                        if ( isset( $xRetVal['extension'] ) )
                        {
                            $xRetVal['extension'] = '.' . $xRetVal['extension'];
                        }
                        break;
            default  :  $iPos = strpos( $aParts['dirname'],':' );
                        if ( $iPos === false )
                        {
                            $xRetVal = $aParts['dirname'];
                        }
                        else
                        {
                            $xRetVal = self::STR_Left( $aParts['dirname'],$iPos + 1);
                        }
        }   /* switch ( $i ) */

        return ( $xRetVal );                                            /* Return result to caller */
    }   /* End of vaesoli.FIL_Split() =========================================== */
    /* ========================================================================== */


    public static function FIL_Size( $szFile )
    /*--------------------------------------*/
    {
        $iSize = @filesize( $szFile );
        return ( is_bool( $iSize ) ? -1 : $iSize );
    }   /* End of vaesoli.FIL_Size() ============================================ */
    /* ========================================================================== */


    /* ========================================================================== */
    /** {{*guid( [$normalize] )=

        Returns a GUID (unique in time, unique in space)

        {*params
            $normalize      (bool)          Optional. [c]false[/c] by default. If
                                            [c]true[/c], the GUID is presented in
                                            lowercase and the opening and closing
                                            curly braces are removed.
        *}

        {*return
            (string)    GUID
        *}

        {*exec
            echo "<p>GUID: ",$szGUID = guid(),': length = ',$iLength = strlen( $szGUID ),"</p>";
            $aParts = explode( '-',$szGUID );

            echo LSUnitTesting::assert( $iLength === 38                                   &&
                                        preg_match( '/\{.*?-.*?-.*?-.*?-.*?\}/',$szGUID ) &&
                                        count( $aParts ) === 5                              ,
                                        'ASSERTION SUCCESSFUL: GUID seems to be OK'         ,
                                        'ASSERTION FAILURE: invalid GUID as it seems'       ,
                                        'GuideAssert' );

            var_dump( $aParts );
        *}

        {*seealso
            html_guid()
        *}

        *}}
     */
    /* ========================================================================== */
    public static function guid( $normalized = false )
    /*----------------------------------------------*/
    {
        static $hyphen = '-';

        $szGUID = null;

        if ( function_exists( 'com_create_guid' ) )
        {
            $szGUID = com_create_guid();
        }   /* if ( function_exists( 'com_create_guid' ) ) */
        else   /* Else of ... if ( function_exists('com_create_guid') ) */
        {
            mt_srand( microtime( true ) * 10000 );                      /* Optional for php 4.2.0 and up. */

            $charid = strtoupper( md5( uniqid( rand(),true ) ) );

            $szGUID = chr(123)                            .             /* "{" */
                      substr( $charid, 0, 8 ) . $hyphen   .
                      substr( $charid, 8, 4 ) . $hyphen   .
                      substr( $charid,12, 4 ) . $hyphen   .
                      substr( $charid,16, 4 ) . $hyphen   .
                      substr( $charid,20,12 )             .
                      chr(125);                                         /* "}" */
        }   /* End of ... Else of ... if ( function_exists('com_create_guid') ) */

        if ( ! $normalized )
            return ( $szGUID );
        else
            return ( strtolower( str_replace( array('{','}'),'',$szGUID ) ) );

    }   /* End of vaesoli.guid() ====================================================== */
    /*==================================================================================*/


    public static function HTTP_GetURL( $szURL,$szUser = null,$szPwd = null,&$iErrCode = 0,$aOptions = null,&$szHeader = null,$iSecs = 5,$aPost = null,$aRequestHeaders = null,&$aInfo = null )
    /*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    {
        //echo "GET URL avec " . $GLOBALS['szLSVUserAgent'];
        $szRetVal   = null;                                             /* Default return value of the function */
        $WithHeader = true;                                             /* With response header */

        if ( function_exists( 'curl_init' ) )                           /* If function is defined */
        {
            if ( ( $xHandle = curl_init() ) )                           /* Create a handle */
            {
                if ( ! is_null( $aOptions ) )                           /* If array of options passed */
                {
                    if ( isset( $aOptions[CURLOPT_HEADER] ) )           /* If response header requested */
                    {
                        $WithHeader = $aOptions[CURLOPT_HEADER];        /* With response header ? */
                    }   /* if ( isset( $aOptions[CURLOPT_HEADER] ) ) */
                    curl_setopt_array ( $xHandle,$aOptions );           /* Use this array */
                }   /* if ( ! is_null( $aOptions ) ) */
                else   /* Else of ... if ( ! is_null( $aOptions ) ) */
                {
                    $iMS = isset( $GLOBALS['iLSVTimeout'] ) ? $GLOBALS['iLSVTimeout'] : $iSecs * 1000;

                    //set_time_limit( 30 + $iSecs );                      /* To cater for connection timeout and execution timeout */

                    curl_setopt( $xHandle,CURLOPT_RETURNTRANSFER    ,true       );  /* TRUE to return the transfer as a string */
                    curl_setopt( $xHandle,CURLOPT_CONNECTTIMEOUT    ,$iSecs     );  /* The number of seconds to wait while trying to connect. Use 0 to wait indefinitely. */
                    curl_setopt( $xHandle,CURLOPT_CONNECTTIMEOUT_MS ,$iMS       );  /* The number of milliseconds to wait while trying to connect. Use 0 to wait indefinitely. */
                    curl_setopt( $xHandle,CURLOPT_TIMEOUT           ,120        );  /* The maximum number of seconds to allow cURL functions to execute */
                    curl_setopt( $xHandle,CURLOPT_USERAGENT         ,'TRQL Radio User Agent' );
                    curl_setopt( $xHandle,CURLOPT_ENCODING          ,''         );  /* Set all encodings possible */
                    curl_setopt( $xHandle,CURLOPT_FOLLOWLOCATION    ,true       );  /* Follow Location: */
                    curl_setopt( $xHandle,CURLOPT_FRESH_CONNECT     ,true       );  /* Fresh connection */
                    curl_setopt( $xHandle,CURLINFO_HEADER_OUT       ,true       );
                    curl_setopt( $xHandle,CURLOPT_HEADER            ,$WithHeader ); /* Response Header info */
                    curl_setopt( $xHandle,CURLOPT_AUTOREFERER       ,true       );
                    curl_setopt( $xHandle,CURLOPT_MAXREDIRS         ,3          );

                    if ( ! is_null( $aPost ) )
                    {
                        curl_setopt( $xHandle,CURLOPT_POST,true );
                        curl_setopt( $xHandle,CURLOPT_POSTFIELDS,$aPost );
                    }

                    if ( ! is_null( $aRequestHeaders ) && is_array( $aRequestHeaders ) )
                    {
                        //curl_setopt( $xhandle,CURLOPT_HTTPHEADER                 ,
                        //             array( 'Content-Type: application/json',
                        //                    'x-api-key: 71EB43AD000EE8D34B4F07C77885744B43B448554324D468F0920C04032A8EB3'
                        //                  ) );
                        curl_setopt( $xHandle,CURLOPT_HTTPHEADER,$aRequestHeaders );
                    }

                    if ( self::STR_StartWith( $szURL,'https' ) )
                    {
                        curl_setopt( $xHandle,CURLOPT_SSL_VERIFYPEER,false );
                    }
                }   /* End of ... Else of ... if ( ! is_null( $aOptions ) ) */

                curl_setopt( $xHandle,CURLOPT_URL,$szURL );             /* URL passed to CURL */

                if ( ! is_null( $szUser ) )                             /* If user passed */
                {
                    curl_setopt( $xHandle,CURLOPT_USERPWD   ,"{$szUser}:{$szPwd}"   );
                }   /* if ( ! is_null( $szUser ) ) */


                // Mis en commentaire ke 07-05-16 07:41:38
                //$szData = curl_exec( $xHandle );                        /* Get data now */
                if ( ( $szData = curl_exec( $xHandle ) ) === false )
                {
                    // Errors received
                    //D:\websites\vaesoli.org\www\httpdocs\vaesoli\include\LSHttp.functions.php:244:string '<url> malformed' (length=15)
                    //D:\websites\vaesoli.org\www\httpdocs\vaesoli\include\LSHttp.functions.php:244:string 'SSL certificate problem: unable to get local issuer certificate' (length=63)
                    //var_dump( curl_error( $xHandle ) );

                    return ( null );

                }
                else
                {
                    $aInfo      = curl_getinfo( $xHandle );             /* Get info from the connection */
                    $iErrCode   = (int) $aInfo['http_code'];            /* Error code (if any) */
                }

                if ( $iErrCode == 200 )                                 /* If success */
                {
                    if ( $WithHeader )                                  /* If response header sent back */
                    {
                        /********************************************************************/
                        /* OK ... $szData contains both the response header AND the payload */
                        /* What we need to do now is to parse this response as to be able   */
                        /* to distinguish the response header from the body. The header is  */
                        /* sent first, then we have a double \r\n, then we have the body.   */
                        /*                                                                  */
                        /* We shall use list(..) to do this together with explode(..) with  */
                        /* only 2 parts.                                                    */
                        /********************************************************************/
                        list( $header,$body ) = explode("\r\n\r\n",$szData,2 );

                        if ( ! is_null( $szHeader ) )                   /* If header requested (CURLINFO_HEADER_OUT option must be set) */
                        {
                            $szHeader = $header;                        /* Store header back in parameter sent by reference */
                        }   /* if ( ! is_null( $szHeader ) ) */

                        $szRetVal = $body;                              /* Place the return buffer in the return slot */
                    }   /* if ( $WithHeader ) */
                    else   /* Else of ... if ( $WithHeader ) */
                    {
                        $szRetVal = $szData;                            /* Place the return buffer in the return slot */
                    }   /* End of ... Else of ... if ( $WithHeader ) */
                }   /* if ( $iErrCode == 200 ) */
                else   /* Else of ... if ( $iErrCode == 200 ) */
                {
                    if ( $WithHeader )                                  /* If response header sent back */
                    {
                        /********************************************************************/
                        /* OK ... $szData contains both the response header AND the payload */
                        /* What we need to do now is to parse this response as to be able   */
                        /* to distinguish the response header from the body. The header is  */
                        /* sent first, then we have a double \r\n, then we have the body.   */
                        /*                                                                  */
                        /* We shall use list(..) to do this together with explode(..) with  */
                        /* 2 parts only.                                                    */
                        /********************************************************************/
                        $szNeedle = "\r\n\r\n";
                        if ( ! self::STR_Empty( $szData ) && strstr( $szData,$szNeedle ) )
                        {
                            list( $header,$body ) = explode( $szNeedle,$szData,2 );

                            if ( ! is_null( $szHeader ) )               /* If header requested (CURLINFO_HEADER_OUT option must be set) */
                            {
                                $szHeader = $header;                    /* Store header back in parameter sent by reference */
                            }   /* if ( ! is_null( $szHeader ) ) */
                        }   /* if ( ! STR_Empty( $szData ) && strstr( $szData,$szNeedle = "\r\n\r\n" ) ) */
                        else   /* Else of ... if ( ! STR_Empty( $szData ) && strstr( $szData,$szNeedle = "\r\n\r\n" ) ) */
                        {
                            $szHeader = null;
                        }   /* End of ... Else of ... if ( ! STR_Empty( $szData ) && strstr( $szData,$szNeedle = "\r\n\r\n" ) ) */
                    }   /* if ( $WithHeader ) */
                    $szRetVal = null;                                   /* Got nothing */
                }   /* End of ... Else of ... if ( $iErrCode == 200 ) */

                curl_close( $xHandle );                                 /* Close connection */
            }   /* if ( ( $xHandle = curl_init() ) ) */
        }   /* if ( function_exists( 'curl_init' ) ) */
        else   /* Else of ... if ( function_exists( 'curl_init' ) ) */
        {
            $szRetVal = file_get_contents( $szURL );
        }   /* End of ... Else of ... if ( function_exists( 'curl_init' ) ) */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* End of HTTP_GetURL() ================================================= */


    public static function HTTP_headers( $szURL )
    /*-----------------------------------------*/
    {
        $aRetVal = null;                                                /* Default return value of the function */

        if ( $ch = curl_init( $szURL ) )                                /* cURL initialization / create cURL handle */
        {
            curl_setopt( $ch,CURLOPT_NOBODY,true );                     /* true = exclude body from output (request method set to HEAD) */
            curl_exec( $ch );                                           /* Execute HTTP query */
            $aRetVal = curl_getinfo( $ch );                             /* Get headers (https://www.php.net/manual/fr/function.curl-getinfo.php) */

            curl_close( $ch );                                          /* Close cURL handle */
        }   /* if ( $ch = curl_init( $szURL ) ) */

        return ( $aRetVal );                                           /* Return result to caller */
    }   /* End of HTTP_headers() ====================================================== */
    /* ================================================================================ */


    public static function HTTP_IsURL( $szURL )
    /*---------------------------------------*/
    {
        $iRetCode = -1;                                                 /* Default return value of the function */

        if ( $ch = curl_init( $szURL ) )                                /* cURL initialization / create cURL handle */
        {
            $options = array( CURLOPT_URL               => $szURL   ,
                              CURLOPT_RETURNTRANSFER    => true     ,
                              CURLOPT_HEADER            => true     ,
                              CURLOPT_FOLLOWLOCATION    => true     ,
                              CURLOPT_ENCODING          => ""       ,
                              CURLOPT_NOBODY            => true     ,   /* true = exclude body from output (request method set to HEAD) */
                              CURLOPT_AUTOREFERER       => true     ,
                              CURLOPT_CONNECTTIMEOUT    => 120      ,
                              CURLOPT_SSL_VERIFYPEER    => false    ,
                              CURLOPT_TIMEOUT           => 120      ,
                              CURLOPT_MAXREDIRS         => 10
                            );
            curl_setopt_array( $ch, $options );
            //curl_setopt( $ch,CURLOPT_NOBODY,true );
            curl_exec( $ch );                                           /* Execute HTTP query */
            $iRetCode = curl_getinfo( $ch,CURLINFO_HTTP_CODE );         /* Get return code */
            //var_dump( $iRetCode );

            //if ( $iRetCode != 200 )
            //{
            //    var_dump( curl_error( $ch ) );
            //}

            curl_close( $ch );                                          /* Close cURL handle */
        }   /* if ( $ch = curl_init( $szURL ) ) */

        return ( $iRetCode );                                           /* Return result to caller */
    }   /* End of HTTP_IsURL() ======================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_iInList( $aList,$szValue[,$bPartOf] )=

        Determines whether $szValue can be found in a list of possible values ($aList)
        ([b]case insensitive[/b])

        {*params
            $aList      (array)     Array of values
            $szValue    (string)    The value to look for in $aList
            $bPartOf    (boolean)   Optional. [c]false[/c] by default. If [c]true[/c]
                                    a partial match is accepted.
        *}

        {*remark
            Case insensitive search
        *}

        {*return
            (bool)  [c]true[/c] if $szValue found in $aList; [c]false[/c] otherwise
        *}

        {*assert
            STR_iInList( array( '/sitemap.php','/help.php','/legal.php' ),'/sitemap.php' ) === true
        *}

        {*assert
            STR_iInList( array( '/sitemap.php','/help.php','/legal.php' ),'/SITEMAP.PHP' ) === true
        *}

        {*assert
            STR_iInList( array( '/sitemap.php','/help.php','/legal.php' ),'map.php' ) === false
        *}

        {*assert
            STR_iInList( array( '/sitemap.php','/help.php','/legal.php' ),'MAP.PHP' ) === false
        *}

        {*assert
            STR_iInList( array( '/sitemap.php','/help.php','/legal.php' ),'.php',true ) === true
        *}

        {*seealso
            STR_InList()
        *}

        {*example
            if ( STR_iInList( array( '/sitemap.php','/help.php','/legal.php' ),$szPage ) )
            {
                echo "<p>{$szPage} found in list!</p>\n";
            }
        *}
        *}}
     */
    /* ================================================================================ */
    public static function STR_iInList( $aList,$szValue,$bPartOf = false ): bool
    /*------------------------------------------------------------------------*/
    {
        $bRetVal = false;                                               /* Return value of the function */

        $szValue = strtolower( $szValue );                              /* Turn the thing to lowercase because it's a case insensitive search */

        foreach( $aList as $x )                                         /* For each slot of the array */
        {
            if ( is_string( $x ) )                                      /* If string */
            {
                if ( ! $bPartOf )                                       /* If perfect match */
                {
                    if ( $bRetVal = ( strtolower( $x ) === $szValue ) ) /* If result OK */
                    {
                        break;                                          /* Stop here */
                    }
                }
                else
                {
                    if ( $bRetVal = ( self::STR_iPos( $x,$szValue ) !== -1 ) ) /* If result OK */
                    {
                        break;                                          /* Stop here */
                    }
                }
            }   /* if ( is_string( $x ) ) */
        }   /* foreach( $aList as $x ) */

        return ( $bRetVal );                                            /* Return result to caller */
    }   /* == End of function STR_InList() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_InList( $aList,$szValue[,$bPartOf] )=

        Determines whether $szValue can be found in a list of possible values ($aList)
        ([b]case sensitive[/b])

        {*params
            $aList      (array)     Array of values
            $szValue    (string)    The value to look for in $aList
            $bPartOf    (boolean)   Optional. [c]false[/c] by default. If [c]true[/c]
                                    a partial match is accepted.
        *}

        {*remark
            Case sensitive search
        *}

        {*return
            (bool)  true if $szValue found in $aList; false otherwise
        *}

        {*assert
            STR_InList( array( '/sitemap.php','/help.php','/legal.php' ),'/sitemap.php' ) === true
        *}

        {*assert
            STR_InList( array( '/sitemap.php','/help.php','/legal.php' ),'/SITEMAP.PHP' ) === false
        *}

        {*assert
            STR_InList( array( '/sitemap.php','/help.php','/legal.php' ),'map.php' ) === false
        *}

        {*assert
            STR_InList( array( '/sitemap.php','/help.php','/legal.php' ),'MAP.PHP' ) === false
        *}

        {*assert
            STR_InList( array( '/sitemap.php','/help.php','/legal.php' ),'legal',true ) === true
        *}

        {*seealso
            STR_iInList()
        *}

        {*example
            if ( STR_InList( array( '/sitemap.php','/help.php','/legal.php' ),$szPage ) )
            {
                echo "<p>{$szPage} found in list!</p>\n";
            }
        *}

        *}}
     */
    /* ================================================================================ */
    public static function STR_InList( $aList,$szValue,$bPartOf = false ): bool
    /*-----------------------------------------------------------------------*/
    {
        $bRetVal = false;                                               /* Return value of the function */

        foreach( $aList as $x )                                         /* For each slot of the array */
        {
            if ( is_string( $x ) )                                      /* If string */
            {
                if ( ! $bPartOf )                                       /* If perfect match */
                {
                    if ( $bRetVal = ( $x === $szValue ) )               /* If result OK */
                    {
                        break;                                          /* Stop here */
                    }
                }
                else
                {
                    if ( $bRetVal = ( self::STR_Pos( strtolower( $x ),$szValue ) !== -1 ) ) /* If result OK */
                    {
                        break;                                          /* Stop here */
                    }
                }
            }   /* if ( is_string( $x ) ) */
        }   /* foreach( $aList as $x ) */

        return ( $bRetVal );                                            /* Return result to caller */
    }   /* == End of function STR_InList() ============================================ */
    /* ================================================================================ */


    public static function STR_Sort( $szStr )
    /*-------------------------------------*/
    {
        //$a = str_split( $szStr );
        //$a = mb_split( ' ',$szStr );
        $a = preg_split( '/(?<!^)(?!$)/u',$szStr );
        sort( $a );

        return( implode( '',$a ) );
    }   /* End of STR_Sort() ========================================================== */
    /* ================================================================================ */


    public static function STR_Balance( $szStr,$szStart,$szEnd )
    /*--------------------------------------------------------*/
    {
        $szRetVal = null;                                               /* Default return value of the function */

        //echo $szStr;
        /* First examine whether we can indeed find the start and end words */
        if ( strlen( $szStart ) > 0 && strlen( $szEnd ) > 0   &&
             ( ( $szStr = strstr( $szStr,$szStart ) ) != false ) &&
               (          strstr( $szStr,$szEnd   )   != false ) )
        {
            $iLength    = strlen( $szStr );                             /* OK ... length of string to treat */
            $szWord     = '';                                           /* Current word we're reading (or even phrase) */
            $iMatch     = 0;                                            /* Match count */

            for ( $i = 0;$i < $iLength;$i++ )                           /* For the entire string */
            {
                $szWord .= $szStr[$i];                                  /* Word is appended with current char */
                //echo "<p>{$i}: " . htmlentities( $szWord ) . " (match={$iMatch})</p>\n";

                if ( is_int( strpos( $szWord,$szStart ) ) )             /* If start pattern found */
                {
                    //echo "<p>{$szStart} START FOUND at {$i}. iMatch was '{$iMatch} and now becomes ";
                    $iMatch++;                                          /* Increment match counter */
                    //echo "'{$iMatch}'</p>\n";
                    $szWord = '';                                       /* Reset current word */
                }   /* if ( is_int( strpos( $szWord,$szStart ) ) ) */
                elseif ( is_int( strpos( $szWord,$szEnd ) ) )           /* If end pattern found */
                {
                    //echo "<p>END FOUND at {$i}. iMatch valait '{$iMatch} et devient maintenant ";
                    $iMatch--;                                          /* Decrement match counter */
                    //echo "'{$iMatch}'</p>\n";
                    $szWord = '';                                       /* Reset current word */

                    if ( $iMatch === 0 )                                /* If start pattern is balanced with end pattern */
                    {
                        //echo "<p>Balanced at {$i}</p>";
                        $szRetVal = substr( $szStr,0,$i+1 );            /* Return string from beginning to current position (included) */
                        break;                                          /* Stop here !!! */
                    }   /* if ( $iMatch === 0 ) */
                }
            }   /* for ( $i = 0;$i < $iLength;$i++ ) */
            //$szRetVal = $szStr;
        }   /* if ( ( ( $szStr = strstr( $szStr,$szStart ) ) != false ) && ... */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* End of function STR_Balance() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*MISC_CastString( $x,$iLength )=

        Casts a value to a string

        {*params
            $x          (mixed)     The value to cast to a string
            $iLength    (int)       Optional return length. Full string
                                    is returned if $iLength < [c]0[/c]. [c]-1[/c] by default
        *}

        {*alias
            MISC_MakeString()
        *}

        {*return
            (string)    $x turned to a string
        *}

        {*assert
            MISC_CastString( true ) === 'true'
        *}

        {*assert
            MISC_CastString( false ) === 'false'
        *}

        {*assert
            MISC_CastString( 18 ) === '18'
        *}

        {*assert
            MISC_CastString( array(),3 ) === 'arr'
        *}

        {*example
            Example #1
            echo MISC_CastString( 'hello',4 ); Prints 'hell'

            Example #2
            echo MISC_CastString( true ); Prints 'true'
        *}

        *}}
     */
    /* ================================================================================ */
    public static function MISC_CastString( $x,$iLength = -1 )
    /*------------------------------------------------------*/
    {
        $szRetVal = null;                                               /* Return value of the function */

        if ( is_string( $x ) )                                          /* If already string */
        {
            $szRetVal = $x;
        }
        elseif ( is_bool( $x ) )                                        /* If boolean/logical value */
        {
            $szRetVal = $x ? 'true' : 'false';
        }
        elseif ( is_object( $x ) )                                      /* If object */
        {
            $szRetVal = 'object';
        }
        elseif ( is_array( $x ) )                                       /* If array */
        {
            $szRetVal = 'array';
        }
        else                                                            /* In any other case */
        {
            $szRetVal = (string) $x;
        }

        if ( $iLength > 0 )                                             /* If result should be limited */
        {
            $szRetVal = substr( $szRetVal,0,$iLength );                  /* Get only a part of the return value */
        }   /* if ( $iLength > 0 ) */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* End of function MISC_CastString() ==================================== */
    public static function MISC_MakeString( $x,$iLength = -1 ) { return ( self::MISC_CastString( $x,$iLength ) ); }
    public static function STR_Make( $x                      ) { return ( self::MISC_CastString( $x          ) ); }


    /* ================================================================================ */
    /** {{*MISC_True( $x,$y,$z )

        Returns a true (ALWAYS) whatever $x,$y,$z were sent

        {*params
            $x          (mixed)     Optional. Not used by the function.
            $y          (mixed)     Optional. Not used by the function.
            $z          (mixed)     Optional. Not used by the function.
        *}

        {*return
            (bool)  true (ALWAYS)
        *}

        {*assert
            MISC_True( false ) === true
        *}
        *}}
     */
    /* ================================================================================ */
    public static function MISC_True( $x = null,$y = null, $z = null )
    /*--------------------------------------------------------------*/
    {
        return ( true );                                                /* Return a true (ALWAYS) */
    }   /* End of function MISC_True() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*MISC_False( $x,$y,$z )

        Returns a false (ALWAYS) whatever $x,$y,$z were sent

        {*params
            $x          (mixed)     Optional. Not used by the function.
            $y          (mixed)     Optional. Not used by the function.
            $z          (mixed)     Optional. Not used by the function.
        *}

        {*return
            (bool)  false (ALWAYS)
        *}

        {*assert
            MISC_False( true ) === false
        *}
        *}}
     */
    /* ================================================================================ */
    public static function MISC_False( $x = null,$y = null, $z = null )
    /*---------------------------------------------------------------*/
    {
        return ( false );                                               /* Return a false (ALWAYS) */
    }   /* End of function MISC_False() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*MISC_Null( $x,$y,$z )

        Returns a null (ALWAYS) whatever $x,$y,$z were sent

        {*params
            $x          (mixed)     Optional. Not used by the function.
            $y          (mixed)     Optional. Not used by the function.
            $z          (mixed)     Optional. Not used by the function.
        *}

        {*return
            (null)  null (ALWAYS)
        *}

        {*assert
            MISC_Null( true ) === null
        *}

        {*assert
            MISC_Null( false ) === null
        *}

        {*assert
            MISC_Null( 'Hello' ) === null
        *}

        {*assert
            MISC_Null( 18 ) === null
        *}

        *}}
     */
    /* ================================================================================ */
    public static function MISC_Null( $x = null,$y = null, $z = null )
    /*--------------------------------------------------------------*/
    {
        return ( null );                                                /* Return a null (ALWAYS) */
    }   /* End of function MISC_Null() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*MISC_CastBool( $x,$bDefault )=

        Casts a value to a boolean

        {*params
            $x          (mixed)     The value to cast to a boolean
            $bDefault   (bool)      Optional default return value
        *}

        {*return
            (bool)  $x turned to a boolean
        *}

        {*assert
            MISC_CastBool( true ) === true
        *}

        {*assert
            MISC_CastBool( 'yes' ) === true
        *}

        {*assert
            MISC_CastBool( 0 ) === false
        *}

        {*assert
            MISC_CastBool( 18 ) === true
        *}

        {*assert
            MISC_CastBool( 'hello' ) === false
        *}

        {*assert
            MISC_CastBool( 'ja' ) === true
        *}

        {*assert
            MISC_CastBool( 'on' ) === true
        *}

        {*assert
            MISC_CastBool( 'vrai' ) === true
        *}

        {*assert
            MISC_CastBool( 'true' ) === true
        *}

        {*assert
            MISC_CastBool( '',false ) === false
        *}

        {*assert
            MISC_CastBool( '',true ) === true
        *}

        {*assert
            MISC_CastBool( null,false ) === false
        *}

        {*assert
            MISC_CastBool( null,true ) === true
        *}

        {*assert
            MISC_CastBool( array() ) === true
        *}

        {*example
            if ( MISC_CastBool( $_GET['xml'] ) )
            {
                echo "XML required";
            }
        *}

        *}}
     */
    /* ================================================================================ */
    public static function MISC_CastBool( $x = null,$bDefault = false )
    /*---------------------------------------------------------------*/
    {
        $x2 = $bDefault;                                                /* Ready to return a logical false */

        if ( ! is_null( $x ) )                                          /* If $x is NOT null */
        {
            $szType = gettype( $x );                                    /* Get variable type */

            switch ( $szType )                                          /* In function of the type of the parameter */
            {
                case 'boolean'  :   $x2 = $x;                           /* Return what was passed to us */
                                    break;
                case 'float'    :
                case 'integer'  :
                case 'double'   :   $x2 = ( $x != 0 );                  /* 0 => false */
                                    break;
                case 'string'   :   $x  = strtolower( $x );             /* Make lowercase */
                                    $x2 = false;
                                    if ( ( $x === 'true' ) ||
                                         ( $x === 'vrai' ) ||
                                         ( $x === 'waar' ) ||
                                         ( $x === 'ja'   ) ||
                                         ( $x === 'yes'  ) ||
                                         ( $x === 'oui'  ) ||
                                         ( $x === 'on'   ) ||
                                         ( $x === '1'    )
                                       )
                                    {
                                        $x2 = true;
                                    }
                                    elseif ( $x === '' || is_null( $x ) )
                                    {
                                        $x2 = $bDefault;
                                    }
                                    break;
                case 'array'    :
                case 'object'   :   $x2 = true;                         /* An object is true; so is an array (convention) */
                                    break;
            }   /* switch ( $szType ) */
        }   /* if ( ! is_null( $x ) ) */

        return ( $x2 );                                                 /* Return result to caller */
    }   /* End of function MISC_CastBool() ============================================ */


    public static function NUM_RoundMultiple( $n,$x )
    /*---------------------------------------------*/
    {
        return ( ceil($n)%$x === 0) ? floor($n) : round(($n+$x/2)/$x)*$x;
    }   /* End of function NUM_RoundMultiple() ======================================== */


    public static function STR_Ascii2( $szStr )
    /*---------------------------------------*/
    {
        $iRetVal    = 0;                                                /* Return value of the function */
        $iLength = strlen( $szStr );                                    /* Length of the string */

        for ( $i = 0;$i < $iLength;$i++ )                               /* For each character of the string */
        {
            $iRetVal += ( ord( $szStr[$i] ) * $i );                     /* Sum ASCII values */
        }   /* for ( $i = 0;$i < $iLength;$i++ ) */

        return ( $iRetVal );                                            /* Return result to caller */
    }   /* == End of vaesoli.STR_Ascii2() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_Eliminate( $szStr,$szCharList )=

        Eliminates all characters of $szCharList from $szStr

        {*params
            $szStr      (string)    The string to process
            $szCharList (string)    The list of characters to get rid of
        *}

        {*return
            (string)        $szStr amputated from all chars found in $szCharList
        *}

        {*exec
            $szStr   = "Hello World\nIs All OK?\r\nHave you seen Henry?";
            $iLength = strlen( $szStr);
            echo '<p>Length was: '                          ,
                     $iLength                               ,
                     '<br />'                               ,
                     $szStr = STR_Eliminate( $szStr,"\r\n" ),
                     '<br />New length is: '                ,
                     $iLength = strlen( $szStr )            ,
                     "</p>\n";
            echo LSUnitTesting::assert( $iLength === 41                                     ,
                                        'ASSERTION SUCCESSFUL: correct length for $szStr'   ,
                                        'ASSERTION FAILURE: incorrect length for $szStr'    ,
                                        'GuideAssert' );
        *}

        {*seealso
            STR_Keep()
        *}

        *}}
     */
    /* ================================================================================ */
    public static function STR_Eliminate( $szStr,$szCharList )
    /*------------------------------------------------------*/
    {
        $iPos       = 0;                                                /* Current position */
        $iLength    = strlen( $szStr );                                 /* Length fo string to process */
        $szRetVal   = '';                                               /* Return value of the function */

        while ( $iPos < $iLength )                                      /* While we haven't treated the whole source code */
        {
            if ( self::STR_Pos( $szCharList,($c = $szStr[$iPos++]) ) == -1 )  /* Character we just read */
            {
                $szRetVal .= $c;                                        /* Add it to the return value */
            }
        }   /* while ( $iPos < $iLength ) */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* == End of vaesoli.STR_Eliminate() ========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_SquareBracketsToAngleBrackets( $szText )=

        Turns square brackets to angle brackets

        {*params
            $szText     (string)    Text to process
        *}

        {*return
            (string)    Square brackets turned to angle brackets
        *}

        {*cdate 22/09/2013 *}
        {*version 5.6.0000 *}
        {*author {PYB} *}
        {*mdate 14/09/2014 h1,h2,h3 support *}

        {*alias STR_FromSquareBracketsToAngleBrackets()
        *}

        {*assert
            STR_SquareBracketsToAngleBrackets( '[ol][li]...[/li][/ol]' ) === '<ol><li>...</li></ol>'
        *}

        {*assert
            STR_SquareBracketsToAngleBrackets( '[h1][/h1]' ) === '<h1></h1>'
        *}

        {*assert
            STR_SquareBracketsToAngleBrackets( '[h2][/h2]' ) === '<h2></h2>'
        *}

        {*assert
            STR_SquareBracketsToAngleBrackets( '[h3][/h3]' ) === '<h3></h3>'
        *}

        {*seealso
            STR_AngleBracketsToSquareBrackets()
        *}

        *}}
     */
    /* ================================================================================ */
    public static function STR_SquareBracketsToAngleBrackets( $szText )
    /*---------------------------------------------------------------*/
    {
        return ( str_replace( array( '[br]'  ,'[hr]'  ,'[p]' ,'[/p]' ,'[b]'     ,'[/b]'     ,'[q]','[/q]','[i]' ,'[/i]' ,'<br>'  ,'[h1]','[/h1]','[h2]','[/h2]','[h3]','[/h3]','[ul]','[/ul]','[ol]','[/ol]','[li]','[/li]','[url]' ,'[/url]'  )   ,
                              array( '<br />','<hr />','<p>' ,'</p>' ,'<strong>','</strong>','<q>','</q>','<em>','</em>','<br />','<h1>','</h1>','<h2>','</h2>','<h3>','</h3>','<ul>','</ul>','<ol>','</ol>','<li>','</li>','[http]','[/http]' )   ,
                              $szText ) );
    }   /* End of vaesoli.STR_SquareBracketsToAngleBrackets() ========================= */
    public static function STR_FromSquareBracketsToAngleBrackets( $szText )   { return ( self::STR_SquareBracketsToAngleBrackets( $szText ) ); }
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*STR_AngleBracketsToSquareBrackets( $szText )=

        Turns angle brackets to square brackets

        {*params
            $szText     (string)    Text to process
        *}

        {*return
            (string)    Angle brackets turned to square brackets
        *}

        {*cdate 22/09/2013 *}
        {*version 5.6.0000 *}
        {*author {PYB} *}
        {*mdate 14/09/2014 h1,h2,h3 support *}

        {*alias
            STR_FromAngleBracketsToSquareBrackets()
        *}

        {*assert
            STR_AngleBracketsToSquareBrackets( '<ol><li>...</li></ol>' ) === '[ol][li]...[/li][/ol]'
        *}

        {*assert
            STR_SquareBracketsToAngleBrackets( '<h1></h1>' ) === '[h1][/h1]'
        *}

        {*assert
            STR_SquareBracketsToAngleBrackets( '<h2></h2>' ) === '[h2][/h2]'
        *}

        {*assert
            STR_SquareBracketsToAngleBrackets( '<h3></h3>' ) === '[h3][/h1]'
        *}

        {*seealso
            STR_SquareBracketsToAngleBrackets()
        *}

        *}}
     */
    /* ================================================================================ */
    public static function STR_AngleBracketsToSquareBrackets( $szText )
    /*-------------------------------------------------*/
    {
        return ( str_replace( array( '<br />','<hr />','<p>' ,'</p>', '<strong>','</strong>','<q>','</q>','<em>','</em>','<br />','<h1>','</h1>','<h2>','</h2>','<h3>','</h3>','<ul>','</ul>','<ol>','</ol>','<li>','</li>','[http]','[/http]' )   ,
                              array( '[br]'  ,'[hr]'  ,'[p]' ,'[/p]', '[b]'     ,'[/b]'     ,'[q]','[/q]','[i]' ,'[/i]' ,'<br>'  ,'[h1]','[/h1]','[h2]','[/h2]','[h3]','[/h3]','[ul]','[/ul]','[ol]','[/ol]','[li]','[/li]','[url]' ,'[/url]'  )   ,
                              $szText ) );
    }   /* End of vaesoli.STR_AngleBracketsToSquareBrackets() ========================= */
    public static function STR_FromAngleBracketsToSquareBrackets( $szText ) { return ( self::STR_AngleBracketsToSquareBrackets( $szText ) ); }
    /* ================================================================================ */


    public static function STR_DetectLanguage( &$szText,$szDefault = '?',$iCount = 50 )
    /*-------------------------------------------------------------------------------*/
    {
        //https://en.m.wikipedia.org/wiki/Most_common_words_in_English
        //http://www.101languages.net/dutch/most-common-dutch-words/
        //http://wortschatz.uni-leipzig.de/Papers/top100de.txt
        //http://netia59a.ac-lille.fr/va.anzin/IMG/pdf/mots_les_plus_frequents.pdf
        //https://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/
        //https://fr.wiktionary.org/wiki/Wiktionnaire:Listes_de_fr%C3%A9quence

        $aLanguages = array( 'ca','cs','de','en','es','fr','it','nl','pt' );

        {   /* Catalan - 200 - https://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Catalan/1-2000 */
            include( 'catalan-words.php' );
        }

        {   /* Czech - 200 - https://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Czech_wordlist */
            include( 'czech-words.php' );
        }

        {   /* German - 200 - https://fr.wiktionary.org/wiki/Wiktionnaire:Listes_de_fr%C3%A9quence/wortschatz-de-1-2000 */
            include( 'german-words.php' );
        }

        {   /* English - 200 - https://en.m.wikipedia.org/wiki/Most_common_words_in_English */
            include( 'english-words.php' );
        }

        {   /* Spanish - 200 - https://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Spanish1000 */
            include( 'spanish-words.php' );
        }

        {   /* French - 200 - https://fr.wiktionary.org/wiki/Wiktionnaire:Listes_de_fr%C3%A9quence/wortschatz-fr-1-2000 */
            include( 'french-words.php' );
        }

        {   /* Italian - 200 - https://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Italian1000 */
            include( 'italian-words.php' );
        }

        {   /* Dutch - 200 - https://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Dutch_wordlist */
            include( 'dutch-words.php' );
        }

        {   /* Portuguese - 200 - https://en.wiktionary.org/wiki/Wiktionary:Frequency_lists/Portuguese_wordlist */
            include( 'portuguese-words.php' );
        }


        // count the occurrences of the most frequent words
        foreach ( $aLanguages as $szLang )
        {
            $counter[$szLang] = 0;
        }

        //$iLimit = count( $aWords['es'] );
        $iLimit = min( $iCount,count( $aWords['ca'] ) );

        for ( $i = 0; $i < $iLimit; $i++ )
        {
            foreach ( $aLanguages as $szLang )
            {
                $counter[$szLang] += substr_count( $szText,' ' . $aWords[$szLang][$i] . ' ' );
            }
        }

        //foreach ( $aLanguages as $szLang )
        //{
        //    var_dump( $counter[$szLang] );
        //}

        // get max counter value
        // from http://stackoverflow.com/a/1461363
        $iMaxMatches = max( $counter );

        //var_dump( $iMaxMatches );

        $aWinningLanguages = array_keys( $counter,$iMaxMatches );
        //var_dump( $aWinningLanguages );

        if ( count( $aWinningLanguages ) > 0 )
        {
            //var_dump( $aWinningLanguages );
            return( $szWinner = $aWinningLanguages[0] );
            //$second = 0;
            //echo "<p>On a un gagnant et c'est {$szWinner}</p>";
            //
            //// get runner-up (second place)
            //foreach ( $aLanguages as $szLang )
            //{
            //    if ( $szLang <> $szWinner )
            //    {
            //        if ( $counter[$szLang] > $second )
            //        {
            //            $second = $counter[$szLang];
            //        }
            //    }
            //}
            //
            //echo "<p>Le second est {$second}</p>";
            //
            //
            //
            //// apply arbitrary threshold of 10%
            //if ( ( $second / $max ) < 0.1 )
            //{
            //    return ( $szWinner );
            //}
        }

        return ( $szDefault );
    }   /* == End of vaesoli.STR_DetectLanguage() ===================================== */
    /* ================================================================================ */

    public static function isdigit( $c )
    /*--------------------------------*/
    {
        $c = (string) $c;
        return ( ! ( $c < '0' || $c > '9' ) );
    }   /* == End of vaesoli.isdigit() ================================================ */
    /* ================================================================================ */


    public static function STR_dionly( $szStr )
    /*---------------------------------------*/
    {
        $szRetVal   = '';                                               /* Return value of the function */
        $iLen       = strlen( $szStr );                                 /* Length of string */

        for( $i=0;$i<$iLen;$i++ )                                       /* For each char in string */
        {
            $c = $szStr[$i];                                            /* Get the character */

            if ( self::isdigit( $c ) )                                  /* If that's a digit */
            {
                $szRetVal .= $c;                                        /* Concatenate in result */
            }   /* if ( isdigit( $c ) ) */
        }   /* for( $i=0;$i<$iLen;$i++ ) */

        return ( $szRetVal );                                           /* Return result to caller */
    }   /* End of vaesoli.STR_dionly() ================================================ */
    /* ================================================================================ */


    public static function STR_padl( $szStr,$iLength,$szPadding = ' ' )
    /*---------------------------------------------------------------*/
    {
        return ( str_pad( (string) $szStr,$iLength,$szPadding,STR_PAD_LEFT ) );
    }   /* End of vaesoli.STR_padl() ================================================== */
    /* ================================================================================ */


    public static function STR_padr( $szStr,$iLength,$szPadding = ' ' )
    /*---------------------------------------------------------------*/
    {
        return ( str_pad( (string) $szStr,$iLength,$szPadding,STR_PAD_RIGHT ) );
    }   /* End of vaesoli.STR_padr() ============================================== */
    /* ============================================================================ */


    public static function STR_Hexa( $szStr )
    /*-------------------------------------*/
    {
        $iLength  = strlen( $szStr );
        $szResult = '';

        for ( $i=0;$i < $iLength;$i++ )
        {
            $szResult  .= sprintf( '%02x',ord( $szStr[$i] ) );
        }

        return ( $szResult );
    }   /* == End of vaesoli.STR_Hexa() =========================================== */
    /* ============================================================================ */


    /* ============================================================================ */
    /** {{*STR_htos( $szStr )=

        Opposite function to [c]STR_hexa()[/c]

        {*params
            $szStr      (string)    Hex values turned to a string equivalent
        *}

        {*return
            (string)    $szStr is transformed into a string equivalent
        *}

        {*exec
            echo $szStr = STR_htos( STR_hexa( "Hello World" ) );
        *}

        {*assert STR_htos( STR_Hexa( $szStr = "Hello World" ) ) === $szStr *}

        {*mdate 22-04-14 19:55:11 *}

        {*seealso
            STR_hexa()
        *}

        *}}
     */
    /* ========================================================================== */
    public static function STR_htos( $szStr )
    /*-------------------------------------*/
    {
        $iLength  = strlen( $szStr );
        $szResult = '';

        for ( $i=0;$i < $iLength;$i += 2 )
        {
            $szResult .= chr( hexdec( substr( $szStr,$i,2 ) ) );
        }

        return ( $szResult );
    }   /* == End of function STR_htos() ============================================== */
    /* ================================================================================ */


    public static function STR_Password( $iLength = 8 ) : string
    /*--------------------------------------------------------*/
    {
        $szPassword = '';

        while ( strlen( $szPassword ) < $iLength )
        {
            if ( $iEven = ( random_int( 1,10 ) % 2 === 0 ) )
                $c = chr( random_int( 33,90 ) );
            else
                $c = chr( mt_rand( 97,126) );

            if ( $c !== '"' && $c !== "'" && $c !== '.' && $c !== '<' && $c !== '>' )
                $szPassword .= $c;
        }   /* while ( strlen( $szPassword ) < $iLength ) */
        
        return ( $szPassword );
    }   /* == End of function STR_password() ========================================== */
    /* ================================================================================ */


    public static function STR_Phonetique( $sIn,$iLength = 16 )
    /*-------------------------------------------------------*/
    {
        $accents = array( 'É' => 'E','È' => 'E','Ë' => 'E','Ê' => 'E','Á' => 'A','À' => 'A','Ä' => 'A'  ,'Â' => 'A',
        				  'Å' => 'A','Ã' => 'A','Æ' => 'E','Ï' => 'I','Î' => 'I','Ì' => 'I','Í' => 'I'  ,
        				  'Ô' => 'O','Ö' => 'O','Ò' => 'O','Ó' => 'O','Õ' => 'O','Ø' => 'O','Œ' => 'OEU',
        				  'Ú' => 'U','Ù' => 'U','Û' => 'U','Ü' => 'U','Ñ' => 'N','Ç' => 'S','¿' => 'E' );

        $min2maj = array( 'é' => 'É','è' => 'È','ë' => 'Ë','ê' => 'Ê','á' => 'Á','â' => 'Â','à' => 'À'  ,'Ä' => 'A',
        				  'Â' => 'A','å' => 'Å','ã' => 'Ã','æ' => 'Æ','ï' => 'Ï','î' => 'Î','ì' => 'Ì'  ,'í' => 'Í',
        				  'ô' => 'Ô','ö' => 'Ö','ò' => 'Ò','ó' => 'Ó','õ' => 'Õ','ø' => 'Ø','œ' => 'Œ'  ,
        				  'ú' => 'Ú','ù' => 'Ù','û' => 'Û','ü' => 'Ü','ç' => 'Ç','ñ' => 'Ñ','ß' => 'S' );


        //$sIn = utf8_decode($sIn);                         // Selon votre implémentation, vous aurez besoin de décoder ce qui arrive pour les caractères spéciaux
        $sIn    = strtr( $sIn,$min2maj );                   // minuscules accentuées ou composées en majuscules simples
        $sIn    = strtr( $sIn,$accents );                   // majuscules accentuées ou composées en majuscules simples
        $sIn    = strtoupper( $sIn );                       // on passe tout le reste en majuscules
        $sIn    = preg_replace( '`[^A-Z]`','',$sIn );       // on garde uniquement les lettres de A à Z

        $sBack  = $sIn;                                     // on sauve le code (utilisé pour les mots très courts)

        $sIn    = preg_replace( '`O[O]+`'       ,'OU'   ,$sIn ); 	// pré traitement OO... -> OU
        $sIn    = preg_replace( '`SAOU`'        ,'SOU'  ,$sIn ); 	// pré traitement SAOU -> SOU
        $sIn    = preg_replace( '`OES`'         ,'OS'   ,$sIn ); 	// pré traitement OES -> OS
        $sIn    = preg_replace( '`CCH`'         ,'K'    ,$sIn ); 		// pré traitement CCH -> K
        $sIn    = preg_replace( '`CC([IYE])`'   ,'KS$1' ,$sIn ); // CCI CCY CCE
        $sIn    = preg_replace( '`(.)\1`'       ,'$1'   ,$sIn ); 	// supression des répétitions

        // quelques cas particuliers
        if ( $sIn == 'CD'       )   return( $sIn    );
        if ( $sIn == 'BD'       )   return( $sIn    );
        if ( $sIn == 'BV'       )   return( $sIn    );
        if ( $sIn == 'TABAC'    )   return( 'TABA'  );
        if ( $sIn == 'FEU'      )   return( 'FE'    );
        if ( $sIn == 'FE'       )   return( $sIn    );
        if ( $sIn == 'FER'      )   return( $sIn    );
        if ( $sIn == 'FIEF'     )   return( $sIn    );
        if ( $sIn == 'FJORD'    )   return( $sIn    );
        if ( $sIn == 'GOAL'     )   return( 'GOL'   );
        if ( $sIn == 'FLEAU'    )   return( 'FLEO'  );
        if ( $sIn == 'HIER'     )   return( 'IER'   );
        if ( $sIn == 'HEU'      )   return( 'E'     );
        if ( $sIn == 'HE'       )   return( 'E'     );
        if ( $sIn == 'OS'       )   return( $sIn    );
        if ( $sIn == 'RIZ'      )   return( 'RI'    );
        if ( $sIn == 'RAZ'      )   return( 'RA'    );

        // pré-traitements
        $sIn = preg_replace( '`OIN[GT]$`', 'OIN', $sIn );									// terminaisons OING -> OIN
        $sIn = preg_replace( '`E[RS]$`', 'E', $sIn ); 										// supression des terminaisons infinitifs et participes pluriels
        $sIn = preg_replace( '`(C|CH)OEU`', 'KE', $sIn ); 									// pré traitement OEU -> EU
        $sIn = preg_replace( '`MOEU`', 'ME', $sIn ); 										// pré traitement OEU -> EU
        $sIn = preg_replace( '`OE([UI]+)([BCDFGHJKLMNPQRSTVWXZ])`', 'E$1$2', $sIn ); 		// pré traitement OEU OEI -> E
        $sIn = preg_replace( '`^GEN[TS]$`', 'JAN', $sIn );									// pré traitement GEN -> JAN
        $sIn = preg_replace( '`CUEI`', 'KEI', $sIn ); 										// pré traitement accueil
        $sIn = preg_replace( '`([^AEIOUYC])AE([BCDFGHJKLMNPQRSTVWXZ])`', '$1E$2', $sIn ); 	// pré traitement AE -> E
        $sIn = preg_replace( '`AE([QS])`', 'E$1', $sIn ); 									// pré traitement AE -> E
        $sIn = preg_replace( '`AIE([BCDFGJKLMNPQRSTVWXZ])`', 'AI$1', $sIn );				// pré-traitement AIE(consonne) -> AI
        $sIn = preg_replace( '`ANIEM`', 'ANIM', $sIn ); 									// pré traitement NIEM -> NIM
        $sIn = preg_replace( '`(DRA|TRO|IRO)P$`', '$1', $sIn ); 							// P terminal muet
        $sIn = preg_replace( '`(LOM)B$`', '$1', $sIn ); 									// B terminal muet
        $sIn = preg_replace( '`(RON|POR)C$`', '$1', $sIn ); 								// C terminal muet
        $sIn = preg_replace( '`PECT$`', 'PET', $sIn ); 										// C terminal muet
        $sIn = preg_replace( '`ECUL$`', 'CU', $sIn ); 										// L terminal muet
        $sIn = preg_replace( '`(CHA|CA|E)M(P|PS)$`', '$1N', $sIn ); 		 				// P ou PS terminal muet
        $sIn = preg_replace( '`(TAN|RAN)G$`', '$1', $sIn ); 			 					// G terminal muet


        // sons YEUX
        $sIn = preg_replace( '`([^VO])ILAG`', '$1IAJ', $sIn );
        $sIn = preg_replace( '`([^TRH])UIL(AR|E)(.+)`', '$1UI$2$3', $sIn );
        $sIn = preg_replace( '`([G])UIL([AEO])`', '$1UI$2', $sIn );
        $sIn = preg_replace( '`([NSPM])AIL([AEO])`', '$1AI$2', $sIn );
        $convMIn  = array("DILAI","DILON","DILER","DILEM","RILON","TAILE","GAILET","AILAI","AILAR",
        "OUILA","EILAI","EILAR","EILER","EILEM","REILET","EILET","AILOL" );
        $convMOut = array( "DIAI", "DION","DIER", "DIEM", "RION", "TAIE", "GAIET", "AIAI", "AIAR",
        "OUIA", "AIAI", "AIAR", "AIER", "AIEM",  "RAIET", "EIET", "AIOL" );
        $sIn = str_replace( $convMIn, $convMOut, $sIn );
        $sIn = preg_replace( '`([^AEIOUY])(SC|S)IEM([EA])`', '$1$2IAM$3', $sIn ); 	// IEM -> IAM
        $sIn = preg_replace( '`^(SC|S)IEM([EA])`', '$1IAM$2', $sIn ); 				// IEM -> IAM

        // MP MB -> NP NB
        $convMIn  = array( 'OMB', 'AMB', 'OMP', 'AMP', 'IMB', 'EMP','GEMB','EMB', 'UMBL','CIEN');
        $convMOut = array( 'ONB', 'ANB', 'ONP', 'ANP', 'INB', 'ANP','JANB','ANB', 'INBL','SIAN');
        $sIn = str_replace( $convMIn, $convMOut, $sIn );

        // Sons en K
        $sIn = preg_replace( '`^ECHO$`', 'EKO', $sIn ); 	// cas particulier écho
        $sIn = preg_replace( '`^ECEUR`', 'EKEUR', $sIn ); 	// cas particulier écœuré
        // Choléra Chœur mais pas chocolat!
        $sIn = preg_replace( '`^CH(OG+|OL+|OR+|EU+|ARIS|M+|IRO|ONDR)`', 'K$1', $sIn ); 				//En début de mot
        $sIn = preg_replace( '`(YN|RI)CH(OG+|OL+|OC+|OP+|OM+|ARIS|M+|IRO|ONDR)`', '$1K$2', $sIn ); 	//Ou devant une consonne
        $sIn = preg_replace( '`CHS`', 'CH', $sIn );
        $sIn = preg_replace( '`CH(AIQ)`', 'K$1', $sIn );
        $sIn = preg_replace( '`^ECHO([^UIPY])`', 'EKO$1', $sIn );
        $sIn = preg_replace( '`ISCH(I|E)`', 'ISK$1', $sIn );
        $sIn = preg_replace( '`^ICHT`', 'IKT', $sIn );
        $sIn = preg_replace( '`ORCHID`', 'ORKID', $sIn );
        $sIn = preg_replace( '`ONCHIO`', 'ONKIO', $sIn );
        $sIn = preg_replace( '`ACHIA`', 'AKIA', $sIn );			// retouche ACHIA -> AKIA
        $sIn = preg_replace( '`([^C])ANICH`', '$1ANIK', $sIn );	// ANICH -> ANIK 	1/2
        $sIn = preg_replace( '`OMANIK`', 'OMANICH', $sIn ); 	// cas particulier 	2/2
        $sIn = preg_replace( '`ACHY([^D])`', 'AKI$1', $sIn );
        $sIn = preg_replace( '`([AEIOU])C([BDFGJKLMNPQRTVWXZ])`', '$1K$2', $sIn ); // voyelle, C, consonne sauf H
        $convPrIn  = array('EUCHA','YCHIA','YCHA','YCHO','YCHED','ACHEO','RCHEO','RCHES',
        'ECHN','OCHTO','CHORA','CHONDR','CHORE','MACHM','BRONCHO','LICHOS','LICHOC');
        $convPrOut = array('EKA',  'IKIA', 'IKA', 'IKO',  'IKED','AKEO','RKEO',  'RKES',
        'EKN',  'OKTO', 'KORA', 'KONDR' ,'KORE' ,'MAKM', 'BRONKO', 'LIKOS', 'LIKOC');
        $sIn = str_replace( $convPrIn, $convPrOut, $sIn );

        // Weuh (perfectible)
        $convPrIn  = array( 'WA','WO', 'WI','WHI','WHY','WHA','WHO');
        $convPrOut = array( 'OI', 'O','OUI','OUI','OUI','OUA', 'OU');
        $sIn = str_replace( $convPrIn, $convPrOut, $sIn );

        // Gueu, Gneu, Jeu et quelques autres
        $convPrIn  = array( 'GNES','GNET','GNER','GNE',  'GI', 'GNI','GNA','GNOU','GNUR','GY','OUGAIN',
        'AGEOL', 'AGEOT','GEOLO','GEOM','GEOP','GEOG','GEOS','GEORG','GEOR','NGEOT','UGEOT','GEOT','GEOD','GEOC','GEO','GEA','GE',
        'QU', 'Q',  'CY', 'CI', 'CN','ICM','CEAT','CE',
        'CR', 'CO', 'CUEI','CU', 'VENCA','CA', 'CS','CLEN','CL', 'CZ', 'CTIQ',
        'CTIF','CTIC','CTIS','CTIL','CTIO','CTI', 'CTU', 'CTE','CTO','CTR','CT', 'PH', 'TH',
        'OW', 'LH', 'RDL', 'CHLO', 'CHR', 'PTIA');
        $convPrOut = array( 'NIES','NIET','NIER', 'NE',  'JI',  'NI','NIA','NIOU','NIUR','JI','OUGIN',
        'AJOL',  'AJOT','JEOLO','JEOM','JEOP','JEOG','JEOS','JORJ','JEOR','NJOT','UJOT','JEOT','JEOD','JEOC', 'JO','JA' ,'JE',
        'K', 'K',  'SI', 'SI', 'KN','IKM', 'SAT','SE',
        'KR', 'KO', 'KEI','KU', 'VANSA','KA', 'KS','KLAN','KL', 'KZ', 'KTIK',
        'KTIF','KTIS','KTIS','KTIL','KSIO','KTI', 'KTU', 'KTE','KTO','KTR','KT', 'F',  'T',
        'OU',  'L',  'RL',  'KLO',  'KR', 'PSIA');
        $sIn = str_replace( $convPrIn, $convPrOut, $sIn );

        $sIn = preg_replace( '`GU([^RLMBSTPZN])`', 'G$1', $sIn ); // Gueu !
        $sIn = preg_replace( '`GNO([MLTNRKG])`', 'NIO$1', $sIn ); // GNO ! Tout sauf S pour gnos
        $sIn = preg_replace( '`GNO([MLTNRKG])`', 'NIO$1', $sIn ); // bis -> gnognotte! Si quelqu'un sait le faire en une seule regexp...


    // TI -> SI v2.0
    $convPrIn  = array( 'BUTIE','BUTIA','BATIA','ANTIEL','RETION','ENTIEL','ENTIAL','ENTIO','ENTIAI','UJETION','ATIEM','PETIEN',
    'CETIE','OFETIE','IPETI','LBUTION','BLUTION','LETION','LATION','SATIET');
    $convPrOut = array( 'BUSIE','BUSIA','BASIA','ANSIEL','RESION','ENSIEL','ENSIAL','ENSIO','ENSIAI','UJESION','ASIAM','PESIEN',
    'CESIE','OFESIE','IPESI','LBUSION','BLUSION','LESION','LASION','SASIET');
    $sIn = str_replace( $convPrIn, $convPrOut, $sIn );
    $sIn = preg_replace( '`(.+)ANTI(AL|O)`', '$1ANSI$2', $sIn ); // sauf antialcoolique, antialbumine, antialarmer, ...
    $sIn = preg_replace( '`(.+)INUTI([^V])`', '$1INUSI$2', $sIn ); // sauf inutilité, inutilement, diminutive, ...
    $sIn = preg_replace( '`([^O])UTIEN`', '$1USIEN', $sIn ); // sauf soutien, ...
    $sIn = preg_replace( '`([^DE])RATI[E]$`', '$1RASI$2', $sIn ); // sauf xxxxxcratique, ...
    // TIEN TION -> SIEN SION v3.1
    $sIn = preg_replace( '`([^SNEU]|KU|KO|RU|LU|BU|TU|AU)T(IEN|ION)`', '$1S$2', $sIn );


    // H muet
    $sIn = preg_replace( '`([^CS])H`', '$1', $sIn ); 	// H muet
    $sIn = str_replace( "ESH", "ES", $sIn );			// H muet
    $sIn = str_replace( "NSH", "NS", $sIn );			// H muet
    $sIn = str_replace( "SH", "CH", $sIn );				// ou pas!

    // NASALES
    $convNasIn  = array( 'OMT','IMB', 'IMP','UMD','TIENT','RIENT','DIENT','IEN',
    'YMU','YMO','YMA','YME', 'YMI','YMN','YM', 'AHO','FAIM','DAIM','SAIM','EIN','AINS');
    $convNasOut = array( 'ONT','INB', 'INP','OND','TIANT','RIANT','DIANT', 'IN',
    'IMU','IMO','IMA','IME', 'IMI','IMN','IN',  'AO', 'FIN','DIN', 'SIN','AIN','INS');
    $sIn = str_replace( $convNasIn, $convNasOut, $sIn );
    // AIN -> IN v2.0
    $sIn = preg_replace( '`AIN$`', 'IN', $sIn );
    $sIn = preg_replace( '`AIN([BTDK])`', 'IN$1', $sIn );
    // UN -> IN
    $sIn = preg_replace( '`([^O])UND`', '$1IND', $sIn ); // aucun mot français ne commence par UND!
    $sIn = preg_replace( '`([JTVLFMRPSBD])UN([^IAE])`', '$1IN$2', $sIn );
    $sIn = preg_replace( '`([JTVLFMRPSBD])UN$`', '$1IN', $sIn );
    $sIn = preg_replace( '`RFUM$`', 'RFIN', $sIn );
    $sIn = preg_replace( '`LUMB`', 'LINB', $sIn );
    // EN -> AN
    $sIn = preg_replace( '`([^BCDFGHJKLMNPQRSTVWXZ])EN`', '$1AN', $sIn );
    $sIn = preg_replace( '`([VTLJMRPDSBFKNG])EN([BRCTDKZSVN])`', '$1AN$2', $sIn ); // deux fois pour les motifs recouvrants malentendu, pendentif, ...
    $sIn = preg_replace( '`([VTLJMRPDSBFKNG])EN([BRCTDKZSVN])`', '$1AN$2', $sIn ); // si quelqu'un sait faire avec une seule regexp!
    $sIn = preg_replace( '`^EN([BCDFGHJKLNPQRSTVXZ]|CH|IV|ORG|OB|UI|UA|UY)`', 'AN$1', $sIn );
    $sIn = preg_replace( '`(^[JRVTH])EN([DRTFGSVJMP])`', '$1AN$2', $sIn );
    $sIn = preg_replace( '`SEN([ST])`', 'SAN$1', $sIn );
    $sIn = preg_replace( '`^DESENIV`', 'DESANIV', $sIn );
    $sIn = preg_replace( '`([^M])EN(UI)`', '$1AN$2', $sIn );
    $sIn = preg_replace( '`(.+[JTVLFMRPSBD])EN([JLFDSTG])`', '$1AN$2', $sIn );
    // EI -> AI
    $sIn = preg_replace( '`([VSBSTNRLPM])E[IY]([ACDFRJLGZ])`', '$1AI$2', $sIn );

    // Histoire d'Ô
    $convNasIn  = array( 'EAU', 'EU',  'Y', 'EOI', 'JEA','OIEM','OUANJ','OUA','OUENJ');
    $convNasOut = array(   'O',  'E',  'I',  'OI', 'JA' ,'OIM' ,'OUENJ', 'OI','OUANJ');
    $sIn = str_replace( $convNasIn, $convNasOut, $sIn );
    $sIn = preg_replace( '`AU([^E])`', 'O$1', $sIn ); // AU sans E qui suit

        // Les retouches!
        $sIn = preg_replace( '`^BENJ`'              ,'BINJ'     ,$sIn );				// retouche BENJ -> BINJ
        $sIn = preg_replace( '`RTIEL`'              ,'RSIEL'    ,$sIn );			// retouche RTIEL -> RSIEL
        $sIn = preg_replace( '`PINK`'               ,'PONK'     ,$sIn );				// retouche PINK -> PONK
        $sIn = preg_replace( '`KIND`'               ,'KOND'     ,$sIn );				// retouche KIND -> KOND
        $sIn = preg_replace( '`KUM(N|P)`'           ,'KON$1'    ,$sIn );			// retouche KUMN KUMP
        $sIn = preg_replace( '`LKOU`'               ,'LKO'      ,$sIn );				// retouche LKOU -> LKO
        $sIn = preg_replace( '`EDBE`'               ,'EBE'      ,$sIn );				// retouche EDBE pied-bœuf
        $sIn = preg_replace( '`ARCM`'               ,'ARKM'     ,$sIn );				// retouche SCH -> CH
        $sIn = preg_replace( '`SCH`'                ,'CH'       ,$sIn );					// retouche SCH -> CH
        $sIn = preg_replace( '`^OINI`'              ,'ONI'      ,$sIn );           // retouche début OINI -> ONI
        $sIn = preg_replace( '`([^NDCGRHKO])APT`'   ,'$1AT'     ,$sIn );	// retouche APT -> AT
        $sIn = preg_replace( '`([L]|KON)PT`'        ,'$1T'      ,$sIn );		// retouche LPT -> LT
        $sIn = preg_replace( '`OTB`'                ,'OB'       ,$sIn );					// retouche OTB -> OB (hautbois)
        $sIn = preg_replace( '`IXA`'                ,'ISA'      ,$sIn );				// retouche IXA -> ISA
        $sIn = preg_replace( '`TG`'                 ,'G'        ,$sIn );					// retouche TG -> G
        $sIn = preg_replace( '`^TZ`'                ,'TS'       ,$sIn );					// retouche début TZ -> TS
        $sIn = preg_replace( '`PTIE`'               ,'TIE'      ,$sIn );				// retouche PTIE -> TIE
        $sIn = preg_replace( '`GT`'                 ,'T'        ,$sIn );					// retouche GT -> T
        $sIn = str_replace(  "ANKIEM"               ,"ANKILEM"  ,$sIn );			// retouche tranquillement
        $sIn = preg_replace( "`(LO|RE)KEMAN`", "$1KAMAN", $sIn );	// KEMAN -> KAMAN
        $sIn = preg_replace( '`NT(B|M)`', 'N$1', $sIn );			// retouche TB -> B  TM -> M
        $sIn = preg_replace( '`GSU`', 'SU', $sIn );					// retouche GS -> SU
        $sIn = preg_replace( '`ESD`', 'ED', $sIn );					// retouche ESD -> ED
        $sIn = preg_replace( '`LESKEL`','LEKEL', $sIn );			// retouche LESQUEL -> LEKEL
        $sIn = preg_replace( '`CK`', 'K', $sIn );					// retouche CK -> K

        // Terminaisons
        $sIn = preg_replace( '`USIL$`', 'USI', $sIn ); 				// terminaisons USIL -> USI
        $sIn = preg_replace( '`X$|[TD]S$|[DS]$`', '', $sIn );		// terminaisons TS DS LS X T D S...  v2.0
        $sIn = preg_replace( '`([^KL]+)T$`', '$1', $sIn );			// sauf KT LT terminal
        $sIn = preg_replace( '`^[H]`', '', $sIn );					// H pseudo muet en début de mot, je sais, ce n'est pas une terminaison
        $sBack2=$sIn;												// on sauve le code (utilisé pour les mots très courts)
        $sIn = preg_replace( '`TIL$`', 'TI', $sIn );				// terminaisons TIL -> TI
        $sIn = preg_replace( '`LC$`', 'LK', $sIn );					// terminaisons LC -> LK
        $sIn = preg_replace( '`L[E]?[S]?$`', 'L', $sIn );			// terminaisons LE LES -> L
        $sIn = preg_replace( '`(.+)N[E]?[S]?$`', '$1N', $sIn );		// terminaisons NE NES -> N
        $sIn = preg_replace( '`EZ$`', 'E', $sIn );					// terminaisons EZ -> E
        $sIn = preg_replace( '`OIG$`', 'OI', $sIn );				// terminaisons OIG -> OI
        $sIn = preg_replace( '`OUP$`', 'OU', $sIn );				// terminaisons OUP -> OU
        $sIn = preg_replace( '`([^R])OM$`', '$1ON', $sIn );			// terminaisons OM -> ON sauf ROM
        $sIn = preg_replace( '`LOP$`', 'LO', $sIn );				// terminaisons LOP -> LO
        $sIn = preg_replace( '`NTANP$`', 'NTAN', $sIn );			// terminaisons NTANP -> NTAN
        $sIn = preg_replace( '`TUN$`', 'TIN', $sIn );				// terminaisons TUN -> TIN
        $sIn = preg_replace( '`AU$`', 'O', $sIn );					// terminaisons AU -> O
        $sIn = preg_replace( '`EI$`', 'AI', $sIn );					// terminaisons EI -> AI
        $sIn = preg_replace( '`R[DG]$`', 'R', $sIn );				// terminaisons RD RG -> R
        $sIn = preg_replace( '`ANC$`', 'AN', $sIn );				// terminaisons ANC -> AN
        $sIn = preg_replace( '`KROC$`', 'KRO', $sIn );				// terminaisons C muet de CROC, ESCROC
        $sIn = preg_replace( '`HOUC$`', 'HOU', $sIn );				// terminaisons C muet de CAOUTCHOUC
        $sIn = preg_replace( '`OMAC$`', 'OMA', $sIn );				// terminaisons C muet de ESTOMAC (mais pas HAMAC)
        $sIn = preg_replace( '`([J])O([NU])[CG]$`', '$1O$2', $sIn );// terminaisons C et G muet de OUC ONC OUG
        $sIn = preg_replace( '`([^GTR])([AO])NG$`', '$1$2N', $sIn );// terminaisons G muet ANG ONG sauf GANG GONG TANG TONG
        $sIn = preg_replace( '`UC$`', 'UK', $sIn );					// terminaisons UC -> UK
        $sIn = preg_replace( '`AING$`', 'IN', $sIn );				// terminaisons AING -> IN
        $sIn = preg_replace( '`([EISOARN])C$`', '$1K', $sIn );		// terminaisons C -> K
        $sIn = preg_replace( '`([ABD-MO-Z]+)[EH]+$`', '$1', $sIn );	// terminaisons E ou H sauf pour C et N
        $sIn = preg_replace( '`EN$`', 'AN', $sIn );					// terminaisons EN -> AN (difficile à faire avant sans avoir des soucis) Et encore, c'est pas top!
        $sIn = preg_replace( '`(NJ)EN$`', '$1AN', $sIn );			// terminaisons EN -> AN
        $sIn = preg_replace( '`^PAIEM`', 'PAIM', $sIn ); 			// PAIE -> PAI
        $sIn = preg_replace( '`([^NTB])EF$`', '\1', $sIn );			// F muet en fin de mot

        $sIn = preg_replace( '`(.)\1`', '$1', $sIn ); 				// supression des répétitions (suite à certains remplacements)

        // cas particuliers, bah au final, je n'en ai qu'un ici
        $convPartIn  = array( 'FUEL');
        $convPartOut = array( 'FIOUL');
        $sIn = str_replace( $convPartIn, $convPartOut, $sIn );

        // Ce sera le seul code retourné à une seule lettre!
        if ($sIn=='O') return($sIn);

        // seconde chance sur les mots courts qui ont souffert de la simplification
        if (strlen($sIn)<2)
        {
        	// Sigles ou abréviations
        	if (preg_match("`[BCDFGHJKLMNPQRSTVWXYZ][BCDFGHJKLMNPQRSTVWXYZ][BCDFGHJKLMNPQRSTVWXYZ][BCDFGHJKLMNPQRSTVWXYZ]*`",$sBack))
        		return($sBack);

        	if (preg_match("`[RFMLVSPJDF][AEIOU]`",$sBack))
        	{
        		if (strlen($sBack)==3)
        			return(substr($sBack,0,2));// mots de trois lettres supposés simples
        		if (strlen($sBack)==4)
        			return(substr($sBack,0,3));// mots de quatre lettres supposés simples
        	}

        	if (strlen($sBack2)>1) return $sBack2;
        }

    if ( strlen( $sIn ) > 1 )
    	return ( substr( $sIn,0,$iLength ) ); // Je limite à 16 caractères mais vous faites comme vous voulez!
    else
    	return '';
    }   /* == End of vaesoli.STR_Phonetique() ========================================= */
    /* ================================================================================ */


    public static function STR_iPos( $szStr,$szSubStr,$iStart = 0 )
    /*-----------------------------------------------------------*/
    {
        $iPos = stripos( $szStr,$szSubStr,$iStart );
        return ( $iPos === false ? -1 : $iPos );
    }   /* End of vaesoli.STR_iPos() ================================================== */
    /* ================================================================================ */

    /* ================================================================================ */
    /** {{*empty( $x )=

        Determine whether a variable is empty

        {*params
            $x          (mixed)     Variable to be checked
        *}

        {*return
            (bool)      Returns [c]false[/c] if @param.x exists and has a non-empty,
                        non-zero value, aka falsey. Otherwise returns [c]true[/c]
        *}

        {*assert
            v::empty( null ) == true
        *}

        {*assert
            v::empty( 0 ) == true
        *}

        {*assert
            v::empty( false ) == true
        *}

        {*assert
            v::empty( true ) == false
        *}

        {*assert
            v::empty( '' ) == true
        *}

        {*assert
            v::empty( '0' ) == false
        *}

        {*remark
            The retun value of v::empty( '0' ) yields a [c]false[/c] to the 
            contrary of PHP.
        *}

        {*example
            var_dump( v::empty( null  ),empty( null  ) );  // Expecting: true            
            var_dump( v::empty( 0     ),empty( 0     ) );  // Expecting: true
            var_dump( v::empty( false ),empty( false ) );  // Expecting: true
            var_dump( v::empty( true  ),empty( true  ) );  // Expecting: false 
            var_dump( v::empty( ''    ),empty( ''    ) );  // Expecting: true 
            var_dump( v::empty( '0'   ),empty( '0'   ) );  // Expecting: false (PHP returns true!)
            var_dump( v::empty( ' 0'  ),empty( ' 0'  ) );  // Expecting: false
            var_dump( v::empty( '0 '  ),empty( '0 '  ) );  // Expecting: false
            var_dump( v::empty( ' 0 ' ),empty( ' 0 ' ) );  // Expecting: false
        *}

        *}}
     */
    /* ================================================================================ */
    public static function empty( $x )
    /*------------------------------*/
    {
        return ( $x !== '0' && empty( $x ) );
    }   /* End of vaesoli.empty() ===================================================== */
    /* ================================================================================ */

    /* ================================================================================ */
    /** {{*STR_Reduce2( $szStr )=

        Reduces consecutive occurrences of the same character to only 1 occurrence

        {*params
            $szStr      (string)    string to process
        *}

        {*return
            (string)   resulting string
        *}

        {*assert
            trim( STR_Reduce2( STR_Replicate( "     Hello     ",5 ),' ' ) ) === "Hello Hello Hello Hello Hello"
        *}

        {*assert
            STR_Reduce2( "Hello",'l' ) === "Helo"
        *}

        {*assert
            STR_Reduce2( "c://somedir//somefolder//hello.txt",'/' ) === "c:/somedir/somefolder/hello.txt"
        *}

        {*example
            echo '"' . trim( STR_Reduce2( STR_Replicate( "     Hello     ",5 ),' ' ) ) . '"';
        *}

        {*seealso
            STR_Replicate(), STR_Reduce()
        *}
        *}}
     */
    /* ================================================================================ */
    public static function STR_Reduce2( $szStr )
    /*----------------------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the function */
        $cPrev = '';

        if ( ! self::empty( $szStr ) )                                    /* If strings not empty */
        {
            $szStr = mb_convert_encoding( trim( $szStr ),'Windows-1252' );

            $iLen = strlen( $szStr );

            for ( $i = 0; $i < $iLen; $i++ )
            {
                if ( ( $c = $szStr[$i] ) != $cPrev )
                {
                    $szRetVal .= $c;
                }   /* if ( ( $c = $szStr[$i] ) != $cPrev ) */
            }   /* for ( $i = 0; $i < $iLen; $i++ ) */
        }   /* if ( ! STR_Empty( $szStr ) && ! STR_Empty( $cChar ) ) */

        return ( mb_convert_encoding( $szRetVal,'UTF-8','Windows-1252' ) ); /* Return result to caller */
    }   /* End of vaesoli.STR_Reduce2() =============================================== */
    /* ================================================================================ */


    public static function STR_SoundexFr( $szStr,$bDebug = false )
    /*----------------------------------------------------------*/
    {
        if ( ! self::STR_Empty( $szStr ) )
        {
            if ( $bDebug )
            {
                echo "<p>START OF ALGORITHM</p>\n";

                echo "<pre>\n";
                echo $szStr;
                echo "</pre>\n";
            }

            $szStr  = strtoupper( self::STR_Eliminate( mb_convert_encoding( self::STR_stripAccents( trim( $szStr ) ),'Windows-1252' ),'- ' ) );

            if ( $bDebug )
            {
                echo "<p>START SEQUENCE</p>\n";
                echo "<p>1) Éliminer les blancs à droite et à gauche du nom</p>\n";
                echo "<p>2) Convertir le nom en majuscule</p>\n";
                echo "<p>3) Convertir les lettres accentuées et le c cédille en lettres non accentuées</p>\n";
                echo "<p>4) Eliminer les blancs et les tirets</p>\n";

                echo "<pre>\n";
                echo $szStr;
                echo "</pre>\n";
            }

            $szStr  = str_replace( array( "GUI",     /* 01 */
                                          "GUE",     /* 02 */
                                          "GA" ,     /* 03 */
                                          "GO" ,     /* 04 */
                                          "GU" ,     /* 05 */
                                          "CA" ,     /* 06 */
                                          "CO" ,     /* 07 */
                                          "CU" ,     /* 08 */
                                          "Q"  ,     /* 09 */
                                          "CC" ,     /* 10 */
                                          "CK" ),    /* 11 */
                                   array( "KI" ,     /* 01 */
                                          "KE" ,     /* 02 */
                                          "KA" ,     /* 03 */
                                          "KO" ,     /* 04 */
                                          "K"  ,     /* 05 */
                                          "KA" ,     /* 06 */
                                          "KO" ,     /* 07 */
                                          "KU" ,     /* 08 */
                                          "K"  ,     /* 09 */
                                          "K"  ,     /* 10 */
                                          "K" ),     /* 11 */
                                    $szStr );
            if ( $bDebug )
            {
                echo "<p>START SEQUENCE</p>\n";
                echo "<p>5) Remplacer les groupes de lettres suivantes par leur correspondance (en conservant l'ordre du tableau)</p>\n";
                echo "<p> - GUI ... KI</p>\n";
                echo "<p> - GUE ... KE</p>\n";
                echo "<p> - GA  ... KA</p>\n";
                echo "<p> - GO  ... KO</p>\n";
                echo "<p> - GU  ... K</p>\n";
                echo "<p> - CA  ... KA</p>\n";
                echo "<p> - CO  ... KO</p>\n";
                echo "<p> - CU  ... KU</p>\n";
                echo "<p> - Q   ... K</p>\n";
                echo "<p> - CC  ... K</p>\n";
                echo "<p> - CK  ... K</p>\n";

                echo "<pre>\n";
                echo $szStr;
                echo "</pre>\n";
            }

            if ( ! self::empty( $szStr ) && isset( $szStr[0] ) )
            {
                $szStr = $szStr[0] . str_replace( array( 'E','I','O','U' ),'A',substr( $szStr,1 ) );

                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>6) Remplacer toutes les voyelles sauf le Y par A exceptée la première lettre</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }

                // All replaced by 1 call:
                //$szStr  = preg_replace( '/\AMAC/sim'      ,'MCC',$szStr );
                //$szStr  = preg_replace( '/\ASCH/sim'      ,'SSS',$szStr );
                //$szStr  = preg_replace( '/\AASA/sim'      ,'AZA',$szStr );
                //$szStr  = preg_replace( '/\AKN/sim'       ,'NN' ,$szStr );
                //$szStr  = preg_replace( '/\A(PH|PF)/sim'  ,'FF' ,$szStr );

                $szStr  = preg_replace( array( '/\AMAC/sim'      ,
                                               '/\ASCH/sim'      ,
                                               '/\AASA/sim'      ,
                                               '/\AKN/sim'       ,
                                               '/\A(PH|PF)/sim' ),
                                        array( 'MCC'             ,
                                               'SSS'             ,
                                               'AZA'             ,
                                               'NN'              ,
                                               'FF' ),
                                        $szStr );
                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>7) Remplacer les préfixes suivants par leur correspondance :</p>\n";
                    echo "<p> - MAC ... MCC</p>\n";
                    echo "<p> - ASA ... AZA  (ASAmian)</p>\n";
                    echo "<p> - KN  ... NN   (KNight)</p>\n";
                    echo "<p> - PF  ... FF   (PFeiffer)</p>\n";
                    echo "<p> - SCH ... SSS  (SCHindler)</p>\n";
                    echo "<p> - PH  ... FF   (PHilippe)</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }

                // Replace all H with '', except if preceded by S or C
                $szStr  = preg_replace( '/(?<!(S|C))H/si','',$szStr );
                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>8) Supprimer les H sauf s'ils sont précédés par S ou C</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }

                // Replace all Y with '', except if preceded by A
                $szStr  = preg_replace( '/(?<!(A))Y/si','',$szStr );
                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>9) Supprimer les Y sauf s'il est précédé d'un A</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }

                // Remove A D T S at the end of the string
                $szStr  = preg_replace( '/(A|D|T|S)\z/si','',$szStr );
                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>10) Supprimer les terminaisons suivantes A, T, D et S</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }

                // Remove all A except at the start of the string
                $szStr  = preg_replace( '/(?!^)A/si','',$szStr );
                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>11) Enlever tous les A sauf le A de tête s'il y en a un</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }

                $szStr  = self::STR_Reduce2( $szStr );
                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>12) Enlever toutes les sous chaînes de lettres répétitives</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }

                $szStr  = str_pad( $szStr,4 );
                if ( $bDebug )
                {
                    echo "<p>START SEQUENCE</p>\n";
                    echo "<p>13) Conserver les 4 premiers caractères du mot et si besoin le compléter avec des blancs pour obtenir 4 caractères</p>\n";

                    echo "<pre>\n";
                    echo $szStr;
                    echo "</pre>\n";
                }
            }
        }

        return ( $szStr );
    }   /* End of vaesoli.STR_SoundexFr() ============================================= */
    /* ================================================================================ */


    public static function STR_stripAccents( $szStr )
    /*---------------------------------------------*/
    {
        if ( ! preg_match('/[\x80-\xff]/',$szStr ) )
        {
            return ( $szStr );
        }

        static $chars = null;

        if ( is_null( $chars ) )
        {
            $chars = array(
            // Decompositions for Latin-1 Supplement
            chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
            chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
            chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
            chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
            chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
            chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
            chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
            chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
            chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
            chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
            chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
            chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
            chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
            chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
            chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
            chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
            chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
            chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
            chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
            chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
            chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
            chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
            chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
            chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
            chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
            chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
            chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
            chr(195).chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
            chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
            chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
            chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
            chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
            chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
            chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
            chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
            chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
            chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
            chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
            chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
            chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
            chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
            chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
            chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
            chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
            chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
            chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
            chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
            chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
            chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
            chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
            chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
            chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
            chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
            chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
            chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
            chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
            chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
            chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
            chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
            chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
            chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
            chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
            chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
            chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
            chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
            chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
            chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
            chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
            chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
            chr(197).chr(148) => 'R', chr(197).chr(149) => 'r',
            chr(197).chr(150) => 'R', chr(197).chr(151) => 'r',
            chr(197).chr(152) => 'R', chr(197).chr(153) => 'r',
            chr(197).chr(154) => 'S', chr(197).chr(155) => 's',
            chr(197).chr(156) => 'S', chr(197).chr(157) => 's',
            chr(197).chr(158) => 'S', chr(197).chr(159) => 's',
            chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
            chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
            chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
            chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
            chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
            chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
            chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
            chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
            chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
            chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
            chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
            chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
            chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
            chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
            chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
            chr(197).chr(190) => 'z', chr(197).chr(191) => 's' );
        }

        return ( strtr( $szStr,$chars ) );
    }   /* End of vaesoli.STR_stripAccents() ====================================== */
    /* ============================================================================ */


    public static function STR_Pos( $szStr,$szSubStr )
    /*----------------------------------------------*/
    {
        if ( is_null( $szStr ) || is_null( $szSubStr ) || $szSubStr === '' || $szStr === '' )
        {
            return ( -1 );
        }
        else
        {
            $iPos = strpos( $szStr,$szSubStr );
            return ( $iPos === false ? -1 : $iPos );
        }
    }   /* End of vaesoli.STR_Pos() ============================================== */
    /* ============================================================================ */


    public static function STR_Reduce( $szStr,$cChar = ' ' )
    /*----------------------------------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the function */

        if ( ! self::empty( $szStr ) && ! self::empty( $cChar ) )               /* If strings not empty */
        {
            $cChar = $cChar[0];

            if ( $cChar === '/' )
            {
                $cToSearch = '\/';
            }
            else
            {
                $cToSearch = quotemeta( $cChar );                   /* Treat 1st char only */
            }
            $szRetVal   = preg_replace( "/{$cToSearch}{2,}/s",$cChar,$szStr );

        }   /* if ( ! STR_Empty( $szStr ) && ! STR_Empty( $cChar ) ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of vaesoli.STR_Reduce() =========================================== */
    /* ============================================================================ */


    public static function STR_Tran( $szStr,$szToReplace,$szReplacement = '' )
    /*----------------------------------------------------------*/
    {
       return ( str_replace( $szToReplace,$szReplacement,$szStr ) );
    }   /* End of vaesoli.STR_tran() =========================================== */


    public static function STR_Empty( $szStr )
    /*---------------------------------------*/
    {
        return ( ( ! $szStr ) || ( @strlen( $szStr ) === 0 ) );
    }   /* End of vaesoli.function STR_Empty() ================================= */


    public static function STR_Left( $szStr,$iCount = 1 )
    /*-------------------------------------------------*/
    {
        return substr( $szStr,0,$iCount );
    }   /* End of vaesoli.STR_Left() =========================================== */


    public static function STR_StartWith( $szStr,$szStart )
    /*---------------------------------------------------*/
    {
        $bRetVal = false;                                               /* Return value of the function */
        $iLength = strlen( $szStart );                                  /* Length of $szStart */

        if ( ! self::STR_Empty( $szStr ) && ( $iLength > 0 ) )                /* If all seems to be OK */
        {
            $bRetVal = ( self::STR_Left( $szStr,$iLength ) === $szStart );    /* Compare strings */
        }   /* if ( ! STR_Empty( $szStr ) && ( $iLength > 0 ) ) */

        return ( $bRetVal );                                            /* Return result to caller */
    } /* End of vaesoli.STR_StartWith() ========================================= */
    /* ========================================================================== */


    public static function STR_EndWith( $szStr,$szEnd )
    /*-----------------------------------------------*/
    {
        $bRetVal = false;                                               /* Return value of the function */
        $iLength = strlen( $szEnd );                                    /* Length of $szEnd */

        if ( ! self::STR_Empty( $szStr ) && ( $iLength > 0 ) )                /* If all seems to be OK */
        {
            $bRetVal = ( self::STR_Right( $szStr,$iLength ) === $szEnd );     /* Compare strings */
        }   /* if ( ! STR_Empty( $szStr ) && ( $iLength > 0 ) ) */

        return ( $bRetVal );                                            /* Return result to caller */
    } /* End of vaesoli.STR_EndWith() =========================================== */
    /* ========================================================================== */


    public static function STR_Strin( $szStr,$iRid = 1 )
    /*-------------------------------------------------*/
    {
        if ( ! self::STR_Empty( $szStr ) && $iRid > 0 )            /* If string NOT empty and valid $iRid */
        {
            return ( substr( $szStr,0,-$iRid ) );                   /* Return string -iRid chars */
        }
        else
        {
            return ( $szStr );                                      /* Return result to caller (original string) */
        }
    }   /* End of vaesoli.STR_Strin() =========================================== */
    /* ========================================================================== */


    /* ========================================================================== */
    /** {{*STR_Right( $szStr,$iCount )=

        Returns the $iCount rightmost characters of $szStr

        {*params
            $szStr      (string)    the string to process
            $iCount     (int)       specifies the number of characters returned
                                    from the character expression. This parameter
                                    is optional. If $iCount is not specified,
                                    only the leftmost character of $szStr is
                                    returned.
        *}

        {*alias
            strright(), STR_Last()
        *}

        {*return
            (string)    the $iCount rightmost characters of $szStr
        *}

        {*author {PYB} *}
        {*mdate 14/10/2013 07:17 *}

        {*assert
            STR_Right( 'Hello World',5 ) === 'World'
        *}

        {*assert
            STR_Right( 'Hello World' ) === 'd'
        *}

        {*seealso
            STR_Left()
        *}

        *}}
     */
    /* ========================================================================== */
    public static function STR_Right( $szString,$iCount = 1 )
    /*---------------------------------------*/
    {
        return substr( $szString,0 + strlen( $szString ) - $iCount,$iCount );
    }   /* End of function STR_Right() ========================================== */
    /* ========================================================================== */


    public static function TIM_MakeInt( $szDTOS )
    /*-----------------------------------------*/
    {
        $iRetVal = -1;                                                  /* Default return va;lue of the function */

        //echo "<p>DTOS: {$szDTOS}</p>\n";
        if ( ! self::STR_Empty( $szDTOS ) )                                   /* If parameter OK */
        {
            $i = strtotime( $szDTOS );                                  /* Make this a time value */

            if ( is_numeric( $i ) )                                     /* If numeric value */
            {
                //echo "<p>" . date('Y/m/d H:i:s',$i) . "</p>\n";
                $iRetVal = (int) $i;                                    /* Turn it to an integer */
            }   /* if ( is_numeric( $i ) ) */
        }   /* if ( $szDTOS && strlen( $szDTOS ) ) */

        return ( $iRetVal );                                            /* Return result to caller */
    }   /* End of vaesoli.TIM_MakeInt() ========================================= */
    /* ========================================================================== */


    /* ========================================================================== */
    /** {{*TIM_Time2Int( $szHour )=

        Turns a time representation (string) into an integer

        {*params
            $szHour (string)    Time string (e.g. "09:14:25" or "09:14" or "09"
                                or "9")
        *}

        {*return
            (int)   $szHour turned to an integer
        *}

        {*assert
            TIM_Time2Int('15') === 15 * 3600
        *}

        {*assert
            TIM_Time2Int('00:13') === 13 * 60
        *}

        {*assert
            TIM_Time2Int('15:17') === 15 * 3600 + 17 * 60
        *}

        {*assert
            TIM_Time2Int('15:17:43') === 15 * 3600 + 17 * 60 + 43
        *}

        {*exec
            echo '<p>00:00 = ',TIM_Time2Int('00:00'),'</p>';
            echo '<p>01:20 = ',TIM_Time2Int('01:20'),'</p>';
            echo '<p>15:17 = ',TIM_Time2Int('15:17'),'</p>';
        *}

        *}}
     */
    /* ========================================================================== */
    public static function TIM_Time2Int( $szHour )
    /*------------------------------------------*/
    {
        $aTokens = explode( ':',$szHour );
        $iTokens = min( count( $aTokens ),3 );

        for ( $i=0,$iRetVal = 0;$i<$iTokens;$i++ )
            $iRetVal += ( (int) $aTokens[$i] ) * pow( 60,(2-$i) );

        return ( $iRetVal );
    }   /* End of function vaesoli.TIM_Time2Int() =============================== */
    /* ========================================================================== */


    public static function TIM_Int2Time( $iSecs )
    /*-----------------------------------------*/
    {
        $iSecs    = abs( $iSecs );
        $iMinutes = (int) ( $iSecs / 60 );
        $iHours   = (int) ( $iMinutes / 60 );
        $iMinutes = $iMinutes - ( $iHours * 60 );
        $iSeconds = $iSecs % 60;

        return ( self::STR_padl( (string) $iHours  ,2,'0' )   . ':' .
                 self::STR_padl( (string) $iMinutes,2,'0' )   . ':' .
                 self::STR_padl( (string) $iSeconds,2,'0' ) );
    }   /* End of vaesoli.TIM_Int2Time() ======================================== */
    /* ========================================================================== */


    /* ================================================================================ */
    /** {{*TIM_Season( $xDate )=

        Gets the season at a given date.

        {*params
            $xDate      (string|int)    The date to consider. Optional.
        *}

        {*return
            (string)                    'spring', 'summer', 'fall' or 'winter'
        *}

        {*abstract

            Le printemps aura lieu du samedi 20 mars au dimanche 20 juin 2021.
            L'été actuel se terminera le lundi 21 septembre 2020.
            L'automne aura lieu du mardi 22 septembre au dimanche 20 décembre 2020.
            L'hiver aura lieu du lundi 21 décembre au vendredi 19 mars 2021.

            --------------

            Spring will take place from Saturday, March 20 to Sunday, June 20, 2021.
            The current summer will end on Monday, September 21, 2020.
            Fall will take place from Tuesday, September 22 to Sunday, December 20, 2020.
            Winter will take place from Monday, December 21 to Friday, March 19, 2021.

        *}

        *}}
     */
    /* ================================================================================ */
    public static function TIM_Season( $xDate = null )
    /*----------------------------------------------*/
    {
        $xDate = $xDate ?? date( 'YmdHis' );

        if ( is_int( $xDate ) )
            $szMark = date( 'md',$xDate );
        else
            $szMark = date( 'md',strtotime( $xDate ) );

        //var_dump( $szMark );

        if     ( $szMark < '0321' || $szMark > '1220')
            return ( 'winter' );
        elseif ( $szMark < '0621' )
            return ( 'spring' );
        elseif ( $szMark < '0921' )
            return ( 'summer' );
        else
            return ( 'fall' );

    }   /* End of Vaesoli.TIM_season() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*TIM_timeOfTheDay( [$tTime] )=

        Gets the time of the day at a gievn time

        {*params
            $tTime          (int)       The time to consider. Optional. Same sort of
                                        value as [c]time()[/c]
        *}

        {*return
            (string)                    'morning', 'afternoon', 'evening' or 'night'
        *}

        {*abstract

            Definitions extrapolated from:[br][br]

            [url]https://en.wikipedia.org/wiki/Morning[/url][br]
            [url]https://en.wikipedia.org/wiki/Night[/url][br]
            [url]https://wgntv.com/weather/how-do-you-define-daytime-and-evening-times-in-a-weather-forecast[/url][br]
            [url]https://en.wikipedia.org/wiki/Evening[/url][br]
            [url]https://ell.stackexchange.com/questions/8954/the-exact-time-of-evening-and-night[/url][br]

        *}

        {*example
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "08:30" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "12:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "12:01" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "16:59" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "17:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "17:01" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "19:59" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "20:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "20:01" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "21:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "22:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "23:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "24:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "00:01" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "03:59" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "04:00" ) ),v::TIM_timeOfTheDay( $x ) );
            var_dump( date( "d-m-Y H:i:s",$x = strtotime( "04:01" ) ),v::TIM_timeOfTheDay( $x ) );
        *}

        *}}
     */
    /* ================================================================================ */
    public static function TIM_timeOfTheDay( $tTime = null )
    /*----------------------------------------------------*/
    {
        //var_dump( $tTime );

        if ( ! is_int( $tTime ) )
            $tTime = time();

        $szTime = (string) date( 'His',$tTime );

        //var_dump( $szTime );

        if     ( $szTime >= '170001' && $szTime <= '200000' )
            return ( 'evening' );
        elseif ( $szTime >= '200001' && $szTime <= '240000' )
            return ( 'night' );
        elseif ( $szTime >= '000000' && $szTime <= '040000' )
            return ( 'night' );
        elseif ( $szTime >= '040001' && $szTime <= '120000' )
            return ( 'morning' );
        else
            return ( 'afternoon' );

    }   /* End of Vaesoli.TIM_timeOfTheDay() ========================================== */
    /* ================================================================================ */


    public static function URL_Parse( $szURL = null,$szPart = null )
    /*------------------------------------------------------------*/
    {
        $aURL               = array();

        $aURL['path']       =
        $aURL['domain']     =
        $aURL['protocol']   = '';
        $aURL['subdomains'] = array();

        if ( ! self::STR_Empty( $szURL ) && preg_match( '/\b((?P<protocol>https?|ftp):\/\/)?(?P<domain>[-A-Z0-9.]+)(?P<path>\/[-A-Z0-9+&@#\/%=~_|!:,.;]*)?/i',$szURL,$aMatch ) )
        {
            $aURL['protocol']   = isset( $aMatch['protocol'] ) ? $aMatch['protocol'] : '';
            $aURL['domain']     = isset( $aMatch['domain']   ) ? $aMatch['domain']   : '';
            $aURL['path']       = isset( $aMatch['path']     ) ? $aMatch['path']     : '';

            // Ancien code ...
            $iSubDomains = count( $aDomains = explode( '.',$aURL['domain'] ) );
            //var_dump( "DOMAINS ..." );
            //var_dump( $aDomains );
            //var_dump( "aURL ..." );
            //var_dump( $aURL['domain'] );
            //var_dump( "NB DE SUBDOMAINS: " . $iSubDomains );
            for ( $i = 0;$i < $iSubDomains - 2;$i++ )
            {
                $aURL['subdomains'][] = $aDomains[$i];
            }   /* for ( $i = 0;$i < $iSubDomains - 3;$i++ ) */

            // Nouveau code ... que j'ai remis en commentaire le 25-09-18 09:19:34
            // car cela causait des problÃ¨mes dans la sÃ©lection de playlist (je
            // pense que trql_radio_getRadioID() a besoin de domaines avec www.
            //$aParts = explode( '.',$aURL['domain'] );
            ////var_dump( $aParts );
            //$aURL['subdomains'][] = $aParts[1];
        }   /* if ( preg_match( ...,$szURL,$aMatch ) ) */

        if ( ! is_null( $szPart ) && isset( $aURL[$szPart] ) )
        {
            return ( $aURL[$szPart] );
        }
        else
        {
            return ( $aURL );
        }
    }   /* End of vaesoli.URL_Parse() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*URL_ParseDomain( $szDomain,$szPart )=

        Parses a domain

        {*params
            $szDomain   (string)    Domain to parse
            $szPart     (string)    Optional. Part to receive.
                                    Can be:[br]
                                    - [c]'tld'[/c][br]
                                    - [c]'domain'[/c][br]
                                    - [c]'subdomain'[/c][br]
        *}

        {*return
            (mixed)     Associative array with the following keys:[br]
                            - [c]tld[/c][br]
                            - [c]domain[/c][br]
                            - [c]subdomain[/c][br]
                        If $szPart passed ([c]'tld'[/c], [c]'domain'[/c] or [c]'subdomain'[/c]) the return value is a string
        *}

        {*assert
            URL_ParseDomain( 'www.vaesoli.org','subdomain' ) == 'www'
        *}

        {*assert
            URL_ParseDomain( 'www.vaesoli.org','domain'    ) == 'vaesoli'
        *}

        {*assert
            URL_ParseDomain( 'www.vaesoli.org','tld'       ) == 'org'
        *}

        {*example
            $szURL      = 'http://www.vaesoli.org/documentation/documentation-vaesoli-code-source.php?page=3';
            $szDomain   = URL_Parse( $szURL,'domain' );
            echo $szDomain;                                 // Prints 'www.vaesoli.org'
            echo URL_ParseDomain( $szDomain,'subdomain' );  // Prints 'www'
            echo URL_ParseDomain( $szDomain,'domain'    );  // Prints 'vaesoli'
            echo URL_ParseDomain( $szDomain,'tld'       );  // Prints 'org'
        *}

        {*exec
            $szDomain = "ui.tl";
            $aParts   = URL_ParseDomain( $szDomain );
            var_dump( $aParts );
        *}
        *}}
     */
    /* ================================================================================ */
    public static function URL_ParseDomain( $szDomain,$szPart = null )
    /*--------------------------------------------------------------*/
    {
        $aURL               = array();

        $aURL['tld']        =
        $aURL['domain']     =
        $aURL['subdomain']  = '';

        if ( preg_match( '/(?P<subdomain>[[:alnum:]]+?\.)?(?P<domain>.+?)\.(?P<tld>.{2,})/i',$szDomain,$aMatch ) )
        {
            $aURL['subdomain']  = isset( $aMatch['subdomain'] ) ? $aMatch['subdomain']  : '';
            $aURL['domain']     = isset( $aMatch['domain']    ) ? $aMatch['domain']     : '';
            $aURL['tld']        = isset( $aMatch['tld']       ) ? $aMatch['tld']        : '';

            if ( ( $iPos = self::STR_Pos( $aURL['tld'],'/' ) ) != -1 )
            {
                $aURL['tld'] = self::STR_Left( $aURL['tld'],$iPos );
            }
        }

        if ( ! is_null( $szPart ) && isset( $aURL[$szPart] ) )
        {
            return ( $aURL[$szPart] );
        }
        else
        {
            return ( $aURL );
        }

        return ( $aURL );
    }   /* End of function URL_ParseDomain() ========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /* XML to JSON, to Array, to Object */
            /* ======================================================================== */
            /** {{*XMLtoJSON( $szXML )=

                Turns an XML into JSON

                {*params
                    $szXML      (string)        XML to turn to JSON
                *}

                {*return
                    (string)    $szXML turned into JSON
                *}

                *}}
             */
            /* ======================================================================== */
            public static function XMLtoJSON( $szXML )
            /*--------------------------------------*/
            {
                $a = self::XMLToArray( $szXML );
                return ( json_encode( $a ) );
            }   /* End of Vaesoli.XMLtoJSON() ========================================= */
            /* ======================================================================== */

            /* ======================================================================== */
            /** {{*XMLtoArray( $szXML )=

                Turns an XML into an array

                {*params
                    $szXML      (string)        XML to turn to an array
                *}

                {*return
                    (array)     $szXML turned into an array
                *}

                *}}
             */
            /* ======================================================================== */
            public static function XMLToArray( $szXML )
            /*---------------------------------------*/
            {
                $oXML = @simplexml_load_string( $szXML,"SimpleXMLElement",LIBXML_NOENT | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NOWARNING );

                if ( is_bool( $oXML ) )
                {
                    var_dump( $szXML );
                    die( "NOT WORKING" );
                }

                $szJSON = json_encode( $oXML );

                return ( json_decode( $szJSON,true ) );
            }   /* End of Vaesoli.XMLtoArray() ======================================== */
            /* ======================================================================== */


            /* ======================================================================== */
            /** {{*XMLtoObject( $szXML )=

                Turns an XML into an array

                {*params
                    $szXML      (string)        XML to turn to an standard object
                *}

                {*return
                    (array)     $szXML turned into an object
                *}

                *}}
             */
            /* ======================================================================== */
            public static function XMLToObject( $szXML )
            /*----------------------------------------*/
            {
                return ( self::ArrayToObject( self::XMLToArray( $szXML ) ) );
            }   /* End of Vaesoli.XMLtoObject() ======================================= */
            /* ======================================================================== */
    /* XML to JSON, to Array, to Object */
    /* ================================================================================ */




    /* ================================================================================ */
    /* Array to Object, to JSON, to XML*/
            public static function ArrayToObject( $a )
            /*--------------------------------------*/
            {
                return ( (object) $a );
            }   /* End of Vaesoli.ArraytoObject() ===================================== */
            /* ======================================================================== */


            public static function ArrayToJSON( $a )
            /*--------------------------------------*/
            {
                return ( json_encode( self::ArrayToObject( $a ) ) );
            }   /* End of Vaesoli.ArraytoJSON() ======================================= */
            /* ======================================================================== */


            public static function ArrayToXML( $a )
            /*-----------------------------------*/
            {
                $szRetVal   = null;
                $oSimpleXML = new \SimpleXMLElement( '<STARTSTARTSTART></STARTSTARTSTART>' );

                // function call to convert array to xml
                self::array_to_xml( $a,$oSimpleXML );

                //saving generated xml file; 
                $szXML = $oSimpleXML->asXML( );

                if ( preg_match( '%<STARTSTARTSTART>(?P<payload>.*?)</STARTSTARTSTART>%si',$szXML,$aMatches ) )
                {
                    $szRetVal = preg_replace('/<\/(\d*?)>/si','</item>',preg_replace('/<(\d*?)>/si','<item no="$1">',$aMatches['payload'] ) );
                }   /* if ( preg_match( '%<STARTSTARTSTART>(?P<payload>.*?)</STARTSTARTSTART>%si',$szXML,$aMatches ) ) */

                return ( $szRetVal );
            }   /* End of Vaesoli.ArraytoXML() ======================================== */
            /* ======================================================================== */


            protected static function array_to_xml( $data,$oSimpleXML )
            /*------------------------------------------------------*/
            {
                foreach( $data as $key => $value )
                {
                    if ( is_array( $value ) )
                    {
                        //var_dump( $key );
                        if ( is_numeric( $key ) )
                        {
                            // Apparemment, ce cas ne se présente jamais et je ne comprends pas pourquoi !
                            //var_dump( "NUMERIC KEY" );
                            //die();
                            //$key = 'item' . $key; //dealing with <0/>..<n/> issues
                            $key = 'item';
                        }

                        $subnode = $oSimpleXML->addChild( $key );

                        self::array_to_xml( $value,$subnode );
                    }
                    else
                    {
                        //var_dump( gettype( $value ) );
                        // DOUTEUX ... if ( gettype( $value ) === 'object' )
                        // DOUTEUX ...     $value = self::ArrayToXML( (array) $value );

                        // Ceci fonctionnait !!!
                        //$oSimpleXML->addChild( "{$key}",htmlspecialchars( "{$value}" ) );

                        if ( gettype( $value ) === 'object' )
                        {
                            $subnode = $oSimpleXML->addChild( $key );
                            self::array_to_xml( (array) $value,$subnode );
                        }
                        else
                        {
                            $oSimpleXML->addChild( "{$key}",$value );
                        }
                    }
                }   /* foreach( $data as $key => $value ) */
            }   /* End of Vaesoli.array_to_xml() ====================================== */
            /* ======================================================================== */
    /* Array to Object, to JSON, to XML*/
    /* ================================================================================ */




    /* ================================================================================ */
    /* JSON to Object, to Array , to XML*/
            public static function JSONToObject( $szJSON )
            /*------------------------------------------*/
            {
                return ( json_decode( $szJSON ) );
            }   /* End of Vaesoli.JSONToObject() ====================================== */
            /* ======================================================================== */

            public static function JSONToArray( $szJSON )
            /*-----------------------------------------*/
            {
                return ( (array) json_decode( $szJSON ) );
            }   /* End of Vaesoli.JSONToArray() ======================================= */
            /* ======================================================================== */

            public static function JSONToXML( $szJSON )
            /*--------------------------------------*/
            {
                return ( self::ArrayToXML( (array) self::JSONToArray( $szJSON ) ) );
            }   /* End of Vaesoli.JSONToXML() ========================================= */
            /* ======================================================================== */
    /* JSON to Object, to Array , to XML*/
    /* ================================================================================ */




    /* ================================================================================ */
    /* Object to JSON, to Array , to XML*/
            public static function ObjectToJSON( $o )
            /*-------------------------------------*/
            {
                return ( json_encode( $o ) );
            }   /* End of Vaesoli.ObjectToJSON() ====================================== */
            /* ======================================================================== */


            public static function ObjectToArray( $o )
            /*--------------------------------------*/
            {
                return ( (array) $o );
            }   /* End of Vaesoli.ObjectToArray() ===================================== */
            /* ======================================================================== */


            public static function ObjectToXML( $o )
            /*------------------------------------*/
            {
                return ( self::ArrayToXML( (array) $o ) );
            }   /* End of Vaesoli.JSONToXML() ========================================= */
            /* ======================================================================== */
    /* JSON to Object, to Array , to XML*/
    /* ================================================================================ */

}
?>