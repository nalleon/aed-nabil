package es.iespuertodelacruz.nla.institutov2.dto;

import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record UsuarioDTOV2V3(
        String nombre,
        String correo
) implements Serializable {

}