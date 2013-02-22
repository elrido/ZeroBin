<?php
class RainTPLTest extends PHPUnit_Framework_TestCase
{
    private static $data = '{"iv":"EN39/wd5Nk8HAiSG2K5AsQ","salt":"QKN1DBXe5PI","ct":"8hA83xDdXjD7K2qfmw5NdA"}';

    private static $error = 'foo bar';

    private static $status = '!*#@?$+';

    private static $expire = array(
        '5min' => '5 minutes',
        '1hour' => '1 hour',
        'never' => 'Never',
    );

    private static $expire_default = '1hour';

    private static $version = 'Version 1.2.3';

    private $_content;

    public function setUp()
    {
        /* Setup Routine */
        $page = new RainTPL;
        $page::configure(array('cache_dir' => 'tmp/'));

        $page = new RainTPL;
        // We escape it here because ENT_NOQUOTES can't be used in RainTPL templates.
        $page->assign('CIPHERDATA', htmlspecialchars(self::$data, ENT_NOQUOTES));
        $page->assign('ERROR', self::$error);
        $page->assign('STATUS', self::$status);
        $page->assign('VERSION', self::$version);
        $page->assign('BURNAFTERREADINGSELECTED', false);
        $page->assign('OPENDISCUSSION', false);
        $page->assign('SYNTAXHIGHLIGHTING', true);
        $page->assign('EXPIRE', self::$expire);
        $page->assign('EXPIREDEFAULT', self::$expire_default);
        ob_start();
        $page->draw('page');
        $this->_content = ob_get_contents();
        // run a second time from cache
        $page->cache('page');
        $page->draw('page');
        ob_end_clean();
    }

    public function tearDown()
    {
        /* Tear Down Routine */
        helper::rmdir(PATH . 'tmp');
    }

    public function testTemplateRendersCorrectly()
    {
        $this->assertTag(
            array(
                'id' => 'cipherdata',
                'content' => htmlspecialchars(self::$data, ENT_NOQUOTES)
            ),
            $this->_content,
            'outputs data correctly'
        );
        $this->assertTag(
            array(
                'id' => 'errormessage',
                'content' => self::$error
            ),
            $this->_content,
            'outputs error correctly'
        );
        $this->assertTag(
            array(
                'id' => 'opendiscussion',
                'attributes' => array(
                    'disabled' => 'disabled'
                ),
            ),
            $this->_content,
            'disables discussions if configured'
        );
        // testing version number in JS address, since other instances may not be present in different templates
        $this->assertTag(
            array(
                'tag' => 'script',
                'attributes' => array(
                    'src' => 'js/zerobin.js?' . rawurlencode(self::$version)
                ),
            ),
            $this->_content,
            'outputs version correctly'
        );
    }
}