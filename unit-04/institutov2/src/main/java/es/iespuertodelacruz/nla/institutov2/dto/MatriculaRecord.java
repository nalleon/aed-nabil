package es.iespuertodelacruz.nla.institutov2.dto;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;

import java.util.List;

public record MatriculaRecord (Integer year, List<AsignaturaRecord> listAsignaturas, AlumnoRecord alumnoRecord) {
}
