<?php
/*************************************************************
 Aldoron Site                                  
 Author: TJ Moore    tjmooredev@gmail.com
**************************************************************/
include 'includes/globals.php';
//include 'includes/menu.php';
session_start();
db_connect();

if($mysqli->connect_error) {
	echo 'Failed to connect to server: (' . $mysqli->connect_error . ') ' . $mysqli->connect_error;
}

include 'templates/include.tpl';
?>
<body>
<!-- Navigation -->
<?php
//global $page;
$_SESSION['page'] = 7;
include 'templates/topmenu.tpl';
include "templates/freebies.tpl";
?>
    <div class='container-fluid'>
        <div class='row clearfix'>
            <div class='col-sm-12' align='left'>
                <font size="+4"><strong>Terms of Service</strong></font>
                <br><br>
                The services TJMAcademy.com provides to Users are subject to the following Terms of Use ("TOU"). TJMAcademy.com reserves the right to update the TOU at any time without notice to User. The most current version of the TOU can be reviewed by clicking on the "Terms of Use" hypertext link located at the bottom of our Web pages. 
                <br><br>
                A.	This Agreement, which incorporates by reference other provisions applicable to use of www.TJMAcademy.com, including, but not limited to, supplemental terms and conditions set forth hereof ("Supplemental Terms") governing the use of certain specific material contained in www.TJMAcademy.com, sets forth the terms and conditions that apply to use of www.TJMAcademy.com by User. By using TJMAcademy.com (other than to read this Agreement for the first time), User agrees to comply with all of the terms and conditions hereof. The right to use www.TJMAcademy.com is personal to User and is not transferable to any other person or entity. User is responsible for all use of User's Account (under any screen name or password) and for ensuring that all use of User's Account complies fully with the provisions of this Agreement. User shall be responsible for protecting the confidentiality of User's password(s), if any. 
                <br><br>
                B.	TJMAcademy.com shall have the right at any time to change or discontinue any aspect or feature of www.TJMAcademy.com, including, but not limited to, content, hours of availability, and equipment needed for access or use. 
                <br><br>
                2.	CHANGED TERMS
                <br><br>
                TJMAcademy.com shall have the right at any time to change or modify the terms and conditions applicable to User's use of www.TJMAcademy.com, or any part thereof, or to impose new conditions, including, but not limited to, adding fees and charges for use. Such changes, modifications, additions or deletions shall be effective immediately upon notice thereof, which may be given by means including, but not limited to, posting on www.TJMAcademy.com, or by electronic or conventional mail, or by any other means by which User obtains notice thereof. Any use of www.TJMAcademy.com by User after such notice shall be deemed to constitute acceptance by User of such changes, modifications or additions. 
                <br><br>
                3.	DESCRIPTION OF SERVICES
                <br><br>
                Through its Web property, TJMAcademy.com provides User with access to a variety of resources, including download areas, communication forums and product information (collectively "Services"). The Services, including any updates, enhancements, new features, and/or the addition of any new Web properties, are subject to the TOU. 
                <br><br>
                4.	EQUIPMENT
                <br><br>
                User shall be responsible for obtaining and maintaining all telephone, computer hardware, software and other equipment needed for access to and use of www.TJMAcademy.com and all charges related thereto. 
                <br><br>
                5.	USER CONDUCT
                <br><br>
                A.	User shall use www.TJMAcademy.com for lawful purposes only. User shall not post or transmit through www.TJMAcademy.com any material which violates or infringes in any way upon the rights of others, which is unlawful, threatening, abusive, defamatory, invasive of privacy or publicity rights, vulgar, obscene, profane or otherwise objectionable, which encourages conduct that would constitute a criminal offense, give rise to civil liability or otherwise violate any law, or which, without TJMAcademy.com 's express prior approval, contains advertising or any solicitation with respect to products or services. Any conduct by a User who, in TJMAcademy.com's discretion, restricts or inhibits any other User from using or enjoying www.TJMAcademy.com will not be permitted. User shall not use www.TJMAcademy.com to advertise or perform any commercial solicitation, including, but not limited to, the solicitation of users to become subscribers of other on-line information services competitive with TJMAcademy.com. 
                <br><br>
                B.	www.TJMAcademy.com contains copyrighted material, trademarks and other proprietary information, including, but not limited to, text, software, photos, video, graphics, music and sound, and the entire contents of www.TJMAcademy.com are copyrighted as a collective work under the United States copyright laws. TJMAcademy.com owns a copyright in the selection, coordination, arrangement and enhancement of such content, as well as in the content original to it. User may not modify, publish, transmit, participate in the transfer or sale, create derivative works, or in any way exploit, any of the content, in whole or in part. User may download copyrighted material for User's personal use only. Except as otherwise expressly permitted under copyright law, no copying, redistribution, retransmission, publication or commercial exploitation of downloaded material will be permitted without the express permission of TJMAcademy.com and the copyright owner. In the event of any permitted copying, redistribution or publication of copyrighted material, no changes in or deletion of author attribution, trademark legend or copyright notice shall be made. User acknowledges that it does not acquire any ownership rights by downloading copyrighted material. 
                <br><br>
                C.	User shall not upload, post or otherwise make available on www.TJMAcademy.com any material protected by copyright, trademark or other proprietary right without the express permission of the owner of the copyright, trademark or other proprietary right and the burden of determining that any material is not protected by copyright rests with User. User shall be solely liable for any damage resulting from any infringement of copyrights, proprietary rights, or any other harm resulting from such a submission. By submitting material to any public area of www.TJMAcademy.com, User automatically grants, or warrants that the owner of such material has expressly granted TJMAcademy.com the royalty-free, perpetual, irrevocable, non-exclusive right and license to use, reproduce, modify, adapt, publish, translate and distribute such material (in whole or in part) worldwide and/or to incorporate it in other works in any form, media or technology now known or hereafter developed for the full term of any copyright that may exist in such material. User also permits any other User to access, view, store or reproduce the material for that User's personal use. User hereby grants TJMAcademy.com the right to edit, copy, publish and distribute any material made available on www.TJMAcademy.com by User. 
                <br><br>
                D.	The foregoing provisions of Section 5 are for the benefit of TJMAcademy.com, its subsidiaries, affiliates and its third party content providers and licensors and each shall have the right to assert and enforce such provisions directly or on its own behalf. 
                <br><br>
                6.	USE OF SERVICES
                <br><br>
                The Services may contain e-mail services, bulletin board services, chat areas, news groups, forums, communities, personal web pages, calendars, photo albums, file cabinets and/or other message or communication facilities designed to enable User to communicate with others (each a "Communication Service" and collectively "Communication Services"). User agrees to use the Communication Services only to post, send and receive messages and material that are proper and, when applicable, related to the particular Communication Service. By way of example, and not as a limitation, User agrees that when using the Communication Services, User will not: 
                <br><br>
                •	Use the Communication Services in connection with surveys, contests, pyramid schemes, chain letters, junk email, spamming or any duplicative or unsolicited messages (commercial or otherwise). 
                <br><br>
                •	Defame, abuse, harass, stalk, threaten or otherwise violate the legal rights (such as rights of privacy and publicity) of others. 
                <br><br>
                •	Publish, post, upload, distribute or disseminate any inappropriate, profane, defamatory, obscene, indecent or unlawful topic, name, material or information. 
                <br><br>
                •	Upload, or otherwise make available, files that contain images, photographs, software or other material protected by intellectual property laws, including, by way of example, and not as limitation, copyright or trademark laws (or by rights of privacy or publicity) unless User own or control the rights thereto or have received all necessary consent to do the same. 
                <br><br>
                •	Use any material or information, including images or photographs, which are made available through the Services in any manner that infringes any copyright, trademark, patent, trade secret, or other proprietary right of any party. 
                <br><br>
                •	Upload files that contain viruses, Trojan horses, worms, time bombs, cancelbots, corrupted files, or any other similar software or programs that may damage the operation of another's computer or property of another. 
                <br><br>
                •	Advertise or offer to sell or buy any goods or services for any business purpose, unless such Communication Services specifically allows such messages. 
                <br><br>
                •	Download any file posted by another user of a Communication Service that User know, or reasonably should know, cannot be legally reproduced, displayed, performed, and/or distributed in such manner. 
                <br><br>
                •	Falsify or delete any copyright management information, such as author attributions, legal or other proper notices or proprietary designations or labels of the origin or source of software or other material contained in a file that is uploaded. 
                <br><br>
                •	Restrict or inhibit any other user from using and enjoying the Communication Services. 
                <br><br>
                •	Violate any code of conduct or other guidelines which may be applicable for any particular Communication Service. 
                <br><br>
                •	Harvest or otherwise collect information about others, including e-mail addresses. 
                <br><br>
                •	Violate any applicable laws or regulations. 
                <br><br>
                •	Create a false identity for the purpose of misleading others. 
                <br><br>
                •	Use, download or otherwise copy, or provide (whether or not for a fee) to a person or entity any directory of users of the Services or other user or usage information or any portion thereof. 
                <br><br>
                TJMAcademy.com has no obligation to monitor the Communication Services. However, TJMAcademy.com reserves the right to review materials posted to the Communication Services and to remove any materials in its sole discretion. TJMAcademy.com reserves the right to terminate User’s access to any or all of the Communication Services at any time, without notice, for any reason whatsoever. TJMAcademy.com reserves the right at all times to disclose any information as it deems necessary to satisfy any applicable law, regulation, legal process or governmental request, or to edit, refuse to post or to remove any information or materials, in whole or in part, in TJMAcademy.com's sole discretion. 
                <br><br>
                Materials uploaded to the Communication Services may be subject to posted limitations on usage, reproduction and/or dissemination; User is responsible for adhering to such limitations if User downloads the materials. 
                <br><br>
                Always use caution when giving out any personally identifiable information in any Communication Services. TJMAcademy.com does not control or endorse the content, messages or information found in any Communication Services and, therefore, TJMAcademy.com specifically disclaims any liability with regard to the Communication Services and any actions resulting from User’s participation in any Communication Services. Managers and hosts are not authorized TJMAcademy.com spokespersons, and their views do not necessarily reflect those of TJMAcademy.com. 
                <br><br>
                7.	MEMBER ACCOUNT, PASSWORD, AND SECURITY
                <br><br>
                If any of the Services requires User to open an account, User must complete the registration process by providing TJMAcademy.com with current, complete and accurate information as prompted by the applicable registration form. User also will choose a password and a user name. User is entirely responsible for maintaining the confidentiality of User’s password and account. Furthermore, User is entirely responsible for any and all activities that occur under User’s account. User agrees to notify TJMAcademy.com immediately of any unauthorized use of User’s account or any other breach of security. TJMAcademy.com will not be liable for any loss that User may incur as a result of someone else using User’s password or account, either with or without User’s knowledge. However, User could be held liable for losses incurred by TJMAcademy.com or another party due to someone else using User’s account or password. User may not use anyone else's account at any time, without the permission of the account holder. 
                <br><br>
                8.	NOTICE SPECIFIC TO SOFTWARE AVAILABLE ON THIS WEB SITE
                <br><br>
                Any software that is made available to download from the Services ("Software") is the copyrighted work of TJMAcademy.com and/or its suppliers. Use of the Software is governed by the terms of the end user license agreement, if any, which accompanies or is included with the Software ("License Agreement"). An end user will be unable to install any Software that is accompanied by or includes a License Agreement, unless he or she first agrees to the License Agreement terms. 
                <br><br>
                The Software is made available for download solely for use by end users according to the License Agreement. Any reproduction or redistribution of the Software not in accordance with the License Agreement is expressly prohibited by law, and may result in severe civil and criminal penalties. Violators will be prosecuted to the maximum extent possible. 
                <br><br>
                WITHOUT LIMITING THE FOREGOING, COPYING OR REPRODUCTION OF THE SOFTWARE TO ANY OTHER SERVER OR LOCATION FOR FURTHER REPRODUCTION OR REDISTRIBUTION IS EXPRESSLY PROHIBITED, UNLESS SUCH REPRODUCTION OR REDISTRIBUTION IS EXPRESSLY PERMITTED BY THE LICENSE AGREEMENT ACCOMPANYING SUCH SOFTWARE. THE SOFTWARE IS WARRANTED, IF AT ALL, ONLY ACCORDING TO THE TERMS OF THE LICENSE AGREEMENT. EXCEPT AS WARRANTED IN THE LICENSE AGREEMENT, TJMAcademy.com HEREBY DISCLAIMS ALL WARRANTIES AND CONDITIONS WITH REGARD TO THE SOFTWARE, INCLUDING ALL WARRANTIES AND CONDITIONS OF MERCHANTABILITY, WHETHER EXPRESS, IMPLIED OR STATUTORY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. 
                <br><br>
                FOR YOUR CONVENIENCE, TJMAcademy.com MAY MAKE AVAILABLE AS PART OF THE SERVICES OR IN ITS SOFTWARE PRODUCTS, TOOLS AND UTILITIES FOR USE AND/OR DOWNLOAD. TJMAcademy.com DOES NOT MAKE ANY ASSURANCES WITH REGARD TO THE ACCURACY OF THE RESULTS OR OUTPUT THAT DERIVES FROM SUCH USE OF ANY SUCH TOOLS AND UTILITIES. PLEASE RESPECT THE INTELLECTUAL PROPERTY RIGHTS OF OTHERS WHEN USING THE TOOLS AND UTILITIES MADE AVAILABLE ON THE SERVICES.
                <br><br>
                9.	NOTICE SPECIFIC TO DOCUMENTS AVAILABLE ON THIS WEB SITE
                <br><br>
                Permission to use Documents (such as white papers, press releases, datasheets and FAQs) from the Services is granted, provided that (1) the below copyright notice appears in all copies and that both the copyright notice and this permission notice appear, (2) use of such Documents from the Services is for informational and non-commercial or personal use only and will not be copied or posted on any network computer or broadcast in any media, and (3) no modifications of any Documents are made. Accredited educational institutions, such as universities, private/public colleges, and state community colleges, may download and reproduce the Documents for distribution in the classroom. Distribution outside the classroom requires express written permission. Use for any other purpose is expressly prohibited by law, and may result in severe civil and criminal penalties. Violators will be prosecuted to the maximum extent possible. 
                <br><br>
                TJMACADEMY.COM AND/OR ITS RESPECTIVE SUPPLIERS MAKE NO REPRESENTATIONS ABOUT THE SUITABILITY OF THE INFORMATION CONTAINED IN THE DOCUMENTS AND RELATED GRAPHICS PUBLISHED AS PART OF THE SERVICES FOR ANY PURPOSE. ALL SUCH DOCUMENTS AND RELATED GRAPHICS ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND. TJMACADEMY.COM AND/OR ITS RESPECTIVE SUPPLIERS HEREBY DISCLAIM ALL WARRANTIES AND CONDITIONS WITH REGARD TO THIS INFORMATION, INCLUDING ALL WARRANTIES AND CONDITIONS OF MERCHANTABILITY, WHETHER EXPRESS, IMPLIED OR STATUTORY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. IN NO EVENT SHALL TJMACADEMY.COM AND/OR ITS RESPECTIVE SUPPLIERS BE LIABLE FOR ANY SPECIAL, INDIRECT OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF INFORMATION AVAILABLE FROM THE SERVICES. 
                <br><br>
                THE DOCUMENTS AND RELATED GRAPHICS PUBLISHED ON THE SERVICES COULD INCLUDE TECHNICAL INACCURACIES OR TYPOGRAPHICAL ERRORS. CHANGES ARE PERIODICALLY ADDED TO THE INFORMATION HEREIN. TJMACADEMY.COM AND/OR ITS RESPECTIVE SUPPLIERS MAY MAKE IMPROVEMENTS AND/OR CHANGES IN THE PRODUCT(S) AND/OR THE PROGRAM(S) DESCRIBED HEREIN AT ANY TIME. 
                <br><br>
                10.	NOTICES REGARDING SOFTWARE, DOCUMENTS AND SERVICES AVAILABLE ON THIS SITE
                <br><br>
                IN NO EVENT SHALL TJMACADEMY.COM AND/OR ITS RESPECTIVE SUPPLIERS BE LIABLE FOR ANY SPECIAL, INDIRECT OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF SOFTWARE, DOCUMENTS, PROVISION OF OR FAILURE TO PROVIDE SERVICES, OR INFORMATION AVAILABLE FROM THE SERVICES. 
                <br><br>
                11.	MATERIALS PROVIDED TO TJMACADEMY.COM OR POSTED AT ANY OF ITS WEB SITES
                <br><br>
                TJMAcademy.com does not claim ownership of the materials User provide to TJMAcademy.com (including feedback and suggestions) or post, upload, input or submit to any Services or its associated services for review by the general public, or by the members of any public or private community, (each a "Submission" and collectively "Submissions"). However, by posting, uploading, inputting, providing or submitting ("Posting") User’s Submission User is granting TJMAcademy.com, its affiliated companies and necessary sublicensees permission to use User’s Submission in connection with the operation of their Internet businesses (including, without limitation, all TJMAcademy.com Services), including, without limitation, the license rights to: copy, distribute, transmit, publicly display, publicly perform, reproduce, edit, translate and reformat User’s Submission; to publish User’s name in connection with User’s Submission; and the right to sublicense such rights to any supplier of the Services. 
                <br><br>
                No compensation will be paid with respect to the use of User’s Submission, as provided herein. TJMAcademy.com is under no obligation to post or use any Submission User may provide and TJMAcademy.com may remove any Submission at any time in its sole discretion. By Posting a Submission User warrants and represents to own or otherwise control all of the rights to User’s Submission as described in these Terms of Use including, without limitation, all the rights necessary for User to provide, post, upload, input or submit the Submissions. 
                <br><br>
                In addition to the warranty and representation set forth above, by Posting a Submission that contain images, photographs, pictures or that are otherwise graphical in whole or in part ("Images"), User warrant and represent that (a) User is the copyright owner of such Images, or that the copyright owner of such Images has granted User permission to use such Images or any content and/or images contained in such Images consistent with the manner and purpose of User’s use and as otherwise permitted by these Terms of Use and the Services, (b) User have the rights necessary to grant the licenses and sublicenses described in these Terms of Use, and (c) that each person depicted in such Images, if any, has provided consent to the use of the Images as set forth in these Terms of Use, including, by way of example, and not as a limitation, the distribution, public display and reproduction of such Images. By Posting Images, User is granting (a) to all members of User’s private community (for each such Images available to members of such private community), and/or (b) to the general public (for each such Images available anywhere on the Services, other than a private community), permission to use User’s Images in connection with the use, as permitted by these Terms of Use, of any of the Services, (including, by way of example, and not as a limitation, making prints and gift items which include such Images), and including, without limitation, a non-exclusive, world-wide, royalty-free license to: copy, distribute, transmit, publicly display, publicly perform, reproduce, edit, translate and reformat User’s Images without having User’s name attached to such Images, and the right to sublicense such rights to any supplier of the Services. The licenses granted in the preceding sentences for a Images will terminate at the time User completely remove such Images from the Services, provided that, such termination shall not affect any licenses granted in connection with such Images prior to the time User completely remove such Images. No compensation will be paid with respect to the use of User’s Images. 
                <br><br>
                12.	DISCLAIMER OF WARRANTY; LIMITATION OF LIABILITY
                <br><br>
                A.	USER EXPRESSLY AGREES THAT USE OF WWW.TJMACADEMY.COM IS AT USER'S SOLE RISK. NEITHER TJMACADEMY.COM, ITS AFFILIATES NOR ANY OF THEIR RESPECTIVE EMPLOYEES, AGENTS, THIRD PARTY CONTENT PROVIDERS OR LICENSORS WARRANT THAT WWW.TJMACADEMY.COM WILL BE UNINTERRUPTED OR ERROR FREE; NOR DO THEY MAKE ANY WARRANTY AS TO THE RESULTS THAT MAY BE OBTAINED FROM USE OF WWW.TJMACADEMY.COM, OR AS TO THE ACCURACY, RELIABILITY OR CONTENT OF ANY INFORMATION, SERVICE, OR MERCHANDISE PROVIDED THROUGH WWW.TJMACADEMY.COM. 
                <br><br>
                B.	WWW.TJMACADEMY.COM IS PROVIDED ON AN "AS IS" BASIS WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF TITLE OR IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE, OTHER THAN THOSE WARRANTIES WHICH ARE IMPLIED BY AND INCAPABLE OF EXCLUSION, RESTRICTION OR MODIFICATION UNDER THE LAWS APPLICABLE TO THIS AGREEMENT. 
                <br><br>
                C.	THIS DISCLAIMER OF LIABILITY APPLIES TO ANY DAMAGES OR INJURY CAUSED BY ANY FAILURE OF PERFORMANCE, ERROR, OMISSION, INTERRUPTION, DELETION, DEFECT, DELAY IN OPERATION OR TRANSMISSION, COMPUTER VIRUS, COMMUNICATION LINE FAILURE, THEFT OR DESTRUCTION OR UNAUTHORIZED ACCESS TO, ALTERATION OF, OR USE OF RECORD, WHETHER FOR BREACH OF CONTRACT, TORTIOUS BEHAVIOR, NEGLIGENCE, OR UNDER ANY OTHER CAUSE OF ACTION. USER SPECIFICALLY ACKNOWLEDGES THAT TJMACADEMY.COM IS NOT LIABLE FOR THE DEFAMATORY, OFFENSIVE OR ILLEGAL CONDUCT OF OTHER USERS OR THIRD-PARTIES AND THAT THE RISK OF INJURY FROM THE FOREGOING RESTS ENTIRELY WITH USER. 
                <br><br>
                D.	IN NO EVENT WILL TJMACADEMY.COM, OR ANY PERSON OR ENTITY INVOLVED IN CREATING, PRODUCING OR DISTRIBUTING WWW.TJMACADEMY.COM OR THE TJMACADEMY.COM SOFTWARE, BE LIABLE FOR ANY DAMAGES, INCLUDING, WITHOUT LIMITATION, DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR PUNITIVE DAMAGES ARISING OUT OF THE USE OF OR INABILITY TO USE WWW.TJMAcademy.com. USER HEREBY ACKNOWLEDGES THAT THE PROVISIONS OF THIS SECTION SHALL APPLY TO ALL CONTENT ON THE SITE. 
                <br><br>
                E.	IN ADDITION TO THE TERMS SET FORTH ABOVE NEITHER, TJMACADEMY.COM, NOR ITS AFFILIATES, INFORMATION PROVIDERS OR CONTENT PARTNERS SHALL BE LIABLE REGARDLESS OF THE CAUSE OR DURATION, FOR ANY ERRORS, INACCURACIES, OMISSIONS, OR OTHER DEFECTS IN, OR UNTIMELINESS OR UNAUTHENTICITY OF, THE INFORMATION CONTAINED WITHIN WWW.TJMACADEMY.COM, OR FOR ANY DELAY OR INTERRUPTION IN THE TRANSMISSION THEREOF TO THE USER, OR FOR ANY CLAIMS OR LOSSES ARISING THEREFROM OR OCCASIONED THEREBY. NONE OF THE FOREGOING PARTIES SHALL BE LIABLE FOR ANY THIRD-PARTY CLAIMS OR LOSSES OF ANY NATURE, INCLUDING, BUT NOT LIMITED TO, LOST PROFITS, PUNITIVE OR CONSEQUENTIAL DAMAGES. 
                <br><br>
                F.	PRIOR TO THE EXECUTION OF A STOCK TRADE, USERS ARE ADVISED TO CONSULT WITH YOUR BROKER OR OTHER FINANCIAL REPRESENTATIVE TO VERIFY PRICING OR OTHER INFORMATION. TJMACADEMY.COM, ITS AFFILIATES, INFORMATION PROVIDERS OR CONTENT PARTNERS SHALL HAVE NO LIABILITY FOR INVESTMENT DECISIONS BASED ON THE INFORMATION PROVIDED. NEITHER, TJMACADEMY.COM, NOR ITS AFFILIATES, INFORMATION PROVIDERS OR CONTENT PARTNERS WARRANT OR GUARANTEE THE TIMELINESS, SEQUENCE, ACCURACY OR COMPLETENESS OF THIS INFORMATION. ADDITIONALLY, THERE ARE NO WARRANTIES AS TO THE RESULTS OBTAINED FROM THE USE OF THE INFORMATION. 
                <br><br>
                G.	FORCE MAJEURE – NEITHER PARTY WILL BE RESPONSIBLE FOR ANY FAILURE OR DELAY IN PERFORMANCE DUE TO CIRCUMSTANCES BEYOND ITS REASONABLE CONTROL, INCLUDING, WITHOUT LIMITATION, ACTS OF GOD, WAR, RIOT, EMBARGOES, ACTS OF CIVIL OR MILITARY AUTHORITIES, FIRE, FLOODS, ACCIDENTS, SERVICE OUTAGES RESULTING FROM EQUIPMENT AND/OR SOFTWARE FAILURE AND/OR TELECOMMUNICATIONS FAILURES, POWER FAILURES, NETWORK FAILURES, FAILURES OF THIRD PARTY SERVICE PROVIDERS (INCLUDING PROVIDERS OF INTERNET SERVICES AND TELECOMMUNICATIONS). THE PARTY AFFECTED BY ANY SUCH EVENT SHALL NOTIFY THE OTHER PARTY WITHIN A MAXIMUM OF FIFTEEN (15) DAYS FROM ITS OCCURENCE. THE PERFORMANCE OF THS AGREEMENT SHALL THEN BE SUSPENDED FOR AS LONG AS ANY SUCH EVENT SHALL PREVENT THE AFFECTED PARTY FROM PERFORMING ITS OBLIGATIONS UNDER THIS AGREEMENT. 
                <br><br>
                13.	LINKS TO THIRD PARTY SITES
                <br><br>
                THE LINKS IN THIS AREA WILL LET YOU LEAVE TJMACADEMY.COM'S SITE. THE LINKED SITES ARE NOT UNDER THE CONTROL OF TJMACADEMY.COM AND TJMACADEMY.COM IS NOT RESPONSIBLE FOR THE CONTENTS OF ANY LINKED SITE OR ANY LINK CONTAINED IN A LINKED SITE, OR ANY CHANGES OR UPDATES TO SUCH SITES. TJMACADEMY.COM IS NOT RESPONSIBLE FOR WEBCASTING OR ANY OTHER FORM OF TRANSMISSION RECEIVED FROM ANY LINKED SITE. TJMACADEMY.COM IS PROVIDING THESE LINKS TO YOU ONLY AS A CONVENIENCE, AND THE INCLUSION OF ANY LINK DOES NOT IMPLY ENDORSEMENT BY TJMACADEMY.COM OF THE SITE. 
                <br><br>
                TJMAcademy.com is a distributor (and not a publisher) of content supplied by third parties and Users. Accordingly, TJMAcademy.com has no more editorial control over such content than does a public library, bookstore, or newsstand. Any opinions, advice, statements, services, offers, or other information or content expressed or made available by third parties, including information providers, Users or any other user of www.TJMAcademy.com, are those of the respective author(s) or distributor(s) and not of TJMAcademy.com. Neither TJMAcademy.com nor any third-party provider of information guarantees the accuracy, completeness, or usefulness of any content, nor its merchantability or fitness for any particular purpose. 
                <br><br>
                In many instances, the content available through www.TJMAcademy.com represents the opinions and judgments of the respective information provider, User, or other user not under contract with TJMAcademy.com. TJMAcademy.com neither endorses nor is responsible for the accuracy or reliability of any opinion, advice or statement made on www.TJMAcademy.com by anyone other than authorized TJMAcademy.com employee spokespersons while acting in their official capacities. Under no circumstances will TJMAcademy.com be liable for any loss or damage caused by a User's reliance on information obtained through www.TJMAcademy.com. It is the responsibility of User to evaluate the accuracy, completeness or usefulness of any information, opinion, advice or other content available through TJMAcademy.com. Please seek the advice of professionals, as appropriate, regarding the evaluation of any specific information, opinion, advice or other content.
                <br><br>
                14.	UNSOLICITED IDEA SUBMISSION POLICY
                <br><br>
                TJMACADEMY.COM OR ANY OF ITS EMPLOYEES DO NOT ACCEPT OR CONSIDER UNSOLICITED IDEAS, INCLUDING IDEAS FOR NEW ADVERTISING CAMPAIGNS, NEW PROMOTIONS, NEW PRODUCTS OR TECHNOLOGIES, PROCESSES, MATERIALS, MARKETING PLANS OR NEW PRODUCT NAMES. PLEASE DO NOT SEND ANY ORIGINAL CREATIVE ARTWORK, SAMPLES, DEMOS, OR OTHER WORKS. THE SOLE PURPOSE OF THIS POLICY IS TO AVOID POTENTIAL MISUNDERSTANDINGS OR DISPUTES WHEN TJMACADEMY.COM'S PRODUCTS OR MARKETING STRATEGIES MIGHT SEEM SIMILAR TO IDEAS SUBMITTED TO TJMACADEMY.COM. SO, PLEASE DO NOT SEND YOUR UNSOLICITED IDEAS TO TJMACADEMY.COM OR ANYONE AT TJMACADEMY.COM. IF, DESPITE OUR REQUEST THAT YOU NOT SEND US YOUR IDEAS AND MATERIALS, YOU STILL SEND THEM, PLEASE UNDERSTAND THAT TJMACADEMY.COM MAKES NO ASSURANCES THAT YOUR IDEAS AND MATERIALS WILL BE TREATED AS CONFIDENTIAL OR PROPRIETARY. 
                <br><br>
                15.	MONITORING
                <br><br>
                TJMAcademy.com shall have the right, but not the obligation, to monitor the content of www.TJMAcademy.com, including chat rooms and forums, to determine compliance with this Agreement and any operating rules established by TJMAcademy.com and to satisfy any law, regulation or authorized government request. TJMAcademy.com shall have the right in its sole discretion to edit, refuse to post or remove any material submitted to or posted on www.TJMAcademy.com. Without limiting the foregoing, TJMAcademy.com shall have the right to remove any material that TJMAcademy.com, in its sole discretion, finds to be in violation of the provisions hereof or otherwise objectionable. 
                <br><br>
                16.	INDEMNIFICATION
                <br><br>
                User agrees to defend, indemnify and hold harmless TJMAcademy.com, its affiliates and their respective directors, officers, employees and agents from and against all claims and expenses, including attorneys' fees, arising out of the use of TJMAcademy.com by User or User's Account. 
                <br><br>
                17.	TERMINATION
                <br><br>
                Either TJMAcademy.com or User may terminate this Agreement at any time. Without limiting the foregoing, TJMAcademy.com shall have the right to immediately terminate User's Account in the event of any conduct by User which TJMAcademy.com, in its sole discretion, considers to be unacceptable, or in the event of any breach by User of this Agreement. 
                <br><br>
                18.	MISCELLANEOUS
                <br><br>
                This Agreement and any operating rules for www.TJMAcademy.com established by TJMAcademy.com  constitute the entire agreement of the parties with respect to the subject matter hereof, and supersede all previous written or oral agreements between the parties with respect to such subject matter. This Agreement shall be construed in accordance with the laws of the Oregon, USA, without regard to its conflict of laws rules. No waiver by either party of any breach or default hereunder shall be deemed to be a waiver of any preceding or subsequent breach or default. The section headings used herein are for convenience only and shall not be given any legal import. 
                <br><br>
                19.	COPYRIGHT NOTICE 
                <br><br>
                TJMAcademy.com its logos are trademarks of TJMAcademy.com. All rights reserved. All other trademarks appearing on TJMAcademy.com are the property of their respective owners. 
                <br><br>
                20.	TRADEMARKS
                <br><br>
                The names of actual companies and products mentioned herein may be the trademarks of their respective owners. The example companies, organizations, products, domain names, email addresses, logos, people and events depicted herein are fictitious. No association with any real company, organization, product, domain name, e-mail address, logo, person, or event is intended or should be inferred. 
                <br><br>
                Any rights not expressly granted herein are reserved.
                <br><br>
            </div>

            <div class="row clearfix">
                <div class="col-sm-12" align="left">&nbsp;</div>
            </div>
        </div>
    </div>

<br><br>
<?php
include 'templates/footer.tpl';
?>
</body>
</html>