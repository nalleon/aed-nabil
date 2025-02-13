package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;

import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record UserOutputDTO(
        String nombre,
        String correo
) implements Serializable {

}