<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Otomaties\Sage\OtomatiesServiceProvider;
use Roots\Acorn\Application;

final class OtomatiesServiceProviderTest extends TestCase
{
    public function testBlocksAreAdded() {
        $app = new Application(null);
        $otomatiesServiceProvider = new OtomatiesServiceProvider($app);
        $otomatiesServiceProvider->boot();

        $this->assertArrayHasKey(OtomatiesServiceProvider::class, $otomatiesServiceProvider::$publishes);
        $otomatiesServiceProviderPublishes = $otomatiesServiceProvider::$publishes[OtomatiesServiceProvider::class];
        $this->assertNotEmpty($otomatiesServiceProviderPublishes);
        $this->assertContains('/app/Blocks/Accordion.php', $otomatiesServiceProviderPublishes);
        $this->assertContains('/resources/views/blocks/latest-posts.blade.php', $otomatiesServiceProviderPublishes);
        $this->assertContains('/resources/styles/blocks/banner.scss', $otomatiesServiceProviderPublishes);
        $this->assertContains('/resources/scripts/blocks/location.js', $otomatiesServiceProviderPublishes);
    }
}
