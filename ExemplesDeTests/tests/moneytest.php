<?php

use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    // ...
/**
 * @covers Money::negate
 */
    public function testCanBeNegated()
    {
        // Arrange
        $a = new Money(1);

        // Act
        $b = $a->negate();

        // Assert
        $this->assertEquals(-1, $b->getAmount());
    }
	/**
 * @covers Money::getAmount
 */
	public function testGetAmount()
    {
        // Arrange
        $a = new Money(100);

        // Act
        $b = $a->getAmount();

        // Assert
        $this->assertEquals(100, $b);
    }

    // ...

    public function testFailure1()
    {
        $this->assertContains(4, array(1, 2, 3));
    }

	public function testFailure2()
    {
        $this->assertNull('foo');
    }
	
	public function testFailure3()
    {
        $this->assertLessThan(1, 2);
    }



}
