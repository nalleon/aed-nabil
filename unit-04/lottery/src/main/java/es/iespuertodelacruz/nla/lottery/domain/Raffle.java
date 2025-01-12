/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

import java.util.*;

/**
 * @author Nabil L. A. <@nalleon>
 */

public class Raffle {
	/**
	 * Properties
	 */
	 public Integer id;
	 private Integer winningNum;
	 private List<Bet> winners;
	 public Date startTime;
	 public Date endTime;
	 public List<Bet> currentBets;

	/**
	 * Default constructor of the class
	 * @param id of the raffle
	 */
	public Raffle(Integer id) {
		this.id = id;
		generateRndNum();
		this.winners = new ArrayList<>();
		selectDuration();
		this.currentBets = new ArrayList<>();
	}

	/**
	 * Full constructor of the class
	 * @param id of the raffle
	 * @param winningNum of the raffle
	 * @param winners of the raffle
	 * @param startTime of the raffle
	 * @param endTime of the raffle
	 * @param currentBets of the raffle
	 */
	public Raffle(Integer id, Integer winningNum, List<Bet> winners, Date startTime, Date endTime, List<Bet> currentBets) {
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
	private void selectDuration(){
		long time = 22000;
				//48000;

		startTime = new Date();
		endTime = new Date(startTime.getTime() + time);
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
	 * Method to check if the raffle is over
	 */
	public boolean isOverdueTime(){
		if(new Date().getTime() - endTime.getTime() >= 0){
			return true;
		}
		return false;
	}

	/**
	 * Method to select the winners of the raffle
	 */
	public void selectWinners(){
		if (!isOverdueTime()){
			return;
		}

		if (currentBets.size() == 1 && isOverdueTime()) {
			winners.add(currentBets.get(0));
			return;
		}

		if (currentBets.isEmpty() && isOverdueTime()) {
			winners.add(null);
			return;
		}

		Set<Integer> auxSet = new HashSet<>();

		for(Bet bet : currentBets){
			int difference = Math.abs(winningNum-bet.numBet);
			auxSet.add(difference);
		}

		List <Integer> sortedList = new ArrayList<>(auxSet);
		Collections.sort(sortedList);
		int lowestDiff = sortedList.get(0);

		for (Bet bet : currentBets){
			int difference = Math.abs(winningNum-bet.numBet);
			if (difference == lowestDiff){
				winners.add(bet);
			}
		}

	}

	/**
	 * Getters
	 */
	public Integer getWinningNum() {
		return winningNum;
	}

	public List<Bet> getWinners() {
		return winners;
	}
}
