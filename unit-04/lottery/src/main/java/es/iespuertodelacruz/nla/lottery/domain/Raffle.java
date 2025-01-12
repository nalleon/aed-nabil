/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.domain;

import java.util.Date;
import java.util.List;
import java.util.Random;

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


	private void generateRndNum(){
		int start = 0;
		int end = 10000;

		Random rnd = new Random();
        winningNum = rnd.nextInt(start, end);
	}

	private boolean selectWinners(){
		if ((new Date().getTime() - endTime.getTime() <= 0)){
			return false;
		}

		return true;
	}




}
