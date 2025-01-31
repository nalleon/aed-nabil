package es.iespuertodelacruz.nla.institutov2.repository;

import es.iespuertodelacruz.nla.institutov2.entities.Asignatura;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;
import java.util.*;
import java.util.Optional;
/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Repository
public interface IAlumnoRepository extends JpaRepository<Alumno, String>{

	@Modifying
	//@Query("DELETE FROM Alumno a WHERE a.dni=:dni")
	@Query(
			value="DELETE FROM alumnos AS a WHERE a.dni=:dni",
			nativeQuery=true
	)
	int deleteAlumnoByDNI(@Param("dni") String dni);

	@Query(
			value="SELECT * FROM alumnos AS a WHERE a.nombre LIKE %:nombre%",
			nativeQuery=true
	)
	List<Alumno> findByNombre(@Param("nombre") String nombre);
}
