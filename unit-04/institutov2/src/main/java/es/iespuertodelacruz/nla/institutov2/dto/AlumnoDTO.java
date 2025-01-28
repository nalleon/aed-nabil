package es.iespuertodelacruz.nla.institutov2.dto;

import java.util.Date;


public record AlumnoDTO(String dni, String apellidos, Date fechanacimiento, String nombre){};
