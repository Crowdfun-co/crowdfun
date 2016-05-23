<!doctype html>
<html>
  <head>
  <meta charset="utf-8">
  <style type="text/css" media="screen">
    body { font-family: helvetica, arial, sans-serif; }
    p { font-family: helvetica, arial, sans-serif; }
  </style>
</head>

<body>

  <table width="600" border="0" cellspacing="0" cellpadding="10px" style="margin: 0 auto; background-color: white;">
    <tr>
      <td>
          <?php
            global $base_url;
            print '<a href="' . $base_url . '" target="_blank"><img src="' . $base_url . '/' . 'sites/all/themes/custom/crowdfun/images/crowdfun.jpg" width="200" height="auto" alt="Crowdfun" /></a>';
            print $body;
          ?>
          <p>-- Crowdfun.co team</p>
      </td>
    </tr>
  </table>

</body>
</html>
