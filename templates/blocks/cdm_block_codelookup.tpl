<SCRIPT LANGUAGE="JavaScript"><{$block.javascript}></SCRIPT>

<form name="lookup_form" action="<{$block.action}>" method="get">
  <table>
      <tr><td><{$block.codesetname}></td><td><{$block.codeset}></td></tr>
      <tr><td>Value</td><td><input  readonly value="<{$block.defcdval}>" name="cvalue"></tr>
      <tr><td><{$block.setchangename}></td><td><{$block.setchange}></td></tr>
      <tr><td><{$block.langchangename}></td><td><{$block.langchange}></td></tr>
      <tr><td></td><td><{$block.submit}></td></tr>
  </table>
</form>

