<?php
	use \SendGrid\Mail\From as From;
	use \SendGrid\Mail\To as To;
	use \SendGrid\Mail\Subject as Subject;
	use \SendGrid\Mail\PlainTextContent as PlainTextContent;
	use \SendGrid\Mail\HtmlContent as HtmlContent;
	use \SendGrid\Mail\Mail as Mail;


	function email($fromname, $fromaddress, $toname, $toaddress, $subject, $message, $is_html = true, $file = "", $file2 = "", $arrCC = NULL, $defaultHeader = true)
	{

		$email = new \SendGrid\Mail\Mail();
		$email->setFrom($fromaddress,$fromname);
		$email->setSubject($subject);
		$email->addTo(trim($toaddress), $toname);
		if ($arrCC) {
			$arrCC = array_unique ($arrCC);
			foreach($arrCC as $cc) {
				$email->addBcc($cc);
			}
		}

		$email->addContent("text/plain", "Thank you for your time and interest");
		if ($is_html) {

			$newMessage='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			    <meta name="viewport" content="width=device-width, initial-scale=1.0">
			    <title></title>
			    <style type="text/css">
			        body,#bodyTable,#bodyCell{
			        height:100% !important;
			        margin:0;
			        padding:0;
			        width:100% !important;
			        }
			        .button{
			            text-decoration:none !important;
			            width: 30%;
			            height: 50px;
			            border-radius: 10px;
			            padding: 8px;
			            background-color: rgba(108 ,61, 214);
			            color: white;
			            font-size: 15px;
			            font-family: Arial, Helvetica, sans-serif;
			            margin-bottom: 5px;
			            margin-top: 11px;
			        text-align: center;
			        }
			        .button:hover{
			            background-color: rgb(127, 93, 206);
			        }
			        table{
			        border-collapse:collapse;
			        }
			        img,a img{
			        border:0;
			        outline:none;
			        text-decoration:none;
			        }
			        h1,h2,h3,h4,h5,h6{
			        margin:0;
			        padding:0;
			        }
			        p{
			        margin:1em 0;
			        padding:0;
			        }
			        a{
			        word-wrap:break-word;
			        }
			        .ReadMsgBody{
			        width:100%;
			        }
			        .ExternalClass{
			        width:100%;
			        }
			        .ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{
			        line-height:100%;
			        }
			        table,td{
			        mso-table-lspace:0pt;
			        mso-table-rspace:0pt;
			        }
			        #outlook a{
			        padding:0;
			        }
			        img{
			        -ms-interpolation-mode:bicubic;
			        }
			        body,table,td,p,a,li,blockquote{
			        -ms-text-size-adjust:100%;
			        -webkit-text-size-adjust:100%;
			        }
			        #bodyCell{
			        padding:20px;
			        }
			        .themezyImage{
			        vertical-align:bottom;
			        }
			        .themezyTextContent img{
			        height:auto !important;
			        }
			        body,#bodyTable{
			        background-color:#e1e1e1;
			        }
			        #bodyCell{
			        border-top:0;
			        }
			        #templateContainer{
			        border:0;
			        }
			        #templatePreheader{
			        background-color:#e1e1e1;
			        border-top:0;
			        border-bottom:0;
			        }
			        .preheaderContainer .themezyTextContent,.preheaderContainer .themezyTextContent p{
			        color:#7b7b7b;
			        font-family:Arial, Helvetica;
			        font-size:11px;
			        line-height:125%;
			        text-align:left;
			        }
			        .preheaderContainer .themezyTextContent a{
			        color:#7b7b7b;
			        font-weight:normal;
			        text-decoration:underline;
			        }
			        #templateHeader{
			        background-color:#FFFFFF;
			        border-top:0;
			        border-bottom:0;
			        }
			        .headerContainer .themezyTextContent,.headerContainer .themezyTextContent p{
			        color:#606060;
			        font-family:Arial, Helvetica;
			        font-size:15px;
			        line-height:150%;
			        text-align:left;
			        }
			        .headerContainer .themezyTextContent a{
			        color:#6DC6DD;
			        font-weight:normal;
			        text-decoration:underline;
			        }
			        #templateBody{
			        background-color:#FFFFFF;
			        border-top:0;
			        border-bottom:0;
			        }
			        .bodyContainer .themezyTextContent,.bodyContainer .themezyTextContent p{
			        color:#111;
			        font-family:Arial, Helvetica;
			        font-size:15px;
			        line-height:150%;
			        text-align:left;
			        }
			        .bodyContainer .themezyTextContent a{
			        color:#6DC6DD;
			        font-weight:normal;
			        text-decoration:underline;
			        }
			        #templateFooter{
			        background-color:#e1e1e1;
			        border-top:0;
			        border-bottom:0;
			        }
			        .footerContainer .themezyTextContent,.footerContainer .themezyTextContent p{
			        color:#7b7b7b;
			        font-family:Arial, Helvetica;
			        font-size:14px;
			        line-height:200%;
			        text-align:center;
			        }
			        .footerContainer .themezyTextContent a{
			        color:#7b7b7b;
			        font-weight:normal;
			        text-decoration:underline;
			        }
			        @media only screen and (max-width: 480px){
			        body,table,td,p,a,li,blockquote{
			        -webkit-text-size-adjust:none !important;
			        }
			        body{
			        width:100% !important;
			        min-width:100% !important;
			        }
			        .button{
			            width: 50%;
			        }
			        td[id=bodyCell]{
			        padding:10px !important;
			        }
			        table[class=themezyTextContentContainer]{
			        width:100% !important;
			        }
			        table[class=themezyBoxedTextContentContainer]{
			        width:100% !important;
			        }
			        table[class=mcpreview-image-uploader]{
			        width:100% !important;
			        display:none !important;
			        }
			        img[class=themezyImage]{
			        width:100% !important;
			        }
			        table[class=themezyImageGroupContentContainer]{
			        width:100% !important;
			        }
			        td[class=themezyImageGroupContent]{
			        padding:9px !important;
			        }
			        td[class=themezyImageGroupBlockInner]{
			        padding-bottom:0 !important;
			        padding-top:0 !important;
			        }
			        tbody[class=themezyImageGroupBlockOuter]{
			        padding-bottom:9px !important;
			        padding-top:9px !important;
			        }
			        table[class=themezyCaptionTopContent],table[class=themezyCaptionBottomContent]{
			        width:100% !important;
			        }
			        table[class=themezyCaptionLeftTextContentContainer],table[class=themezyCaptionRightTextContentContainer],table[class=themezyCaptionLeftImageContentContainer],table[class=themezyCaptionRightImageContentContainer],table[class=themezyImageCardLeftTextContentContainer],table[class=themezyImageCardRightTextContentContainer]{
			        width:100% !important;
			        }
			        td[class=themezyImageCardLeftImageContent],td[class=themezyImageCardRightImageContent]{
			        padding-right:18px !important;
			        padding-left:18px !important;
			        padding-bottom:0 !important;
			        }
			        td[class=themezyImageCardBottomImageContent]{
			        padding-bottom:9px !important;
			        }
			        td[class=themezyImageCardTopImageContent]{
			        padding-top:18px !important;
			        }
			        td[class=themezyImageCardLeftImageContent],td[class=themezyImageCardRightImageContent]{
			        padding-right:18px !important;
			        padding-left:18px !important;
			        padding-bottom:0 !important;
			        }
			        td[class=themezyImageCardBottomImageContent]{
			        padding-bottom:9px !important;
			        }
			        td[class=themezyImageCardTopImageContent]{
			        padding-top:18px !important;
			        }
			        table[class=themezyCaptionLeftContentOuter] td[class=themezyTextContent],table[class=themezyCaptionRightContentOuter] td[class=themezyTextContent]{
			        padding-top:9px !important;
			        }
			        td[class=themezyCaptionBlockInner] table[class=themezyCaptionTopContent]:last-child td[class=themezyTextContent]{
			        padding-top:18px !important;
			        }
			        td[class=themezyBoxedTextContentColumn]{
			        padding-left:18px !important;
			        padding-right:18px !important;
			        }
			        td[class=themezyTextContent]{
			        padding-right:18px !important;
			        padding-left:18px !important;
			        }
			        table[id=templateContainer],table[id=templatePreheader],table[id=templateHeader],table[id=templateBody],table[id=templateFooter]{
			        max-width:600px !important;
			        width:100% !important;
			        }
			        table[class=themezyBoxedTextContentContainer] td[class=themezyTextContent],td[class=themezyBoxedTextContentContainer] td[class=themezyTextContent] p{
			        font-size:18px !important;
			        line-height:125% !important;
			        }
			        table[id=templatePreheader]{
			        display:block !important;
			        }
			        td[class=preheaderContainer] td[class=themezyTextContent],td[class=preheaderContainer] td[class=themezyTextContent] p{
			        font-size:18px !important;
			        line-height:115% !important;
			        text-align: center !important;
			        }
			        td[class=headerContainer] td[class=themezyTextContent],td[class=headerContainer] td[class=themezyTextContent] p{
			        font-size:18px !important;
			        line-height:125% !important;
			        }
			        td[class=bodyContainer] td[class=themezyTextContent],td[class=bodyContainer] td[class=themezyTextContent] p{
			        font-size:18px !important;
			        line-height:125% !important;
			        }
			        td[class=footerContainer] td[class=themezyTextContent],td[class=footerContainer] td[class=themezyTextContent] p{
			        font-size:18px !important;
			        line-height:115% !important;
			        }
			        }
			    </style>
			</head>
			<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
			    <span style="display: none !important;
			        visibility: hidden;
			        mso-hide: all;
			        font-size: 1px;
			        line-height: 1px;
			        max-height: 0;
			        max-width: 0;
			        opacity: 0;
			        overflow: hidden;"></span>
			    <center>
			        <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
			            <tr>
			            <td align="center" valign="top" id="bodyCell">
			                <!-- BEGIN TEMPLATE // -->
			                <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">';
								if ($defaultHeader) {
								$newMessage.='
			                    <tr>
			                        <td align="center" valign="top">
			                        <!-- BEGIN HEADER // -->
									
			                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
			                            <tr>
			                                <td valign="top" class="headerContainer">
			                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="themezyImageBlock">
			                                    <tbody class="themezyImageBlockOuter">
			                                        <tr>
			                                            <td valign="top" style="padding:0px" class="themezyImageBlockInner">
			                                                <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="themezyImageContentContainer">
			                                                <tbody>
			                                                    <tr>
			                                                        <td class="themezyImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; text-align:center;">
			                                                            <img align="center" alt="Head Email" src="'.RAIZ_HTTPS.'assets/images/masamo_dash_top.png" width="600" style="max-width:100%; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="themezyImage" >
			                                                        </td>
			                                                    </tr>
			                                                </tbody>
			                                                </table>
			                                            </td>
			                                        </tr>
			                                    </tbody>
			                                    </table>
			                                </td>
			                            </tr>
			                        </table>
			                        <!-- // END HEADER -->
			                        </td>
			                    </tr>';
								}
								$newMessage.='
			                    <tr>
			                        <td align="center" valign="top">
			                        <!-- BEGIN BODY // -->
			                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
			                            <tr>
			                                <td valign="top" class="bodyContainer">
			                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="themezyTextBlock">
			                                    <tbody class="themezyTextBlockOuter">
			                                        <tr>
			                                            <td valign="top" class="themezyTextBlockInner">
			                                              <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="themezyTextContentContainer">
			                                              <tbody>
			                                                  <tr>
			                                                    <td valign="top" class="themezyTextContent" style="padding: 25px 50px;">
			                                                      '.$message.'
			                                                    </td>
			                                                  </tr>
			                                              </tbody>
			                                              </table>
			                                            </td>
			                                        </tr>
			                                    </tbody>
			                                    </table>
			                                </td>
			                            </tr>
			                        </table>
			                        <!-- // END BODY -->
			                        </td>
			                    </tr>
			                </table>
			                <!-- // END TEMPLATE -->
			            </td>
			            </tr>
			        </table>
			    </center>
			</body>
			</html>';
			$email->addContent(
				"text/html",$newMessage
			);
		}


		$sendgrid = new \SendGrid(SENDGRID_API);
		// if($file){
		// 	if(filesize($file)/1024/1024<10){
		// 	if (is_array($file)) {
		// 		foreach($file as $f) {
		// 			$attachment = NULL;
		// 			$filename = basename($f);
		// 			$file_encoded = base64_encode(file_get_contents($f));
		//
		// 			$attachment = new SendGrid\Mail\Attachment();
		// 			//$attachment->setType("application/text");
		// 			$attachment->setContent($file_encoded);
		// 			$attachment->setDisposition("attachment");
		// 			$attachment->setFilename($filename);
		//
		// 			$email->addAttachment($attachment);
		// 		}
		// 	} else {
		// 		$filename = basename($file);
		// 		$file_encoded = base64_encode(file_get_contents($file));
		//
		// 		$attachment = new SendGrid\Mail\Attachment();
		// 		//$attachment->setType("application/text");
		// 		$attachment->setContent($file_encoded);
		// 		$attachment->setDisposition("attachment");
		// 		$attachment->setFilename($filename);
		//
		// 		$email->addAttachment($attachment);
		// 	}
		//  }
		// }
		try {

			$response = $sendgrid->send($email);
			return $response;
		} catch (Exception $e) {
			echo  'Caught exception: ',  $e->getMessage(), "\n";
		}

	}
?>
