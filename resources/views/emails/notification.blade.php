<!DOCTYPE html>
<html lang="en">
<head>
    <title>Salted | A Responsive Email Template</title>
    <!--

        SALTED | A RESPONSIVE EMAIL TEMPLATE
        =====================================

        Based on code used and tested by Litmus (@litmusapp)
        Originally developed by Kevin Mandeville (@KEVINgotbounce)
        Cleaned up by Jason Rodriguez (@rodriguezcommaj)
        Presented by A List Apart (@alistapart)

        Email is surprisingly hard. While this has been thoroughly tested, your mileage may vary.
        It's highly recommended that you test using a service like Litmus and your own devices.

        Enjoy!

     -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        #outlook a {
            padding: 0;
        }

        /* Force Outlook to provide a "view in browser" message */
        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }

        /* Force Hotmail to display normal line spacing */
        body, table, td, a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Prevent WebKit and Windows mobile changing default text sizes */
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        /* Remove spacing between tables in Outlook 2007 and up */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* Allow smoother rendering of resized image in Internet Explorer */

        /* RESET STYLES */
        body {
            margin: 0;
            padding: 0;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        .appleBody a {
            color: #68440a;
            text-decoration: none;
        }

        .appleFooter a {
            color: #999999;
            text-decoration: none;
        }

        /* MOBILE STYLES */
        @media screen and (max-width: 525px) {

            /* ALLOWS FOR FLUID TABLES */
            table[class="wrapper"] {
                width: 100% !important;
            }

            /* ADJUSTS LAYOUT OF LOGO IMAGE */
            td[class="logo"] {
                text-align: left;
                padding: 20px 0 20px 0 !important;
            }

            td[class="logo"] img {
                margin: 0 auto !important;
            }

            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
            td[class="mobile-hide"] {
                display: none;
            }

            img[class="mobile-hide"] {
                display: none !important;
            }

            img[class="img-max"] {
                max-width: 100% !important;
                height: auto !important;
            }

            /* FULL-WIDTH TABLES */
            table[class="responsive-table"] {
                width: 100% !important;
            }

            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
            td[class="padding"] {
                padding: 10px 5% 15px 5% !important;
            }

            td[class="padding-copy"] {
                padding: 10px 5% 10px 5% !important;
                text-align: center;
            }

            td[class="padding-meta"] {
                padding: 30px 5% 0px 5% !important;
                text-align: center;
            }

            td[class="no-pad"] {
                padding: 0 0 20px 0 !important;
            }

            td[class="no-padding"] {
                padding: 0 !important;
            }

            td[class="section-padding"] {
                padding: 50px 15px 50px 15px !important;
            }

            td[class="section-padding-bottom-image"] {
                padding: 50px 15px 0 15px !important;
            }

            /* ADJUST BUTTONS ON MOBILE */
            td[class="mobile-wrapper"] {
                padding: 10px 5% 15px 5% !important;
            }

            table[class="mobile-button-container"] {
                margin: 0 auto;
                width: 100% !important;
            }

            a[class="mobile-button"] {
                width: 80% !important;
                padding: 15px !important;
                border: 0 !important;
                font-size: 16px !important;
            }

        }
    </style>
</head>
<body style="margin: 0; padding: 0;">

<!-- ONE COLUMN SECTION -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
    <tr>
        <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <!-- HERO IMAGE -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="padding-copy">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <a href="http://www.rurusteve.com/emailnotification.png"
                                                               target="_blank"><img
                                                                        src="http://www.rurusteve.com/emailnotification.png"
                                                                        border="0"
                                                                        alt="Notifikasi Cuti"
                                                                        style="display: block; color: #666666; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px; width: 200px; margin: 0 auto; padding: 0 50px;"
                                                                        class="img-max"></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center"
                                                style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;"
                                                class="padding-copy">{{ ucwords(strtolower($nama)) }} telah mengajukan
                                                cuti
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center"
                                                style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;"
                                                class="padding-copy">
                                                {{ ucwords(strtolower($nama)) }} mengajukan cuti pada
                                                tanggal <b>{{ date_format($leaverequest->tanggalmulaicuti, 'd F y') }}
                                                    sampai {{ date_format($leaverequest->tanggalakhircuti, 'd F y') }}</b>, untuk
                                                @if($leaverequest->jeniscuti == 1)
                                                    {{ucwords(strtolower('CUTI TAHUNAN, CUTI NASIONAL DAN WISATA'))}}
                                                @elseif($leaverequest->jeniscuti == 2)
                                                    {{ucwords(strtolower('CUTI PERKAWINAN, KELAHIRAN DAN MENIKAHKAN ANAK**'))}}
                                                @elseif($leaverequest->jeniscuti == 3)

                                                    {{ucwords(strtolower('CUTI KEGUGURAN DAN KEMATIAN**'))}}
                                                @elseif($leaverequest->jeniscuti == 4)

                                                    {{ucwords(strtolower('CUTI FORCE MAJEUR'))}}
                                                @elseif($leaverequest->jeniscuti == 5)

                                                    {{ucwords(strtolower('IJIN RESMI (KTP, SIM, STNK, PASPOR, DAN SURAT NIKAH)**'))}}
                                                @elseif($leaverequest->jeniscuti == 6)

                                                    {{ucwords(strtolower('IJIN SAKIT'))}}
                                                @elseif($leaverequest->jeniscuti == 7)

                                                    {{ucwords(strtolower('IJIN SAKIT DENGAN SURAT DOKTER*'))}}
                                                @elseif($leaverequest->jeniscuti == 8)

                                                    {{ucwords(strtolower('CUTI TIDAK DIBAYAR (MANGKIR/TIDAK ADA JATAH)'))}}
                                                @elseif($leaverequest->jeniscuti == 9)

                                                    {{ucwords(strtolower('JUMLAH CUTI YANG DIAMBIL'))}}

                                                @endif dengan alasan {{ $leaverequest->keterangan }}


                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- BULLETPROOF BUTTON -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                           class="mobile-button-container">
                                        <tr>
                                            <td align="center" style="padding: 25px 0 0 0;" class="padding-copy">
                                                <table border="0" cellspacing="0" cellpadding="0"
                                                       class="responsive-table">
                                                    <tr>
                                                        <td align="center"><a
                                                                    href="http://www.namast3.com"
                                                                    target="_blank"
                                                                    style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #5D9CEC; border-top: 15px solid #5D9CEC; border-bottom: 15px solid #5D9CEC; border-left: 25px solid #5D9CEC; border-right: 25px solid #5D9CEC; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block; margin: 0 50px;"
                                                                    class="mobile-button">Cek sekarang &rarr;</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- FOOTER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
    <tr>
        <td bgcolor="#ffffff" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td style="padding: 20px 0px 20px 0px;">
                        <!-- UNSUBSCRIBE COPY -->
                        <table width="500" border="0" cellspacing="0" cellpadding="0" align="center"
                               class="responsive-table">
                            <tr>
                                <td align="center" valign="middle"
                                    style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                                    <span class="appleFooter" style="color:#666666;">Jl. Arjuna Utara No.10, Blok A Kavling 10, Kota Jakarta Barat, 11470</span><br><a
                                            class="original-only" style="color: #666666; text-decoration: none;">Notification</a><span
                                            class="original-only"
                                            style="font-family: Arial, sans-serif; font-size: 12px; color: #444444;">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a
                                            style="color: #666666; text-decoration: none;">namast3.com</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>