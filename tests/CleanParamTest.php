<?php
namespace vipnytt\RobotsTxtParser\Tests;

use vipnytt\RobotsTxtParser\Parser;

/**
 * Class CleanParamTest
 *
 * @package vipnytt\RobotsTxtParser\Tests
 */
class CleanParamTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider generateDataForTest
     * @param string $robotsTxtContent
     * @param array $cleanParam
     */
    public function testCleanParam($robotsTxtContent, $cleanParam)
    {
        $parser = new Parser('http://www.site1.com', 200, $robotsTxtContent);
        $this->assertInstanceOf('vipnytt\RobotsTxtParser\Parser', $parser);

        $this->assertTrue($parser->userAgent()->isDisallowed('http://www.site1.com/forums/showthread.php?s=681498b9648949605&ref=parent'));
        $this->assertFalse($parser->userAgent()->isAllowed('http://www.site1.com/forums/showthread.php?s=681498b9648949605&ref=parent'));

        $this->assertEquals($cleanParam, $parser->getCleanParam());
    }

    /**
     * Generate test data
     *
     * @return array
     */
    public
    function generateDataForTest()
    {
        return [
            [
                <<<ROBOTS
User-agent: *
Disallow: Clean-param: s&ref /forum*/sh*wthread.php
Clean-param: abc /forum/showthread.php
Clean-param: sid&sort /forum/*.php
Clean-param: someTrash&otherTrash
ROBOTS
                ,
                [
                    "abc" => [
                        "/forum/showthread.php",
                    ],
                    "sid" => [
                        "/forum/*.php",
                    ],
                    "sort" => [
                        "/forum/*.php",
                    ],
                    "someTrash" => [
                        "/",
                    ],
                    "otherTrash" => [
                        "/",
                    ],
                ]
            ]
        ];
    }
}
