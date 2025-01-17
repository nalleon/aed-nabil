/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

import org.springframework.stereotype.Component;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

/**
 * @author Nabil L. A. <@nalleon>
 */

@Component
public class Lottery {

	/**
	 * Properties
	 */
	private List<Raffle> raffles;
	private static Lottery instance;
	private Raffle currentRaffle;

	/**
	 * Default constructor of the class
	 */
	public Lottery () {
		raffles = new ArrayList<>(Arrays.asList(new Raffle(1)));
	}

	/**
	 * Method to get the current instance of the lottery
	 * @return new Lottery if null, the current Lottery otherwise
	 */
	public static synchronized Lottery getInstance(){
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

	public List<Raffle> getRaffles() {
		return raffles;
	}

}
