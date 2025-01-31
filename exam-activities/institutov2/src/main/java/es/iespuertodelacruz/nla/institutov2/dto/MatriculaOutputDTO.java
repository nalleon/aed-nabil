package es.iespuertodelacruz.nla.institutov2.dto;

import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record MatriculaOutputDTO(Integer year, List<AsignaturaDTO> asignaturas, AlumnoDTOV2 alumno) {
}
