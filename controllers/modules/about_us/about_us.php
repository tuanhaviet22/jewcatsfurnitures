<?php
    $xtp = new XTemplate("{$baseUrl}/views/modules/about_us.html");

    $xtp->assign("baseUrl", $baseUrl);
    $xtp->parse("ABOUTUS");
    $contents = $xtp->text("ABOUTUS");