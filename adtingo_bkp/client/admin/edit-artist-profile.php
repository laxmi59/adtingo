<?php 
$nav=1;
include("includes/adminsessions.php");
include('includes/header.php'); ?>
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
                <td width="17%" align="left" class="tr5"><div id="left">
                <ul>
                <li class="tittle"> Artist information</li>
                <li><a href="#" class="selected">Manage Pprofile</a></li>
                <li><a href="view-listing.php">view marketplace</a></li>
                <li><a href="view-jobs.php">view jobs</a></li>
                 <li><a href="ratings-reviews.php">ratings & reviews</a></li>
                  </ul>
                </div></td>
                <td width="1%" align="left" class="tr5">&nbsp;</td>
             <td width="83%" height="100" align="left" class="tr5"><table width="100%" border="0" cellspacing="0" cellpadding="0">                 <tr>
                    <td height="20" align="left" class="content-header">&lt;username&gt;</td>
                    <td align="right"  class="padbot5">&nbsp;</td>
                  </tr>
                  <tr class="grey-bg">
                    <td height="4" colspan="2"></td>
                  </tr>
                </table><table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tbody><tr>
				  <td align="left"> </td>
				</tr>
				<tr>
				  <td align="left" class="form-headings"><table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody><tr>
					  <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr>
	<td align="left">edit personal  profile </td>
	<td align="right" class="padright10"><a class="thickbox arrow-blue" href="view-artist-profile.html?height=338&amp;width=720">preview</a></td>
	</tr>
	</tbody></table></td>
					</tr>
				  </tbody></table></td>
				</tr>
				<tr>
				  <td class="form-bg">
					  <table width="100%" cellspacing="0" cellpadding="0" border="0"><form action="members.php"/>
						<tbody>
						<tr>
						  <td height="10" width="1%" align="left"/>
						  <td height="10" width="23%" align="left"/>
						  <td height="10" width="76%" align="left"/>
						</tr>
						<tr>
						  <td align="left"> </td>
						  <td height="30" align="left">First Name</td>
						  <td align="left"><input name="emailaddress7" type="text" class="input2" value="Johnny "/></td>
						</tr>
						<tr>
						  <td align="left"> </td>
						  <td height="30" align="left">Last Name</td>
						  <td align="left"><input name="emailaddress2" type="text" class="input2" value="Cash"/></td>
						</tr>
						<tr>
						  <td align="left"> </td>
						  <td height="30" align="left">Upload Your Photo</td>
						  <td align="left"><input type="file" name="fileField" class="input2" id="fileField" /></td>
						</tr>
						<tr>
						  <td align="left"> </td>
						  <td height="70" align="left">Description</td>
						  <td align="left"><textarea>Consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
</textarea></td>
						</tr>						
						<tr>
						  <td align="left"> </td>
						  <td height="30" align="left"> </td>
						  <td align="left"><input type="submit" value="Submit" id="button3" class="button" name="button3"/></td>
						</tr>
					  </tbody></table>                      </td>
				</tr>
			  </tbody></table>
                  </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table> </td>
        </tr>
      </table>
     <?php include('includes/footer.php'); ?>