/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.dto;

import es.iespuertodelacruz.nla.lottery.domain.Bet;

import java.util.Date;
import java.util.List;

/**
 * @author Nabil L. A. <@nalleon>
 */
public class RaffleDTO {
    /**
     * Properties
     */
    private int id;
    private Integer winningNum;
    private List<Bet> winners;
    private Date startTime;
    private Date endTime;
    private List<Bet> currentBets;

    /**
     * Full constructor of the raffle
     * @param id of the raffle
     * @param winningNum of the raffle
     * @param winners of the raffle
     * @param startTime of the raffle
     * @param endTime of the raffle
     * @param currentBets of the raffle
     */
    public RaffleDTO(int id, Integer winningNum, List<Bet> winners, Date startTime, Date endTime, List<Bet> currentBets) {
        this.id = id;
        this.winningNum = winningNum;
        this.winners = winners;
        this.startTime = startTime;
        this.endTime = endTime;
        this.currentBets = currentBets;
    }

    /**
     * Getters
     */
    public int getId() {
        return id;
    }

    public Integer getWinningNum() {
        if ((new Date().getTime() - endTime.getTime() >= 0)){
            return winningNum;
        }

        return null;
    }

    public List<Bet> getWinners() {
        if ((new Date().getTime() - endTime.getTime() >= 0)){
            return winners;
        }

        return null;
    }

    public Date getStartTime() {
        return startTime;
    }

    public Date getEndTime() {
        return endTime;
    }

    public List<Bet> getCurrentBets() {
        return currentBets;
    }
}
