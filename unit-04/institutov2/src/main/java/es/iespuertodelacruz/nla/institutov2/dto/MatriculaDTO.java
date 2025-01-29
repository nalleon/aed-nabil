package es.iespuertodelacruz.nla.institutov2.dto;

import java.util.List;

public record MatriculaDTO(Integer year, List<AsignaturaDTO> asignaturas, AlumnoDTOV2 alumno) {
}
