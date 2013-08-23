{include="head.tpl"}

<SCRIPT language="Javascript"> 
<!-- 
if (document.images) 
{  
img1on = new Image ;img1off = new Image; 
img2on = new Image ;img2off = new Image; 
img3on = new Image ;img3off = new Image; 
img4on = new Image ;img4off = new Image; 
img5on = new Image ;img5off = new Image;  
img6on = new Image ;img6off = new Image;
 
img1on.src = "{THEME}/images/about2.png"; img1off.src = "{THEME}/images/about{ABOUT_ACTIVE}.png";
img2on.src = "{THEME}/images/djs2.png"; img2off.src = "{THEME}/images/djs{DJ_ACTIVE}.png";
img3on.src = "{THEME}/images/pjs2.png"; img3off.src = "{THEME}/images/pjs{PJ_ACTIVE}.png";
img4on.src = "{THEME}/images/topless2.png"; img4off.src = "{THEME}/images/topless{TPJ_ACTIVE}.png";
img5on.src = "{THEME}/images/mc2.png"; img5off.src = "{THEME}/images/mc{MC_ACTIVE}.png";
img6on.src = "{THEME}/images/contacts2.png"; img6off.src = "{THEME}/images/contacts{CONTACTS_ACTIVE}.png";

} 

function img_act(imgName) { 
if (document.images) 
{ imgOn = eval (imgName + "on.src"); 
document [imgName].src = imgOn; } } 

function img_inact(imgName) { 
if (document.images) 
{ imgOff = eval(imgName + "off.src"); 
document [imgName].src = imgOff; } } 

//--> 
</SCRIPT>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="100%" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="225" align="center" valign="top" style="background:url({THEME}/images/main_bg.png); background-position:center center; background-repeat:repeat-y;"><table width="950" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="840" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="225" align="center" valign="middle"><a href="/"><img src="{THEME}/images/title_logo2.png" alt="GLOBAL STAR EVENT AGENCY" width="692" height="204" border="0" /></a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="105" align="center" valign="top" style="background:url({THEME}/images/main_bg.png); background-position: center center; background-repeat:repeat-y;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="15" align="center" valign="middle" background="{THEME}/images/shadow_top.png"><img src="{THEME}/images/spacer15.png" width="15" height="15" /></td>
                <td width="900" height="15" align="center" valign="middle" background="{THEME}/images/shadow_top2.png"><img src="{THEME}/images/spacer15.png" width="15" height="15" /></td>
                <td height="15" align="center" valign="middle" background="{THEME}/images/shadow_top.png"><img src="{THEME}/images/spacer15.png" width="15" height="15" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="75" align="center" valign="middle" background="{THEME}/images/background2.jpg"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="middle"><a href="index.php?shw=about"><img src="{THEME}/images/about{ABOUT_ACTIVE}.png" alt="Î ÊÎÌÏÀÍÈÈ" width="193" height="22" name="img1" onMouseOver="img_act('img1')" onMouseOut="img_inact('img1')" border="0"/></a></td>
                <td width="15" align="center" valign="middle"><img src="{THEME}/images/nav_spacer2.png" width="10" height="40" /></td>
                <td align="center" valign="middle"><a href="index.php?shw=dj"><img src="{THEME}/images/djs{DJ_ACTIVE}.png" alt="ÄÈÄÆÅÈ" width="133" height="22" name="img2" onMouseOver="img_act('img2')" onMouseOut="img_inact('img2')" border="0"/></a></td>
                <td width="15" align="center" valign="middle"><img src="{THEME}/images/nav_spacer2.png" width="10" height="40" /></td>
                <td align="center" valign="middle"><a href="index.php?shw=pj"><img src="{THEME}/images/pjs{PJ_ACTIVE}.png" alt="ÏÈÄÆÅÈ" width="133" height="22" name="img3" onMouseOver="img_act('img3')" onMouseOut="img_inact('img3')" border="0"/></a></td>
                <td width="15" align="center" valign="middle"><img src="{THEME}/images/nav_spacer2.png" width="10" height="40" /></td>
                <td align="center" valign="middle"><a href="index.php?shw=tpj"><img src="{THEME}/images/topless{TPJ_ACTIVE}.png" alt="ÒÎÏËÅÑÑ ÏÈÄÆÅÈ" width="264" height="22" name="img4" onMouseOver="img_act('img4')" onMouseOut="img_inact('img4')" border="0"/></a></td>
                <td width="15" align="center" valign="middle"><img src="{THEME}/images/nav_spacer2.png" width="10" height="40" /></td>
                <td align="center" valign="middle"><a href="index.php?shw=mc"><img src="{THEME}/images/mc{MC_ACTIVE}.png" alt="ÌÑ" width="48" height="22" name="img5" onMouseOver="img_act('img5')" onMouseOut="img_inact('img5')" border="0"/></a></td>
                <td width="15" align="center" valign="middle"><img src="{THEME}/images/nav_spacer2.png" width="10" height="40" /></td>
                <td align="center" valign="middle"><a href="index.php?shw=contacts"><img src="{THEME}/images/contacts{CONTACTS_ACTIVE}.png" alt="ÊÎÍÒÀÊÒÛ" width="155" height="22" name="img6" onMouseOver="img_act('img6')" onMouseOut="img_inact('img6')" border="0"/></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="15" align="center" valign="middle" background="{THEME}/images/shadow_bot.png"><img src="{THEME}/images/spacer15.png" width="15" height="15" /></td>
                <td width="900" height="15" align="center" valign="middle" background="{THEME}/images/shadow_bot2.png"><img src="{THEME}/images/spacer15.png" width="15" height="15" /></td>
                <td height="15" align="center" valign="middle" background="{THEME}/images/shadow_bot.png"><img src="{THEME}/images/spacer15.png" width="15" height="15" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      
      
      <tr>
        <td align="center" valign="top" style="background:url({THEME}/images/main_bg.png); background-position:center center; background-repeat:repeat-y;"><table width="950" height="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="100%" align="center" valign="top"><table width="840" height="10" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="11" align="right" background="{THEME}/images/border_long_hor2.png"><img src="{THEME}/images/spacer11.png" width="11" height="11" /></td>
                        <td width="15" height="11"><img src="{THEME}/images/arrow2.png" width="15" height="11" /></td>
                        <td width="50" height="11" background="{THEME}/images/border_long_hor2.png"><img src="{THEME}/images/spacer11.png" width="11" height="11" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top" style=""><div align="justify">{CONTENT}</div></td>
              </tr>
              
            </table></td>
          </tr>
        </table></td>
      </tr>
      
      
      <tr>
        <td height="133" align="center" valign="bottom" style="background:url({THEME}/images/main_bg.png); background-position:center center; background-repeat:repeat-y;"><table width="950" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="840" border="0" cellspacing="0" cellpadding="0" style="padding-top:15px;">
              <tr>
                <td height="20" align="left" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><img src="{THEME}/images/partners.png" alt="ÏÀÐÒÍÅÐÛ" width="158" height="22" /></td>
                  </tr>
                  <tr>
                    <td><table width="100%%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="11" align="right" background="{THEME}/images/border_long_hor2.png"><img src="{THEME}/images/spacer11.png" width="11" height="11" /></td>
                          <td width="15" height="11"><img src="{THEME}/images/arrow2.png" width="15" height="11" /></td>
                          <td width="50" height="11" background="{THEME}/images/border_long_hor2.png"><img src="{THEME}/images/spacer11.png" width="11" height="11" /></td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="100" align="center" valign="middle">{FOOTER}</td>
              </tr>
              
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</BODY>
</HTML>