package es.iespuertodelacruz.nla.institutov2.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.nla.institutov2.entities.Alumno;

@Repository
public interface IAlumnoRepository extends JpaRepository<Alumno, String>{

	@Modifying
	//@Query("DELETE FROM Alumno a WHERE a.dni=:dni")
	@Query(
			value="DELETE FROM Alumno a WHERE a.dni =:dni",
			nativeQuery=true
	)
	int deleteAlumnoByDNI(@Param("dni") String dni);
}
