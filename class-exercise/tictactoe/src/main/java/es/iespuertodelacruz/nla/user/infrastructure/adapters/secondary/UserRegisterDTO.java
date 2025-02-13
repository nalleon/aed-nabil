package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary;
import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record UserRegisterDTO(
        String name,
        String email,
        String password
) implements Serializable {

}