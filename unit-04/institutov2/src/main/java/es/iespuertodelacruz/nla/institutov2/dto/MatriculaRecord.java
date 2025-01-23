package es.iespuertodelacruz.nla.institutov2.dto;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;

import java.util.List;

public record MatriculaRecord (Integer id, Integer year, List<AsignaturaRecord> list) {
}
