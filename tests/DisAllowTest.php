<?php
namespace vipnytt\RobotsTxtParser\Tests;

use vipnytt\RobotsTxtParser\Parser;

/**
 * Class DisAllowTest
 *
 * @package vipnytt\RobotsTxtParser\Tests
 */
class DisAllowTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider generateDataForTest
     * @param string $robotsTxtContent
     */
    public function testDisAllowTest($robotsTxtContent)
    {
        $parser = new Parser('http://example.com', 200, $robotsTxtContent);
        $this->assertInstanceOf('vipnytt\RobotsTxtParser\Parser', $parser);

        $this->assertTrue($parser->userAgent()->isAllowed("/"));
        $this->assertTrue($parser->userAgent()->isAllowed("/article"));
        $this->assertTrue($parser->userAgent()->isDisallowed("/temp"));
        $this->assertFalse($parser->userAgent()->isDisallowed("/"));
        $this->assertFalse($parser->userAgent()->isDisallowed("/article"));
        $this->assertFalse($parser->userAgent()->isAllowed("/temp"));

        $this->assertTrue($parser->userAgent('*')->isAllowed("/"));
        $this->assertTrue($parser->userAgent('*')->isAllowed("/article"));
        $this->assertTrue($parser->userAgent('*')->isDisallowed("/temp"));
        $this->assertFalse($parser->userAgent('*')->isDisallowed("/"));
        $this->assertFalse($parser->userAgent('*')->isDisallowed("/article"));
        $this->assertFalse($parser->userAgent('*')->isAllowed("/temp"));

        $this->assertTrue($parser->userAgent('agentV')->isDisallowed("/foo"));
        $this->assertTrue($parser->userAgent('agentV')->isAllowed("/bar"));
        $this->assertTrue($parser->userAgent('agentW')->isDisallowed("/foo"));
        $this->assertTrue($parser->userAgent('agentW')->isAllowed("/bar"));

        $this->assertTrue($parser->userAgent('spiderX/1.0')->isAllowed("/temp"));
        $this->assertTrue($parser->userAgent('spiderX/1.0')->isDisallowed("/assets"));
        $this->assertTrue($parser->userAgent('spiderX/1.0')->isAllowed("/forum"));
        $this->assertFalse($parser->userAgent('spiderX/1.0')->isDisallowed("/temp"));
        $this->assertFalse($parser->userAgent('spiderX/1.0')->isAllowed("/assets"));
        $this->assertFalse($parser->userAgent('spiderX/1.0')->isDisallowed("/forum"));

        $this->assertTrue($parser->userAgent('botY-test')->isDisallowed("/"));
        $this->assertTrue($parser->userAgent('botY-test')->isDisallowed("/forum"));
        $this->assertTrue($parser->userAgent('botY-test')->isAllowed("/forum/"));
        $this->assertTrue($parser->userAgent('botY-test')->isDisallowed("/forum/topic"));
        $this->assertTrue($parser->userAgent('botY-test')->isDisallowed("/public"));
        $this->assertFalse($parser->userAgent('botY-test')->isAllowed("/"));
        $this->assertFalse($parser->userAgent('botY-test')->isAllowed("/forum"));
        $this->assertFalse($parser->userAgent('botY-test')->isDisallowed("/forum/"));
        $this->assertFalse($parser->userAgent('botY-test')->isAllowed("/forum/topic"));
        $this->assertFalse($parser->userAgent('botY-test')->isAllowed("/public"));


        $this->assertTrue($parser->userAgent('crawlerZ')->isAllowed("/"));
        $this->assertTrue($parser->userAgent('crawlerZ')->isDisallowed("/forum"));
        $this->assertTrue($parser->userAgent('crawlerZ')->isDisallowed("/public"));
        $this->assertFalse($parser->userAgent('crawlerZ')->isDisallowed("/"));
        $this->assertFalse($parser->userAgent('crawlerZ')->isAllowed("/forum"));
        $this->assertFalse($parser->userAgent('crawlerZ')->isAllowed("/public"));
    }

    /**
     * Generate test data
     *
     * @return array
     */
    public function generateDataForTest()
    {
        return [
            [
                <<<ROBOTS
User-agent: *
Disallow: /admin
Disallow: /temp#comment
Disallow: /forum

User-agent: agentV
User-agent: agentW
Disallow: /foo
Allow: /bar #comment

User-agent: spiderX
Disallow:
Disallow: /admin#
Disallow: /assets

User-agent: botY
Disallow: /
Allow: /forum/$
Allow: /article

User-agent: crawlerZ
Disallow:
Disallow: /
Allow: /$
ROBOTS
            ]
        ];
    }
}