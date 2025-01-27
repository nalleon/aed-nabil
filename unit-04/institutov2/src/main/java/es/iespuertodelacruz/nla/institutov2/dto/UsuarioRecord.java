package es.iespuertodelacruz.nla.institutov2.dto;
import java.io.Serializable;
import java.util.Date;

public record UsuarioRecord( String dni,
                             String nombre,
                             String correo,
                             Date fechaCreacion,
                             String password,
                             String rol
) implements Serializable {

}
