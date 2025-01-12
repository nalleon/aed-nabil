/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.controller;

import es.iespuertodelacruz.nla.lottery.controller.interfaces.IController;
import es.iespuertodelacruz.nla.lottery.domain.Bet;
import es.iespuertodelacruz.nla.lottery.domain.Lottery;
import es.iespuertodelacruz.nla.lottery.domain.Raffle;
import es.iespuertodelacruz.nla.lottery.dto.BetDTO;
import es.iespuertodelacruz.nla.lottery.dto.LotteryDTO;
import es.iespuertodelacruz.nla.lottery.dto.RaffleDTO;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Date;
import java.util.List;

/**
 * @author Nabil L. A. <@nalleon>
 */
@RestController
@CrossOrigin
@RequestMapping("api/v1/lottery")
public class LotteryController implements IController {
    private Lottery lottery;
    @Autowired
    public void setLottery(Lottery lottery){
        this.lottery = lottery;
    }

    @PostMapping("/raffles/{id}")
    @Override
    public ResponseEntity<?> add(@PathVariable int id, @RequestBody BetDTO betDTO) {

        boolean result = bet(id, betDTO.getName(), betDTO.getNumBet(), betDTO.getBetAmount());

        if (!result){
            return ResponseEntity.ok("Error. " +
                    "This raffle is closed. Current raffle is: " + lottery.getCurrentRaffle().id);
        }

        return ResponseEntity.ok("Ok. Bet successfully added");
    }



    /**
     * Method to bet in the raffle
     * @param idRaffle of the raffle
     * @param name of the user
     * @param numBet of the selected num to bet on
     * @param betAmount of the selected amount of money bet
     * @return
     */
    private boolean bet(int idRaffle, String name, Integer numBet, Float betAmount){
        if (lottery.getCurrentRaffle() == null) {
            return false;
        }

        if((lottery.getCurrentRaffle().id != idRaffle) && (new Date().getTime() -
                lottery.getCurrentRaffle().endTime.getTime() >= 0)){
            return false;
        }

        Bet bet = new Bet(name, numBet, betAmount);
        lottery.getCurrentRaffle().currentBets.add(bet);

        return true;
    }

    @GetMapping("/raffles")
    @Override
    public ResponseEntity<List<RaffleDTO>> getAll() {
        return null;
    }

    @GetMapping("/raffles/{id}")
    @Override
    public ResponseEntity<RaffleDTO> getById(@PathVariable int id) {
        return null;
    }

    @GetMapping
    @Override
    public ResponseEntity<?> getLatest() {
        return ResponseEntity.ok(lottery.getCurrentRaffle());
    }



}
