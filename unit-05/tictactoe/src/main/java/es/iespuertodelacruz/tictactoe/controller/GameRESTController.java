package es.iespuertodelacruz.tictactoe.controller;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("tictactoe/api")
@CrossOrigin
public class GameRESTController {

    @GetMapping("/games/{id}")
    public ResponseEntity<?> getSelectedGame(){

        return ResponseEntity.ok("");
    }

    @PostMapping("/games/{id}/bet")
    public ResponseEntity<?> betInGame(){
        return ResponseEntity.ok("");
    }

    @GetMapping("/games")
    public ResponseEntity<?> getAllGames(){
        return ResponseEntity.ok("");
    }

    @PostMapping("/games")
    public ResponseEntity<?> createNewGame(){
        return ResponseEntity.ok("");
    }
}
