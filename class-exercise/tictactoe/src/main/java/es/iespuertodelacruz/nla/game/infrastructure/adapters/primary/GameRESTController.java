package es.iespuertodelacruz.nla.game.infrastructure.adapters.primary;


import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.primary.IGameService;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.GameDTO;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.GamePlayDTO;
import es.iespuertodelacruz.nla.shared.utils.ApiResponse;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserJoinDTO;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.stream.Collectors;

@RestController
@CrossOrigin
@RequestMapping("/api/v2/games")
public class GameRESTController {


    /**
     * Properties
     */
    private IGameService gameService;

    private IUserService userService;
    /**
     * Setters of the game service
     * @param gameService of the game
     */
    @Autowired
    public void setGameService(IGameService gameService) {
        this.gameService = gameService;
    }

    /**
     * Setters of the user service
     * @param userService of the user
     */
    @Autowired
    public void setUserService(IUserService userService) {
        this.userService = userService;
    }


    @GetMapping
    public ResponseEntity<?> getAll() {
        List<GameDTO> filteredList = gameService.findAll().stream().map(game ->
                new GameDTO(game.getPlayer1().getName(), game.getPlayer2().getName(), game.getBoard(), game.isFinished())).collect(Collectors.toList());

        if (filteredList.isEmpty()) {
            String message = "There are no games";
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, filteredList));
        }

        String message = "List successfully obtained";
        return ResponseEntity.ok(new ApiResponse<>(200, message, filteredList));
    }

    @PostMapping
    public ResponseEntity<?> joinCreateOpenGame(@RequestBody UserJoinDTO userDTO) {

        Game dbItem = gameService.findOpenGame();
        User aux = userService.findByUsername(userDTO.name());

        if (dbItem != null) {
            System.out.println("JOIN");
            dbItem.setPlayer2(aux);
            Game joinedGame = gameService.joinGame(dbItem.getId(), aux);
            return ResponseEntity.ok(new ApiResponse<>(204, "Joined game with id: " + joinedGame.getId(),
                    null));
        } else {
            Game game = gameService.add(aux);
            return ResponseEntity.ok(new ApiResponse<>(200, "Created new game with id: " + game.getId(),
                    null));
        }
    }


    @PostMapping("/bet/{id}")
    public ResponseEntity<?> play(@RequestParam int id, @RequestBody GamePlayDTO dto) {

        Game dbItem = gameService.play(id, dto.playername(), dto.posX(), dto.posY());

        if(dbItem == null){
            return ResponseEntity.ok(new ApiResponse<>(403, "Forbidden action",
                    null));
        }

        GameDTO result = new GameDTO(dbItem.getPlayer1().getName(), dbItem.getPlayer2().getName(), dbItem.getBoard(), dbItem.isFinished());

        return ResponseEntity.ok(new ApiResponse<>(200, "Played at (" + dto.posX() +", " + dto.posY()+")",
                result));
    }


//
//    @PostMapping("/{id}")
//    public ResponseEntity<?> joinSelectedGame(@RequestParam Integer id, @RequestBody UserJoinDTO userDTO) {
//        Game dbItem = gameService.findById(id);
//        User aux = userService.findByUsername(userDTO.name());
//
//        System.out.println(dbItem);
//
//        if (dbItem != null) {
//            System.out.println("JOIN");
//            dbItem.setPlayer2(aux);
//            Game joinedGame = gameService.joinGame(dbItem);
//            return ResponseEntity.ok(new ApiResponse<>(204, "Joined game with id: " + joinedGame.getId(),
//                    null));
//        } else {
//            Game game = gameService.add(aux);
//            return ResponseEntity.ok(new ApiResponse<>(200, "Game with id: " +id+ " not found. " +
//                    "Created new game with id: " + game.getId(),
//                    null));
//        }
//    }
}