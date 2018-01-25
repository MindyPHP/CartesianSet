<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\CartesianSet\Tests;

use Mindy\CartesianSet\CartesianSetBuilder;
use PHPUnit\Framework\TestCase;

class CartesianSetBuilderTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionArrayOfSets()
    {
        $tupleSetNotInArray = ['a', 'b', 'c'];
        $builder = new CartesianSetBuilder();
        $builder->build($tupleSetNotInArray);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionEmptySets(): void
    {
        $builder = new CartesianSetBuilder();
        $builder->build([]);
    }

    public function testOneSet()
    {
        $set = ['a', 'b', 'c'];
        $builder = new CartesianSetBuilder();
        $this->assertEquals($set, $builder->build([$set]));
    }

    public function testOneSetWithNull()
    {
        $setA = ['a', 'b', null];
        $setB = ['1', '2', '3'];
        $expected = [
            ['a', '1'],
            ['a', '2'],
            ['a', '3'],
            ['b', '1'],
            ['b', '2'],
            ['b', '3'],
        ];
        $builder = new CartesianSetBuilder();
        $result = $builder->build([$setA, $setB]);
        $this->assertEquals($expected, $result);
    }

    public function testTwoSets()
    {
        $setA = ['a', 'b', 'c'];
        $setB = ['1', '2', '3'];
        $expected = [
            ['a', '1'],
            ['a', '2'],
            ['a', '3'],
            ['b', '1'],
            ['b', '2'],
            ['b', '3'],
            ['c', '1'],
            ['c', '2'],
            ['c', '3'],
        ];
        $builder = new CartesianSetBuilder();
        $this->assertEquals($expected, $builder->build([$setA, $setB]));
    }

    public function testMoreThanTwoSets()
    {
        $setA = ['a', 'b', 'c'];
        $setB = ['1', '2', '3'];
        $setC = ['!', '@', '$'];

        $expected = [
            ['a', '1', '!'], ['a', '1', '@'], ['a', '1', '$'],
            ['a', '2', '!'], ['a', '2', '@'], ['a', '2', '$'],
            ['a', '3', '!'], ['a', '3', '@'], ['a', '3', '$'],
            ['b', '1', '!'], ['b', '1', '@'], ['b', '1', '$'],
            ['b', '2', '!'], ['b', '2', '@'], ['b', '2', '$'],
            ['b', '3', '!'], ['b', '3', '@'], ['b', '3', '$'],
            ['c', '1', '!'], ['c', '1', '@'], ['c', '1', '$'],
            ['c', '2', '!'], ['c', '2', '@'], ['c', '2', '$'],
            ['c', '3', '!'], ['c', '3', '@'], ['c', '3', '$'],
        ];
        $builder = new CartesianSetBuilder();
        $this->assertEquals($expected, $builder->build([$setA, $setB, $setC]));
    }
}
