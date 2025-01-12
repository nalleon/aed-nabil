/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.dto;

/**
 * @author Nabil L. A. <@nalleon>
 */
public class BetDTO {
    /**
     * Properties
     */
    private String name;
    private Integer numBet;
    private Float betAmount;

    /**
     * Default constructor of the class
     */
    public BetDTO() {}

    /**
     * Full constructor of the class
     * @param name of the person betting
     * @param numBet of the selected num to bet
     * @param betAmount of the amount of money betted
     */
    public BetDTO(String name, Integer numBet, Float betAmount) {
        this.name = name;
        this.numBet = numBet;
        this.betAmount = betAmount;
    }

    /**
     * Getters
     */
    public String getName() {
        return name;
    }

    public Integer getNumBet() {
        return numBet;
    }

    public Float getBetAmount() {
        return betAmount;
    }
}
