<?php
defined( "RETVAL_DONT_KNOW_WHAT_TO_DO")                         or define( 'RETVAL_DONT_KNOW_WHAT_TO_DO'                            , 0 );
defined( "RETVAL_ENTRY_ADDED")                                  or define( 'RETVAL_ENTRY_ADDED'                                     , 1 );
defined( "RETVAL_ENTRY_ALREADY_FOUND")                          or define( 'RETVAL_ENTRY_ALREADY_FOUND'                             , 2 );
defined( "RETVAL_ANTI_PATTERN")                                 or define( 'RETVAL_ANTI_PATTERN'                                    , 3 );
                                                                
defined( "DEFAULT_MIX_END_AT")                                  or define( 'DEFAULT_MIX_END_AT'                                     , -12000 );
defined( "DEFAULT_END_AT" )                                     or define( "DEFAULT_END_AT"                                         , DEFAULT_MIX_END_AT );
defined( "MUSIC_NUMBER_OF_DAYS")                                or define( 'MUSIC_NUMBER_OF_DAYS'                                   , 75 );
                                                                
defined( "ALGO_GENRE_KEY_ENERGY")                               or define( 'ALGO_GENRE_KEY_ENERGY'                                  , 1 );
defined( "ALGO_GENRE_KEY_BPM")                                  or define( 'ALGO_GENRE_KEY_BPM '                                    , ALGO_GENRE_KEY_ENERGY + 1 );
defined( "ALGO_ARTIST_KEY_ENERGY")                              or define( 'ALGO_ARTIST_KEY_ENERGY'                                 , ALGO_GENRE_KEY_ENERGY + 2 );
defined( "ALGO_ARTIST_KEY_BPM")                                 or define( 'ALGO_ARTIST_KEY_BPM'                                    , ALGO_GENRE_KEY_ENERGY + 3 );
defined( "ALGO_ARTIST_KEY_ENERGY_BPM")                          or define( 'ALGO_ARTIST_KEY_ENERGY_BPM'                             , ALGO_GENRE_KEY_ENERGY + 4 );
defined( "ALGO_ARTIST_KEY_BPM_ENERGY")                          or define( 'ALGO_ARTIST_KEY_BPM_ENERGY'                             , ALGO_GENRE_KEY_ENERGY + 5 );
                                                                
defined( "AMAZON_AWS" )                                         or define( "AMAZON_AWS"                                             ,"http://s3-eu-west-1.amazonaws.com/quitus-pat/quitus/pat/mp3-" );
defined( "JINGLE_SCARCITY" )                                    or define( "JINGLE_SCARCITY"                                        ,5 );
defined( "PARLOR_SCARCITY" )                                    or define( "PARLOR_SCARCITY"                                        ,7 );
defined( "LOCOMOTIVE_SCARCITY" )                                or define( "LOCOMOTIVE_SCARCITY"                                    ,4 );
defined( "AIRPOWER_SCARCITY" )                                  or define( "AIRPOWER_SCARCITY"                                      ,6 );
defined( "MAX_ARTIST_APPEARANCE" )                              or define( "MAX_ARTIST_APPEARANCE"                                  ,1 );
defined( "ALGORITHM_VERSION" )                                  or define( "ALGORITHM_VERSION"                                      ,64 );
defined( "DEFAULT_QUARANTINE_IN_DAYS" )                         or define( "DEFAULT_QUARANTINE_IN_DAYS"                             ,80 );
defined( "NO_QUARANTINE" )                                      or define( "NO_QUARANTINE"                                          ,'NO QURANTINE' );
defined( "DEFAULT_LOCOMOTIVE_QUARANTINE_IN_DAYS" )              or define( "DEFAULT_LOCOMOTIVE_QUARANTINE_IN_DAYS"                  ,45 );
defined( "DEFAULT_NUGGET_QUARANTINE_IN_DAYS" )                  or define( "DEFAULT_NUGGET_QUARANTINE_IN_DAYS"                      ,12 );
defined( "DEFAULT_WADESDA_QUARANTINE_IN_DAYS" )                 or define( "DEFAULT_WADESDA_QUARANTINE_IN_DAYS"                     ,7 );

defined( "DEFAULT_BIGSOUL_QUARANTINE_IN_DAYS" )                 or define( "DEFAULT_BIGSOUL_QUARANTINE_IN_DAYS"                     ,12 );
defined( "DEFAULT_BIGSOUL_DAILY_QUARANTINE_IN_DAYS" )           or define( "DEFAULT_BIGSOUL_DAILY_QUARANTINE_IN_DAYS"               ,17 );
defined( "DEFAULT_WORLD_WIDE_WEST_QUARANTINE_IN_DAYS" )         or define( "DEFAULT_WORLD_WIDE_WEST_QUARANTINE_IN_DAYS"             ,25 );
defined( "DEFAULT_WORD_WIDE_WEST_DAILY_QUARANTINE_IN_DAYS" )    or define( "DEFAULT_WORD_WIDE_WEST_DAILY_QUARANTINE_IN_DAYS"        ,25 );

                                                                
defined( "MONDAY")                                              or define( "MONDAY"                                                 ,1 );
defined( "TUESDAY")                                             or define( "TUESDAY"                                                ,MONDAY + 1 );
defined( "WEDNESDAY")                                           or define( "WEDNESDAY"                                              ,MONDAY + 2 );
defined( "THURSDAY")                                            or define( "THURSDAY"                                               ,MONDAY + 3 );
defined( "FRIDAY")                                              or define( "FRIDAY"                                                 ,MONDAY + 4 );
defined( "SATURDAY")                                            or define( "SATURDAY"                                               ,MONDAY + 5 );
defined( "SUNDAY")                                              or define( "SUNDAY"                                                 ,MONDAY + 6 );
                                                                
defined( "DEFAULT_COVER")                                       or define( "DEFAULT_COVER"                                          ,'https://www.trql.fm/images/logos/TRQL%20Radio%20Square2.png' );
                                                                
defined( "EXCEPTION_HASH_FILE_BASIS" )                          or define( "EXCEPTION_HASH_FILE_BASIS"                              ,1000 );
defined( "EXCEPTION_HASH_FILE_EMPTY" )                          or define( "EXCEPTION_HASH_FILE_EMPTY"                              ,EXCEPTION_HASH_FILE_BASIS + 0 );
defined( "EXCEPTION_HASH_FILE_CANNOT_BE_UNSERIALIZED" )         or define( "EXCEPTION_HASH_FILE_CANNOT_BE_UNSERIALIZED"             ,EXCEPTION_HASH_FILE_BASIS + 1 );
defined( "EXCEPTION_HASH_FILE_OUT_OF_MEMORY" )                  or define( "EXCEPTION_HASH_FILE_OUT_OF_MEMORY"                      ,EXCEPTION_HASH_FILE_BASIS + 2 );
                                                                
defined( "EXCEPTION_CODE_BASIS" )                               or define( "EXCEPTION_CODE_BASIS"                                   ,EXCEPTION_HASH_FILE_BASIS + 1000 );
defined( "EXCEPTION_CODE_FUNCTIONS_NOT_FOUND" )                 or define( "EXCEPTION_CODE_FUNCTIONS_NOT_FOUND"                     ,EXCEPTION_CODE_BASIS + 0 );
defined( "EXCEPTION_CODE_FUNCTION_UNDEFINED"  )                 or define( "EXCEPTION_CODE_FUNCTION_UNDEFINED"                      ,EXCEPTION_CODE_BASIS + 1 );
defined( "EXCEPTION_CODE_INVALID_PROPERTY" )                    or define( "EXCEPTION_CODE_INVALID_PROPERTY"                        ,EXCEPTION_CODE_BASIS + 2 );
defined( "EXCEPTION_CODE_INVALID_PARAMETER" )                   or define( "EXCEPTION_CODE_INVALID_PARAMETER"                       ,EXCEPTION_CODE_BASIS + 3 );
defined( "EXCEPTION_CODE_INVALID_HOME" )                        or define( "EXCEPTION_CODE_INVALID_HOME"                            ,EXCEPTION_CODE_BASIS + 4 );
defined( "EXCEPTION_CODE_FILE_NOT_FOUND" )                      or define( "EXCEPTION_CODE_FILE_NOT_FOUND"                          ,EXCEPTION_CODE_BASIS + 5 );


defined( "EXCEPTION_SHOW_BASIS" )                               or define( "EXCEPTION_SHOW_BASIS"                                   ,EXCEPTION_CODE_BASIS + 1000 );
defined( "EXCEPTION_SHOW_INVALID_SELECTION" )                   or define( "EXCEPTION_SHOW_INVALID_SELECTION"                       ,EXCEPTION_SHOW_BASIS + 1 );


                                                                
defined( "SPECIAL_DAY_APOCALYPSE_SEED_COUNT" )                  or define( "SPECIAL_DAY_APOCALYPSE_SEED_COUNT"                      ,310 );
defined( "SPECIAL_DAY_ZAKOUSKIS_SEED_COUNT" )                   or define( "SPECIAL_DAY_ZAKOUSKIS_SEED_COUNT"                       ,ceil( SPECIAL_DAY_APOCALYPSE_SEED_COUNT / 3 ) * 1.6 );
defined( "SPECIAL_DAY_GUNEGUNAIKOS_SEED_COUNT" )                or define( "SPECIAL_DAY_GUNEGUNAIKOS_SEED_COUNT"                    ,ceil( SPECIAL_DAY_APOCALYPSE_SEED_COUNT     ) * 1.6 );
defined( "SPECIAL_DAY_VALENTINE_SEED_COUNT" )                   or define( "SPECIAL_DAY_VALENTINE_SEED_COUNT"                       ,ceil( SPECIAL_DAY_APOCALYPSE_SEED_COUNT     ) * 1.6 );


if ( ! defined( 'RET_CODES' ) ) /* If HTTP codes not defined */
{
    define( 'RET_CODES'                                 ,0  );

    define( 'RET_CODE_CONTINUE'                         ,100 );

    define( 'RET_CODE_OK'                               ,200 );
    define( 'RET_CODE_CREATED'                          ,201 );
    define( 'RET_CODE_ACCEPTED'                         ,202 );
    define( 'RET_CODE_NON_AUTHORITATIVE'                ,203 );
    define( 'RET_CODE_NO_CONTENT'                       ,204 );
    define( 'RET_CODE_RESET_CONTENT'                    ,205 );
    define( 'RET_CODE_PARTIAL_CONTENT'                  ,206 );

    define( 'RET_CODE_MULTIPLE_CHOICES'                 ,300 );
    define( 'RET_CODE_MOVED_PERMANENTLY'                ,301 );
    define( 'RET_CODE_FOUND'                            ,302 );
    define( 'RET_CODE_SEE_OTHER'                        ,303 );
    define( 'RET_CODE_NOT_MODIFIED'                     ,304 );
    define( 'RET_CODE_USE_PROXY'                        ,305 );
    define( 'RET_CODE_RESERVED'                         ,306 );
    define( 'RET_CODE_TEMPORARY_REDIRECT'               ,307 );

    define( 'RET_CODE_BAD_REQUEST'                      ,400 );
    define( 'RET_CODE_NOT_OK'                           ,400 );
    define( 'RET_CODE_NOK'                              ,400 );
    define( 'RET_CODE_KO'                               ,400 );
    define( 'RET_CODE_UNAUTHORIZED'                     ,401 );
    define( 'RET_CODE_PAYMENT_REQUIRED'                 ,402 );
    define( 'RET_CODE_FORBIDDEN'                        ,403 );
    define( 'RET_CODE_NOT_FOUND'                        ,404 );
    define( 'RET_CODE_METHOD_NOT_ALLOWED'               ,405 );
    define( 'RET_CODE_NOT_ACCEPTABLE'                   ,406 );
    define( 'RET_CODE_PROXY_AUTHENTIFICATION_REQUIRED'  ,407 );
    define( 'RET_CODE_REQUEST_TIMEOUT'                  ,408 );
    define( 'RET_CODE_CONFLICT'                         ,409 );
    define( 'RET_CODE_GONE'                             ,410 );
    define( 'RET_CODE_LENGTH_REQUIRED'                  ,411 );
    define( 'RET_CODE_PRECONDITION_FAILED'              ,412 );
    define( 'RET_CODE_REQUEST_ENTITY_TOO_LARGE'         ,413 );
    define( 'RET_CODE_REQUEST_URI_TOO_LONG'             ,414 );
    define( 'RET_CODE_UNSUPPORTED_MEDIA_TYPE'           ,415 );
    define( 'RET_CODE_REQUESTED_RANGE_NOT_SATISFIABLE'  ,416 );
    define( 'RET_CODE_EXPECTATION_FAILED'               ,417 );

    define( 'RET_CODE_INTERNAL_SERVER_ERROR'            ,500 );
    define( 'RET_CODE_NOT_IMPLEMENTED'                  ,501 );
    define( 'RET_CODE_BAD_GATEWAY'                      ,502 );
    define( 'RET_CODE_SERVICE_UNAVAILABLE'              ,503 );
    define( 'RET_CODE_GATEWAY_TIMEOUT'                  ,504 );
    define( 'RET_CODE_HTTP_VERSION_NOT_SUPPORTED'       ,505 );
}

defined( "API_BASIS" )                                  or define( "API_BASIS"                                              ,1000000 );
defined( "API_ERROR_SUCCESS" )                          or define( "API_ERROR_SUCCESS"                                      ,API_BASIS + RET_CODE_OK );
defined( "API_ERROR_NOT_FOUND" )                        or define( "API_ERROR_NOT_FOUND"                                    ,API_BASIS + RET_CODE_NOT_FOUND );
defined( "API_ERROR_NOT_ACCEPTABLE" )                   or define( "API_ERROR_NOT_ACCEPTABLE"                               ,API_BASIS + RET_CODE_NOT_ACCEPTABLE );
defined( "API_ERROR_INTERNAL_SERVER_ERROR" )            or define( "API_ERROR_INTERNAL_SERVER_ERROR"                        ,API_BASIS + RET_CODE_INTERNAL_SERVER_ERROR );
defined( "API_ERROR_BAD_REQUEST" )                      or define( "API_ERROR_BAD_REQUEST"                                  ,API_BASIS + RET_CODE_BAD_REQUEST );
defined( "API_ERROR_NOT_IMPLEMENTED" )                  or define( "API_ERROR_NOT_IMPLEMENTED"                              ,API_BASIS + RET_CODE_NOT_IMPLEMENTED );
defined( "API_ERROR_CONFLICT" )                         or define( "API_ERROR_CONFLICT"                                     ,API_BASIS + RET_CODE_CONFLICT );
defined( "API_ERROR_UNAUTHORIZED" )                     or define( "API_ERROR_UNAUTHORIZED"                                 ,API_BASIS + RET_CODE_UNAUTHORIZED );

?>