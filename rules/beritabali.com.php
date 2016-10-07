<?php

return array(
    'grabber' => array(
        '%.*%' => array(
            'test_url' => 'http://beritabali.com/read/2016/10/07/201610070001/Anggota-Yayasan-Dimas-Kanjeng-Terdaftar-di-Belimbing-150-Orang.html',
            'body' => array(
            	'//div[@class="col-lg-8"]/p/img',
            	'//div[@class="col-lg-8"]/div'
            	),
            'strip' => array(
            	'//script',
            	'//strong',
            	'//h1',
            	'//*[@id="wideskyscraper"]',
                '//*[contains(@class, "addthis_toolbox addthis_default_style") or contains(@class, "comments") or contains(@class, "sl-article-floatin-tools")  or contains(@class, "sl-art-pag")]',
                '//*[@class="row well"]',
                '//*[@class="list-group"]',
                '//*[@class="well"]',
                '//*[@id="fb-root"]',
                '//*[@style="text-align: justify;"]',
            )
            
        ),
    ),
);
