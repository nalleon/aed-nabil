package es.iespuertodelacruz.nla.game.infrastructure.adapters.primary;


import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.primary.IGameService;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.GameDTO;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.GameListDTO;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.GamePlayDTO;
import es.iespuertodelacruz.nla.shared.utils.ApiResponse;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserJoinDTO;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.stream.Collectors;

@RestController
@CrossOrigin
@RequestMapping("/api/v3/games")
@Tag(name="v3", description = "For administrators")
public class GameRESTControllerV3 {


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
        List<GameListDTO> filteredList = gameService.findAll().stream().map(game ->
                new GameListDTO(game.getId(), game.getPlayer1().getName(), game.getPlayer2().getName(), game.getBoard(),
                        game.isFinished(), game.getCurrentTurn().getName())).collect(Collectors.toList());

        if (filteredList.isEmpty()) {
            String message = "There are no games";
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, filteredList));
        }

        String message = "List successfully obtained";
        return ResponseEntity.ok(new ApiResponse<>(200, message, filteredList));
    }

    @PostMapping
    public ResponseEntity<?> createNewGame(@RequestBody UserJoinDTO userDTO) {
        User aux = userService.findByUsername(userDTO.name());

        if (aux != null) {
            Game joinedGame = gameService.add(aux);
            return ResponseEntity.ok(new ApiResponse<>(204,
                    "Created new game with id: " + joinedGame.getId(), null));
        }

        return ResponseEntity.ok(new ApiResponse<>(404,
                "User with name: " + userDTO.name() + " NOT found", null));

    }


    @PostMapping("/{id}")
    public ResponseEntity<?> joinSelectedGame(@RequestParam Integer id, @RequestBody UserJoinDTO userDTO) {
        Game dbItem = gameService.findById(id);
        User aux = userService.findByUsername(userDTO.name());

        System.out.println(dbItem);

        if (dbItem != null) {
            dbItem.setPlayer2(aux);
            Game joinedGame = gameService.joinGame(id, aux);
            return ResponseEntity.ok(new ApiResponse<>(204, "Joined game with id: " + joinedGame.getId(),
                    null));
        } else {
            Game game = gameService.add(aux);
            return ResponseEntity.ok(new ApiResponse<>(200, "Game with id: " +id+ " not found. " +
                    "Created new game with id: " + game.getId(),
                    null));
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> updateGame(@RequestParam Integer id, @RequestBody GameDTO gameDTO) {
        Game dbItem = gameService.findById(id);

        if (dbItem != null) {
            User player1 = userService.findByUsername(gameDTO.player1());
            User player2 = userService.findByUsername(gameDTO.player2());

            Game update = gameService.update(id, player1, player2, gameDTO.board(), gameDTO.finished());
            return ResponseEntity.ok(new ApiResponse<>(204, "Updated game with id: " + update.getId(),
                    null));
        }

        return ResponseEntity.ok(new ApiResponse<>(400, "Error updating game with id: " +id, null));

    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> deleteGame(@RequestParam Integer id) {
        Game dbItem = gameService.findById(id);

        if (dbItem != null) {
            boolean deleted = gameService.delete(id);
            return ResponseEntity.ok(new ApiResponse<>(204, "Deleted game with id: " + id,
                    deleted));
        }

        return ResponseEntity.ok(new ApiResponse<>(400, "Error updating game with id: " +id, null));

    }
}