/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

import java.util.*;
import java.util.stream.Collectors;

/**
 * @author Nabil L. A. <@nalleon>
 */
public class Raffle {
	/**
	 * Properties
	 */
	 public int id;
	 private Integer winningNum;
	 private List<Bet> winners;
	 public Date startTime;
	 public Date endTime;
	 public List<Bet> currentBets;

	public Raffle(int id, Integer winningNum, List<Bet> winners, Date startTime, Date endTime, List<Bet> currentBets) {
		this.id = id;
		this.winningNum = winningNum;
		this.winners = winners;
		this.startTime = startTime;
		this.endTime = endTime;
		this.currentBets = currentBets;
	}

	/**
	 * Method to select the raffle duration
	 */
	private boolean selectDuration(){
		long time = 36000;

		startTime = new Date();
		endTime = new Date(startTime.getTime() + time);

		return true;
	}

	/**
	 * Method to bet in the raffle
	 * @param idRaffle of the raffle
	 * @param name of the user
	 * @param numBet of the selected num to bet on
	 * @param betAmount of the selected amount of money bet
	 * @return
	 */
	private boolean bet(int idRaffle, String name, int numBet, float betAmount){
		if((Lottery.instance.currentRaffle.id != idRaffle) && (new Date().getTime() - endTime.getTime() >= 0)){
			return false;
		}

		Bet bet = new Bet(name, numBet, betAmount);
		currentBets.add(bet);

		return true;
	}


	/**
	 * Method to generate a random number between 0 and 10000
	 */
	private void generateRndNum(){
		if(winningNum != null){
			return;
		}

		int start = 0;
		int end = 10000;

		Random rnd = new Random();
        winningNum = rnd.nextInt(start, end);
	}

	/**
	 * Method to select the winners of the raffle
	 * @return false if time its over, true otherwise
	 */
	private boolean selectWinners(){
		if ((new Date().getTime() - endTime.getTime() <= 0)){
			return false;
		}

		if (currentBets.isEmpty() && (new Date().getTime() - endTime.getTime() >= 0)) {
			winners.add(null);
			return true;
		} else if (currentBets.size() == 1) {
			winners.add(currentBets.get(0));
			return true;
		}

		Set<Integer> auxSet = new HashSet<>();

		for(Bet bet : currentBets){
			int difference = Math.abs(winningNum-bet.numBet);
			auxSet.add(difference);
		}

		List <Integer> sortedList = new ArrayList<>(auxSet);
		Collections.sort(sortedList);
		int lowestDiff = sortedList.get(sortedList.size()-1);

		for (Bet bet : currentBets){
			int difference = Math.abs(winningNum-bet.numBet);
			if (difference == lowestDiff){
				winners.add(bet);
			}
		}

		return true;
	}




}
