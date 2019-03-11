<?php
    function generateAdminCode()
    {
        return generateCode( 'ADM-', 5 );
    }

    function generateSchoolCode()
    {
        return generateCode( 'SCH-', 4 );
    }

    function generateSchoolAdminCode()
    {
        return generateCode( 'SADM-', 7 );
    }

    function generateStudentCode()
    {
        return generateCode( 'STD-', 10 );
    }

    function generateTransactionCode()
    {
        return generateCode( 'TRN-', 11 );
    }

    function generateWalletCode()
    {
        return generateCode( 'WLT-', 6 );
    }

    function generateTransactionRRN()
    {
        return generateRRN( 12 );
    }

    function generateCode( $prefix, $length )
    {
        $code = "";
        $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        for( $i = 0; $i < $length; $i++ )
        {
            $random_int = mt_rand();
            $code .= $charset[ $random_int % strlen( $charset ) ];
        }
        return $prefix.$code;
    }

    function generateRRN( $length )
    {
        $code = "";
        $charset = "0123456789";

        for( $i = 0; $i < $length; $i++ )
        {
            $random_int = mt_rand();
            $code .= $charset[ $random_int % strlen( $charset ) ];
        }
        return $code;
    }