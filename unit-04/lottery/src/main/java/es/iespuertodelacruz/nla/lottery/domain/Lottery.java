/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

import java.util.ArrayList;
import java.util.List;

/**
 * @author Nabil L. A. <@nalleon>
 */
public class Lottery {

	/**
	 * Properties
	 */
	public List<Raffle> raffles;
	public static Lottery instance;
	public Raffle currentRaffle;

	/**
	 * Default constructor of the class
	 */
	private Lottery () {
		raffles = new ArrayList<>();
	}

	/**
	 * Method to get the current instance of the lottery
	 * @return new Lottery if null, the current Lottery otherwise
	 */
	public Lottery getInstance(){
		if (instance == null){
			instance = new Lottery();
		}
		 return instance;
	}

	/**
	 * Method to get the current raffle
	 * @return if raffles is not empty returns the last index, null otherwise
	 */
	public Raffle getCurrentRaffle() {
		if (!raffles.isEmpty()){
			currentRaffle = raffles.get(raffles.size()-1);
			return currentRaffle;
		}

		return null;
	}
}
