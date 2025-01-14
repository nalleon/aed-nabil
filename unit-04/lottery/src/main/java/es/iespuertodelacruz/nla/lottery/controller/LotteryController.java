/**
 * 
 */
package es.iespuertodelacruz.nla.lottery.controller;

import es.iespuertodelacruz.nla.lottery.controller.interfaces.IController;
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


    @PostMapping("/raffles/{id}")
    @Override
    public ResponseEntity<?> add(@PathVariable int id, @RequestBody BetDTO betDTO) {
        Lottery instance = Lottery.getInstance();

        if (instance.getCurrentRaffle() == null ||
                instance.getCurrentRaffle().getId() != id) {

            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body
                    ("Error: This raffle does not exist or is closed ");
        }

        boolean result = instance.getCurrentRaffle().
                placeBet(betDTO.getName(), betDTO.getNumBet(), betDTO.getBetAmount());

        if (!result){
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(
                    "Error. This raffle is closed. " +
                    "Current raffle is: " + instance.getCurrentRaffle().getId()
            );
        }

        return ResponseEntity.ok("Ok. Bet successfully added");
    }


    @GetMapping("/raffles")
    @Override
    public ResponseEntity<List<RaffleDTO>> getAll() {
        Lottery instance = Lottery.getInstance();

        List<RaffleDTO> result = new ArrayList<>();
        for (Raffle raffle : instance.getRaffles()){
            RaffleDTO raffleDTO = new RaffleDTO(
                    raffle.getId(),
                    raffle.getWinningNum(),
                    raffle.getWinners(),
                    raffle.getStartTime(),
                    raffle.getEndTime(),
                    raffle.getCurrentBets()
            );

            result.add(raffleDTO);
        }

        return ResponseEntity.ok(result);
    }

    @GetMapping("/raffles/{id}")
    @Override
    public ResponseEntity<RaffleDTO> getById(@PathVariable int id) {
        Lottery instance = Lottery.getInstance();
        List<Raffle> auxList = instance.getRaffles();

        boolean found = false;
        int arrPos = 0;
        RaffleDTO raffleDTO = null;

        while (!found){
            if(auxList.get(arrPos).getId() == id){
                 raffleDTO = new RaffleDTO(
                         auxList.get(arrPos).getId(),
                         auxList.get(arrPos).getWinningNum(),
                         auxList.get(arrPos).getWinners(),
                         auxList.get(arrPos).getStartTime(),
                         auxList.get(arrPos).getEndTime(),
                         auxList.get(arrPos).getCurrentBets()
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
        Lottery instance = Lottery.getInstance();

        if (instance.getCurrentRaffle().isOverdueTime() && instance.getCurrentRaffle().getWinners().isEmpty()){
            instance.getCurrentRaffle().selectWinners();
        }

        RaffleDTO raffleDTO = new RaffleDTO(
                instance.getCurrentRaffle().getId(),
                instance.getCurrentRaffle().getWinningNum(),
                instance.getCurrentRaffle().getWinners(),
                instance.getCurrentRaffle().getStartTime(),
                instance.getCurrentRaffle().getEndTime(),
                instance.getCurrentRaffle().getCurrentBets()
        );


        return ResponseEntity.ok(raffleDTO);
    }



}
