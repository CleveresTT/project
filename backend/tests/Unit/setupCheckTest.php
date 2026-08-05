<?php
use PHPUnit\Framework\TestCase;
use App\Service\SetupCheckService;

class setupCheckTest extends TestCase
{
    private SetupCheckService $setupChecker;

    protected function setUp(): void
    {
        $this->setupChecker = new SetupCheckService();
    }

    /** @test */
    public function tests_setup_is_working(): void
    {
        $result = $this->setupChecker->getTestValueMultipliedByParameter(10);
        $this->assertEquals(12130, $result);
    }
}
