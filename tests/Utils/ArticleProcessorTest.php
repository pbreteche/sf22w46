<?php

namespace App\Tests\Utils;

use App\Entity\Article;
use App\Utils\ArticleProcessor;
use PHPUnit\Framework\TestCase;

class ArticleProcessorTest extends TestCase
{
    /**
     * @dataProvider timeDiffProvider
     */
    public function testTimeDiff(string $input1, string $input2, int $expected)
    {
        $article1 = (new Article())->setPublishedAt(new \DateTimeImmutable($input1));
        $article2 = (new Article())->setPublishedAt(new \DateTimeImmutable($input2));
        $articleProcessor = new ArticleProcessor();

        $result = $articleProcessor->timeDiff($article1, $article2);

        $this->assertInstanceOf(\DateInterval::class, $result, 'Result should be a DateInterval instance');
        $this->assertEquals($expected, $result->days, sprintf('There should be %d days between %s and %s', $expected, $input1, $input2));
        $this->markTestIncomplete('Should test start and end date identical');
    }

    public function timeDiffProvider()
    {
        return [
            'dates in natural order' => ['2022-11-14', '2022-11-17', 3],
            'dates in reverse order' => ['2022-11-18', '2022-11-11', 7],
        ];
    }
}
