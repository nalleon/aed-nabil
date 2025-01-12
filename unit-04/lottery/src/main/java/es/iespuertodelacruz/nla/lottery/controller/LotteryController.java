/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.controller;

import es.iespuertodelacruz.nla.lottery.controller.interfaces.IController;
import es.iespuertodelacruz.nla.lottery.domain.Bet;
import es.iespuertodelacruz.nla.lottery.domain.Lottery;
import es.iespuertodelacruz.nla.lottery.domain.Raffle;
import es.iespuertodelacruz.nla.lottery.dto.BetDTO;
import es.iespuertodelacruz.nla.lottery.dto.RaffleDTO;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;

/**
 * @author Nabil L. A. <@nalleon>
 */
@RestController
@CrossOrigin
@RequestMapping("api/v1/lottery")
public class LotteryController implements IController {
    /**
     * Properties
     */
    private Lottery lottery;

    @Autowired
    public void setLottery(Lottery lottery){
        this.lottery = lottery;
    }

    @PostMapping("/raffles/{id}")
    @Override
    public ResponseEntity<?> add(@PathVariable int id, @RequestBody BetDTO betDTO) {

        if (lottery.getCurrentRaffle() == null ||
                lottery.getInstance().getCurrentRaffle().id != id) {

            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body
                    ("Error: This raffle does not exist or is closed ");
        }

        boolean result = lottery.getCurrentRaffle().
                placeBet(betDTO.getName(), betDTO.getNumBet(), betDTO.getBetAmount());

        if (!result){
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(
                    "Error. This raffle is closed. " +
                    "Current raffle is: " + lottery.getCurrentRaffle().id
            );
        }

        return ResponseEntity.ok("Ok. Bet successfully added");
    }


    @GetMapping("/raffles")
    @Override
    public ResponseEntity<List<RaffleDTO>> getAll() {
        List<RaffleDTO> result = new ArrayList<>();
        for (Raffle raffle : lottery.raffles){
            RaffleDTO raffleDTO = new RaffleDTO(
                    raffle.id,
                    raffle.getWinningNum(),
                    raffle.getWinners(),
                    raffle.startTime,
                    raffle.endTime,
                    raffle.currentBets
            );

            result.add(raffleDTO);
        }

        return ResponseEntity.ok(result);
    }

    @GetMapping("/raffles/{id}")
    @Override
    public ResponseEntity<RaffleDTO> getById(@PathVariable int id) {
        List<Raffle> auxList = lottery.raffles;

        boolean found = false;
        int arrPos = 0;
        RaffleDTO raffleDTO = null;

        while (!found){
            if(auxList.get(arrPos).id == id){
                 raffleDTO = new RaffleDTO(
                         auxList.get(arrPos).id,
                         auxList.get(arrPos).getWinningNum(),
                         auxList.get(arrPos).getWinners(),
                         auxList.get(arrPos).startTime,
                         auxList.get(arrPos).endTime,
                         auxList.get(arrPos).currentBets
                );
                 found = true;
            }
            arrPos++;
        }

        return ResponseEntity.ok(raffleDTO);
    }

    @GetMapping
    @Override
    public ResponseEntity<?> getLatest() {
        if (lottery.getCurrentRaffle().isOverdueTime() && lottery.getCurrentRaffle().getWinners().isEmpty()){
            lottery.getCurrentRaffle().selectWinners();
        }

        RaffleDTO raffleDTO = new RaffleDTO(
                lottery.getCurrentRaffle().id,
                lottery.getCurrentRaffle().getWinningNum(),
                lottery.getCurrentRaffle().getWinners(),
                lottery.getCurrentRaffle().startTime,
                lottery.getCurrentRaffle().endTime,
                lottery.getCurrentRaffle().currentBets
        );


        return ResponseEntity.ok(raffleDTO);
    }



}
