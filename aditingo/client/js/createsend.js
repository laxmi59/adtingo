var pages=function(){function a(){document.title=this.title;$("#iloveie").html("<h1>"+this.h1+"</h1>");try{pageTracker._trackPageview("/createSend/"+this.name+".aspx");}catch(b){}}return{addPage:function(b,c,d){this[b]={title:c,h1:d,load:a};}};}();if(!window.CS){window.CS={};}CS.PaymentForm=function(){return{showPayment:function(){$("#paymentForm").show();if($("#editCard").is(":visible")){$("#savecard").val(true);}},hidePayment:function(){$("#savecard").val(false);$("#paymentForm").hide();},toggleEdit:function(){$("#editCard").toggle();$("#existingCard").toggle();if($("#editCard").is(":visible")){$("#savecard").val(true);}else{$("#savecard").val(false);}return false;},showLoading:function(){$("#waitButton").toggle();$("#payButton").toggle();document.confirmTest.submit();},showFilters:function(a){$("#"+a).toggle();},prePayClick:function(a,b){if(a||!canUseCredits){$("#creditCharge").html(b);}else{this.hidePayment();}},cardPayClick:function(a,b){if(a||!canUseCredits){$("#creditCharge").html(b);}else{this.showPayment();}},changeABCosts:function(a){var b=a=="AB"?doubleTest:singleTest;$("#creditsPaymentString").html(b.creditsString);$("#fullPaymentString").html(b.fullPaymentString);$("#paymentMethodPre").val(b.paymentType);$("#paymentMethodPre").click(function(){CS.PaymentForm.prePayClick(b.mixedPayment,b.remaining);});$("#paymentMethodCard").click(function(){CS.PaymentForm.cardPayClick(b.mixedPayment,b.costs);});if(b.mixedPayment){$("#creditCharge").html(b.remaining);$("#paymentMethodCard").attr("checked",true);$("#paymentMethodPre").attr("checked",false);this.showPayment("paymentForm");}else{$("#creditCharge").html(b.costs);$("#paymentMethodPre").attr("checked",true);$("#paymentMethodCard").attr("checked",false);if(canUseCredits){this.hidePayment("paymentForm");}}}};}();if(!window.CS){window.CS={};}CS.Default={checkUnschedule:function(b){var a="Are you sure you want to move this campaign back to drafts?";if(confirm(a)){location.replace("default.aspx?cID="+b+"&action=unschedule");}return false;}};if(!window.CS){window.CS={};}CS.DSTesting={showDrafts:function(){if($("#selectDraft").is(":visible")){$("#selectDraft").slideUp("slow");}else{$("#selectDraft").slideDown("slow");}},hideDropDown:function(){$("#versionDropDown").hide();$("#aVersion").attr("checked",true);},showDropDown:function(){$("#versionDropDown").show();$("#aVersion").attr("checked",true);}};if(!window.CS){window.CS={};}CS.Step1=function(){var d=false;function a(e){if($("#authenticatedDomain").is(":visible")){if($("input[name='abSplit']").val()=="True"){var f=$("input[name='testType']:checked").val();switch(f){case"Subject":e="abSubjectAuthDomain";break;case"Content":e="abContentAuthDomain";break;}}else{e="regularAuthDomain";}}switch(e){case"regular":c(1,2,"","",3,4,"","","","","","","","","","",5,6);break;case"regularAuthDomain":c(1,2,"","",3,"","","","","",4,5,"","","","",6,7);break;case"abSubject":c(1,"",2,3,4,5,"","","","","","","","","","",6,7);break;case"abSubjectAuthDomain":c(1,"",2,3,4,"","","","","",5,6,"","","","",7,8);break;case"abContent":c(1,2,"","",3,4,"","","","","","","","","","",5,6);break;case"abContentAuthDomain":c(1,2,"","",3,"","","","","",4,5,"","","","",6,7);break;case"abFrom":c(1,2,"","","","",3,4,5,6,"","","","","","",7,8);break;}if($("#authenticatedDomainA").is(":visible")){c(1,2,"","","","",3,4,"","","","",5,6,7,8,9,10);}}function c(t,f,l,q,u,e,k,v,h,s,g,n,r,m,p,j,o,i){$("#campaignName").attr("tabindex",t);$("#subject").attr("tabindex",f);$("#subjectA").attr("tabindex",l);$("#subjectB").attr("tabindex",q);$("#fromName").attr("tabindex",u);$("#fromEmail").attr("tabindex",e);$("#fromNameA").attr("tabindex",k);$("#fromNameB").attr("tabindex",v);$("#fromEmailA").attr("tabindex",h);$("#fromEmailB").attr("tabindex",s);$("#fromEmailPrefix").attr("tabindex",g);$("#fromEmailDomain").attr("tabindex",n);$("#fromEmailPrefixA").attr("tabindex",r);$("#fromEmailDomainA").attr("tabindex",m);$("#fromEmailPrefixB").attr("tabindex",p);$("#fromEmailDomainB").attr("tabindex",j);$("#replyTo").attr("tabindex",o);$("#submitButton").attr("tabindex",i);setTimeout(function(){$("#campaignName").focus();},300);}function b(){if($("#bVersionLossWarning")!=null){if(abState=="ab"&&$("#radioContent").is(":checked")){$("#bVersionLossWarning").hide();}else{$("#bVersionLossWarning").show();}}}return{editedReply:function(){d=true;},switchDomain:function(f){var e="#fromEmail"+f;var g="#fromEmailPrefix"+f;if($("#fromEmailDomain"+f).val()=="switch"){$("#isitauthenticated"+f).val("False");$("#authenticatedDomain"+f).toggle();$("#authenticationTick"+f).toggle();$("#differentDomainDesc"+f).toggle();$("#differentDomainEntry"+f).toggle();if($(g).val()==""){$(e).val("");}else{$(e).val($(g).val()+"@");}$(e).focus();}},useAuthenticated:function(g){var e="#fromEmail"+g;var h="#fromEmailPrefix"+g;var f="#fromEmailDomain"+g;$("#isitauthenticated"+g).val("True");$("#authentication"+g).show();$("#authenticatedDomain"+g).show();$("#authenticationTick"+g).show();$("#differentDomainDesc"+g).hide();$("#differentDomainEntry"+g).hide();$(f).attr("selectedIndex",0);a("authDomain");$(e).val($(h).val()+"@"+$(f).attr("options")[0].text);},copyName:function(e){if($(e).val()==""){$(e).val(document.step1_1.campaignName.value);}},copyEmail:function(e){if(document.step1_1.replyTo.value==""){document.step1_1.replyTo.value=$("#fromEmail"+e).val();}},copyAuthEmail:function(g){var f="#fromEmailDomain"+g;var e="#fromEmailPrefix"+g;var h="#fromEmail"+g;domain=$(f).attr("options")[$(f).attr("selectedIndex")].text;if(domain!="Use a different domain"){if(!d&&g!="B"&&$(e).val()!=""){document.step1_1.replyTo.value=$(e).val()+"@"+domain;}$(h).val($(e).val()+"@"+domain);}},personalizeSubject:function(g){var e="#subject"+g;var f=$(e).val()+$("#personalize"+g).val();$(e).val(f);$(e).focus();},togglePersonalization:function(e){$("#personalizeOff"+e).toggle();$("#personalizeOn"+e).toggle();return false;},showAbSettings:function(){if(abState=="reg"){document.step1_1.abSplit.value="True";var f=$("input[name='testType']:checked").val();var e=f;selectedTestType=f;$("#regTab").removeClass("current");$("#abTab").addClass("current");$("#numA").html("2");$("#numB").html("3");$("#numC").html("4");$("#numD").html("5");$("#numE").html("6");$("#absplits").show();$("#regIcons").hide();if(e=="Subject"){$("#regSubject").hide();$("#abSubject").show();a("abSubject");$("#sfIcons").fadeIn("slow");}if(e=="Content"){a("abContent");$("#coIcons").fadeIn("slow");}if(e=="FromName"){$("#regFrom").hide();$("#abFrom").show();a("abFrom");$("#sfIcons").fadeIn("slow");}abState="ab";}else{document.step1_1.abSplit.value="False";abState="reg";$("#abTab").removeClass("current");$("#regTab").addClass("current");$("#numA").html("1");$("#numB").html("2");$("#numC").html("3");$("#numD").html("4");$("#numE").html("5");$("#absplits").hide();$("#abSubject").hide();$("#regSubject").show();$("#abFrom").hide();$("#regFrom").show();$("#sfIcons").hide();$("#coIcons").hide();a("regular");$("#regIcons").fadeIn("slow");}b();},showTest:function(){if($("#radioSubject").is(":checked")){selectedTestType="Subject";$("#regSubject").hide();$("#abSubject").show();$("#abFrom").hide();$("#regFrom").show();$("#coIcons").hide();a("abSubject");$("#sfIcons").fadeIn("slow");}else{if($("#radioContent").is(":checked")){selectedTestType="Subject";$("#abSubject").hide();$("#regSubject").show();$("#abFrom").hide();$("#regFrom").show();$("#sfIcons").hide();a("abContent");$("#coIcons").fadeIn("slow");}else{selectedTestType="FromName";$("#abSubject").hide();$("#regSubject").show();$("#regFrom").hide();$("#abFrom").show();$("#coIcons").hide();a("abFrom");$("#sfIcons").fadeIn("slow");}}b();}};}();CS.Step2={ready:function(){$("#importFromComp").ajaxUpload({onStart:function(){tHeight=$(window).height();lHeight=$("#cr_downloading").height();$("#cr_downloading").css("margin-top",[tHeight-lHeight-90]/2+"px");$("#cr_loading_screen").css("height",tHeight+1590+"px");scroll(0,0);$("#cr_loading_screen").show();},onComplete:function(a){$(a).parseJson({errorSetup:{title:"Sorry, we couldn't import your campaign content because..."},onError:function(){$("#cr_loading_screen").hide();$("#htmlFile, #zipFile").val("");}});}});},checkFormat:function(){radioChecked=$("input[name='format']:checked").val();if(radioChecked==2||radioChecked==3){ajax(saveFormatUrl,"POST",null,null,"selectFormats",null,"json");if(radioChecked==2){hash=defaultImportType;}else{hash="defineTextContent";textPreviousLink=selectFormatUrl;$("#textPartIntroduction").html("Type in or copy and paste the text for your email below.");pages.defineTextContent.title=pages.defineTextContent.title.replace(/Step (.).4/,"Step $1.2");pages.defineTextContent.h1=pages.defineTextContent.h1.replace(/Step (.).4/,"Step $1.2");}this.pageLoad(hash);}else{$("#selectFormats").submit();}},addAnchor:function(a){window.location.hash=a;},hideAll:function(){$(".cr_module").hide();},pageLoad:function(a){if(a){hideMessages();this.hideAll();if(a==="selectFormat"){$("#"+a+"Div").show();}else{if(a==="defineTextContent"){$("#defineTextContentDiv").show();}else{$("#step2_1Div").show();$("#"+a+"Div").show();}}if(a==="step2_1"){a=defaultImportType;}switch(a){case"defineTextContent":this.defineTextContent();pages.defineTextContent.load();break;case"editHtml":this.editHtml();pages.editHtml.load();break;case"step2_2_2":this.step2_2_2();pages.step2_2_2.load();break;case"step2_2_1":this.step2_2_1();pages.step2_2_1.load();setTimeout(function(){$("#txtURL").focus();},300);break;default:pages.selectFormat.load();}}else{this.hideAll();$("#selectFormatDiv").show();pages.selectFormat.load();}},defineTextContent:function(){setTimeout(function(){$("#textContent").focus();},500);},tabify:function(b,c,d,a){$("#editHtml").removeClass("current");$("#"+c).removeClass("current");$("#"+b).addClass("current");$("#editHtmlDiv").hide();$("#"+a).hide();$("#"+d).show();},resizeLoading:function(){tHeight=$(window).height();lHeight=$("#cr_downloading").height();$("#cr_downloading").css("margin-top",[tHeight-lHeight-90]/2+"px");$("#cr_loading_screen").css("height",tHeight+1590+"px");scroll(0,0);},reimport:function(){$("#step2_2_1").hide();$("#step2_2_2").hide();this.tabify("reimportCampaign","editHtml",defaultImportType,"editHtmlDiv");},editHtml:function(){if($("div.failureMessage li").html()==="There is no HTML content. Please add some content before saving."){$("#errorDiv").show();$("#inTextDiv").addClass("cr_edit_html clearfixError");}$("#step2_2_1").hide();$("#step2_2_2").hide();$("#importWeb").removeClass("current");$("#importComputer").removeClass("current");$("#editHtml").addClass("current");$("#editHtmlDiv").show();resizeIframe();},step2_2_1:function(){this.tabify("importWeb","importComputer","step2_2_1","step2_2_2");},step2_2_2:function(){this.tabify("importComputer","importWeb","step2_2_2","step2_2_1");},hideLoading:function(){$("#loading").hide();},getText:function(){$("#loading").show();$.ajax({url:textGenerateUrl,type:"GET",success:function(a){$("#textContent").val(a);setTimeout(CS.Step2.hideLoading,500);}});return false;},change:function(a,d,b){$("#template").attr("checked",true);try{$("#htmltext").attr("checked",false);}catch(c){}$("#text").attr("checked",false);if(identity){identity.removeClass();identity.addClass("quickPreview");}tID=b;identity=$("#"+d);identity.removeClass();identity.addClass("quickPreviewOn");$("#"+a).attr("checked",true);},selectFormatMethod:function(data){$(eval("("+data+")")).parseJson({onError:function(){$("#cr_loading_screen").hide();}});},selectFormatWebImport:function(){this.resizeLoading();ajax(webImportUrl,"POST","",this.selectFormatMethod,"importFromWeb",function(){$("#cr_loading_screen").show();});},editableImport:function(a){this.resizeLoading();$("#cr_loading_screen").show();setTimeout(function(){ajax(a,"POST","",CS.Step2.selectFormatMethod,"editableImport","");},1500);},selectTemplate:function(){if($("#template").is(":checked")&&tID){$("#check"+tID).attr("checked",true);this.change("check"+tID,"case"+tID,tID);}else{if(identity&&$("#check"+tID)!=null){$("#check"+tID).attr("checked",false);identity.removeClass();identity.addClass("quickPreview");}}},goTextPrevious:function(){window.location.replace(textPreviousLink);}};if(!window.CS){window.CS={};}CS.Step2_3=function(){function testEmailMethod(data){$(eval("("+data+")")).parseJson({onSuccess:function(){$("#cr_send_form").hide();$("#cr_send_confirm").fadeIn();$("#cr_error_comment").hide();$("#cr_comment").show();$("#txtTestCampaign").val("");setTimeout(function(){$("#cr_send_test").slideUp();},3000);setTimeout(showForm,4000);},onError:function(){$("#txtTestCampaign").focus();showForm();},errorSetup:{renderer:function(messages,fields){$("#txtTestCampaign").addClass("clearfixError");$("#cr_comment").hide();$("#cr_error_comment").html(messages[0]);$("#cr_error_comment").show();}},successSetup:{renderer:function(){}}});}function showForm(){$("#cr_or_other").html('or <a href="" onclick="CS.Step2_3.showSendTest(); return false;">cancel</a>');$("#cr_send_form").show();$("#cr_send_confirm").hide();}return{toggleImages:function(type){$("#"+type+"Images").toggle();$("#"+type+"Show").toggle();$("#"+type+"Hide").toggle();},showSendTest:function(){if($("#cr_send_test").is(":visible")){$("#cr_send_test").slideUp();}else{$("#cr_send_test").slideDown();setTimeout(function(){$("#txtTestCampaign").select();},400);}},sendTestEmail:function(isTemporaryImport){var action="send";if(isTemporaryImport){action="sendtemporaryimport";}ajax("/campaign/test/"+action+"/"+cID+"/?sendOneVersion=true","POST","",testEmailMethod,"testEmailForm",function(){$("#cr_or_other").html("Sending test email...");});},showAll:function(id){$("#"+id).show();$("#"+id+"_link").hide();}};}();if(!window.CS){window.CS={};}CS.Step3=function(){var c=[];function a(){$(".cr_module").hide();}function b(f){var e=f.split("|");var d=$("#"+e[1]);if(e[2]!==d.html()){d.fadeOut(function(){d.html(e[2]);d.show();});}}return{switchBtn:function(d){if(d=="existing"){$("#btn_alt").show();$("#btn_next").hide();}else{$("#btn_next").show();$("#btn_alt").hide();}},updateSegmentTotal:function(e,f,d){if(c.indexOf(f)<0){c.push(f);ajax("/Subscribers/pageElements/segmentCount.aspx?listId="+e+"&segId="+f+"&controlId="+d,"GET","",b,"","");}},selectRadio:function(){$("#existing").attr("checked",true);},pageLoad:function(d,e){if(showErrors){showErrors=false;}else{$("#errorDiv").hide();}if(!d){d=defaultMethod;e=defaultMethod;}if(!e){e=d;}a();$("#"+d+"Div").show();pages[e].load();},checkType:function(){radioChecked=$("input[name='subscribers']:checked").val();if(radioChecked=="manually"){hash="step3_2";location.hash="#"+hash;}else{$("#step3point1").submit();}}};}();if(!window.CS){window.CS={};}CS.Step4_1=function(){function step4_1TestEmailMethod(data){$(eval("("+data+")")).parseJson({errorSetup:{title:"Sorry, we couldn't send a test because..."},successSetup:{renderer:function(messages,fields){$("#successDiv").show();var html="";var checkbox="";for(var i in messages){if(messages[i]&&typeof(messages[i])==="string"){html+=messages[i]+"; ";if($(":checkbox[value="+messages[i]+"]").length==0){checkbox+='<div class="radioContainerPad">\n\t<input type="checkbox" name="recenttests" value="'+messages[i]+'" id="'+messages[i]+'">\n\t<label for="'+messages[i]+'" class="big" style="font-weight:normal">'+messages[i]+"</label>\n</div>";}}}$("#recentEmailsStart").after(checkbox);$("#recipients").html(html.substring(0,html.length-2));var checkboxs=$("#recentEmailsStart").siblings();if(checkboxs.filter(".radioContainerPad").length>5){checkboxs.filter(".radioContainerPad:gt(4)").remove();}checkboxs.find(":checked").attr("checked",false);$("#txtTestCampaign").val("");}}});setTimeout(function(){$("#messageResponse").fadeOut();},500);}var dontSwitchButtons;function pageOperations(){$("#messageResponse").show();if(!dontSwitchButtons){$("#skipButton").hide();$("#nextButton").show();}hideMessages();}return{step4_1TestEmail:function(dontSwitch){dontSwitchButtons=dontSwitch;ajax("/campaign/test/send/"+cID,"POST","",step4_1TestEmailMethod,"step4",pageOperations);}};}();if(!window.CS){window.CS={};}CS.Snapshot=function(){return{checkDeleteManual:function(b,c){var a="Are you sure you want to remove these "+c+" manually added recipients from this campaign?";if(confirm(a)){location.replace("snapshot.aspx?cID="+b+"&action=deleteList");}return false;},checkDeleteList:function(c,a,d){var b="Are you sure you want to remove this Subscriber List containing "+d+" subscribers from this Campaign?";if(confirm(b)){location.replace("snapshot.aspx?cID="+c+"&listID="+a+"&action=deleteList");}return false;},checkDeleteSegment:function(c,a,d){var b="Are you sure you want to remove this segment containing "+d+" subscribers from this Campaign?";if(confirm(b)){location.replace("snapshot.aspx?cID="+c+"&segID="+a+"&action=deleteSegment");}return false;},checkUnschedule:function(b){var a="Are you sure you want to move this campaign back to drafts?";if(confirm(a)){location.replace("snapshot.aspx?cID="+b+"&action=unschedule");}return false;}};}();