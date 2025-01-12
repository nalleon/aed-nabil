/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

import org.springframework.stereotype.Component;

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
	private boolean selectDuration(){
		long time = 36000*2;

		startTime = new Date();
		endTime = new Date(startTime.getTime() + time);

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
	public boolean selectWinners(){
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
