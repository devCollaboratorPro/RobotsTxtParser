<?php
namespace vipnytt\RobotsTxtParser\Client\Directives;

use vipnytt\RobotsTxtParser\Parser\Directives\DirectiveParserCommons;

/**
 * Class CleanParamClient
 *
 * @package vipnytt\RobotsTxtParser\Client\Directives
 */
class CleanParamClient implements ClientInterface
{
    use DirectiveParserCommons;

    /**
     * Clean-param
     * @var string[][]
     */
    private $cleanParam = [];

    /**
     * CleanParamClient constructor.
     *
     * @param string[] $cleanParam
     */
    public function __construct(array $cleanParam)
    {
        $this->cleanParam = $cleanParam;
    }

    /**
     * Check
     *
     * @param  string $url
     * @return bool
     */
    public function isListed($url)
    {
        foreach ($this->cleanParam as $param => $paths) {
            if (
                (
                    mb_stripos($url, "?$param=") ||
                    mb_stripos($url, "&$param=")
                ) &&
                $this->checkPath($url, $paths)
            ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Export
     *
     * @return string[][]
     */
    public function export()
    {
        return $this->cleanParam;
    }
}
