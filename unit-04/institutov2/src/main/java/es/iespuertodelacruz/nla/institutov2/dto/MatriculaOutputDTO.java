package es.iespuertodelacruz.nla.institutov2.dto;

import java.util.List;

public record MatriculaOutputDTO(Integer year, List<AsignaturaDTO> asignaturas, AlumnoDTOV2 alumno) {
}
