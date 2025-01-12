/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

import org.springframework.stereotype.Component;

/**
 * @author Nabil L. A. <@nalleon>
 */

public class Bet {
	public String name;
	public Integer numBet;
	public Float betAmount;

	/**
	 * Default constructor of the class
	 */
	public Bet() {}

	/**
	 * Full constructor of the class
	 * @param name of the person betting
	 * @param numBet of the selected num to bet
	 * @param betAmount of the amount of money betted
	 */
	public Bet(String name, Integer numBet, Float betAmount) {
		this.name = name;
		this.numBet = numBet;
		this.betAmount = betAmount;
	}

}
