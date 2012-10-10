<?php 
$nav=0;
include("includes/adminsessions.php");
include('includes/header.php'); 
?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="customerGrid_table">
            <thead>
              
              <tr>
                <td width="83%" height="100" align="left" class="tr5">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">                  
                  <tr>
                    <td height="20" align="left" class="content-header">Add your payment details</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table>  <form action="campaign-information.php" method="post" name="profilrfrm" enctype="multipart/form-data" onsubmit="return validatemember();">
				
<input type="hidden" name="userid" id="userid" value="<?php echo $_REQUEST['mid']; ?>" />
<input type="hidden" name="page" id="page" value="<?php echo $_REQUEST['page']; ?>" />

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" align="left" class="form-headings"><?php echo $title;?> </td>
                    </tr>
                    
                    <tr>
                      <td class="form-bg2"><table width="100%" cellpadding="0" cellspacing="1" id="customerGrid_table2">
                        <thead>
                          
                          
                          <tr>
                            <td width="12%" align="left" class="tr2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="23%" height="10" align="left"></td>
                                <td width="76%" height="10" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" colspan="2" align="left" class="table-tab">Billing information</td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>First Name</strong></td>
                                <td align="left"><input name="textfield" type="text" class="textfill" id="textfield" value="test first name" /></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt><strong>Last Name </strong></dt>
                                  <dt>&nbsp;</dt>
                                </dl>                                </td>
                                <td align="left"><input name="textfield2" type="text" class="textfill" id="textfield2" value="test first name" /></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left">                                  <strong>Email Address
                                  </strong>
                                  <dt>&nbsp;</dt>                                  <dt>&nbsp;</dt></td>
                                <td align="left"><input name="textfield6" type="text" class="textfill" id="textfield6" value="test first name" /></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left">                                  <strong>First Line of Billing Address</strong>                                </td>
                                <td align="left"><textarea name="textarea" id="textarea" cols="45" rows="5" class="w-165"></textarea></td>
                              </tr>
                              
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                                </tr>
                              <tr>
                                <td height="30" align="left">                                  <strong>Country</strong>                                  <dt>&nbsp;</dt></td>
                                <td align="left"><select tabindex="2" title="Country" id="billcountry_id" name="billcountry_id" class="w-165">
			     <option value="">-- Select Country --</option>
			   <option value="240">United Kingdom</option><option value="2">Canada</option><option value="3">Afghanistan</option><option value="4">Albania</option><option value="5">Algeria</option><option value="6">American Samoa</option><option value="7">Andorra</option><option value="8">Angola</option><option value="9">Anguilla</option><option value="10">Antarctica</option><option value="11">Antigua and Barbuda</option><option value="12">Argentina</option><option value="13">Armenia</option><option value="14">Aruba</option><option value="15">Australia</option><option value="16">Austria</option><option value="17">Azerbaijan</option><option selected="seleted" value="18">Bahamas</option><option value="19">Bahrain</option><option value="20">Bangladesh</option><option value="21">Barbados</option><option value="22">Belarus</option><option value="23">Belgium</option><option value="24">Belize</option><option value="25">Benin</option><option value="26">Bermuda</option><option value="27">Bhutan</option><option value="28">Bolivia</option><option value="29">Bosnia and Herzegovina</option><option value="30">Botswana</option><option value="31">Bouvet Island</option><option value="32">Brazil</option><option value="34">Brunei Darussalam</option><option value="35">Bulgaria</option><option value="36">Burkina Faso</option><option value="37">Burundi</option><option value="38">Cambodia</option><option value="39">Cameroon</option><option value="40">Cape Verde</option><option value="41">Cayman Islands</option><option value="42">Central African Republic</option><option value="43">Chad</option><option value="44">Chile</option><option value="45">China</option><option value="46">Christmas Island</option><option value="47">Cocos (Keeling) Islands</option><option value="48">Colombia</option><option value="49">Comoros</option><option value="50">Congo</option><option value="51">Cook Islands</option><option value="52">Costa Rica</option><option value="53">Croatia (Hrvatska)</option><option value="54">Cuba</option><option value="55">Cyprus</option><option value="56">Czech Republic</option><option value="57">Denmark</option><option value="58">Djibouti</option><option value="59">Dominica</option><option value="60">Dominican Republic</option><option value="61">East Timor</option><option value="62">Ecudaor</option><option value="63">Egypt</option><option value="64">El Salvador</option><option value="65">Equatorial Guinea</option><option value="66">Eritrea</option><option value="67">Estonia</option><option value="68">Ethiopia</option><option value="69">Falkland Islands (Malvinas)</option><option value="70">Faroe Islands</option><option value="71">Fiji</option><option value="72">Finland</option><option value="73">France</option><option value="74">France, Metropolitan</option><option value="75">French Guiana</option><option value="76">French Polynesia</option><option value="77">French Southern Territories</option><option value="78">Gabon</option><option value="79">Gambia</option><option value="80">Georgia</option><option value="81">Germany</option><option value="82">Ghana</option><option value="83">Gibraltar</option><option value="84">Greece</option><option value="85">Greenland</option><option value="86">Grenada</option><option value="87">Guadeloupe</option><option value="88">Guam</option><option value="89">Guatemala</option><option value="90">Guinea</option><option value="91">Guinea-Bissau</option><option value="92">Guyana</option><option value="93">Haiti</option><option value="95">Honduras</option><option value="96">Hong Kong</option><option value="97">Hungary</option><option value="98">Iceland</option><option value="99">India</option><option value="100">Indonesia</option><option value="101">Iran</option><option value="102">Iraq</option><option value="103">Ireland</option><option value="104">Israel</option><option value="105">Italy</option><option value="106">Ivory Coast</option><option value="107">Jamaica</option><option value="108">Japan</option><option value="109">Jordan</option><option value="110">Kazakhstan</option><option value="111">Kenya</option><option value="112">Kiribati</option><option value="113">Korea, Democratic</option><option value="114">Korea, Republic of</option><option value="115">Kuwait</option><option value="116">Kyrgyzstan</option><option value="117">Lao</option><option value="118">Latvia</option><option value="119">Lebanon</option><option value="120">Lesotho</option><option value="121">Liberia</option><option value="122">Libyan Arab Jamahiriya</option><option value="123">Liechtenstein</option><option value="124">Lithuania</option><option value="125">Luxembourg</option><option value="126">Macau</option><option value="127">Macedonia</option><option value="128">Madagascar</option><option value="129">Malawi</option><option value="130">Malaysia</option><option value="131">Maldives</option><option value="132">Mali</option><option value="133">Malta</option><option value="134">Marshall Islands</option><option value="135">Martinique</option><option value="136">Mauritania</option><option value="137">Mauritius</option><option value="138">Mayotte</option><option value="139">Mexico</option><option value="140">Micronesia</option><option value="141">Moldova, Republic of</option><option value="142">Monaco</option><option value="143">Mongolia</option><option value="144">Montserrat</option><option value="145">Morocco</option><option value="146">Mozambique</option><option value="147">Myanmar</option><option value="148">Namibia</option><option value="149">Nauru</option><option value="150">Nepal</option><option value="151">Netherlands</option><option value="152">Netherlands Antilles</option><option value="153">New Caledonia</option><option value="154">New Zealand</option><option value="155">Nicaragua</option><option value="156">Niger</option><option value="157">Nigeria</option><option value="158">Niue</option><option value="159">Norfork Island</option><option value="160">Northern Mariana Islands</option><option value="161">Norway</option><option value="162">Oman</option><option value="163">Pakistan</option><option value="164">Palau</option><option value="165">Panama</option><option value="166">Papua New Guinea</option><option value="167">Paraguay</option><option value="168">Peru</option><option value="169">Philippines</option><option value="170">Pitcairn</option><option value="171">Poland</option><option value="172">Portugal</option><option value="173">Puerto Rico</option><option value="174">Qatar</option><option value="175">Reunion</option><option value="176">Romania</option><option value="177">Russian Federation</option><option value="178">Rwanda</option><option value="180">Saint Lucia</option><option value="182">Samoa</option><option value="183">San Marino</option><option value="184">Sao Tome and Principe</option><option value="185">Saudi Arabia</option><option value="186">Senegal</option><option value="187">Seychelles</option><option value="188">Sierra Leone</option><option value="189">Singapore</option><option value="190">Slovakia</option><option value="191">Slovenia</option><option value="192">Solomon Islands</option><option value="193">Somalia</option><option value="194">South Africa</option><option value="195">South Georgia</option><option value="196">Spain</option><option value="197">Sri Lanka</option><option value="198">St. Helena</option><option value="199">St. Pierre and Miquelon</option><option value="200">Sudan</option><option value="201">Suriname</option><option value="203">Swaziland</option><option value="204">Sweden</option><option value="205">Switzerland</option><option value="206">Syrian Arab Republic</option><option value="207">Taiwan</option><option value="208">Tajikistan</option><option value="209">Tanzania</option><option value="210">Thailand</option><option value="211">Togo</option><option value="212">Tokelau</option><option value="213">Tonga</option><option value="214">Trinidad and Tobago</option><option value="215">Tunisia</option><option value="216">Turkey</option><option value="217">Turkmenistan</option><option value="218">Turks and Caicos Islands</option><option value="219">Tuvalu</option><option value="220">Uganda</option><option value="221">Ukraine</option><option value="222">United Arab Emirates</option><option value="223">United States</option><option value="225">Uruguay</option><option value="226">Uzbekistan</option><option value="227">Vanuatu</option><option value="228">Vatican City State</option><option value="229">Venezuela</option><option value="230">Vietnam</option><option value="231">Virigan Islands (British)</option><option value="232">Virgin Islands (U.S.)</option><option value="233">Wallis and Futuna Islands</option><option value="234">Western Sahara</option><option value="235">Yemen</option><option value="236">Yugoslavia</option><option value="237">Zaire</option><option value="238">Zambia</option><option value="239">Zimbabwe</option>               </select></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left">                                  <strong>State/Province</strong>                                  <dt>&nbsp;</dt></td>
                                <td align="left"><input name="textfield8" type="text" class="textfill" id="textfield8" value="test first name" /></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left">                                  <strong>City</strong>                                </td>
                                <td align="left"><input name="textfield9" type="text" class="textfill" id="textfield9" value="test first name" /></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left">                                  <strong>Zip/Postal Code</strong>                                                                    </td>
                                <td align="left"><input name="textfield4" type="text" class="textfill" id="textfield4" value="http://www.twitter.com/" /></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><strong>Telephone</strong></td>
                                <td align="left"><input name="textfield5" type="text" class="textfill" id="textfield5" value="http://www.facebook.com/" /></td>
                              </tr>
                              
                              
                              
                              <tr>
                                <td align="left">&nbsp;</td>
                                <td height="10" align="left">&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left" class="table-tab">Your payment details (secure)</td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" align="left"></td>
                                </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt>Card Type</dt>
                                </dl>                                </td>
                                <td height="10" align="left"><select tabindex="2" name="CreditCardType" id="CreditCardType" class="w-165">
              <option value="">--Please Select--</option>
            <option selected="seleted" value="AmEx">American Express</option><option value="MasterCard">MasterCard</option><option value="Visa">Visa</option><option value="Discover">Discover</option><option value="Maestro">Maestro</option><option value="Solo">Solo</option>            </select></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt>Card Number </dt>
                                </dl>                                </td>
                                <td height="10" align="left"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><span class="small-text">XXXX-XXXX-XXXX-1111 </span></td>
                                  </tr>
                                  <tr>
                                    <td align="left" valign="top"><input name="textfield3" type="text" class="textfill" id="textfield3" /></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="8" colspan="2" align="left"></td>
                                </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt>Expiry Date </dt>
                                </dl>                                </td>
                                <td height="10" align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><select tabindex="2" name="CC_ExpDate_Month" id="CC_ExpDate_Month" class="w-88">
          <option value="">-- Month --</option>
            <option value="1">January</option><option value="2">February</option><option selected="selected" value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">Octorber</option><option value="11">November</option><option value="12">December</option>           </select></td>
                                    <td>&nbsp;</td>
                                    <td><select tabindex="2" name="CC_ExpDate_Year" style="width: 75px;" id="CC_ExpDate_Year" class="w-65">
             <option value="">-- Year --</option>
           <option value="2010"> 2010 </option><option value="2011"> 2011 </option><option value="2012"> 2012 </option><option selected="selected" value="2013"> 2013 </option><option value="2014"> 2014 </option><option value="2015"> 2015 </option><option value="2016"> 2016 </option><option value="2017"> 2017 </option><option value="2018"> 2018 </option><option value="2019"> 2019 </option><option value="2020"> 2020 </option><option value="2021"> 2021 </option><option value="2022"> 2022 </option><option value="2023"> 2023 </option><option value="2024"> 2024 </option><option value="2025"> 2025 </option><option value="2026"> 2026 </option><option value="2027"> 2027 </option><option value="2028"> 2028 </option><option value="2029"> 2029 </option>           </select></td>
                                  </tr>
                                  
                                </table></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt>Name on Card </dt>
                                </dl>                                </td>
                                <td height="10" align="left"><input name="textfield7" type="text" class="textfill" id="textfield7" /></td>
                              </tr>
                              <tr>
                                <td height="30" align="left"><dl>
                                  <dt>Card Verification #</dt>
                                </dl>                                </td>
                                <td height="10" align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left" valign="middle"><input name="textfield10" type="text" class="textfill-small" id="textfield10"  /></td>
                                    <td align="left" valign="middle">&nbsp;</td>
                                    <td align="left" valign="middle">Most cards:</td>
                                    <td width="55" align="center" valign="middle"><img src="images/visaVerification.gif" width="49" height="30" /></td>
                                    <td align="left" valign="middle">Amex:</td>
                                    <td width="55" align="center" valign="middle"><img src="images/amexVerification.gif" width="49" height="30" /></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td align="left"><dl>
                                  <dt>&nbsp;</dt>
                                </dl>                                </td>
                                <td height="10" align="left">&nbsp;</td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left">&nbsp;</td>
                                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><a href="campaign-information.php">
                                      <input type="submit" name="button" id="button" value="back" class="button" />
                                    </a></td>
                                    <td>&nbsp;</td>
                                    <td><a href="template-preview.php"><input type="submit" value="Save and deploy" id="submitproduct" class="button" name="submitproduct" /></a></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table></td>
                    </tr>
                  </table></form></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table></td>
        </tr>
      </table>
	 
     <?php include('includes/footer.php'); ?>