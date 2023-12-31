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
$_SESSION['page'] = 6;
include 'templates/topmenu.tpl';
include "templates/freebies.tpl";
?>
    <div class='container-fluid'>
        <div class='row clearfix'>
            <div class='col-sm-12' align='left'>
                <font size="+4"><strong>Privacy Statement</strong></font>
                <br><br>
                TJMAcademy.com is committed to protecting your privacy and developing technology that gives you the most powerful and safe online experience. This Statement of Privacy applies to the TJMAcademy.com website and governs data collection and usage. By using the TJMAcademy.com website, you consent to the data practices described in this statement.
                <h3>Collection of your Personal Information</h3>
                TJMAcademy.com collects personally identifiable information, such as, but not limited to, your e-mail address, name, home or work address or telephone number. TJMAcademy.com also collects anonymous demographic information, which is not unique to you, such as, but not limited to, your ZIP code, age, gender, preferences, interests and favorites.
                <br><br>
                There is also information about your computer hardware and software that is automatically collected by TJMAcademy.com. This information can include: your IP address, browser type, domain names, access times and referring website addresses. This information is used by TJMAcademy.com for the operation of the service, to maintain quality of the service, and to provide general statistics regarding use of the TJMAcademy.com website.
                <br><br>
                TJMAcademy.com encourages you to review the privacy statements of websites you choose to link to from TJMAcademy.com so that you can understand how those websites collect, use and share your information. TJMAcademy.com is not responsible for the privacy statements or other content on websites outside of the TJMAcademy.com and TJMAcademy.com family of websites.
                <h3>Use of your Personal Information</h3>
                TJMAcademy.com collects and uses your personal information to operate the TJMAcademy.com website and deliver the services you have requested. TJMAcademy.com also uses your personally identifiable information to inform you of other products or services available from TJMAcademy.com and its affiliates. TJMAcademy.com may also contact you via surveys to conduct research about your opinion of current services or of potential new services that may be offered.
                <br><br>
                TJMAcademy.com does not sell, rent or lease its customer lists to third parties. TJMAcademy.com may, from time to time, contact you on behalf of external business partners about a particular offering that may be of interest to you. In those cases, your unique personally identifiable information (e-mail, name, address, telephone number) is not transferred to the third party. In addition, TJMAcademy.com may share data with trusted partners to help us perform statistical analysis, send you email or postal mail, provide customer support, or arrange for deliveries. All such third parties are prohibited from using your personal information except to provide these services to TJMAcademy.com, and they are required to maintain the confidentiality of your information.
                <br><br>
                TJMAcademy.com does not use or disclose sensitive personal information, such as race, religion, or political affiliations, without your explicit consent.
                <br><br>
                TJMAcademy.com keeps track of the websites and pages our customers visit within TJMAcademy.com, in order to determine what TJMAcademy.com services are the most popular. This data is used to deliver customized content within TJMAcademy.com to customers whose behavior indicates that they are interested in a particular subject area.
                <br><br>
                TJMAcademy.com websites will disclose your personal information, without notice, only if required to do so by law or in the good faith belief that such action is necessary to: (a) conform to the edicts of the law or comply with legal process served on TJMAcademy.com or the site; (b) protect and defend the rights or property of TJMAcademy.com; and, (c) act under exigent circumstances to protect the personal safety of users of TJMAcademy.com, or the public.
                <h3>Use of Cookies</h3>
                The TJMAcademy.com website use "cookies" to help you personalize your online experience. A cookie is a text file that is placed on your hard disk by a Web page server. Cookies cannot be used to run programs or deliver viruses to your computer. Cookies are uniquely assigned to you, and can only be read by a web server in the domain that issued the cookie to you.
                <br><br>
                One of the primary purposes of cookies is to provide a convenience feature to save you time. The purpose of a cookie is to tell the Web server that you have returned to a specific page. For example, if you personalize TJMAcademy.com's pages, or register with TJMAcademy.com site or services, a cookie helps TJMAcademy.com to recall your specific information on subsequent visits. This simplifies the process of recording your personal information, such as billing addresses, shipping addresses, and so on. When you return to the same TJMAcademy.com website, the information you previously provided can be retrieved, so you can easily use the TJMAcademy.com features that you customized.
                <br><br>
                You have the ability to accept or decline cookies. Most Web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. If you choose to decline cookies, you may not be able to fully experience the interactive features of the TJMAcademy.com services or websites you visit.
                <h3>Security of your Personal Information</h3>
                TJMAcademy.com secures your personal information from unauthorized access, use or disclosure. TJMAcademy.com secures the personally identifiable information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use or disclosure. When personal information (such as a credit card number) is transmitted to other websites, it is protected through the use of encryption, such as the Secure Socket Layer (SSL) protocol.
                <h3>Changes to this Statement</h3>
                TJMAcademy.com will occasionally update this Statement of Privacy to reflect company and customer feedback. TJMAcademy.com encourages you to periodically review this Statement to be informed of how TJMAcademy.com is protecting your information.
                <h3>Contact Information</h3>
                TJMAcademy.com welcomes your comments regarding this Statement of Privacy. If you believe that TJMAcademy.com has not adhered to this Statement, please contact TJMAcademy.com. We will use commercially reasonable efforts to promptly determine and remedy the problem.
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