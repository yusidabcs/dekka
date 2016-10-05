<?php

return array(
    'grabber' => array(
        '%.*%' => array(
            'test_url' => 'http://bali.antaranews.com/berita/96660/luhut-harapkan-revisi-pp-minerba-segera-selesai',
            'body' => array(
            	'//div[@id="image_news"]',
            	'//div[@id="content_news"]',

            ),
            'strip' => array(
                '//*[@class="date"]',
                '//*[@class="title"]',
                '//*[@class="byline"]',
                '//*[@class="cl"]',
            	'//script',
            )
            
        ),
    ),
);
