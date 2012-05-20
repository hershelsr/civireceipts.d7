<html>
<head>
 <link type="text/css" rel="stylesheet" media="all" href="<?php echo $data->css; ?>" />
</head>
<body>
<?php
$i = 0;
foreach($data->pages as $page) {
  $i++;
  ?>
  <div id="receipt"><?php echo t('RECEIPT'); ?></div>
  <div id="company">
    <?php
    $addr = str_replace("\n",'<br>',$page->company['civireceipts_company_address']);
    print "<h1>{$page->company['civireceipts_company_name']}</h1>
      {$addr}<br>
      tel: {$page->company['civireceipts_company_tel']} fax: {$page->company['civireceipts_company_fax']}<br>
      {$page->company['civireceipts_company_email']}<br>";
    ?>
  </div>
  <div id="thankyou"><?php echo t('Thank you!'); ?></div>
  <div id="recipient">
    <?php
    $recipient = "{$page->display_name}<br>
      {$page->address['street_address']}<br>
      {$page->address['city']}, {$page->address['state']} {$page->address['postal_code']}<br>
      {$page->address['country']}";
    print $recipient;
    ?>
  </div>
  <div id="items"><table>
    <tr>
      <th><?php echo t('Date'); ?></th>
      <th><?php echo t('Amount'); ?></th>
    </tr>
    <?php
    $total_gift = 0;
    foreach($page->contribs as $contrib) {
      print "<tr>
                 <td class=\"amount\">{$contrib['receive_date']}</td>
                 <td class=\"amount\">\${$contrib['total_amount']}</td>
             </tr>";
      $total_gift += $contrib['total_amount'];
    }
    ?>
    </table></div>
  <div id="YTD">
    <?php
    echo t('Current Gift:') . " \$" . number_format($total_gift,2) . '<br>';
    echo t('Year-to-Date Gift Total:') . " \${$page->YTD}";
    ?>
  </div>
  <div id="IRS">
    <?php
    echo $page->company['civireceipts_irs_info'];
    ?>
  </div>
  <div id="AddrChange">
    <?php
    echo t('Please note any address changes:') . "<br>";
    print $recipient;
    ?>
  </div>
  
  <?php
  if(count($data->pages) > $i) {
    print '<div style="page-break-after:always;"></div>';
  }
}
?>
</body>

