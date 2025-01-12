/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

/**
 * @author Nabil L. A. <@nalleon>
 * POST
 */
public class Bet {
	private String name;
	private int numBet;
	private float betAmount;

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
	public Bet(String name, int numBet, float betAmount) {
		this.name = name;
		this.numBet = numBet;
		this.betAmount = betAmount;
	}
}
