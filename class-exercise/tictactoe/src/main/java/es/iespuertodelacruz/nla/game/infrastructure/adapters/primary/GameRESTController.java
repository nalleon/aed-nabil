package es.iespuertodelacruz.nla.game.infrastructure.adapters.primary;


import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.primary.IGameService;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.GameDTO;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.GamePlayDTO;
import es.iespuertodelacruz.nla.shared.security.JwtService;
import es.iespuertodelacruz.nla.shared.utils.ApiResponse;
import es.iespuertodelacruz.nla.shared.utils.AuthCheck;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserJoinDTO;
import io.swagger.v3.oas.annotations.tags.Tag;
import jakarta.servlet.http.HttpServletRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

import static es.iespuertodelacruz.nla.shared.security.JwtFilter.authHeader;
import static es.iespuertodelacruz.nla.shared.security.JwtFilter.authHeaderTokenPrefix;

@RestController
@CrossOrigin
@RequestMapping("/api/v2/games")
@Tag(name="v2", description = "For authenticated users")
public class GameRESTController extends AuthCheck {


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
    public ResponseEntity<?> joinCreateOpenGame(HttpServletRequest request, @RequestBody UserJoinDTO userDTO) {

        ResponseEntity<ApiResponse<?>> check = checkSameUserInRequest(request, userDTO.name());
        if (check.getStatusCode() != HttpStatus.OK) {
            return check;
        }

        Game dbItem = gameService.findOpenGame();
        User aux = userService.findByUsername(userDTO.name());

        if (dbItem != null) {
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
    public ResponseEntity<?> bet(HttpServletRequest request, @RequestParam int id, @RequestBody GamePlayDTO dto) {

        Game aux = gameService.findById(id);

        ResponseEntity<ApiResponse<?>> check = checkUserInGame(request, aux);

        if (check.getStatusCode() != HttpStatus.OK) {
            return check;
        }


        Game dbItem = gameService.play(id, dto.playername(), dto.posX(), dto.posY());

        if(dbItem == null){
            return ResponseEntity.ok(new ApiResponse<>(403, "Forbidden action",
                    null));
        }


        GameDTO result = new GameDTO(dbItem.getPlayer1().getName(), dbItem.getPlayer2().getName(), dbItem.getBoard(), dbItem.isFinished());

        String message = dto.playername() + " played at (" + dto.posX() +", " + dto.posY()+")";

        if(result.finished()){
            message = "Game finished with victory for: ";
            if(dbItem.getCurrentTurn() != dbItem.getPlayer1()){
                message += dbItem.getPlayer1().getName();
            }
            message += dbItem.getPlayer2().getName();
        }

        return ResponseEntity.ok(new ApiResponse<>(200, message, result));
    }
}