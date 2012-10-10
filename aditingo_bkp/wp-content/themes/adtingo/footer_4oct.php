<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<?
$arr = getValue($_SERVER['REQUEST_URI']);
//echo $catid;
?>
<div class="footer-container">
  <div class="footer">
    <ul class="footerlinks">
      <li>
		<? if($arr[1]<>'') echo wp_show_categories_footer($arr[1]);?>
		</li>
      <li>
        <div class="footer-left">
		<? $foot=Footer_Page_Names();
		echo $foot;?>
		</div>
        <div class="footer-right"><a href="#" class="like-us"></a><a href="#" class="follow-us"></a></div>
      </li>
      <li><span class="f-11">You have received this email because you have opted to subcribe to our deals. If you wish to have a miserable life and unsubscribe, don't let us stop you.</span></li>
    </ul>
  </div>
</div>
</body>
</html>
