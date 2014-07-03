<?php

class Card
{
	private $cardNumber;
	private $cardSuite;

	public function Card($number, $suite)
	{
		$this->cardNumber = $number;
		$this->setSuite($suite);
	}

	function calculateValue()
	{
		if($this->cardSuite != -1)
		{
			if(is_int($this->cardNumber) && $this->cardNumber > 1 && $this->cardNumber <= 10)
				return $this->cardNumber;
			elseif($this->cardNumber == 'K' || $this->cardNumber == 'Q' || $this->cardNumber == 'J')
				return 10;
			elseif($this->cardNumber == 'A')
				return 11;
			else
				return -1;
		}
		else 
			return -1;
	}

	function getSuite()
	{
		return $this->cardSuite;
	}

	function getNumber()
	{
		return $this->cardNumber;
	}
	
	function setSuite($suite)
	{
		if($suite == 'S' || $suite == 'C' || $suite == 'H' || $suite == 'D')
			$this->cardSuite = $suite;
		else
			$this->cardSuite = -1;
	}
	
}

function BlackJack($number1, $suite1, $number2, $suite2)
{
	$card1 = new Card($number1, $suite1);
	$card2 = new Card($number2, $suite2);
	if($card1 != $card2)
	{
		if($card1->calculateValue() != -1 && $card2->calculateValue() != -1)
		{
			$sum = $card1->calculateValue() + $card2->calculateValue();
			if($sum == 21)
				echo $sum . " - BlackJack!!";
			else
				echo 'Value is: ' . $sum;
		}
		else
			echo 'invalid card(s) given';
	}
	else
		echo 'cards may not be identical';
}

?>