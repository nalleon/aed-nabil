package es.iespuertodelacruz.nla.institutov2.dto;

import java.io.Serializable;

public record UsuarioUpdateDTO(
        String correo,
        String password
) implements Serializable {

}