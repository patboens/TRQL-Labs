<?php
namespace trql\storage;

defined( 'STORAGE_TRAIT_VERSION' ) or define( 'STORAGE_TRAIT_VERSION','0.1' );
defined( 'TRAIT_MODULO' ) or define( 'TRAIT_MODULO',11003 );

trait Storage
/*---------*/
{
    public function map( $szKey,$modulo = TRAIT_MODULO,$sz2ndLevelPrefix = null )
    /*-------------------------------------------------------------------------*/
    {
        $szMD5      = md5( (string) $szKey );
        $szMD52nd   = md5( strtoupper( (string) $szKey . (string) $szKey ) );
        $t1         = microtime( true );

        // La valeur la plus haute retournée dans un MD5 est un 'f', ascii 102 =>
        // la somme la plus haute serait 11016
        // Donc, le modulo ne peut pas être supérieur à 11016!!!
        // Le meilleur choix se portant sur 11003, prime number le plus proche de
        // 11016
        //var_dump( ( 102 * 3  ) +
        //          ( 102 * 6  ) +
        //          ( 102 * 9  ) +
        //          ( 102 * 12 ) +
        //          ( 102 * 15 ) +
        //          ( 102 * 18 ) +
        //          ( 102 * 21 ) +
        //          ( 102 * 24 ) );
        //die();

        $modulo = min( $modulo ?? TRAIT_MODULO,TRAIT_MODULO );

        return ( array( 'key'           => $szKey                                                                                           ,
                        'md5'           => $szMD5                                                                                           ,
                        'md52nd'        => $szMD52nd                                                                                        ,
                        'modulo'        => $modulo                                                                                          ,
                        'level1'        => sprintf(                     '%05d',$this->asciiSum( substr( $szMD5      ,0 ,8 ) ) % $modulo )   ,
                        'level2'        => sprintf(                     '%05d',$this->asciiSum( substr( $szMD5      ,8 ,8 ) ) % $modulo )   ,
                        'level3'        => sprintf(                     '%05d',$this->asciiSum( substr( $szMD5      ,16,8 ) ) % $modulo )   ,
                        'level4'        => sprintf(                     '%05d',$this->asciiSum( substr( $szMD5      ,24,8 ) ) % $modulo )   ,
                        'levelA'        => sprintf( $sz2ndLevelPrefix . '%05d',$this->asciiSum( substr( $szMD52nd   ,0 ,8 ) ) % $modulo )   ,
                        'levelB'        => sprintf( $sz2ndLevelPrefix . '%05d',$this->asciiSum( substr( $szMD52nd   ,8 ,8 ) ) % $modulo )   ,
                        'levelC'        => sprintf( $sz2ndLevelPrefix . '%05d',$this->asciiSum( substr( $szMD52nd   ,16,8 ) ) % $modulo )   ,
                        'levelD'        => sprintf( $sz2ndLevelPrefix . '%05d',$this->asciiSum( substr( $szMD52nd   ,24,8 ) ) % $modulo )   ,
                        'possibilities' => pow( $modulo,8 )                                                                                 ,
                        'perf'          => microtime( true ) - $t1                                                                          ,
                      ) );

    }   /* End of Storage.map() ======================================================= */
    /* ================================================================================ */


    public function asciiSum( $szStr )
    /*------------------------------*/
    {
        $a = str_split( $szStr );
        $sum = 0;

        $i = 0;
        foreach ( $a as $c )
        {
            $sum += ord( $c ) * ( ++$i * 3 );
        }   /* foreach ( $a as $c ) */

        return ( $sum );
    }   /* End of Storage.asciiSum() ================================================== */
    /* ================================================================================ */

}   /* End of Storage ================================================================= */
/* ==================================================================================== */
?>