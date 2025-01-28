package es.iespuertodelacruz.nla.institutov2.dto;
import java.io.Serializable;
import java.util.Date;

public record UsuarioDTO(
                 String nombre,
                 String correo,
                 String password
) implements Serializable {

}