<?php

return array(
    'grabber' => array(
        '%.*%' => array(
            'test_url' => 'http://bali.tribunnews.com/2016/10/04/pelecehan-seksual-di-monang-maning-gadis-dibekap-lalu',
            'body' => array('//div[@id="article_con"]'),
            'strip' => array(
            	'//script',
            	'//*[@id="fixsharebottom"]',
            	'//*[@id="wideskyscraper"]',
                '//*[contains(@class, "social") or contains(@class, "comments") or contains(@class, "sl-article-floatin-tools")  or contains(@class, "sl-art-pag")]',
                '//*[@id="fixads"]',
                '//*[@class="side-article mb20"]',
            )
            
        ),
    ),
);
