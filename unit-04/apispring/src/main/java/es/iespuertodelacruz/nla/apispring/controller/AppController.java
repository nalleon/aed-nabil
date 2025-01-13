package es.iespuertodelacruz.nla.apispring.controller;

import es.iespuertodelacruz.nla.apispring.domain.Game;
import es.iespuertodelacruz.nla.apispring.utils.Globals;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/v1/numguesser")
@CrossOrigin
public class AppController {

    public static  class BetDTO{
        int bet;

        public BetDTO() {
        }

        public BetDTO(int bet) {
            this.bet = bet;
        }

        public int getBet() {
            return bet;
        }

        public void setBet(int bet) {
            this.bet = bet;
        }
    }
    @GetMapping
    public ResponseEntity<?> status(){
        Game instance = Game.getInstance();

        if (instance.isActive()){
            return ResponseEntity.ok("Current game is running with nums: " + Globals.MIN_RND_NUM + ", " +
                    Globals.MAX_RND_NUM);
        } else {
            return ResponseEntity.ok("Current game is not running. Start it via: /POST /api/v1/numguesser");
        }
    }

    @PostMapping
    public  ResponseEntity<?> reiniciar(){
        Game instance = Game.getInstance();
        boolean ok = instance.startRestartGame();

        if(!ok){
            return ResponseEntity.badRequest().body("Game is already running!");
        } else {
            return ResponseEntity.ok("Game successfully started! Nums between:" + Globals.MIN_RND_NUM + ", " +
                                        Globals.MAX_RND_NUM);
        }
    }


    @PostMapping("/bet")
    public  ResponseEntity<?> bet(@RequestBody BetDTO betDTO){
        Game instance = Game.getInstance();
        String message = instance.placeBet(betDTO.getBet());
        return ResponseEntity.ok(message);
    }
}
