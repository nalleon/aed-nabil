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
@RequestMapping("/api/v1/users")
public class GameRESTController {


    /**
     * Properties
     */
    private IGameService service;

    private PasswordEncoder passwordEncoder;

    /**
     * Setters of the user service
     * @param service of the user
     */
    @Autowired
    public void setService(IGameService service) {
        this.service = service;
    }

     /**
     * Setters of the user service
     * @param passwordEncoder of the role
     */
    @Autowired
    public void setPasswordEncoder(PasswordEncoder passwordEncoder) {
        this.passwordEncoder = passwordEncoder;
    }
    @GetMapping
    public ResponseEntity<?> getAll() {
        List<UserOutputDTO> filteredList = service.findAll().stream().map(usuario ->
                new UserOutputDTO(usuario.getName(), usuario.getEmail())).collect(Collectors.toList());

        if (filteredList.isEmpty()) {
            String message = "There are no users";
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, filteredList));
        }

        String message = "List successfully obtained";
        return ResponseEntity.ok(new ApiResponse<>(200, message, filteredList));
    }


    @GetMapping("/{id}")
    public ResponseEntity<?> getById(@PathVariable Integer id) {
        Game aux = service.findById(id);
        if (aux != null){
            UserOutputDTO dto =  new UserOutputDTO(aux.getName(), aux.getEmail());

            ApiResponse<UserOutputDTO> response = new ApiResponse<>(200, "User found", dto);
            return ResponseEntity.ok(response);
        }

        ApiResponse<UserOutputDTO> errorResponse = new ApiResponse<>(404, "User NOT found", null);
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(errorResponse);
    }

    @PostMapping
    public ResponseEntity<ApiResponse<?>> createUser(UserRegisterDTO registerDTO) {
        if (registerDTO == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "El usuario no puede ser nulo", null));
        }

        try {
            Game game = new Game();
            game.setName(registerDTO.name());
            game.setPassword(passwordEncoder.encode(registerDTO.password()));
            game.setEmail(registerDTO.email());

            Game dbItem = service.add(game.getName(), game.getEmail(), game.getPassword());

            UserOutputDTO result = new UserOutputDTO(dbItem.getName(), dbItem.getEmail());

            return ResponseEntity.status(HttpStatus.CREATED)
                    .body(new ApiResponse<>(201, "Usuario creado correctamente", result));

        } catch (RuntimeException e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, "Error al intentar registrar el usuario", null));
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<ApiResponse<?>> update(
            @PathVariable Integer id,
            @RequestBody UserUpdateInputDTO updateInputDTO) {

        if (updateInputDTO == null) {
            return ResponseEntity.badRequest()
                    .body(new ApiResponse<>(400, "User cannot be null", null));
        }

        Game dbItem = service.findById(id);

        if (dbItem == null) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(new ApiResponse<>(404, "User NOT found", null));
        }

        try {

            dbItem.setPassword(passwordEncoder.encode(updateInputDTO.password()));
            dbItem.setEmail(updateInputDTO.email());


            Game updatedDbItem = service.update(dbItem.getName(), dbItem.getEmail(), dbItem.getPassword());

            UserOutputDTO result = new UserOutputDTO(updatedDbItem.getName(), updatedDbItem.getEmail());

            return ResponseEntity.ok(new ApiResponse<>(200, "Update successful", result));

        } catch (RuntimeException e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, "Error while trying to update", null));
        }
    }
    @DeleteMapping("/{id}")
    public ResponseEntity<?> delete(@PathVariable Integer id) {
        if(id == 1){
            return ResponseEntity.status(HttpStatus.FORBIDDEN).body(
                    new ApiResponse<>(403, "", null));
        }

        boolean deleted = service.delete(id);

        if (deleted) {
            String message = "User deleted correctly";
            return ResponseEntity.status(HttpStatus.NO_CONTENT)
                    .body(new ApiResponse<>(204, message, null));
        } else {
            String message = "User not deleted";
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(new ApiResponse<>(500, message, null));
        }

    }
}