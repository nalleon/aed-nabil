package es.iespuertodelacruz.nla.institutov2.dto;
import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record UsuarioRegisterDTO(
                 String nombre,
                 String correo,
                 String password
) implements Serializable {

}