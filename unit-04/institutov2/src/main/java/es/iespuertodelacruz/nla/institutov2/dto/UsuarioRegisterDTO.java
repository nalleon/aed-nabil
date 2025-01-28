package es.iespuertodelacruz.nla.institutov2.dto;
import java.io.Serializable;

public record UsuarioRegisterDTO(
                 String nombre,
                 String correo,
                 String password
) implements Serializable {

}