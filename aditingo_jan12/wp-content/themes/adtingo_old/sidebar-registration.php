<div class="content-left">
  <form onSubmit="return validateformStep1();" method="post" name="registration" action="registration_step2.php">
    <div id="div-Form">
      <div class="form-title">Create  Profile Step1</div>
      <div class="requiredfields"><span class="red">*</span> Required Fields </div>
      <div class="register-form">
        <div align="center" class="errer-mess2"></div>
        <dl class="form1">
          <dt>Email address <span class="red">*</span></dt>
          <dd>
            <input type="text" onChange="member_emailcheck(this.value,'emailerr');" value="" id="email" class="inputs" name="email">
            <input type="hidden" id="emailerr" name="emailerr">
            <input type="hidden" id="metroIds" name="metroIds">
          </dd>
          <dt> Subscriptions List <span class="red">*</span></dt>
          <dd>
            <div class="subscriptions">
              <ul class="subscriptions-fields">
                <li>
                  <input type="checkbox" value="86" id="metropolitian_area1" name="metropolitian_area">
                  &nbsp;Adtingo Nation&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="69" id="metropolitian_area2" name="metropolitian_area">
                  &nbsp;Atlanta&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="70" id="metropolitian_area3" name="metropolitian_area">
                  &nbsp;Austin&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="71" id="metropolitian_area4" name="metropolitian_area">
                  &nbsp;Boston&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="96" id="metropolitian_area5" name="metropolitian_area">
                  &nbsp;Boston123&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="88" id="metropolitian_area6" name="metropolitian_area">
                  &nbsp;Boston21&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="92" id="metropolitian_area7" name="metropolitian_area">
                  &nbsp;Boston31&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="72" id="metropolitian_area8" name="metropolitian_area">
                  &nbsp;Chicago&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="73" id="metropolitian_area9" name="metropolitian_area">
                  &nbsp;Dallas&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="74" id="metropolitian_area10" name="metropolitian_area">
                  &nbsp;Denver&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="75" id="metropolitian_area11" name="metropolitian_area">
                  &nbsp;Hamptons&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="76" id="metropolitian_area12" name="metropolitian_area">
                  &nbsp;Las Vegas&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="77" id="metropolitian_area13" name="metropolitian_area">
                  &nbsp;London&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="78" id="metropolitian_area14" name="metropolitian_area">
                  &nbsp;Los Angeles&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="79" id="metropolitian_area15" name="metropolitian_area">
                  &nbsp;Miami&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="80" id="metropolitian_area16" name="metropolitian_area">
                  &nbsp;New York&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="81" id="metropolitian_area17" name="metropolitian_area">
                  &nbsp;Philadelphia&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="82" id="metropolitian_area18" name="metropolitian_area">
                  &nbsp;San Diego&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="83" id="metropolitian_area19" name="metropolitian_area">
                  &nbsp;San Francisco&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="84" id="metropolitian_area20" name="metropolitian_area">
                  &nbsp;Seattle&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="97" id="metropolitian_area21" name="metropolitian_area">
                  &nbsp;test&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="98" id="metropolitian_area22" name="metropolitian_area">
                  &nbsp;test123&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="99" id="metropolitian_area23" name="metropolitian_area">
                  &nbsp;test1234&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="91" id="metropolitian_area24" name="metropolitian_area">
                  &nbsp;test211&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="89" id="metropolitian_area25" name="metropolitian_area">
                  &nbsp;test22&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="90" id="metropolitian_area26" name="metropolitian_area">
                  &nbsp;test23&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="93" id="metropolitian_area27" name="metropolitian_area">
                  &nbsp;test31&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="94" id="metropolitian_area28" name="metropolitian_area">
                  &nbsp;test32&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="95" id="metropolitian_area29" name="metropolitian_area">
                  &nbsp;test33&nbsp;&nbsp;</li>
                <li>
                  <input type="checkbox" value="85" id="metropolitian_area30" name="metropolitian_area">
                  &nbsp;Washington DC&nbsp;&nbsp;</li>
              </ul>
            </div>
          </dd>
          <dt></dt>
          <dd>
            <input type="submit" value="Next" name="but" class="greenButton">
          </dd>
        </dl>
        <div class="signup"> </div>
      </div>
    </div>
  </form>
</div>
<?php get_sidebar('sidebar-adtingo2'); ?>
