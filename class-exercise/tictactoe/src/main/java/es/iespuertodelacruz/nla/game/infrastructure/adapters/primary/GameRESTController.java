package es.iespuertodelacruz.nla.game.infrastructure.adapters.primary;

import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.UserOutputDTO;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.UserRegisterDTO;
import es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto.UserUpdateInputDTO;
import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.primary.IGameService;
import es.iespuertodelacruz.nla.shared.utils.ApiResponse;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.password.PasswordEncoder;
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
    private IGameService service;


    /**
     * Setters of the user service
     * @param service of the user
     */
    @Autowired
    public void setService(IGameService service) {
        this.service = service;
    }


}