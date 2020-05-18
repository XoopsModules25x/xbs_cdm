<h4><{$lang_pagetitle}></h4>

<table width="100%" class="outer" cellspacing='1'>
    <tr>
        <th><{$lang_col1name}></th>
        <th align='center'><{$lang_col2name}></th>
        <th align='center'><{$lang_col3name}></th>
        <th align='center'><{$lang_col4name}></th>
        <th align='center'><{$lang_col5name}></th>
        <th align='center'><{$lang_col6name}></th>
    </tr>

    <!-- start codes item loop -->
    <{section name=i loop=$codes}>
        <tr>
            <td class="even"><{$codes[i].cd_set}></td>
            <td align="LEFT" class="odd"><{$codes[i].cd_lang}></td>
            <td align="LEFT" class="even"><{$codes[i].cd}></td>
            <td align="LEFT" class="odd"><{$codes[i].cd_prnt}></td>
            <td align="LEFT" class="odd"><{$codes[i].cd_value}></td>
            <td align="LEFT" class="even"><{$codes[i].cd_desc}></td>

        </tr>
    <{/section}>
    <!-- end codes item loop -->

</table>
<!-- do not remove the following copyright section -->
<div align="right">
    <br>CDM © 2004-2005, <a href="http://xoobs.net" title="Click to see software author's web page" target="_blank">A Kitson.</a> UK.
</div>
<!-- end of copyright section -->
