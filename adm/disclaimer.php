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
$_SESSION['page'] = 5;
include 'templates/topmenu.tpl';
include "templates/freebies.tpl";
?>
    <div class='container-fluid'>
        <div class='row clearfix'>
            <div class='col-sm-12' align='left'>
            	<font size="+4"><strong>Disclaimer</strong></font>
                <br><br>
                This website is owned and operated by TJ Moore Internet Marketing Academy("Company," "our," "we," or "us").
                <br>
                <br>
                This Disclaimer, along with the Terms of Use and Privacy Policy, governs your access to and use of www.tjmacademy.com, including any content, functionality and services offered on or through www.tjmacademy.com (the “Website”), whether a guest or a registered user.
                <br>
                <br>
                Please read the Disclaimer carefully before you start to use the Website(s). By using the Website(s) or by clicking to accept or agree to the Terms of Use when this option is made available to you, you accept and agree to be bound and abide by the Disclaimer. If you do not want to agree to the Privacy Policy, you must not access or use the Website(s).
                <br><br>
                <font size="+1"><strong>For Educational And Informational Purposes Only</strong></font>
                <br><br>
                The information contained on our Website(s) and the resources available for download through our website(s) are for educational and informational purposes only.
                <br><br>
                <font size="+1"><strong>Not Legal Or Other Professional Advice</strong></font>
                <br><br>
                The information contained on our Website(s) and the resources available for download through our Website(s) is not intended and shall not be understood or construed as, legal, ﬁnancial, tax, or other professional advice.
                <br><br>
                We have done our best to ensure that the information provided on our Website(s) and the resources available for download are accurate and provide valuable information.
                <br><br>
                Neither the Company nor any of its employees shall be held liable or responsible for any errors or omissions on our Website(s) for any damage you may suffer as a result of failing to seek competent legal or professional advice from a licensed attorney or other professional who is familiar with your situation.
                <br><br>
                <font size="+1"><strong>User’s Personal Responsibility</strong></font>
                <br><br>
                By using our Website(s), you accept personal responsibility for the results of your actions. You agree to take full responsibility for any harm or damage you suffer as a result of the use, or non-use, of the information available on our Website(s) or the resources available for download from our Website(s). You agree to use judgment and conduct due diligence before taking any action implementing any plan or policy suggested or recommended on our Website(s).
                <br><br>
                <font size="+1"><strong>No Guarantees</strong></font>
                <br><br>
                You agree that the Company has not made any guarantees about the results of taking any action, whether recommended on our Website(s) or not. The Company provides educational and informational resources that are intended to help users of our Website(s) succeed in business and otherwise. You, nevertheless, recognize that your ultimate success or failure will be the result of your own efforts, your particular situation, and innumerable other circumstances beyond the control and/or knowledge of the Company.
                <br><br>
                You also recognize that prior results do not guarantee a similar outcome. Thus, the results obtained by others – whether client or customers of the Company or otherwise – applying the principles set out in our Website(s) are no guarantee that you or another other person or entity will be able to obtain similar results.
                <br><br>
                <font size="+1"><strong>Errors And Omissions</strong></font>
                <br><br>
                Our World Wide Web Sites are a public resource of general information that is intended, but not promised or guaranteed, to be correct, complete, and up-to-date. We have taken reasonable steps to ensure that the information contained in our Website(s) is accurate, but we cannot represent that our Website(s) are free of errors. You accept that the information contained on our Website(s) may be erroneous and agree to conduct due diligence to verify any information obtained from our Website(s) and/or resources available on it prior to taking any action. You expressly agree not to rely upon any information contained in our Website(s).
                <br><br>
                <font size="+1"><strong>Reviews</strong></font>
                <br><br>
                At various times, we may provide reviews of products, services, or other resources. This may include reviews of books, services and/or software applications. Any such reviews will represent the good-faith opinions of the author of such review. The products and services reviewed may be provided to the Company for free or at a reduced price as an incentive to provide a review.
                <br><br>
                Regardless of any such discounts, we will provide honest reviews of these products and/or services. You recognize that you should conduct your own due diligence and should not rely solely upon any reviews provided on our Website(s).
                <br><br>
                We will disclose the existence of any discounts or incentives received in exchange for providing a review of a product. If you would like more information about any such discounts and incentives, send an email to support@teemor.com that includes the title of the reviewed product as the subject line. We will respond via email and disclose any incentives or products we received in association with any such review.
                <br><br>
                <font size="+1"><strong>No Endorsements</strong></font>
                <br><br>
                From time to time, the Company will refer to other products, services, coaches, consultants, and/or experts. Any such referral is not intended as an endorsement or statement that the information provided by the other party is accurate. The Company provides this information as a reference for users. It is your responsibility to conduct your own investigation and make your own determination about any such product, service, coach, consultant, and/or expert.
                <br><br>
                <font size="+1"><strong>Testimonials</strong></font>
                <br><br>
                At various places on our Website(s), you may ﬁnd testimonials from clients and customers of the products and services offered on our Website(s) or by the Company. The testimonials are actual statements made by clients and/or customers and have been truthfully conveyed on our Website(s).
                <br><br>
                Although these testimonials are truthful statements about results obtained by these clients and/or customers, the results obtained by these clients and/or customers are not necessarily typical. You speciﬁcally recognize and agree that the testimonials are not a guarantee of results that you or anyone else will obtain by using any products or services offered on our Website(s) or by the Company.
                <br><br>
                <font size="+1"><strong>Earnings Disclaimer</strong></font>
                <br><br>
                From time to time, the Company may report on the success of one of its existing or prior clients/customers. The information about this success is accurately portrayed by the Customer. You acknowledge that the prior success of others does not guarantee your success.
                <br><br>
                As with any business, your results may vary and will be based on your individual capacity, business experience, expertise, level of desire. There are no guarantees concerning the level of success you may experience. There is no guarantee that you will make any income at all and you accept the risk that the earnings and income statements differ by individual. Each individual’s success depends on his or her background, dedication, desire and motivation.
                <br><br>
                The use of our information, products and services should be based on your own due diligence and you agree that the Company is not liable for any success or failure of your business that is directly or indirectly related to the purchase and use of our information, products, and services reviewed or advertised on our Website(s).
                <br><br>
                <font size="+1"><strong>No Warranties</strong></font>
                <br><br>
                THE COMPANY MAKES NO WARRANTIES REGARDING THE PERFORMANCE OR OPERATION OF OUR WEBSITES(S). THE COMPANY FURTHER MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE INFORMATION, CONTENTS, MATERIALS, DOCUMENTS, PROGRAMS, PRODUCTS, BOOKS, OR SERVICES INCLUDED ON OR THROUGH OUR WEBSITES(S). TO THE FULLEST EXTENT PERMISSIBLE UNDER THE LAW, THE COMPANY DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.
                <br><br>
                <font size="+1"><strong>Limitation of Liability</strong></font>
                <br><br>
                YOU AGREE TO ABSOLVE THE COMPANY OF ANY AND ALL LIABILITY OR LOSS THAT YOU OR ANY PERSON OR ENTITY ASSOCIATED WITH YOU MAY SUFFER OR INCUR AS A RESULT OF USE OF THE INFORMATION CONTAINED ON OUR WEBSITES(S) AND/OR THE RESOURCES YOU MAY DOWNLOAD FROM OUR WEBSITES(S). YOU AGREE THAT THE COMPANY SHALL NOT BE LIABLE TO YOU FOR ANY TYPE OF DAMAGES, INCLUDING DIRECT, INDIRECT, SPECIAL, INCIDENTAL, EQUITABLE, OR CONSEQUESTIONAL LOSS OR DAMAGES FOR USE OF OUR WEBSITES(S).
                <br><br>
                THE INFORMATION, SOFTWARE, PRODUCTS, AND SERVICES INCLUDED IN OR AVAILABLE THROUGH OUR WEBSITES(S) MAY INCLUDE INACCURACIES OR TYPOGRAPHICAL ERRORS. CHANGES ARE PERIODICALLY ADDED TO THE INFORMATION HEREIN. THE COMPANY AND/OR ITS SUPPLIERS MAY MAKE IMPROVEMENTS AND/OR CHANGES IN OUR WEBSITES(S) AT ANY TIME.
                <br><br>
                THE COMPANY AND/OR ITS SUPPLIERS MAKE NO REPRESENTATIONS ABOUT THE SUITABILITY, RELIABILITY, AVAILABIITY, TIMELINESS, AND ACCURACY OF THE INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS CONTAINED ON OUR WEBSITES(S) FOR ANY PURPOSE. TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, ALL SITE INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS ARE PROVIDED "AS IS" WITHOUT WARRANTY OR CONDITION OF ANY KIND. THE COMPANY AND/OR ITS SUPPLIERS HEREBY DISCLAIM ALL WARRANTIES AND CONDITIONS WITH REGARD TO THIS INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS, INCLUDING ALL IMPLIED WARRANTIES OR CONDITIONS OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, AND NO INFRINGEMENT.
                <br><br>
                TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT SHALL THE COMPANY AND/OR ITS SUPPLIERS BE LIABLE FOR ANY DIRECT, INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL, CONSEQUENTIAL DAMAGES OR ANY DAMAGE WHATSOEVER INCLUDING, WITHOUT LIMITATION, DAMAGES FOR LOSS OF USE, DATA OR PROFITS, ARISING OUT OF OR IN ANY WAY CONNECTED WITH THE USE OR PERFORMANCE OF OUR WEBSITES(S), WITH THE DELAY OR INABILITY TO USE OUR WEBSITES(S) OR RELATED SERVICES, THE PROVISION OF OR FAILURE TO PROVIDE SERVICES, OR FOR ANY INFORMATION,
                SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS OBTAINED THROUGH OUR WEBSITES(S), OR OTHERWISE ARISING OUT OF THE USE OF OUR WEBSITES(S), WHETHER BASED ON CONTRACT, TORT, NEGLIGENCE, STRICT LIABILITY OR OTHER EVEN IF THE COMPANY OR ANY OF ITS SUPPLIERS HAS BEEN ADVISED OF THE POSSIBILITY OF DAMAGES. BECAUSE STATES/JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, THE ABOVE LIMITATION MAY NOT APPLY TO YOU. IF YOU ARE DISSATISFIED WITH ANY PORTION OF OUR WEBSITES(S), OR WITH ANY OF THESE TERMS OF USE, YOUR SOLE AND EXCLUSIVE REMEDY IS TO DISCONTINUE USING OUR WEBSITES(S).
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