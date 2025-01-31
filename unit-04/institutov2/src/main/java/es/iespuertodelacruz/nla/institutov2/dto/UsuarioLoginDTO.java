package es.iespuertodelacruz.nla.institutov2.dto;

import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record UsuarioLoginDTO(
        String nombre,
        String password
) implements Serializable {

}