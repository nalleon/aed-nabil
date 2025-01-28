package es.iespuertodelacruz.nla.institutov2.dto;

import java.io.Serializable;

public record UsuarioLoginDTO(
        String nombre,
        String password
) implements Serializable {

}