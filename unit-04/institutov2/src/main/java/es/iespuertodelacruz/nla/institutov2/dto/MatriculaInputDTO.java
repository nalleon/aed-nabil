package es.iespuertodelacruz.nla.institutov2.dto;

import java.util.List;

public record MatriculaInputDTO(Integer year, List<Integer> asignaturasId, String alumno) {
}
