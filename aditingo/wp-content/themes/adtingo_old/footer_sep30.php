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
$ex1=$_SERVER['REQUEST_URI'];
$file = basename(rtrim($ex1, '/'));
$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id and slug='$file' order by tab2.name ");
$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);

if($Sel_Sub_Cat_Num){
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	if($file=="category")$catid="atlanta"; else $catid=$file;

	$sel=mysql_fetch_array(mysql_query("select * from `wp_terms` where slug='$catid'"));
	$Row=mysql_fetch_array(mysql_query("select * from `wp_term_taxonomy` where term_id=$sel[term_id]"));
	if($Row['parent']<>0){
		$Sel_parent=mysql_fetch_array(mysql_query("select * from `wp_terms` where term_id=$Row[parent]"));
		$catid=$Sel_parent['slug'];
	}
}else{
	//echo "tttt";
	$Sel_Sub_Cat=mysql_query("SELECT * FROM `wp_term_taxonomy` as tab1, `wp_terms` as tab2 where tab1.taxonomy = 'category' and tab1.parent = 0 and tab1.term_id = tab2.term_id order by tab2.name ");
	$Sel_Sub_Cat_Num = mysql_num_rows($Sel_Sub_Cat);
	$catid="atlanta";
}

?>
<div class="footer-container">
  <div class="footer">
    <ul class="footerlinks">
      <li><!--<a href="#">Food &amp; Dining</a> | <a href="#">Style</a> | <a href="#">Entertainment</a> | <a href="#">Travel</a> | <a href="#">Nightlife</a> | <a href="#">Home &amp; Gadgets</a> | <a href="electronics_gadgets.php">Electronics &amp; Gadgets</a> | <a href="#">Dating</a><br />
        | <a href="#">Sports &amp; Fitness</a> | <a href="#">Career &amp; Money</a> | <a href="#">Cars</a> | <a href="#">Health &amp; Beauty</a> |-->
		<? if($catid<>'') echo wp_show_categories_footer($catid);?>
		</li>
      <li>
        <div class="footer-left"><a href="#">Privacy Policy</a> | <a href="#">Terms &amp; Conditions</a> | <a href="#">Advertise</a> | <a href="#">Contact Us</a> | <a href="#">Unsubscribe</a></div>
        <div class="footer-right"><a href="#" class="like-us"></a><a href="#" class="follow-us"></a></div>
      </li>
      <li><span class="f-11">You have received this email because you have opted to subcribe to our deals. If you wish to have a miserable life and unsubscribe, don't let us stop you.</span></li>
    </ul>
  </div>
</div>
</body>
</html>
