package es.iespuertodelacruz.nla.user.infrastructure.adapters.primary;

import es.iespuertodelacruz.nla.shared.utils.ApiResponse;
import es.iespuertodelacruz.nla.shared.utils.FileStorageService;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserOutputDTO;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserRegisterDTO;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserUpdateInputDTO;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import java.util.Date;
import java.util.List;
import java.util.UUID;
import java.util.stream.Collectors;
import java.io.IOException;
import java.net.URLConnection;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.List;
import java.util.logging.Logger;
import java.util.stream.Collectors;
import org.springframework.core.io.Resource;

@RestController
@CrossOrigin
@RequestMapping("/api/v3/users")
@Tag(name="v3", description = "For administrators")
public class UserRESTController {


    /**
     * Properties
     */
    private IUserService service;

    private FileStorageService storageService;

    private PasswordEncoder passwordEncoder;

    /**
     * Setters of the user service
     * @param service of the user
     */
    @Autowired
    public void setService(IUserService service) {
        this.service = service;
    }

    /**
     * Setters of the user service
     * @param storageService of the user
     */
    @Autowired
    public void setStorageService(FileStorageService storageService) {
        this.storageService = storageService;
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
        User aux = service.findById(id);
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
            User user = new User();
            user.setName(registerDTO.name());
            user.setPassword(passwordEncoder.encode(registerDTO.password()));
            user.setEmail(registerDTO.email());

            User dbItem = service.add(user.getName(), user.getEmail(), user.getPassword());

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

        User dbItem = service.findById(id);

        if (dbItem == null) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body(new ApiResponse<>(404, "User NOT found", null));
        }

        try {

            dbItem.setPassword(passwordEncoder.encode(updateInputDTO.password()));
            dbItem.setEmail(updateInputDTO.email());


            User updatedDbItem = service.update(dbItem.getName(), dbItem.getEmail(), dbItem.getPassword());

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


    @PostMapping(value = "/upload/{username}", consumes = MediaType.MULTIPART_FORM_DATA_VALUE)
    public ResponseEntity<?> uploadFile(@RequestParam("username") String username, @RequestParam("file") MultipartFile file) {
        String message = "";
        try {
            String namefile = storageService.save(file);
            message = "" + namefile;

            User aux = service.findByUsername(username);

            aux.setProfilePicture(namefile);

            User result = service.updatePicture(aux.getName(), aux.getEmail(), aux.getPassword(), aux.getProfilePicture());

            return ResponseEntity.status(HttpStatus.OK).body(new ApiResponse<>(200, message, result));
        } catch (Exception e) {
            message = "Could not upload the file: " + file.getOriginalFilename()
                    + ". Error: " + e.getMessage();
            return ResponseEntity.status(HttpStatus.EXPECTATION_FAILED).body(new ApiResponse<>(417, message, null));
        }
    }

    @GetMapping("/img/{filename}")
    public ResponseEntity<?> getFiles(@PathVariable String filename) {
        Resource resource = storageService.get(filename);

        String contentType = null;
        try {
            contentType = URLConnection.guessContentTypeFromStream(resource.getInputStream());
        } catch (IOException ex) {
            System.out.println("Could not determine file type.");
        }

        if (contentType == null) {
            contentType = "application/octet-stream";
        }
        String headerValue = "attachment";
        filename="" +
                resource.getFilename() + "";
        return ResponseEntity.
                ok()
                .contentType(MediaType.parseMediaType(contentType))
                .header(
                        org.springframework.http.HttpHeaders.
                                CONTENT_DISPOSITION,
                        headerValue
                )
                .body(resource);
    }
}