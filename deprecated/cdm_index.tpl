<h4><{$lang_pagetitle}></h4>
<!-- Set up meta set list for selection by user -->
<table width="100%" class="outer" cellspacing='1'>
<caption>
<{$lang_table1name}><br>
<a href="cdm_meta_edit.php?id=0"><img src="<{$xoops_url}>/modules/cdm/images/b_insrow.png" title ="<{$lang_insert}>"> <{$lang_insert}></a>&nbsp;&nbsp;
<{$lang_table1info}>
</caption>
<!-- Column names -->
  <tr>
	<th><{$lang_tble1col1}></th>
	<th><{$lang_tble1col2}></th>
	<th><{$lang_tble1col3}></th>
    <th align='center'>&nbsp;</th>
  </tr>


<!-- start sets item loop -->
<{section name=i loop=$sets}>
  <tr>
    <td class="even"><{$sets[i].cd_set}></td>
    <td align="LEFT" class="even"><{$sets[i].cd_desc}></td>
    <td align="LEFT" class="even"><{$sets[i].row_flag}></td>
	<td align="CENTER" class="odd"><a href="index.php?codeSet=<{$sets[i].cd_set}>"><img src="<{$xoops_url}>/modules/cdm/images/b_browse.png" title ="<{$lang_select}>"></a>&nbsp;<a	href="cdm_meta_edit.php?codeSet=<{$sets[i].cd_set}>"><img src="<{$xoops_url}>/modules/cdm/images/b_edit.png" title ="<{$lang_edit}>"></a></td>
  </tr>
<{/section}>
<!-- end sets item loop -->
</table>

<p>
<!-- Set up list of codes for user to select to edit -->
<table width="100%" class="outer" cellspacing='1'>
<caption>
<{$lang_table2name}><{$setname}><br>
<a href="cdm_codes_edit.php?id=0&cd_set=<{$setname}>"><img src="<{$xoops_url}>/modules/cdm/images/b_insrow.png" title ="<{$lang_insert}>"> <{$lang_insert}></a>&nbsp;&nbsp;
<{$lang_table2info}>
</caption>
<!-- Column names -->
  <tr>
	<{section name=i loop=$lang_tble2nm}>
  		<th><{$lang_tble2nm[i]}></th>
	<{/section}>
    <th align='center'>&nbsp;</th>
  </tr>

<!-- start codes item loop -->
<{section name=i loop=$codes}>
  <tr>
    <td class="even"><{$codes[i].cd_set}></td>
    <td align="LEFT" class="even"><{$codes[i].cd_lang}></td>
    <td align="LEFT" class="even"><{$codes[i].cd}></td>
    <td align="LEFT" class="even"><{$codes[i].cd_value}></td>
    <td align="LEFT" class="even"><{$codes[i].cd_desc}></td>
    <td align="LEFT" class="even"><{$codes[i].cd_prnt}></td>
    <td align="LEFT" class="even"><{$codes[i].row_flag}></td>
    <td align="center" class="odd"><a
	href="cdm_codes_edit.php?id=<{$codes[i].id}>"><img
	src="<{$xoops_url}>/modules/cdm/images/b_edit.png" title ="<{$lang_edit}>"></a></td>

  </tr>
<{/section}>
<!-- end codes item loop -->

</table>
<!-- do not remove the following copyright section -->
<div align="right">
<br>CDM © 2004, <a href="http://akitson.bbcb.co.uk" title="Click to see software author's web page" target="_blank">A Kitson.</a> UK.
</div>
<!-- end of copyright section -->
