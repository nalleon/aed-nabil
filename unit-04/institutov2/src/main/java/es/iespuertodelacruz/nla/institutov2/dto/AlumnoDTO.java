package es.iespuertodelacruz.nla.institutov2.dto;

import es.iespuertodelacruz.nla.institutov2.entities.Matricula;

import java.util.Date;
import java.util.List;


public record AlumnoDTO (String dni, String apellidos, Date fechanacimiento, String nombre, List<Matricula> matriculas){};
