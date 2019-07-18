<!DOCTYPE html>
<html {lang_atts} xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>{title}</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
    <style>
        * {
            font-family: sans-serif !important;
        }
    </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        a[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links a,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td-primary:hover,
        .button-a-primary:hover {
            background: #e04c67 !important;
            border-color: #e04c67 !important;
        }

        /* remove margin-bottom from last paragraph */
        .email-container p:last-child {
            margin-bottom: 0 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 12px !important;
                line-height: 18px !important;
            }

            /* hide som parts on mobile especially the empty spaces */
            .email-mobile-hidden {
                display: none !important; font-size: 1px; line-height: 1px; max-height: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;
            }

        }

    </style>
    <!-- Progressive Enhancements : END -->

</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #332d51;">
<center style="width: 100%; background-color: #332d51;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #222222;">
        <tr>
            <td>
    <![endif]-->

    <!-- Visually Hidden Preheader Text : BEGIN -->
    <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        {inbox_preview_text}
    </div>
    <!-- Visually Hidden Preheader Text : END -->

    <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
    <!-- Preview Text Spacing Hack : BEGIN -->
    <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <!-- Preview Text Spacing Hack : END -->















    <!--
        Set the email width. Defined in two places:
        1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 660px.
        2. MSO tags for Desktop Windows Outlook enforce a 660px width.
    -->
    <div style="max-width: 660px; margin: 0 auto;" class="email-container">
        <!--[if mso]>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
                <td>
        <![endif]-->

        <!-- Body : BEGIN -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">

            <!-- Empty Space : BEGIN -->
            <tr>
                <td aria-hidden="true" height="40" style="font-size: 0px; line-height: 0px;">
                    &nbsp;
                </td>
            </tr>
            <!-- Empty Space : END -->

            <!-- Logo : BEGIN -->
            <tr>
                <td style="padding: 20px 0; text-align: center; background-color: #ffffff;">
                    <img src="images/logo.png" width="240" height="50" alt="{alt}" border="0" style="height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                </td>
            </tr>
            <!-- Logo : END -->


            <!-- Banner : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <img src="images/banner.jpg" width="660" height="" alt="alt_text" border="0" style="width: 100%; max-width: 660px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img">
                </td>
            </tr>
            <!-- Banner : END -->

            <!-- Message : BEGIN -->
            <tr>
                <td style="background-color: #d82446;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;" align="center">
                                <h1 style="margin: 0; font-family: sans-serif; font-size: 17px; line-height: 24px; color: #ffffff; font-weight: bold;">RESERVATION RECEIVED</h1>
                                <p style="margin: 0; color: #ffffff;">The confirmation email will be sendend after checked.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Message : END -->

            <!-- Empty Space : BEGIN -->
            <tr>
                <td aria-hidden="true" height="10" style="font-size: 0px; line-height: 0px;">
                    &nbsp;
                </td>
            </tr>
            <!-- Empty Space : END -->

            <!-- Title : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-bottom: 1px solid #EBEBEF;">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                <h2 style="margin: 0; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #d82446; font-weight: bold;">BOOKING DETAILS</h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Title : END -->

            <!-- Table : BEGIN -->
            <tr>
                <td style="background-color: #ffffff; padding: 10px 0;">

                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 10px 20px; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #555555; font-weight: bold;">
                                <p style="margin: 0;">SERVICES</p>
                            </td>
                            <td style="padding: 10px 20px; font-family: sans-serif; font-size: 16px; line-height: 20px; color: #555555;">
                                <p style="margin: 0;">Private Transfer</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 20px; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #555555; font-weight: bold;">
                                <p style="margin: 0;">PASSENGERS</p>
                            </td>
                            <td style="padding: 10px 20px; font-family: sans-serif; font-size: 16px; line-height: 20px; color: #555555;">
                                <p style="margin: 0;">1-4</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 20px; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #555555; font-weight: bold;">
                                <p style="margin: 0;">TOTAL PRICE</p>
                            </td>
                            <td style="padding: 10px 20px; font-family: sans-serif; font-size: 16px; line-height: 20px; color: #555555;">
                                <p style="margin: 0;"><strong>50 € (Pay On Arrival)</strong></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Table : END -->

            <!-- Empty Space : BEGIN -->
            <tr>
                <td aria-hidden="true" height="10" style="font-size: 0px; line-height: 0px;">
                    &nbsp;
                </td>
            </tr>
            <!-- Empty Space : END -->

            <!-- Title : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-bottom: 1px solid #EBEBEF;">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                <h2 style="margin: 0; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #d82446; font-weight: bold;">CONTENT TITLE</h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Title : END -->

            <!-- Content : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                <p style="margin: 0 0 10px 0;">One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.</p>
                                <p style="margin: 0 0 10px 0;">He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.</p>
                                <p style="margin: 0 0 10px 0;">The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked</p>
                                <p style="margin: 0 0 10px 0;">"What's happened to me? " he thought. It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Content : END -->

            <!-- 2 Even Columns : BEGIN -->
            <tr>
                <td style="padding: 0 10px 20px 10px; background-color: #ffffff;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td valign="top" width="50%">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: center; padding: 0 10px;">
                                            <img src="https://via.placeholder.com/600x400" width="300" height="" alt="alt_text" border="0" style="width: 100%; max-width: 300px; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                            <p style="margin: 0;">Maecenas sed ante pellentesque, posuere leo id, eleifend dolor.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="50%">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: center; padding: 0 10px;">
                                            <img src="https://via.placeholder.com/600x400" width="300" height="" alt="alt_text" border="0" style="width: 100%; max-width: 300px; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px 10px 0;">
                                            <p style="margin: 0;">Maecenas sed ante pellentesque, posuere leo id, eleifend dolor.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Two Even Columns : END -->

            <!-- Clear Spacer : BEGIN -->
            <tr>
                <td aria-hidden="true" height="10" style="font-size: 0px; line-height: 0px;">
                    &nbsp;
                </td>
            </tr>
            <!-- Clear Spacer : END -->

            <!-- Action : BEGIN -->
            <tr>
                <td style="background-color: #ffffff;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px;">
                                <!-- Button : BEGIN -->
                                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                                    <tr>
                                        <td class="button-td button-td-primary" style="border-radius: 4px; background: #222222;">
                                            <a class="button-a button-a-primary" href="https://google.com/" style="background: #D82446; border: 1px solid #D82446; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;">Primary Button</a>
                                        </td>
                                    </tr>
                                </table>
                                <!-- Button : END -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Action : END -->

        </table>
        <!-- Body : END -->

        <!-- Social : BEGIN -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td style="padding: 20px 20px 0 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #ffffff;">
                    <p style="margin: 0;">Follow Us</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 20px 15px 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">

                    <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center" style="padding: 5px;">
                                <p style="margin: 0;">
                                    <a href="#" class="social-link" title="Facebook"><img src="images/facebook-circle-colored.png" width="32" height="" alt="alt_text" border="0" style="width: 100%; max-width: 32px; height: auto; background: #332d51; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img"></a>
                                </p>
                            </td>
                            <td align="center" style="padding: 5px;">
                                <p style="margin: 0;">
                                    <a href="#" class="social-link" title="Twitter"><img src="images/twitter-circle-colored.png" width="32" height="" alt="alt_text" border="0" style="width: 100%; max-width: 32px; height: auto; background: #332d51; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img"></a>
                                </p>
                            </td>
                            <td align="center" style="padding: 5px;">
                                <p style="margin: 0;">
                                    <a href="#" class="social-link" title="Instagram"><img src="images/instagram-circle-colored.png" width="32" height="" alt="alt_text" border="0" style="width: 100%; max-width: 32px; height: auto; background: #332d51; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img"></a>
                                </p>
                            </td>
                            <td align="center" style="padding: 5px;">
                                <p style="margin: 0;">
                                    <a href="#" class="social-link" title="YouTube"><img src="images/youtube-circle-colored.png" width="32" height="" alt="alt_text" border="0" style="width: 100%; max-width: 32px; height: auto; background: #332d51; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img"></a>
                                </p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
        <!-- Social : END -->

        <!--[if mso]>
        </td>
        </tr>
        </table>
        <![endif]-->
    </div>

    <!-- Full Bleed Background Section : BEGIN -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #d82446;">
        <tr>
            <td>
                <div align="center" style="max-width: 660px; margin: auto;" class="email-container">
                    <!--[if mso]>
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
                        <tr>
                            <td>
                    <![endif]-->
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 20px; text-align: center; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #ffffff;">
                                <p style="margin: 0;">
                                    <a target="_blank" style="text-decoration:underline; color:#ffffff;" href="https://safetransferistanbul.com">Safe Transfer Istanbul</a>&nbsp;offers
                                    a low-cost private airport transfer.</p>
                            </td>
                        </tr>
                    </table>
                    <!--[if mso]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </div>
            </td>
        </tr>
    </table>
    <!-- Full Bleed Background Section : END -->

















    <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
</center>
</body>
</html>